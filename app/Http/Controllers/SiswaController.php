<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $siswas = Siswa::all();
        return view('siswas.index', compact('siswas', 'kelas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat' => 'required|string|max:255',
            'tgl' => 'required|date',
            'alamat' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'email' => 'required|string|email|max:255|unique:siswas',
            'telepon' => 'nullable|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $request->all();

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('siswa'), $imageName);
            $validatedData['foto'] = $imageName;
        }

        Siswa::create($validatedData);

        return response()->json(['success' => 'Siswa berhasil ditambahkan'], 200);
    }


    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string' . $siswa->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat' => 'required|string|max:255',
            'tgl' => 'required|date',
            'alamat' => 'string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'email' => 'required|string|email|max:255' . $siswa->id,
            'telepon' => 'nullable|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $validatedData = $request->all();

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('siswa'), $imageName);
            $validatedData['foto'] = $imageName;
        }

        $siswa->update($validatedData);

        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('siswas.create', compact('kelas'));
    }

    public function show(Siswa $siswa)
    {
        return view('siswas.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('siswas.edit', compact('siswa', 'kelas'));
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $gurus = Guru::all();
        return view('gurus.index', compact('gurus'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat' => 'required|string|max:255',
            'tgl' => 'required|date',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:gurus',
            'telepon' => 'nullable|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $request->all();

        // Penanganan unggahan foto
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('guru'), $imageName);
            $validatedData['foto'] = $imageName;
        }

        // Buat entri Guru baru
        Guru::create($validatedData);

        // Return success response
        return response()->json(['success' => 'Guru berhasil ditambahkan.'], 200);
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string' . $guru->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat' => 'required|string|max:255',
            'tgl' => 'required|date',
            'alamat' => 'string|max:255',
            'email' => 'required|string|email|max:255' . $guru->id,
            'telepon' => 'nullable|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $validatedData = $request->all();

        // Penanganan unggahan foto
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('guru'), $imageName);
            $validatedData['foto'] = $imageName;
        }

        // Update entri Guru
        $guru->update($validatedData);

        // Redirect to a specific route after successful update
        return redirect()->route('gurus.index')->with('success', 'Guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('gurus.index')->with('success', 'Guru berhasil dihapus.');
    }
}

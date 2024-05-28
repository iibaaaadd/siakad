<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('searchdocs');
        $gurus = Guru::query();

        if ($search) {
            $gurus->where(function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('nip', 'LIKE', "%{$search}%")
                    ->orWhere('tempat', 'LIKE', "%{$search}%")
                    ->orWhere('tgl', 'LIKE', "%{$search}%")
                    ->orWhere('alamat', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('telepon', 'LIKE', "%{$search}%");
            });
        }

        $gurus = $gurus->get();

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


    public function edit(Guru $guru)
    {
        return view('gurus.edit', compact('guru'));
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('gurus.index')->with('success', 'Guru berhasil dihapus.');
    }

    public function search(Request $request)
    {
        // Ambil nilai pencarian dari permintaan
        $searchQuery = $request->input('search');

        // Lakukan pencarian berdasarkan nama atau NIP guru
        $gurus = Guru::where('nama', 'like', "%$searchQuery%")
            ->orWhere('nip', 'like', "%$searchQuery%")
            ->get();

        // Kembalikan tampilan parsial dengan data guru yang difilter
        return view('partials.guru_list')->with('gurus', $gurus);
    }
}

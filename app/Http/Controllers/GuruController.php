<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

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
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat' => 'required|string|max:255',
            'tgl' => 'required|date',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:gurus',
            'telepon' => 'nullable|string|max:15',
        ]);

        // Penanganan unggahan foto
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('guru'), $imageName);
            $validatedData['foto'] = $imageName;
        }

        // Buat entri Guru baru
        Guru::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('gurus.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:gurus,nip,' . $guru->id,
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tempat' => 'required',
            'tgl' => 'required|date',
            'alamat' => 'required',
            'email' => 'required|email|unique:gurus,email,' . $guru->id,
            'telepon' => 'nullable',
        ]);

        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('/guru'), $fotoName);
            $guru->foto = $fotoName;
        }

        $guru->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('gurus.index')->with('success', 'Guru berhasil diperbarui.');
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

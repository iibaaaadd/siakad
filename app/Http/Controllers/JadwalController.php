<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $jadwals = Jadwal::all();
        $gurus = Guru::all();
        $kelas = Kelas::all();
        $mapels = Mapel::all();
        return view('jadwal.index', compact('jadwals', 'gurus', 'kelas', 'mapels'));
    }

    public function create()
    {
        $jadwals = Jadwal::all();
        $gurus = Guru::all();
        $kelas = Kelas::all();
        $mapels = Mapel::all();
        return view('jadwal.create', compact('jadwals', 'gurus', 'kelas', 'mapels'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // Simpan data jadwal baru
        Jadwal::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Jadwal $jadwal)
    {
        // Tampilkan form untuk mengedit jadwal
        return view('jadwals.edit', compact('jadwal'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        // Validasi input
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'kelas_id' => 'exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // Update data jadwal
        $jadwal->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        // Hapus jadwal
        $jadwal->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('jadwals.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}

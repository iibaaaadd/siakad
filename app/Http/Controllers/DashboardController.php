<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Jadwal;


use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        $siswas = Siswa::all();
        $siswa = Siswa::count();
        $gurus = Guru::all();
        $guru = Guru::count();
        $kelas = Kelas::count();
        $mapels = Mapel::count();
        return view('dashboard', compact('siswas', 'jadwals', 'siswa','guru', 'gurus', 'kelas', 'mapels'));
    }
}

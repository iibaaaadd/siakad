<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Mapel;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $siswas = Siswa::count();
        $gurus = Guru::count();
        $kelas = Kelas::count();
        $mapels = Mapel::count();
        return view('dashboard', compact('siswas', 'gurus', 'kelas', 'mapels'));
    
    }
}

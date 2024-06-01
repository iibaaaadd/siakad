<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Kelas::create($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas created successfully.');
    }
    
    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $kela->update($request->all());
        return redirect()->route('kelas.index')->with('success', 'Kelas updated successfully.');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas deleted successfully.');
    }
}

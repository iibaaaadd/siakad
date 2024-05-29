<?php


namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::all();
        return view('mapels.index', compact('mapel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Mapel::create($request->all());
        return redirect()->route('mapel.index')->with('success', 'Kelas created successfully.');
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $mapel->update($request->all());
        return redirect()->route('mapel.index')->with('success', 'Kelas updated successfully.');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route('mapel.index')->with('success', 'Kelas deleted successfully.');
    }
}

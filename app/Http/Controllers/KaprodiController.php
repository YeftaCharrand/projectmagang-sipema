<?php

namespace App\Http\Controllers;

use App\Models\Kaprodi;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index()
    {
        $kaprodis = Kaprodi::all();
        return view('kaprodi.index', compact('kaprodis'));
    }

    public function create()
    {
        return view('kaprodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:kaprodi',
            'kode_dosen' => 'required|unique:kaprodi',
            'nip' => 'required|unique:kaprodi',
            'name' => 'required',
        ]);

        Kaprodi::create($request->all());

        return redirect()->route('kaprodi.index')->with('success', 'Kaprodi created successfully.');
    }

    public function show(Kaprodi $kaprodi)
    {
        return view('kaprodi.show', compact('kaprodi'));
    }

    public function edit(Kaprodi $kaprodi)
    {
        return view('kaprodi.edit', compact('kaprodi'));
    }

    public function update(Request $request, Kaprodi $kaprodi)
    {
        $request->validate([
            'user_id' => 'required|unique:kaprodi,user_id,' . $kaprodi->id,
            'kode_dosen' => 'required|unique:kaprodi,kode_dosen,' . $kaprodi->id,
            'nip' => 'required|unique:kaprodi,nip,' . $kaprodi->id,
            'name' => 'required',
        ]);

        $kaprodi->update($request->all());

        return redirect()->route('kaprodi.index')->with('success', 'Kaprodi updated successfully.');
    }

    public function destroy(Kaprodi $kaprodi)
    {
        $kaprodi->delete();

        return redirect()->route('kaprodi.index')->with('success', 'Kaprodi deleted successfully.');
    }
}

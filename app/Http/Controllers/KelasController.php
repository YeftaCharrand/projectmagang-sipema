<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function indexKelas()
    {
        $kelas = Kelas::all();
        return view('kelas', compact('kelas'));
    }

    public function createKelas()
    {
        return view('kelas');
    }

    public function storeKelas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function updateKelas(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);
    
        // Tangani nilai null secara eksplisit
        $data = $request->only(['name', 'jumlah']);
    
        // Cari kelas berdasarkan id dan update data
        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->update($data);
    
        } catch (Exception $e) {
            dd($e);
        }
    
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $kelas = Kelas::where('name', 'like', '%' . $query . '%')->get();

        return view('kelas', [
            'kelas' => $kelas
        ]);
    }

    public function destroyKelas(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function indexDosen()
    {
        // Menggunakan all() untuk mendapatkan semua data
        $dosen = Dosen::all(); 
        return view('dosen', compact('dosen'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
    
        $dosen = Dosen::where('name', 'LIKE', "%{$query}%")
                      ->orWhere('nip', 'LIKE', "%{$query}%")
                      ->orWhere('kode_dosen', 'LIKE', "%{$query}%")
                      ->get();    
        return view('dosen', [
            'dosen' => $dosen
        ]);
    }

    public function storeDosen(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'kode_dosen' => 'required|string',
            'nip' => 'required|string',
            'name' => 'required|string',
        ]);

        // Tentukan nilai default untuk password dan role
        $password = 'password12345';
        $role = 'dosen';

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($password), // Password default
            'role' => $role // Role default
        ]);

        // Simpan data dosen baru dengan user_id dari user yang baru dibuat
        Dosen::create([
            'user_id' => $user->id,
            'kode_dosen' => $request->input('kode_dosen'),
            'nip' => $request->input('nip'),
            'name' => $request->input('name'),
        ]);
        
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function updateDosen(Request $request, $kode_dosen)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Tangani nilai null secara eksplisit
        $data = $request->only(['name']);
        
        if ($request->has('kelas_id')) {
            $data['kelas_id'] = $request->filled('kelas_id') ? $request->input('kelas_id') : null;
        }

        // Cari dosen berdasarkan kode_dosen dan update data
        try {
            $dosen = Dosen::where('kode_dosen', $kode_dosen)->firstOrFail();
            $dosen->update($data);
            
        } catch (Exception $e) {
            dd($e);
        }
        
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroyDosen(Dosen $dosen)
    {
        // Menghapus data user yang terkait dengan dosen
        $dosen->user->delete();

        // Menghapus data dosen
        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Data dosen dan user berhasil dihapus.');
    }

}

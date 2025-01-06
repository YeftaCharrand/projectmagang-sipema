<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaRoleKaprodiController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function indexMahasiswa()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mhs', compact('mahasiswa'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $mahasiswa = Mahasiswa::where('nama', 'LIKE', "%{$query}%")
                      ->orWhere('nim', 'LIKE', "%{$query}%")
                      ->get();

        return view('mhs', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function storeMahasiswa(Request $request)
    {
        // ($request->all());
        // validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'nim' => 'required|integer|unique:mahasiswa,nim',
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'nullable|exists:kelas,id' // Validasi optional kelas_id
        ]);

        // Tentukan nilai default untuk password, role, dan edit
        $password = 'password12345';
        $role = 'mahasiswa';
        //$edit = false;

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($password), // Password default
            'role' => $role // Role default
        ]);

        // Simpan data mahasiswa baru dengan user_id dari user yang baru dibuat
        Mahasiswa::create([
            'user_id' => $user->id,
            // 'kelas_id' => $request->filled('kelas_id') ? $request->input('kelas_id') : null,
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'kelas_id' => $request->filled('kelas_id') ? $request->input('kelas_id') : null,
            'edit' => false // Edit default false
        ]);

        return redirect()->route('mhs.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function updateMahasiswa(Request $request, $nim)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            // 'kelas_id' => 'nullable|exists:kelas,id' // Validasi kelas_id jika ada
        ]);

        // Tangani nilai null secara eksplisit
        $data = $request->only(['nim', 'nama', 'tempat_lahir', 'tanggal_lahir']);
        
        if ($request->has('kelas_id')) {
            $data['kelas_id'] = $request->filled('kelas_id') ? $request->input('kelas_id') : null;
        }

        // Cari mahasiswa berdasarkan id dan update data
        try {
            $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
            $mahasiswa->update($data);
            
        } catch (Exception $e) {
            dd($e);
        }
        
        return redirect()->route('mhs.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('cobaeditmhs', compact('mahasiswa'));
    }

    public function destroyMahasiswa(Mahasiswa $mahasiswa){
        // Menghapus data user yang terkait dengan mahasiswa
        $mahasiswa->user()->delete();

        // Menghapus data mahasiswa
        $mahasiswa->delete();
        return redirect()->route('mhs.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

}

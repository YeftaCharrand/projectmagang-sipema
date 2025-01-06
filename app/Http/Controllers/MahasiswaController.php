<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function profilemahasiswa(){
        $mahasiswas = Mahasiswa::where('user_id', auth()->user()->id)->get();
        // $mahasiswas = Mahasiswa::with('kelas' )->get();
        $kelasList = Kelas::all();

        return view('mahasiswa.profilemahasiswa', compact('mahasiswas', 'kelasList'));
    }
    
    public function store(Request $request)
    {
        // Ambil data dari request
        $data = [
            'mahasiswa_id' => $request->input('mahasiswa_id'),
            'kelas_id' => $request->input('kelas_id'),
            'keterangan' => $request->input('keterangan'),
        ];

        // Menyimpan permintaan ke dalam tabel requests
        UserRequest::create($data);

        // Update status request_edit pada tabel mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($request->input('mahasiswa_id'));
        $mahasiswa->update(['request_edit' => true]);

        return redirect()->route('mahasiswa.index')->with('success', 'Permintaan edit telah dikirim.');
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Cek apakah password lama diinputkan dan sesuai
        if ($request->filled('password') && !Hash::check($request->input('password_old'), Auth::user()->password)) {
            return redirect()->back()->withErrors(['password_old' => 'Password lama tidak sesuai']);
        }

        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->kelas_id = $request->kelas_id;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;

        // Cek apakah input email diisi, jika ya baru update
        if ($request->filled('email')) {
            $mahasiswa->user->email = $request->input('email');
        }

        // Cek apakah input password diisi, jika ya baru update
        if ($request->filled('password')) {
            $mahasiswa->user->password = Hash::make($request->input('password'));
        }

        // Cek apakah input username diisi, jika ya baru update
        if ($request->filled('username')) {
            $mahasiswa->user->username = $request->input('username');
        }

        $mahasiswa->edit = 0; // Set edit to 0 after update
        $mahasiswa->save();
        $mahasiswa->user->save(); // Simpan perubahan pada user terkait

        UserRequest::where('mahasiswa_id', $id)->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }
}
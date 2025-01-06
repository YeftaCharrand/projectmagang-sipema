<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenRoleController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        // Mengambil data dosen yang sedang login
        $dosen = $user->dosen;
        $isDosenWali = $request->attributes->get('is_dosen_wali');

        // Tentukan nama kelas atau kosongkan jika bukan dosen wali
        $kelas = $isDosenWali && $dosen->kelas ? $dosen->kelas->name : '';

        if ($isDosenWali) {
            // Dosen wali melihat mahasiswa yang mereka walikan
            $mahasiswas = Mahasiswa::where('kelas_id', $dosen->kelas_id)->get();
        } else {
            // Dosen biasa hanya bisa melihat data mahasiswa
            $mahasiswas = Mahasiswa::all();
        }

        return view('dosenrole', [
            'mahasiswas' => $mahasiswas,
            'isDosenWali' => $isDosenWali,
            'dosenName' => $dosen->name,
            'kelasName' => $kelas,
            'nip' => $dosen->nip
        ]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required'
        ]);

        $user = Auth::user();

        Mahasiswa::create([
            'user_id' => $user->id,
            'kelas_id' => $user->dosen->kelas_id, // Asumsi user yang login adalah dosen wali
            'nim' => $request->nim,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);
        return redirect('/dosen')->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mahasiswas = Mahasiswa::find($id);
        return view('edit', ['mahasiswas' => $mahasiswas]);
    }

    public function update(Request $request, $id)
    {
        //validasi inputan
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required'
        ]);

        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->save();

        return redirect()->route('dosenrole.index')->with('success', 'Data jurusan berhasil diupdate');
    }

    public function destroy(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $request->validate([
            'kelas_id' => 'nullable',
        ]);
        $mahasiswa->kelas_id = null;
        $mahasiswa->save();

        return redirect()->route('dosenrole.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }

    public function request(Request $request)
    {
        $user = Auth::user();
        $isDosenWali = $request->attributes->get('is_dosen_wali');

        if ($isDosenWali) {
            // Dosen wali melihat permintaan edit dari mahasiswa yang mereka walikan
            $requestEdit = UserRequest::whereHas('mahasiswa', function ($query) use ($user) {
                $query->where('kelas_id', $user->dosen->kelas_id);
            })->with('mahasiswa', 'kelas')->get();
        } else {
            $requestEdit = [];
        }

        return view('requestmhs', ['requestEdit' => $requestEdit]);
    }

    public function updateEdit(Request $request)
    {
        $mahasiswas = Mahasiswa::where('id', $request->id)->first();
        $mahasiswas->update([
            'edit' => $request->edit
        ]);
        $requestEdit = UserRequest::where('mahasiswa_id', $request->id)->first();
        if ($requestEdit) {
            $requestEdit->delete();
        }
        return redirect()->route('request.index');
    }

    public function filterByClass(Request $request)
    {
        $kelas_id = $request->get('kelas_id');

        if ($kelas_id === 'no_class') {
            // Ambil mahasiswa dengan kelas_id null
            $mahasiswas = Mahasiswa::whereNull('kelas_id')->get();
        } elseif ($kelas_id) {
            // Ambil mahasiswa berdasarkan kelas yang dipilih
            $mahasiswas = Mahasiswa::where('kelas_id', $kelas_id)->get();
        } else {
            // Jika tidak ada kelas yang dipilih, ambil semua mahasiswa
            $mahasiswas = Mahasiswa::all();
        }

        // Ambil semua kelas untuk ditampilkan pada dropdown
        $kelas = Kelas::all();

        return view('mahasiswa', ['mahasiswas' => $mahasiswas, 'kelas' => $kelas]);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosen;
        $isDosenWali = $dosen->kelas_id ? true : false;
        $kelasName = $isDosenWali && $dosen->kelas ? $dosen->kelas->name : '';

        $search = $request->input('search');

        $query = Mahasiswa::query();

        if ($search) {
            $query->where('nama', 'LIKE', "%{$search}%");
        }

        if ($isDosenWali) {
            $query->where('kelas_id', $dosen->kelas_id);
        }

        $mahasiswas = $query->paginate(10);

        return view('dosenrole', [
            'mahasiswas' => $mahasiswas,
            'isDosenWali' => $isDosenWali,
            'dosenName' => $dosen->name,
            'kelasName' => $kelasName,
            'nip' => $dosen->nip
        ]);
    }

    public function updateDosen(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nip' => 'required|string|max:20|unique:dosen,nip,' . $id,
            'kode_dosen' => 'required|string|max:10|unique:dosen,kode_dosen,' . $id,
            'name' => 'required|string|max:100',
        ]);

        // Mengambil data dosen berdasarkan id
        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id); // Ambil user terkait dosen ini

        // Update data di tabel dosens
        $dosen->nip = $request->input('nip');
        $dosen->kode_dosen = $request->input('kode_dosen');
        $dosen->name = $request->input('name');
        $dosen->save();

        // Redirect kembali ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('dosenrole.index')->with('success', 'Data dosen berhasil diupdate.');
    }
}

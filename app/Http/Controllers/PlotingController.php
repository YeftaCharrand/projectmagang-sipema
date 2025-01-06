<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class PlotingController extends Controller
{
    public function indexPlot(Request $request)
    {
        // Mengambil semua kelas untuk ditampilkan di halaman
        $kelas = Kelas::all();

        // Mengambil kelas yang belum memiliki dosen untuk dropdown
        $kelasTersedia = Kelas::whereDoesntHave('dosen')->get();

        // Mengambil dosen dan mahasiswa yang belum memiliki kelas
        $dosen = Dosen::whereNull('kelas_id')->get();
        $mahasiswa = Mahasiswa::whereNull('kelas_id')->get();

        // Mengambil kelas yang belum penuh
        $kelasBelumPenuh = Kelas::select('kelas.*')
        ->leftJoin('mahasiswa', 'kelas.id', '=', 'mahasiswa.kelas_id')
        ->groupBy('kelas.id', 'kelas.name', 'kelas.jumlah') // Grouping by necessary fields
        ->havingRaw('COUNT(mahasiswa.id) < kelas.jumlah')
        ->get();

        // Mengelompokkan dosen dan mahasiswa berdasarkan kelas
        $dosenByKelas = [];
        $mahasiswaByKelas = [];
        foreach ($kelas as $kelasItem) {
            $dosenByKelas[$kelasItem->id] = Dosen::where('kelas_id', $kelasItem->id)->get();
            $mahasiswaByKelas[$kelasItem->id] = Mahasiswa::where('kelas_id', $kelasItem->id)->get();
        }

        return view('plotting', compact('kelas', 'kelasTersedia', 'kelasBelumPenuh', 'dosen', 'mahasiswa', 'dosenByKelas', 'mahasiswaByKelas'));
    }

    public function updateKelasDosen(Request $request)
    {
        $request->validate([
            'id_dosen' => 'required|exists:dosen,id',
            'id_kelas' => 'required|exists:kelas,id',
        ]);

        $idKelas = $request->input('id_kelas');
        $idDosen = $request->input('id_dosen');

        // Check if the selected class already has a lecturer
        $kelasDenganDosen = Dosen::where('kelas_id', $idKelas)->first();

        if ($kelasDenganDosen) {
            return redirect()->route('plotting.index')->withErrors([
                'id_kelas' => 'Kelas yang dipilih sudah memiliki dosen.'
            ]);
        }

        // Update lecturer assignment
        Dosen::where('id', $idDosen)->update(['kelas_id' => $idKelas]);

        return redirect()->route('plotting.index')->with('success', 'Kelas dosen berhasil diperbarui.');
    }

    public function destroyKelasDosen($id)
    {
        // Temukan dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Set `kelas_id` menjadi null
        $dosen->update(['kelas_id' => null]);

        // Redirect atau berikan feedback
        return redirect()->route('plotting.index')->with('success', 'Kelas dosen berhasil dihapus.');
    }

    public function updateKelasMahasiswa(Request $request)
    {
        $request->validate([
            'mahasiswa_ids' => 'required|array',
            'mahasiswa_ids.*' => 'exists:mahasiswa,id',
            'id_kelas' => 'required|exists:kelas,id',
        ]);

        $idKelas = $request->input('id_kelas');
        $mahasiswaIds = $request->input('mahasiswa_ids');

        // Hitung jumlah mahasiswa yang sudah terdaftar di kelas yang dipilih
        $kelas = Kelas::findOrFail($idKelas);
        $jumlahMahasiswaDiKelas = Mahasiswa::where('kelas_id', $idKelas)->count();

        // Hitung jumlah mahasiswa yang akan ditambahkan
        $jumlahMahasiswaAkanDiperbarui = count($mahasiswaIds);

        // Periksa jika jumlah mahasiswa yang akan ditambahkan melebihi kapasitas kelas
        if (($jumlahMahasiswaDiKelas + $jumlahMahasiswaAkanDiperbarui) > $kelas->jumlah) {
            return redirect()->route('plotting.index')->withErrors([
                'id_kelas' => 'Kapasitas kelas tidak mencukupi untuk jumlah mahasiswa yang dipilih.'
            ]);
        }

        // Perbarui kelas mahasiswa
        Mahasiswa::whereIn('id', $mahasiswaIds)->update(['kelas_id' => $idKelas]);

        return redirect()->route('plotting.index')->with('success', 'Kelas mahasiswa berhasil diperbarui.');
    }
    
    public function destroyKelasMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update(['kelas_id' => null]);
        
        return redirect()->route('plotting.index')->with('success', 'Kelas mahasiswa berhasil dihapus.');
    }
}

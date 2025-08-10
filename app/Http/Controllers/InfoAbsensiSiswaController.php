<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Absensi;
use App\Models\Staf;
use App\Models\DataOption;
use App\Models\DetilAbsensi;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Kelas;
class InfoAbsensiSiswaController extends Controller
{
    public function index()
    {
        $tanggalAkhir = date("Y-m-d");
        // Mengurangi 3 bulan menggunakan strtotime
        $tanggalAwal = date("Y-m-d", strtotime("-1 months", strtotime($tanggalAkhir)));
        $data = DetilAbsensi::whereHas('absensi.jadwal', function ($query) use ($tanggalAwal, $tanggalAkhir) {
                $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
            })->get();
        $dataSiswa = Siswa::all();
        $dataMataPelajaran = MataPelajaran::all();
        $dataKelas = Kelas::all();
        //dd($data);
        return view('info-absensi-siswa.info-absensi-siswa', compact('data', 'tanggalAwal', 'tanggalAkhir', 'dataSiswa', 'dataMataPelajaran', 'dataKelas'));
    }

    public function perbaruiData(Request $request)
    {
        //dd($request->all());
        $tanggalAkhir = date("Y-m-d");
        $tanggalAwal = date("Y-m-d", strtotime("-1 months", strtotime($tanggalAkhir)));

        if($request->tanggalAkhir != null){
            $tanggalAkhir = $request->tanggalAkhir;
        }

        if($request->tanggalAwal != null){
            $tanggalAwal = $request->tanggalAwal;
        }else{
           $tanggalAwal = date("Y-m-d", strtotime("-1 months", strtotime($tanggalAkhir))); 
        }
        

        $data;
        $idsiswa = $request->idsiswa;
        $idmatapelajaran = $request->idmatapelajaran;
        $idkelas = $request->idkelas;

        $query = DetilAbsensi::query();
        if ($idsiswa != null) {
            $query->where('id_siswa', $idsiswa);
        }

        // Filter tanggal dari relasi absensi
        $query->whereHas('absensi', function ($q) use ($tanggalAwal, $tanggalAkhir) {
            $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        });
        if ($idkelas != null) {
            $query->whereHas('siswa', function ($q) use ($idkelas) {
                $q->where('id_kelas', $idkelas);
            });
        }
        // Filter berdasarkan id mata pelajaran (dari relasi absensi → jadwal)
        if ($idmatapelajaran != null) {
            $query->whereHas('absensi.jadwal', function ($q) use ($idmatapelajaran) {
                $q->where('id_mata_pelajaran', $idmatapelajaran);
            });
        }

        $data = $query->get();


        //dd($data);

        return view('info-absensi-siswa.panel-detil', compact('data', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function cetakData(Request $request)
    {
        //dd($request->all());
        $tanggalAkhir = date("Y-m-d");
        $tanggalAwal = date("Y-m-d", strtotime("-1 months", strtotime($tanggalAkhir)));
        if($request->tanggalAkhir != null){
            $tanggalAkhir = $request->tanggalAkhir;
        }

        if($request->tanggalAwal != null){
            $tanggalAwal = $request->tanggalAwal;
        }else{
           $tanggalAwal = date("Y-m-d", strtotime("-1 months", strtotime($tanggalAkhir))); 
        }
        

        
        $data;
        $idsiswa = $request->idsiswa;
        $idmatapelajaran = $request->idmatapelajaran;
        $idkelas = $request->idkelas;

        $siswa = "";
        $kelas = "";
        $matapelajaran = "";

        $query = DetilAbsensi::query();
        if ($idsiswa != null) {
            $siswa = Siswa::findOrFail($idsiswa);
            $query->where('id_siswa', $idsiswa);
        }

        // Filter tanggal dari relasi absensi
        $query->whereHas('absensi', function ($q) use ($tanggalAwal, $tanggalAkhir) {
            $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        });

        if ($idkelas != null) {
            $kelas = Kelas::findOrFail($idkelas);
            $query->whereHas('siswa', function ($q) use ($idkelas) {
                $q->where('id_kelas', $idkelas);
            });
        }
        // Filter berdasarkan id mata pelajaran (dari relasi absensi → jadwal)
        if ($idmatapelajaran != null) {
            $matapelajaran = MataPelajaran::findOrFail($idmatapelajaran);
            $query->whereHas('absensi.jadwal', function ($q) use ($idmatapelajaran) {
                $q->where('id_mata_pelajaran', $idmatapelajaran);
            });
        }

        $data = $query->get();
        

        $namaSekolah = DataOption::where('entity', '=', 'Nama Sekolah')->first();
        $alamatSekolah= DataOption::where('entity', '=', 'Alamat Sekolah')->first();
        //dd($data);
        $pdf= Pdf::loadView('info-absensi-siswa.info-absensi-siswa-cetak', compact('data', 'tanggalAwal', 'tanggalAkhir', 'siswa', 'kelas', 'matapelajaran', 'namaSekolah', 'alamatSekolah'));
        return $pdf->stream('LaporanAbsensiSiswa.pdf');
        
        
    }
}

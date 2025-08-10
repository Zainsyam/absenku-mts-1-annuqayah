<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Absensi;
use App\Models\Staf;
use App\Models\DataOption;
use App\Models\DetilAbsensi;
class InfoAbsensiController extends Controller
{
    public function index()
    {
        $tanggalAkhir = date("Y-m-d");
        // Mengurangi 3 bulan menggunakan strtotime
        $tanggalAwal = date("Y-m-d", strtotime("-3 months", strtotime($tanggalAkhir)));
        $data = Absensi:: whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();
        $dataGuru = Staf::where('id_jabatan', 2)->orWhere('id_jabatan', 3)->get();
        //dd($data);
        return view('info-absensi.info-absensi', compact('data', 'tanggalAwal', 'tanggalAkhir', 'dataGuru'));
    }

    public function perbaruiData(Request $request)
    {
        //dd($request->all());
        $tanggalAkhir = date("Y-m-d");
        $tanggalAwal = date("Y-m-d", strtotime("-3 months", strtotime($tanggalAkhir)));

        if($request->tanggalAkhir != null){
            $tanggalAkhir = $request->tanggalAkhir;
        }

        if($request->tanggalAwal != null){
            $tanggalAwal = $request->tanggalAwal;
        }else{
           $tanggalAwal = date("Y-m-d", strtotime("-3 months", strtotime($tanggalAkhir))); 
        }
        

        $data;
        $idguru = $request->idguru;
        if($idguru != null){
            $data = Absensi::where('id_guru', $idguru)
                    ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
                    ->get();
        }else{
            $data = Absensi:: whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();
        }

        return view('info-absensi.panel-detil', compact('data', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function detailSiswa(Request $request)
    {
        //dd($request->all());
        $data = DetilAbsensi::where('id_absensi', $request->id)->get();
        //dd($data);
        return view('info-absensi.panel-detil-siswa', compact('data'));
    }

    public function updateAbsensi(Request $request)
    {
        foreach ($request->absensi as $id => $status) {
            DetilAbsensi::where('id', $id)
                ->update(['status_kehadiran' => $status]);
        }

        return redirect('informasi/absensi')->with('success', 'Data absensi berhasil diperbarui!');
    }

    public function cetakData(Request $request)
    {
        //dd($request->all());
        $tanggalAkhir = date("Y-m-d");
        $tanggalAwal = date("Y-m-d", strtotime("-3 months", strtotime($tanggalAkhir)));
        if($request->tanggalAkhir != null){
            $tanggalAkhir = $request->tanggalAkhir;
        }

        if($request->tanggalAwal != null){
            $tanggalAwal = $request->tanggalAwal;
        }else{
           $tanggalAwal = date("Y-m-d", strtotime("-3 months", strtotime($tanggalAkhir))); 
        }
        

        $data;
        $guru = "";
        $idguru = $request->idguru;
        if($idguru != null){
            $guru = Staf::findOrFail($idguru);
            $data = Absensi::where('id_guru', $idguru)
                    ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
                    ->get();
        }else{
            $data = Absensi:: whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();
        }
        $namaSekolah = DataOption::where('entity', '=', 'Nama Sekolah')->first();
        $alamatSekolah= DataOption::where('entity', '=', 'Alamat Sekolah')->first();
        //dd($guru);
        $pdf= Pdf::loadView('info-absensi.info-absensi-cetak', compact('data', 'tanggalAwal', 'tanggalAkhir', 'guru', 'namaSekolah', 'alamatSekolah'));
        return $pdf->stream('LaporanAbsensi.pdf');
        
        
    }
}

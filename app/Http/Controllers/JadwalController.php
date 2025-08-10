<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Staf;
use App\Models\DataOption;
use App\Models\Absensi;
use App\Models\DetilAbsensi;
use App\Models\PengajuanPengganti;
use App\Models\Siswa;
use Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\IpUtils;
use Illuminate\Support\Facades\Log;

class jadwalController extends Controller
{
    public function index (){      
        $data = Jadwal::all();
        $hariIni = Carbon::now()->locale('id')->dayName; // Nama hari saat ini

        return view('jadwal.jadwal', compact('data', 'hariIni'));
    }

    public function tambah (){
        $dataMataPelajaran = MataPelajaran::all();
        $dataKelas = Kelas::all();
        $dataGuru = Staf::where('id_jabatan', 2)->get();
        $dataHari = DataOption::where('entity', '=', 'Hari')->get();
        $dataJenis = DataOption::where('entity', '=', 'Jenis Jadwal')->get();
        return view('jadwal.tambah', compact('dataMataPelajaran', 'dataKelas', 'dataGuru', 'dataHari', 'dataJenis'));
    }

    public function simpan (Request $request){
        $data = $request->except('_token', 'submit');
        Jadwal::create($data);
        return redirect('akademik/jadwal');
    }

    public function edit ($id){
        $data = Jadwal::findOrFail($id);
        $dataMataPelajaran = MataPelajaran::all();
        $dataKelas = Kelas::all();
        $dataGuru = Staf::where('id_jabatan', 2)->get();
        $dataHari = DataOption::where('entity', '=', 'Hari')->get();
        $dataJenis = DataOption::where('entity', '=', 'Jenis Jadwal')->get();
        return view('jadwal.edit', compact('data', 'dataMataPelajaran', 'dataKelas', 'dataGuru', 'dataHari', 'dataJenis'));
    }

    public function update (Request $request, $id){
        $data = Jadwal::findOrFail($id);
        $data->id_mata_pelajaran = $request->id_mata_pelajaran;
        $data->id_kelas = $request->id_kelas;
        $data->id_guru = $request->id_guru;
        $data->hari = $request->hari;
        $data->jam_mulai = $request->jam_mulai;
        $data->jam_selesai = $request->jam_selesai;
        $data->jenis = $request->jenis;
        $data->save();

        return redirect('akademik/jadwal');
    }

    public function validasiAbsensi (Request $request)
    {
        //dd($request->all());
        $data = Jadwal::findOrFail($request->id);

        // Set timezone ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");
        $time = date("H:i");

        // Validasi rentang waktu
        if ($time <= $data->jam_mulai || $time >= $data->jam_selesai) {
            return response()->json([
                'status' => 'error',
                'message' => "Maaf, Anda hanya dapat melakukan absen saat jam pelajaran berlangsung, yaitu dari {$data->jam_mulai} hingga {$data->jam_selesai}."
            ], 400);
        }

        $statusValidasiNetwork = DataOption::where('entity', '=', 'Status Validasi Network')->pluck('nama')->first();
        if($statusValidasiNetwork == 'Yes'){
            $allowedNetwork = DataOption::where('entity', 'IP Network')->pluck('nama')->first(); // contoh: 192.168.1.0/24
            $clientIP = request()->ip();

            if (!IpUtils::checkIp($clientIP, $allowedNetwork)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Maaf, Anda harus terhubung ke jaringan atau WiFi sekolah untuk melakukan absensi.'
                ], 400);
            }
        }

        $statusValidasiLokasi = DataOption::where('entity', '=', 'Status Validasi Lokasi')->pluck('nama')->first();
        if ($statusValidasiLokasi === 'Yes') {
            $batasAreaString = DataOption::where('entity', '=', 'Radius Lokasi Absensi')->first();
            if ($request->has(['latitude', 'longitude'])) {
                $userLat = (float) $request->latitude;
                $userLong = (float) $request->longitude;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data lokasi tidak lengkap.'
                ], 400);
            }

            // PARSING KOORDINAT SEKOLAH
            $schoolLat = DataOption::where('entity', '=', 'Koordinat Sekolah Lat')->pluck('nama')->first();
            $schoolLong = DataOption::where('entity', '=', 'Koordinat Sekolah Long')->pluck('nama')->first();

            // Konversi ke float
            $userLat = (float) $userLat;
            $userLong = (float) $userLong;
            $schoolLat = (float) $schoolLat;
            $schoolLong = (float) $schoolLong;
            $batasArea = (float) $batasAreaString->nama;

            // DEBUG: Cek koordinat dan hasil perhitungan
            Log::debug('Koordinat parsed:', [
                'userLat' => $userLat,
                'userLong' => $userLong,
                'schoolLat' => $schoolLat,
                'schoolLong' => $schoolLong
            ]);

            $distance = $this->haversine($userLat, $userLong, $schoolLat, $schoolLong);

            Log::debug('Hasil perhitungan jarak (km): ' . $distance);

            // Validasi jarak lebih dari 100 meter (0.1 km)
            if ($distance > $batasArea) {
                $radiusMeter = $batasArea * 1000;
                if ($radiusMeter >= 1000) {
                    $displayRadius = number_format($batasArea, 2) . ' km';
                } else {
                    $displayRadius = intval($radiusMeter) . ' meter';
                }
                return response()->json([
                    'status' => 'error',
                    'message' => 'Maaf, Anda berada di luar radius ' . $displayRadius . ' dari sekolah. Silakan mendekat untuk melakukan absensi.'
                ], 400);
            }

        }
        

        // Cek apakah sudah absen hari ini
        $sudahAbsen = Absensi::where('id_jadwal', $data->id)
            ->where('tanggal', $date)
            ->exists();

        if ($sudahAbsen) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah melakukan absen hari ini.'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Absen berhasil dilakukan.'
        ]);
        
    }
    public function rekamAbsensi(Request $request)
    {
        // Cari jadwal berdasarkan ID
        $data = Jadwal::findOrFail($request->id);
        $dataSiswa = Siswa::where('id_kelas', $data->id_kelas)->get();
        return view('jadwal.absensi', compact('data', 'dataSiswa'));

    }
    public function simpanAbsensi(Request $request)
    {
        //dd($request->all());
        // Set timezone ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");

        // Cari jadwal berdasarkan ID
        $data = Jadwal::findOrFail($request->id);
        $data->status_pengganti = false;
        $data->save();

        $guru = Staf::where("user_id", Auth::user()->id)->first();
        //dd($guru);
        // Simpan absensi
        $absensi = new Absensi();
        $absensi->id_jadwal = $data->id;
        $absensi->id_guru = $guru->id;
        $absensi->tanggal = $date;
        $absensi->pokok_pembahasan = $request->pokok_pembahasan;
        $absensi->koordinat = json_encode($request->koordinat); // Simpan sebagai JSON jika koordinat lebih dari 1
        $absensi->ip = request()->ip();
        $absensi->save();

        $absensiData = $request->input('absensi'); // bentuknya array: [id_siswa => status]
        //dd($absensiData);
        foreach ($absensiData as $idSiswa => $status) {
            DetilAbsensi::create([
                'id_absensi' => $absensi->id,
                'id_jadwal' => $request->id,
                'id_siswa' => $idSiswa,
                'status_kehadiran' => $status,
            ]);
        }

        return redirect('dashboard');
    }

    public function ajukanGuruPengganti(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");

        $data = Jadwal::findOrFail($request->id);
        /*$guru = Staf::where("user_id", Auth::user()->id)->first();
        PengajuanPengganti::create([
            'id_jadwal' => $id,
            'id_guru' => $guru->id,
            'tanggal' => $date,
        ]);*/
        return view('jadwal.pengajuan_pengganti', compact('data')); 
    }

    public function simpanPengajuan(Request $request){
        //dd($request->all());
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");

        $data = Jadwal::findOrFail($request->id);
        $data->status_pengganti = true;
        $data->save();
        $guru = Staf::where("user_id", Auth::user()->id)->first();


        PengajuanPengganti::create([
            'id_jadwal' => $request->id,
            'id_guru' => $guru->id,
            'tanggal' => $date,
            'alasan' => $request->alasan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Perizinan telah diterima.'
        ]);

        
    }

    public function alihkanJadwal(Request $request){
        $data = Jadwal::findOrFail($request->id);
        $data->status_guru_pengganti = true;
        $data->save();

        $guru = Staf::where("user_id", Auth::user()->id)->first();

        $pengajuanPengganti = PengajuanPengganti::where('id_jadwal', $request->id)->whereNull('id_guru_pengganti')->latest()->first(); // atau ->firstOrFail() kalau harus ada datanya
        $pengajuanPengganti->id_guru_pengganti = $guru->id;
        $pengajuanPengganti->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Perizinan telah diterima.'
        ]);
    }

    public function delete (Request $request){
        $data = Jadwal::findOrFail($request->id);
        $data->delete();
        return redirect('akademik/jadwal');
    }
    private function haversine($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Radius bumi dalam kilometer
        $latDelta = deg2rad($lat2 - $lat1);
        $lngDelta = deg2rad($lng2 - $lng1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lngDelta / 2) * sin($lngDelta / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance; // Jarak dalam kilometer
    }
}

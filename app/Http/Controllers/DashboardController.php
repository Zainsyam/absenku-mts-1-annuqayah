<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staf;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Absensi;
use App\Models\DetilAbsensi;
use App\Models\Siswa;
use App\Models\PengajuanPengganti;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index (){   
        $data = [];
        $hariIni = Carbon::now()->locale('id')->dayName; // Nama hari saat ini
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        // Untuk Admin
        $totalGuru = 0;
        $totalMataPelajaran = 0;
        $totalKelas = 0;
        $totalAbsenTercatat = 0;
        $totalHonor = 0;
        $totalJadwal = 0;

        $topStafHadir = collect(); // kosong, tapi bisa tetap dipanggil di blade
        $topSiswaAlpha = collect(); // kosong, tapi bisa tetap dipanggil di blade

        $totalAbsenHadir = 0;
        $totalAbsenSakit = 0;
        $totalAbsenIzin = 0;
        $totalAbsenAlpha = 0;
        if(Auth::user()->role == 'Guru'){
            $guru = Staf::where('user_id', Auth::user()->id)->first();

            $jadwal = Jadwal::where('id_guru', $guru->id)
                ->orderByRaw("
                    FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')
                ")
                ->orderBy('jam_mulai')
                ->get();
            // Kelompokkan jadwal berdasarkan hari
            $data = $jadwal->groupBy('hari');

            $totalJadwal = $data->count();
            $totalAbsenTercatat = Absensi::whereBetween('tanggal', [$start, $end])->where('id_guru', $guru->id)->count();
            $totalHonor = $totalAbsenTercatat * $guru->rate_gaji;

        }else if(Auth::user()->role == 'Guru Piket'){
            $guru = Staf::where('user_id', Auth::user()->id)->first();
            $jadwalIds = PengajuanPengganti::whereNull('id_guru_pengganti')->orWhere('id_guru_pengganti', $guru->id)->pluck('id_jadwal');
            $data = Jadwal::where('status_pengganti', true)
                            ->where('hari', '=', $hariIni) // kalau field `hari` pakai nama hari
                            ->whereIn('id', $jadwalIds)
                            ->orderBy('jam_mulai')
                            ->get();

            $totalJadwal = $data->count();
            $totalAbsenTercatat = Absensi::whereBetween('tanggal', [$start, $end])->where('id_guru', $guru->id)->count();
            $totalHonor = $totalAbsenTercatat * $guru->rate_gaji;
        }
        else if (Auth::user()->role == 'Siswa') {
            $siswa = Siswa::where('user_id', Auth::user()->id)->first();
            $totalAbsenHadir = DetilAbsensi::join('absensi', 'detil_absensi.id_absensi', '=', 'absensi.id')
                                ->whereBetween('absensi.tanggal', [$start, $end])
                                ->where('status_kehadiran', 'Hadir')
                                ->where('id_siswa', $siswa->id)->count();
            $totalAbsenIzin = DetilAbsensi::join('absensi', 'detil_absensi.id_absensi', '=', 'absensi.id')
                                ->whereBetween('absensi.tanggal', [$start, $end])
                                ->where('status_kehadiran', 'Izin')
                                ->where('id_siswa', $siswa->id)->count();
            $totalAbsenSakit = DetilAbsensi::join('absensi', 'detil_absensi.id_absensi', '=', 'absensi.id')
                                ->whereBetween('absensi.tanggal', [$start, $end])
                                ->where('status_kehadiran', 'Sakit')
                                ->where('id_siswa', $siswa->id)->count();
            $totalAbsenAlpha = DetilAbsensi::join('absensi', 'detil_absensi.id_absensi', '=', 'absensi.id')
                                ->whereBetween('absensi.tanggal', [$start, $end])
                                ->where('status_kehadiran', 'Alpha')
                                ->where('id_siswa', $siswa->id)->count();
            //dd($totalAbsenHadir);
        } else if(Auth::user()->role == 'Admin') {
            // Untuk Admin: ambil statistik
            $totalGuru = Staf::count();
            $totalMataPelajaran = MataPelajaran::count();
            $totalKelas = Kelas::count();
            $totalAbsenTercatat = Absensi::whereBetween('tanggal', [$start, $end])->count();

            // Query top 5 staf dengan kehadiran "Hadir" di bulan ini
            $topStafHadir = DB::table('absensi')
                ->join('staf', 'absensi.id_guru', '=', 'staf.id')
                ->select('staf.nama_lengkap', DB::raw('COUNT(absensi.id) as total_hadir'))
                ->whereBetween('absensi.tanggal', [$start, $end])
                ->groupBy('staf.nama_lengkap')
                ->orderByDesc('total_hadir')
                ->limit(5)
                ->get();

            // Query top 5 siswa dengan Alpha terbanyak
            $topSiswaAlpha = DB::table('detil_absensi')
                ->join('siswa', 'detil_absensi.id_siswa', '=', 'siswa.id')
                ->join('absensi', 'detil_absensi.id_absensi', '=', 'absensi.id')
                ->select('siswa.nama_lengkap', DB::raw('COUNT(detil_absensi.id) as total_alpha'))
                ->whereBetween('absensi.tanggal', [$start, $end])
                ->where('status_kehadiran', '=', 'Alpha')
                ->groupBy('siswa.nama_lengkap')
                ->orderByDesc('total_Alpha')
                ->limit(5)
                ->get();

        }

        return view('dashboard', compact(
            'data',
            'hariIni',
            'totalGuru',
            'totalMataPelajaran',
            'totalKelas',
            'totalAbsenTercatat',
            'topStafHadir',
            'topSiswaAlpha',
            'totalAbsenHadir',
            'totalAbsenIzin',
            'totalAbsenSakit',
            'totalAbsenAlpha',
            'totalJadwal',
            'totalHonor'
        ));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DataOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_option')->insert([
            ['entity' => 'Hari', 'nama' => 'Senin'],
            ['entity' => 'Hari', 'nama' => 'Selasa'],
            ['entity' => 'Hari', 'nama' => 'Rabu'],
            ['entity' => 'Hari', 'nama' => 'Kamis'],
            ['entity' => 'Hari', 'nama' => 'Jumat'],
            ['entity' => 'Hari', 'nama' => 'Sabtu'],
            ['entity' => 'Hari', 'nama' => 'Minggu'],
            ['entity' => 'Jenis Jadwal', 'nama' => 'Reguler'],
            ['entity' => 'Jenis Jadwal', 'nama' => 'Pengganti'],
            ['entity' => 'Kehadiran', 'nama' => 'Hadir'],
            ['entity' => 'Kehadiran', 'nama' => 'Izin'],
            ['entity' => 'Kehadiran', 'nama' => 'Sakit'],
            ['entity' => 'Kehadiran', 'nama' => 'Absen'],
            ['entity' => 'Koordinat Sekolah Lat', 'nama' => '-7.1015612'],
            ['entity' => 'Koordinat Sekolah Long', 'nama' => '113.6536861'],
            ['entity' => 'Status Validasi Lokasi', 'nama' => 'Yes'],
            ['entity' => 'Status Validasi Network', 'nama' => 'No'],
            ['entity' => 'IP Network', 'nama' => ''],
            ['entity' => 'Radius Lokasi Absensi', 'nama' => '0.1'],
            ['entity' => 'Nama Sekolah', 'nama' => ''],
            ['entity' => 'Alamat Sekolah', 'nama' => ''],
        ]);
    }
}

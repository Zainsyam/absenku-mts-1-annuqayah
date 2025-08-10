<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');


Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//Route::get('/login', 'LoginController@index')->name('login');
Route::post('login/submit', 'LoginController@login')->name('login-submit');
Route::get('/logout', 'LoginController@logout')->name('logout');


Route::get('akademik/kelas', 'KelasController@index')->name('kelas');
Route::get('akademik/kelas-tambah', 'KelasController@tambah')->name('kelas-tambah');
Route::post('akademik/kelas-simpan', 'KelasController@simpan')->name('kelas-simpan');
Route::get('akademik/kelas-edit/{id}', 'KelasController@edit')->name('kelas-edit');
Route::post('akademik/kelas-update/{id}', 'KelasController@update')->name('kelas-update');
Route::post('akademik/kelas-delete', 'KelasController@delete')->name('kelas-delete');


Route::get('akademik/matapelajaran', 'MataPelajaranController@index')->name('matapelajaran');
Route::get('akademik/matapelajaran-tambah', 'MataPelajaranController@tambah')->name('matapelajaran-tambah');
Route::post('akademik/matapelajaran-simpan', 'MataPelajaranController@simpan')->name('matapelajaran-simpan');
Route::get('akademik/matapelajaran-edit/{id}', 'MataPelajaranController@edit')->name('matapelajaran-edit');
Route::post('akademik/matapelajaran-update/{id}', 'MataPelajaranController@update')->name('matapelajaran-update');
Route::post('akademik/matapelajaran-delete', 'MataPelajaranController@delete')->name('matapelajaran-delete');

Route::get('akademik/guru', 'GuruController@index')->name('guru');
Route::get('akademik/guru-tambah', 'GuruController@tambah')->name('guru-tambah');
Route::post('akademik/guru-simpan', 'GuruController@simpan')->name('guru-simpan');
Route::get('akademik/guru-edit/{id}', 'GuruController@edit')->name('guru-edit');
Route::post('akademik/guru-update/{id}', 'GuruController@update')->name('guru-update');
Route::get('akademik/guru-reset/{id}', 'GuruController@reset')->name('guru-reset');
Route::post('akademik/guru-delete', 'GuruController@delete')->name('guru-delete');

Route::get('akademik/siswa', 'SiswaController@index')->name('siswa');
Route::get('akademik/siswa-tambah', 'SiswaController@tambah')->name('siswa-tambah');
Route::post('akademik/siswa-simpan', 'SiswaController@simpan')->name('siswa-simpan');
Route::get('akademik/siswa-edit/{id}', 'SiswaController@edit')->name('siswa-edit');
Route::post('akademik/siswa-update/{id}', 'SiswaController@update')->name('siswa-update');
Route::get('akademik/siswa-reset/{id}', 'SiswaController@reset')->name('siswa-reset');
Route::post('akademik/siswa-delete/', 'SiswaController@delete')->name('siswa-delete');

Route::get('user/staf', 'StafController@index')->name('staf');
Route::get('user/staf-tambah', 'StafController@tambah')->name('staf-tambah');
Route::post('user/staf-simpan', 'StafController@simpan')->name('staf-simpan');
Route::get('user/staf-edit/{id}', 'StafController@edit')->name('staf-edit');
Route::post('user/staf-update/{id}', 'StafController@update')->name('staf-update');
Route::get('user/staf-reset/{id}', 'StafController@reset')->name('staf-reset');
Route::post('user/staf-delete/', 'StafController@delete')->name('staf-delete');

Route::get('akademik/jadwal', 'JadwalController@index')->name('jadwal');
Route::get('akademik/jadwal-tambah', 'JadwalController@tambah')->name('jadwal-tambah');
Route::post('akademik/jadwal-simpan', 'JadwalController@simpan')->name('jadwal-simpan');
Route::get('akademik/jadwal-edit/{id}', 'JadwalController@edit')->name('jadwal-edit');
Route::post('akademik/jadwal-update/{id}', 'JadwalController@update')->name('jadwal-update');
Route::post('akademik/jadwal-delete/', 'JadwalController@delete')->name('jadwal-delete');
Route::post('akademik/jadwal/validasi-absensi', 'JadwalController@validasiAbsensi')->name('jadwal-validasi-absensi');
Route::post('akademik/jadwal/rekam-absensi', 'JadwalController@rekamAbsensi')->name('jadwal-rekam-absensi');
Route::post('akademik/jadwal/simpan-absensi', 'JadwalController@simpanAbsensi')->name('jadwal-simpan-absensi');
Route::post('akademik/jadwal/pengajuan-pengganti', 'JadwalController@ajukanGuruPengganti')->name('ajukan-guru-pengganti');
Route::post('akademik/jadwal/simpan-pengajuan', 'JadwalController@simpanPengajuan')->name('jadwal-simpan-pengajuan');
Route::post('akademik/jadwal/alihkan-jadwal', 'JadwalController@alihkanJadwal')->name('alihkan-jadwal');

Route::get('informasi/honor', 'InfoHonorController@index')->name('info-honor');
Route::post('informasi/honor/filter', 'InfoHonorController@perbaruiData')->name('info-honor-filter');
Route::post('informasi/honor/cetak', 'InfoHonorController@cetakData')->name('info-honor-cetak');

Route::get('informasi/absensi', 'InfoAbsensiController@index')->name('info-absensi');
Route::post('informasi/absensi/detail-siswa', 'InfoAbsensiController@detailSiswa')->name('info-absensi-detail-siswa');
Route::post('informasi/absensi/update-absensi', 'InfoAbsensiController@updateAbsensi')->name('update-absensi');
Route::post('informasi/absensi/filter', 'InfoAbsensiController@perbaruiData')->name('info-absensi-filter');
Route::post('informasi/absensi/cetak', 'InfoAbsensiController@cetakData')->name('info-absensi-cetak');

Route::get('informasi/absensi-siswa', 'InfoAbsensiSiswaController@index')->name('info-absensi-siswa');
Route::post('informasi/absensi-siswa/filter', 'InfoAbsensiSiswaController@perbaruiData')->name('info-absensi-siswa-filter');
Route::post('informasi/absensi-siswa/cetak', 'InfoAbsensiSiswaController@cetakData')->name('info-absensi-siswa-cetak');


Route::get('setting/system', 'SettingSystemController@index')->name('setting-system');
Route::post('setting/system-update', 'SettingSystemController@update')->name('setting-system-update');

Route::get('setting/user', 'LoginController@settings')->name('setting-password');
Route::post('setting/user-update', 'LoginController@settingsupdate')->name('setting-password-update');

Route::get('setting/profil', 'LoginController@profile')->name('setting-profile');
Route::post('setting/profil-update', 'LoginController@profileupdate')->name('setting-profile-update');
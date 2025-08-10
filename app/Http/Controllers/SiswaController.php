<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;

class SiswaController extends Controller
{
    public function index(){
        
        $data = Siswa::all();
        return view('siswa.siswa', compact('data'));
    }
    public function tambah (){
        $dataKelas = Kelas::all();
        return view('siswa.tambah', compact('dataKelas'));

    }
    public function simpan (Request $request){
        $data = $request->except('_token', 'submit');
        $userData = [
            'nama' => $request->input('nama_panggilan'),
            'username' => $request->input('nama_panggilan'),
            'password' => bcrypt($request->input('nama_panggilan')),
            'role' => 'Siswa',
        ];

        // Create user record
        $user = User::create($userData);

        $data = $request->except('_token', 'submit');
        $data['user_id'] = $user->id;
        Siswa::create($data);

        return redirect('akademik/siswa');
    }

    public function edit ($id){
        $data = Siswa::findOrFail($id);
        $dataKelas = Kelas::all();
        return view('siswa.edit', compact('data', 'dataKelas'));
    }

    public function update (Request $request, $id){

        $data = Siswa::findOrFail($id);
        $data->nama_lengkap = $request->nama_lengkap;
        $data->nama_panggilan = $request->nama_panggilan;
        $data->nis = $request->nis;
        $data->id_kelas = $request->id_kelas;
        $data->noHP = $request->noHP;
        $data->save();

        $user = User::findOrFail($data->user_id);
        $user->nama = $data->nama_panggilan;
        $user->save();
        $data->save();

        return redirect('akademik/siswa');
    }
    
    public function delete (Request $request){
        $data = Siswa::findOrFail($request->id);
        

        $user = User::findOrFail($data->user_id);
        $user->delete();
        $data->delete();
        return redirect('akademik/siswa');
    }

}

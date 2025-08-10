<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staf;
use App\Models\User;
use App\Models\Jabatan;
use Auth;

class GuruController extends Controller
{
    public function index (){   
        $dataJabatan = Jabatan::where('nama', 'LIKE', '%Guru%')->get();
        $idsJabatan = $dataJabatan->pluck('id'); // ambil semua id jabatan

        $data = Staf::whereIn('id_jabatan', $idsJabatan)->get();
        return view('guru.guru', compact('data'));
    }

    public function tambah (){
        $dataJabatan = Jabatan::where('nama', 'LIKE', '%Guru%')->get();
        return view('guru.tambah', compact('dataJabatan'));
    }

    public function simpan (Request $request){
        $dataJabatan = Jabatan::findOrFail($request->id_jabatan);
        //dd($request->all());
        $userData = [
            'nama' => $request->input('nama_panggilan'),
            'username' => $request->input('nama_panggilan'),
            'password' => bcrypt($request->input('nama_panggilan')),
            'role' => $dataJabatan->nama,
        ];

        // Create user record
        $user = User::create($userData);

        $data = $request->except('_token', 'submit');
        $data['user_id'] = $user->id;
        $data['id_jabatan'] = $dataJabatan->id;
        Staf::create($data);

        return redirect('akademik/guru');
    }

    public function edit ($id){
        $data = Staf::findOrFail($id);
        $dataJabatan = Jabatan::where('nama', 'like', '%Guru%')->get();
        return view('guru.edit', compact('data', 'dataJabatan'));
    }

    public function update (Request $request, $id){
        $dataJabatan = Jabatan::findOrFail($request->id_jabatan);

        $data = Staf::findOrFail($id);
        $data->nama_lengkap = $request->nama_lengkap;
        $data->nama_panggilan = $request->nama_panggilan;
        $data->rate_gaji = $request->rate_gaji;
        $data->id_jabatan = $dataJabatan->id;
        $data->save();

        $user = User::findOrFail($data->user_id);
        $user->nama = $data->nama_panggilan;
        $user->role = $dataJabatan->nama;
        $user->save();

        return redirect('akademik/guru');
    }
    
    public function reset ($id){
        
        $data = Staf::findOrFail($id);

        $user = User::findOrFail($data->user_id);
        $user->password = bcrypt($data->nis);
        $user->save();

        return redirect('akademik/guru');
    }
    
    public function delete (Request $request){
        
        $data = Staf::findOrFail($request->id);
        $data->delete();

        $user = User::findOrFail($data->user_id);
        $user->delete();

        return redirect('akademik/guru');
    }
}

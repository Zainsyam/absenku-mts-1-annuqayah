<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;

class matapelajaranController extends Controller
{
    public function index(){
        
        $data = MataPelajaran::all();
        return view('mata-pelajaran.mata-pelajaran', compact('data'));
    }
    public function tambah (){

        return view('mata-pelajaran.tambah');

    }
    public function simpan (Request $request){
        $data = $request->except('_token', 'submit');
        MataPelajaran::create($data);

        return redirect('akademik/matapelajaran');
    }

    public function edit ($id){
        $data = MataPelajaran::findOrFail($id);
        return view('mata-pelajaran.edit', compact('data',));
    }

    public function update (Request $request, $id){

        $data = MataPelajaran::findOrFail($id);
        $data->nama = $request->nama;
        $data->kode = $request->kode;
        $data->save();

        return redirect('akademik/matapelajaran');
    }
    
    public function delete (Request $request){
        $data = MataPelajaran::findOrFail($request->id);
        $data->delete();
        return redirect('akademik/matapelajaran');
    }

}

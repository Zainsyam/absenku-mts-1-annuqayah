<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index(){
        
        $data = Kelas::all();
        return view('kelas.kelas', compact('data'));
    }
    public function tambah (){

        return view('kelas.tambah');

    }
    public function simpan (Request $request){
        $data = $request->except('_token', 'submit');
        Kelas::create($data);

        return redirect('akademik/kelas');
    }

    public function edit ($id){
        $data = Kelas::findOrFail($id);
        return view('kelas.edit', compact('data',));
    }

    public function update (Request $request, $id){

        $data = Kelas::findOrFail($id);
        $data->nama = $request->nama;
        $data->kode = $request->kode;
        $data->save();

        return redirect('akademik/kelas');
    }
    
    public function delete (Request $request){
        $data = Kelas::findOrFail($request->id);
        $data->delete();
        return redirect('akademik/kelas');
    }

}

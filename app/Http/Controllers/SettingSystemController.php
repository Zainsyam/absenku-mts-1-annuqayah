<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataOption;
use Auth;
use Carbon\Carbon;

class SettingSystemController extends Controller
{
    public function index (){      
        $statusValidasiLokasi = DataOption::where('entity', '=', 'Status Validasi Lokasi')->first();
        $statusValidasiNetwork = DataOption::where('entity', '=', 'Status Validasi Network')->first();
        $schoolLat = DataOption::where('entity', '=', 'Koordinat Sekolah Lat')->first(); // Koordinat sekolah (latitude)
        $schoolLong = DataOption::where('entity', '=', 'Koordinat Sekolah Long')->first();             // Koordinat sekolah (longitude)
        $ipNetwork = DataOption::where('entity', '=', 'IP Network')->first();

        $namaSekolah = DataOption::where('entity', '=', 'Nama Sekolah')->first();
        $alamatSekolah= DataOption::where('entity', '=', 'Alamat Sekolah')->first();
        $batasArea = DataOption::where('entity', '=', 'Radius Lokasi Absensi')->first();

        return view('setting.index', compact('statusValidasiLokasi', 'statusValidasiNetwork', 'schoolLat', 'schoolLong', 'ipNetwork', 'namaSekolah', 'alamatSekolah', 'batasArea'));
    }

    public function update (Request $request){
        $DataOptionLat = DataOption::findOrFail($request->schoolLatid);
        $DataOptionLat->nama = $request->schoolLat;
        $DataOptionLat->save();

        $DataOptionLong = DataOption::findOrFail($request->schoolLongid);
        $DataOptionLong->nama = $request->schoolLong;
        $DataOptionLong->save();

        $DataOptionStatus = DataOption::findOrFail($request->statusValidasiLokasi);
        $DataOptionStatus->nama = $request->statusValidasiLokasiValue;
        $DataOptionStatus->save();

        $DataOptionStatusNetwork = DataOption::findOrFail($request->statusValidasiNetwork);
        $DataOptionStatusNetwork->nama = $request->statusValidasiNetworkValue;
        $DataOptionStatusNetwork->save();

        $DataOptionLat = DataOption::findOrFail($request->ipNetworkId);
        $DataOptionLat->nama = $request->ipNetwork;
        $DataOptionLat->save();

        $namaSekolah = DataOption::findOrFail($request->namaSekolahid); 
        $namaSekolah->nama = $request->namaSekolah; 
        $namaSekolah->save(); 

        $alamatSekolah = DataOption::findOrFail($request->alamatSekolahid); 
        $alamatSekolah->nama = $request->alamatSekolah; 
        $alamatSekolah->save(); 

        $batasArea = DataOption::findOrFail($request->batasAreaid); 
        $batasArea->nama = 
        $request->batasArea; $batasArea->save();

        return redirect('setting/system');
    }
}

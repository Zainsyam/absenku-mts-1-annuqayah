<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use File;
use Illuminate\Support\Facades\Hash;
use Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        return redirect('/');
    }

    public function profile()
    {
        return view('utility.profile');
    }

    public function profileupdate(Request $request)
    {
        $data = Auth::user();
        $data->username = $request->input('username');
        if ($request->hasFile('userpp')) {
        $image_path = $data->user_img;
        if(file_exists('images/'.$image_path)) {
          File::delete('images/'.$image_path);
          }
        $file = $request->file('userpp');
        $new_name = $file->hashName();
        $path = $file->move('images/', $new_name);
        $data->user_img = $new_name;
      }
        $data->save();
        return redirect()->back();
    }

    public function settings()
    {
        return view('utility.ubah-password');
    }

    public function settingsupdate(Request $request)
    {
        if (!Hash::check($request->input('current_pass'), Auth::user()->password)) {
            return redirect()->back()->with('error', 'Password saat ini salah.');
        }

        if (strcmp($request->input('current_pass'), $request->input('new_pass')) == 0) {
            return redirect()->back()->with('error', 'Password baru tidak boleh sama dengan password lama.');
        }

        if (strcmp($request->input('new_pass'), $request->input('confirm_pass')) !== 0) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok.');
        }

        $user = Auth::user();
        $user->password = Hash::make($request->input('new_pass'));
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}

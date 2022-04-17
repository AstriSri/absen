<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\a5;
use Auth;


class HomeController extends Controller
{
    public function loginadmin() {
        $user = Auth::user();
        if($user){
            $role = $user->Role[0]->kode_role ?? false;
			if ($role == 100) {
                return redirect('/admin');
            }elseif($role == 5 || $role == 7){
                return redirect('/userhome');
            }else{
                return view('loginadmin');
            }
		} else {
            return view('loginadmin');
        }
    }

    public function adminlogin(Request $request){
        $username = $request->username;
        $password = $request->password;
    	$user = User::where('username', $username)->first();
    	if($user){
            if (($user->pegawai != null) || ($user->dosen != null) || ($user->Role[0]->kode_role == 100)) {
                $session = Auth::attempt(['username' => $username, 'password' => $password]);
                if($session){
                    $nama = Auth::user()->name;
                    
                    $this->activity($nama, "proses", "login", '', '');
                    if ($user->Role->count() == 0) {
                        return back()->with('error', 'Akun Error, Role tidak terdaftar');
                    }
                    if ($user->Role[0]->kode_role == 100 ||  $user->Role[0]->kode_role == 10){
                        return redirect('/admin')->with('message', 'Selamat datang '.$nama.'. . .');
                    } else if($user->Role[0]->kode_role == 5 || $user->Role[0]->kode_role == 7){
                        return redirect('/userhome')->with('message', 'Selamat datang '.$nama.'. . .');
                    } else { 
                        return back()->with('error', 'User tidak terdaftar');
                    }
                } else {
                    return back()->with('error','Password yang anda masukkan salah');
                }
            } else {
                return back()->with('error','Akun Anda telah Dihapus, Harap Hubungin Admin .... !');
            }
      	} else {
      		return back()->with('error','Username Tidak Terdaftar');
      	}
    }

    public function logoutadmin() {
        Auth::logout();
        return redirect('/')->with('message', 'Logout berhasil . . .');
    }
}

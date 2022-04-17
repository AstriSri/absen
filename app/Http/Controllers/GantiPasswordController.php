<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use DB;
use App\a5;

class GantiPasswordController extends Controller
{
  public function gantipassword() {
    return view('gantipassword');
  }

  public function simpanpassword(Request $request) {
    $isAdmin = Auth::user()->isAdmin;
    $request->user()->fill([
        'password' => bcrypt($request->password)
    ])->save();
    
    $this->activity(Auth::user()->name, "update", Auth::user()->id, "data user", "Mengganti password dengan password baru");

    Auth::logout();
    return redirect ('/')->with('success', 'Password berhasil diganti. Silahkan login menggunakan password baru.');
  }

  public function simpanemailpass(Request $request) {
    $npm = Auth::user()->npm;
    $level = Auth::user()->level;
    $dataemail = DB::table('users')->where("email", "=", "$request->email")->first();
    if($dataemail) {
      return redirect ('userfirstlogin')->with('error', 'E-mail sudah digunakan. Silahkan cek kembali.');
    } else {
      $request->user()->fill([
            'password' => Hash::make($request->passwordbaru),
            'email' => $request->email
        ])->save();
      $u = new a5;
      $u->user = $npm;
      $u->history = "User ".$npm." menambahkan e-mail dan mengganti password";
      $u->save();
      if($level == 12){
        return redirect ('/dosenhome')->with('success', 'E-mail tersimpan. Password berhasil diganti.');
      } else {
        return redirect ('/userhome')->with('success', 'E-mail tersimpan. Password berhasil diganti.');
      }
    }
  }

  public function updateakun(Request $request, $id) {
    $npm = Auth::user()->npm;
    $level = Auth::user()->level;
    if($level == 100 || $level == 9 || $level == 10) {
      $akun = DB::table('users')->where("id", "=", $id)->first();
      $npmakun = $akun->npm;

      $a = User::findOrFail($id);
      $a->name = $request->nama;
      $a->npm = $request->npm;
      $a->email = $request->email;
      $a->level = $request->level;
      $a->hak_akses = $request->hakakses;
      $a->password = Hash::make($request->password);
      $a->save();

      $u = new a5;
      $u->user = $npm;
      $u->history = "User ".$npm." mengupdate akun ".$npmakun;
      $u->save();
      return redirect ('dataakun/cari')->with('success', 'Perubahan telah disimpan.');
    } else {
      return redirect('adminhome')->with('error', 'Anda tidak memiliki hak akses untuk halaman tersebut.');
    }
  }
    //
}

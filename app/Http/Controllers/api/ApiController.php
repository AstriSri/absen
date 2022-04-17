<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
    	$user = User::where('username', $username)->first();
    	if($user){
            if (($user->pegawai != null) || ($user->dosen != null)) {
                $session = Auth::attempt(['username' => $username, 'password' => $password]);
                if($session){
                    $nama = Auth::user()->name;
                    
                    // $this->activity($nama, "proses", "login", '', '');
                    if ($user->Role->count() == 0) {
                        $respon = [
                            'status' => 'error',
                            'msg' => 'Unathorized',
                            'errors' => "Role tidak terdaftar",
                            'content' => null,
                        ];
                        return response()->json($respon, 403);
                    }
                    if($user->Role->pluck("kode_role")->first() == 5 || $user->Role->pluck("kode_role")->first() == 7){
                        $tokenResult = hash('sha256', "$user->name;$user->password");
                        $user->token = $tokenResult;
                        $respon = [
                            'status' => 'success',
                            'msg' => 'Login successfully',
                            'errors' => null,
                            'content' => [
                                'status_code' => 200,
                                'access_token' => $tokenResult,
                                'token_type' => 'Bearer',
                                'name' => $user->name,
                                'user' => $user->username,
                                'role' => $user->Role->pluck("role")->first()
                            ]
                        ];
                        return response()->json($respon, 200);
                    } else { 
                        return back()->with('error', 'User tidak terdaftar');
                    }
                } else {
                    $respon = [
                        'status' => 'error',
                        'msg' => 'Unathorized',
                        'errors' => "Password yang anda masukkan salah",
                        'content' => null,
                    ];
                    return response()->json($respon, 401);
                }
            } else if($user->Role->pluck("kode_role")->first() == 100) {
                $respon = [
                    'status' => 'error',
                    'msg' => 'Unathorized',
                    'errors' => "Admin mobile belum dikembangkan",
                    'content' => null,
                ];
                return response()->json($respon, 403);
            } else {
                $respon = [
                    'status' => 'error',
                    'msg' => 'Unathorized',
                    'errors' => "Akun Anda telah Dihapus",
                    'content' => null,
                ];
                return response()->json($respon, 403);
            }
      	} else {
            $respon = [
                'status' => 'error',
                'msg' => 'Unathorized',
                'errors' => "Username Tidak Terdaftar",
                'content' => null,
            ];
            return response()->json($respon, 402);
      	}
    }

    public function logout(Request $request) {
        $user = User::where("token", $request->token)->first();
        $user->null_token = null;
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }
}

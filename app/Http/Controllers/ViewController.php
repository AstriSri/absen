<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use DB;
use File;
use Response;
use App\a5;
use App\sip_agama;
use App\sip_divisi;
use App\sip_biodata;
use App\sip_dokumen;
use App\sip_dosen;
use App\sip_dosen_homebase;
use App\sip_golongan;
use App\sip_golongandarah;
use App\sip_jabatan;
use App\sip_jeniskelamin;
use App\sip_keluarga;
use App\sip_kewarganegaraan;
use App\sip_kota;
use App\sip_pegawai;
use App\sip_pendidikan;
use App\sip_provinsi;
use App\sip_riwayatgolongan;
use App\sip_riwayatjabatan;
use App\sip_riwayatpendidikan;
use App\sip_statusdosen;
use App\sip_statuskerja;
use App\sip_statuspegawai;

class ViewController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function display_foto($foto2){
    $file = Storage::disk('ftp')->get('/simpeg/foto_user/'.$foto2);
    $file2 = Image::make($file)->response('jpg');
    return $file2;
  }

  public function test()
  {
    $provinsi = sip_provinsi::all();

    return view('test', compact('provinsi'));
  }

  public function dokumen_view($id, $stat)
  {
    $dok = sip_dokumen::where('id', $id)->first();
    $namafile = $dok->dokumen;
    $filename = explode(".", $namafile);
    $tipefile = $filename[1];
    if($stat == "pegawai"){
      $folder = "simpeg/dokumen_pegawai/";
    } else {
      $folder = "simpeg/dokumen_dosen/";
    }
    $file = Storage::disk('ftp')->get($folder . $namafile);
    if ($tipefile == "pdf") {
      $file2 = Response::make($file, 200);
      $file2->header('Content-Type', 'application/pdf');
    } else {
      $file2 = Image::make($file)->response('jpg');
    }
    return $file2;
  }
}

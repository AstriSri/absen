<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\User;
use App\sip_agama;
use App\sip_divisi;
use App\sip_biodata;
use App\sip_dokumen;
use App\sip_dosen;
use App\sip_golongandarah;
use App\sip_jeniskelamin;
use App\sip_kewarganegaraan;
use App\sip_pegawai;
use App\sip_provinsi;
use App\sip_riwayatgolongan;
use App\sip_riwayatjabatanpegawai;
use App\sip_riwayatjabatandosen;
use App\sip_riwayatpendidikan;
use App\sip_statusdosen;
use App\sip_statuskerja;
use App\sip_statuspegawai;

class UserController extends Controller
{
  public function userhome()
  {
      return view('userhome');
  }

  public function profil()
  {
    $user = Auth::user();
    $username = $user->username;
    $data["kewarganegaraan"] = sip_kewarganegaraan::whereNull('deleted_at')->orderBy('kewarganegaraan', 'asc')->get();
    $data["jeniskelamin"] = sip_jeniskelamin::whereNull('deleted_at')->orderBy('jeniskelamin', 'asc')->get();
    $data["statuspegawai"] = sip_statuspegawai::whereNull('deleted_at')->orderBy('status', 'asc')->get();
    $data["statuskerja"] = sip_statuskerja::whereNull('deleted_at')->orderBy('status', 'asc')->get();
    $data["goldar"] = sip_golongandarah::whereNull('deleted_at')->orderBy('goldar', 'asc')->get();
    $data["divisi"] = sip_divisi::whereNull('deleted_at')->orderBy('divisi', 'asc')->get();
    $data["agama"] = sip_agama::whereNull('deleted_at')->orderBy('agama', 'asc')->get();
    $data["provinsi"] = sip_provinsi::orderBy('name', 'asc')->get();
    $data["dokumen"] = sip_dokumen::where('user', $username)->get();
    $data["biodata"] = sip_biodata::where('user', $username)->first();
    $data["riwayatjabatanpegawai"] = sip_riwayatjabatanpegawai::where('user', $username)->get();
    $data["riwayatjabatandosen"] = sip_riwayatjabatandosen::where('user', $username)->get();
    $data["riwayatgolongan"] = sip_riwayatgolongan::where('user', $username)->get();
    $data["riwayatpendidikan"] = sip_riwayatpendidikan::where('user', $username)->get();
    $data["role"] = $user->role;
    
    $this->activity(Auth::user()->name, "detail", $user->name, "profil", "[$username-{$user->name}] Melihat profil");
    return view('user-profil', $data);
  }

  public function updateBiodata(Request $request, $id)
  {
      $biodata = sip_biodata::find($id);
      if ($biodata == null) {
        $biodata = new sip_biodata;
        $biodata->user = auth()->user()->username;
      }
      $biodata->kewarganegaraan = $request->kewarganegaraan;
      $biodata->jeniskelamin = $request->jeniskelamin;
      $biodata->tanggallahir = $request->tanggallahir;
      $biodata->tempatlahir = $request->tempatlahir;
      $biodata->notelprumah = $request->notelprumah;
      $biodata->kelurahan = $request->kelurahan;
      $biodata->kecamatan = $request->kecamatan;
      $biodata->provinsi = $request->provinsi;
      $biodata->kodepos = $request->kodepos;
      $biodata->goldar = $request->goldar;
      $biodata->alamat = $request->alamat;
      $biodata->nomorktp = $request->nik;
      $biodata->agama = $request->agama;
      $biodata->kota = $request->kota;
      $biodata->nohp = $request->nohp;
      $biodata->npwp = $request->npwp;
      $biodata->rt = $request->rt;
      $biodata->rw = $request->rw;
      $biodata->save();

      $this->activity(auth()->user()->username, "update", $biodata->User->name, "data biodata", "Memperbarui data biodata dengan id => [$id - {$biodata->User->name}]");

      return redirect()->back()->with('success', "Biodata {$biodata->User->username} berhasil diupdate . . ."); 
  }

  public function updateFoto(Request $request)
  {
    $user = auth()->user();
    if($fotolama = $user->foto ){
        Storage::disk('ftp')->delete("simpeg/foto_user/$fotolama");
    }

    $username = $user->username;

    $image = str_replace('data:image/png;base64,', '', $request['foto']);
    $image = str_replace(' ', '+', $image);
    $file = base64_decode($image);

    $safeName = "foto-$username.png";
    Storage::disk('ftp')->put("simpeg/foto_user/$safeName", $file);
    $user->foto= $safeName;
    $user->save();
    $namagelar = $user->dosen->namagelar ?? $user->pegawai->namagelar;
    $this->activity(Auth::user()->name, "update", $namagelar, "Foto Profile", "Update Foto [$username-$namagelar]");
    
  }

  public function idCardDosen()
  {
    $dosen = auth()->user()->dosen;
    return view("idcard.dosen", compact("dosen"));
  }

  public function idCardPegawai()
  {
    $pegawai = auth()->user()->pegawai;
    return view("idcard.pegawai", compact("pegawai"));
  }
}

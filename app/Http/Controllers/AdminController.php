<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use DB;
use File;
use App\a5;
use App\Role;
use App\sip_agama;
use App\sip_biodata;
use App\sip_divisi;
use App\sip_dokumen;
use App\sip_dosen;
use App\sip_dosen_homebase;
use App\sip_golongan;
use App\sip_golongandarah;
use App\sip_jabatan;
use App\sip_jabatan_fungsional;
use App\sip_jam_kerja;
use App\sip_jam_kerja_pegawai;
use App\sip_jeniskelamin;
use App\sip_keluarga;
use App\sip_kewarganegaraan;
use App\sip_pegawai;
use App\sip_pendidikan;
use App\sip_riwayatgolongan;
use App\sip_riwayatjabatan;
use App\sip_riwayatpendidikan;
use App\sip_statusdosen;
use App\sip_statusaktifdosen;
use App\sip_statuskerja;
use App\sip_statuspegawai;
use App\UserRole;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function adminhome()
  {
    $nama = Auth::user()->name;
    $jumlah_pegawai = sip_pegawai::all()->count();
    $pegawai_aktif = sip_pegawai::where('statuspegawai', 1)->count();
    $pegawai_tidak_aktif = sip_pegawai::where('statuspegawai', 0)->count();
    $jumlah_dosen = sip_dosen::all()->count();

      return view('admin.home.dashboard', [
        'jumlah_pegawai' => $jumlah_pegawai,
        'pegawai_aktif' => $pegawai_aktif,
        'pegawai_tidak_aktif' => $pegawai_tidak_aktif,
        'jumlah_dosen' => $jumlah_dosen,
      ])->with('message', 'Selamat datang ' . $nama . '. . .');
  }

  public function caridataakun()
  {
    $data["level"] = Role::groupBy('kode_role')->orderBy('kode_role', 'asc')->get();
    // $data["hak"] = DB::table('users')->whereNotNull("hak_akses")->groupBy('hak_akses')->orderBy('hak_akses', 'asc')->get();
      return view('admin.user.dataakun-cari', $data);
  }

  public function dataakun(Request $request)
  {
    if ($request->nama) {
      $detail = $request->nama;
      $data["user"] = User::where("name", "like", "%{$request->nama}%")->ofRole('!=', 100)->orderBy('name', 'asc')->get();
      $history = "Mencari data akun dengan nama => (" . $request->nama . ")";

      return view('admin.user.dataakun-hasil', $data);
    }
    if ($request->username) {
      $detail = $request->username;
      $data["user"] = User::where("username", "like", "%{$request->username}%")->orderBy('username', 'asc')->get();
      $history = "Mencari data akun dengan username => (" . $request->username . ")";

      return view('admin.user.dataakun-hasil', $data);
    }
    if ($request->email) {
      $detail = $request->email;
      $data["user"] = User::where("email", "like", "%{$request->email}%")->orderBy('name', 'asc')->get();
      $history = "Mencari data akun dengan emial => (" . $request->email . ")";

      return view('admin.user.dataakun-hasil', $data);
    }
    if ($request->level) {
      $detail = $request->level;
      $data["user"] = User::ofRole("=",$request->level)->get();
      $history = "Mencari data akun dengan level => (" . $request->level . ")";
    }

    $this->activity(Auth::user()->name, "search", $detail, "data akun", $history);
    return view('admin.user.dataakun-hasil', $data);
  }

  public function tambahakun()
  {
    return view('admin.user.tambahakun');
  }

  public function simpanakun(Request $request)
  {
      $user = User::create([
        'name' => $request->nama,
        'email' => $request->email,
        'username' => $request->username,
        'hak_akses' => $request->hakakses,
        'password' => bcrypt($request->password),
      ]);

      UserRole::create([
        'username' => $request->username,
        'kode_role' => $request->level,
      ]);

      $history = "Menambahkan " . $request->username . " (" . $request->nama . ") sebagai User baru";
      $this->activity(Auth::user()->name, "create", $request->username, "data akun", $history);
      return redirect('/dataakun/cari')->with('success', 'Data Berhasil Ditambahkan . . .');
  }

  public function editakun($id)
  {
    $data["akun"] = DB::table('users')->where("id", "=", $id)->first();

    return view('admin.user.editakun', $data);
  }

  public function updateakun(Request $request, $id)
  {
      $a = User::findOrFail($id);
      $a->name = $request->nama;
      $a->username = $request->username;
      $a->email = $request->email;
      $a->level = $request->level;
      $a->hak_akses = $request->hakakses;
      $a->password = Hash::make($request->password);
      $user = $a->username;
      $a->save();

      $this->activity($user = Auth::user()->name, "update", $user, "data akun", "Mengupdate akun " . $user);
      
      return redirect('admin/dataakun/cari')->with('success', 'Perubahan telah disimpan.');
  }

  public function hapusakun($id)
  {
    $j = User::findOrFail($id);
    $username = $j->username;
    $j->delete();

    $this->activity(Auth::user()->name, "delete", $username, "data akun", "Menghapus akun (" . $username . ")");
    return redirect('admin/dataakun/cari')->with('success', 'Data berhasil dihapus . . .');
  }

  public function trash($model)
  {
    switch ($model) {
      case 'agama':
        $agama = sip_agama::onlyTrashed()->get();
        return view('admin.agama.agama-trash', compact('agama'));
      
      case 'divisi':
        $divisi = sip_divisi::onlyTrashed()->get();
        return view('admin.divisi.divisi-trash', compact('divisi'));
      
      case 'goldar':
        $goldar = sip_golongandarah::onlyTrashed()->get();
        return view('admin.goldar.goldar-trash', compact('goldar'));
      
      case 'golongan':
        $golongan = sip_golongan::onlyTrashed()->get();
        return view('admin.golongan.golongan-trash', compact('golongan'));
      
      case 'jabatan':
        $jabatan = sip_jabatan::onlyTrashed()->get();
        return view('admin.jabatan.jabatan-trash', compact('jabatan'));
      
      case 'jabatan-fungsional':
        $jabatan_fungsional = sip_jabatan_fungsional::onlyTrashed()->get();
        return view('admin.jabatan_fungsional.jabatan_fungsional-trash', compact('jabatan_fungsional'));
      
      case 'jeniskelamin':
        $jeniskelamin = sip_jeniskelamin::onlyTrashed()->get();
        return view('admin.jeniskelamin.jeniskelamin-trash', compact('jeniskelamin'));
      
      case 'kewarganegaraan':
        $kewarganegaraan = sip_kewarganegaraan::onlyTrashed()->get();
        return view('admin.kewarganegaraan.kewarganegaraan-trash', compact('kewarganegaraan'));
      
      case 'pendidikan':
        $pendidikan = sip_pendidikan::onlyTrashed()->get();
        return view('admin.pendidikan.pendidikan-trash', compact('pendidikan'));

      case 'role':
          $role = Role::onlyTrashed()->get();
          return view('admin.role.role-trash', compact('role'));
        
      case 'userrole':
          $userrole = UserRole::onlyTrashed()->get();
          return view('admin.userrole.userrole-trash', compact('userrole'));
        
      case 'statusdosen':
        $statusdosen = sip_statusdosen::onlyTrashed()->get();
        return view('admin.statusdosen.statusdosen-trash', compact('statusdosen'));
      case 'statusaktifdosen':
        $statusaktifdosen = sip_statusaktifdosen::onlyTrashed()->get();
        return view('admin.statusaktifdosen.statusaktifdosen-trash', compact('statusaktifdosen'));
      
      case 'statuskerja':
        $statuskerja = sip_statuskerja::onlyTrashed()->get();
        return view('admin.statuskerja.statuskerja-trash', compact('statuskerja'));
      
      case 'statuspegawai':
        $statuspegawai = sip_statuspegawai::onlyTrashed()->get();
        return view('admin.statuspegawai.statuspegawai-trash', compact('statuspegawai'));
      
      case 'dosen-homebase':
        $dosen_homebase = sip_dosen_homebase::onlyTrashed()->get();
        return view('admin.dosen-homebase.dosen-homebase-trash', compact('dosen_homebase'));
      
      case 'pegawai':
        $pegawai = sip_pegawai::onlyTrashed()->get();
        return view('admin.pegawai.pegawai-trash', compact('pegawai'));

      case 'dosen':
        $dosen = sip_dosen::onlyTrashed()->get();
        return view('admin.dosen.dosen-trash', compact('dosen'));
      
      case 'jam_kerja':
        $jam_kerja = sip_jam_kerja::onlyTrashed()->get();
        return view("admin.jam_kerja.trash", compact('jam_kerja'));
      
      case 'jam_kerja_pegawai':
        $jam_kerja_pegawai = sip_jam_kerja_pegawai::onlyTrashed()->get();
        return view("admin.jam_kerja_pegawai.trash", compact('jam_kerja_pegawai'));
      
      default:
        abort(404);
        break;
    }
  }

  public function restore($model, $id)
  {
    switch ($model) {
      case 'agama':
        $agama = sip_agama::onlyTrashed()->where('id', $id);
        $agama->restore();
        return redirect('admin/trash/agama/index')->with('success', 'Restore berhasil.');

      case 'divisi':
        $divisi = sip_divisi::onlyTrashed()->where('id', $id);
        $divisi->restore();
        return redirect('admin/trash/divisi/index')->with('success', 'Restore berhasil.');
      
      case 'goldar':
        $goldar = sip_golongandarah::onlyTrashed()->where('id', $id);
        $goldar->restore();
        return redirect('admin/trash/goldar/index')->with('success', 'Restore berhasil.');
      
      case 'golongan':
        $golongan = sip_golongan::onlyTrashed()->where('id', $id);
        $golongan->restore();
        return redirect('admin/trash/golongan/index')->with('success', 'Restore berhasil.');
      
      case 'jabatan':
        $jabatan = sip_jabatan::onlyTrashed()->where('id', $id);
        $jabatan->restore();
        return redirect('admin/trash/jabatan/index')->with('success', 'Restore berhasil.');
      
      case 'jabatan-fungsional':
        $jabatan_fungsional = sip_jabatan_fungsional::onlyTrashed()->where('id', $id);
        $jabatan_fungsional->restore();
        return redirect('admin/trash/jabatan-fungsional/index')->with('success', 'Restore berhasil.');
      
      case 'jeniskelamin':
        $jeniskelamin = sip_jeniskelamin::onlyTrashed()->where('id', $id);
        $jeniskelamin->restore();
        return redirect('admin/trash/jeniskelamin/index')->with('success', 'Restore berhasil.');
      
      case 'kewarganegaraan':
        $kewarganegaraan = sip_kewarganegaraan::onlyTrashed()->where('id', $id);
        $kewarganegaraan->restore();
        return redirect('admin/trash/kewarganegaraan/index')->with('success', 'Restore berhasil.');
      
      case 'pendidikan':
        $pendidikan = sip_pendidikan::onlyTrashed()->where('id', $id);
        $pendidikan->restore();
        return redirect('admin/trash/pendidikan/index')->with('success', 'Restore berhasil.');

      case 'role':
          $role = Role::onlyTrashed()->where('id', $id);
          $role->restore();
          return redirect('admin/trash/role/index')->with('success', 'Restore berhasil.');

      case 'userrole':
          $userrole = UserRole::onlyTrashed()->where('id', $id);
          $userrole->restore();
          return redirect('admin/trash/userrole/index')->with('success', 'Restore berhasil.');
        
      case 'statusdosen':
        $statusdosen = sip_statusdosen::onlyTrashed()->where('id', $id);
        $statusdosen->restore();
        return redirect('admin/trash/statusdosen/index')->with('success', 'Restore berhasil.');
      case 'statusaktifdosen':
        $statusaktifdosen = sip_statusaktifdosen::onlyTrashed()->where('id', $id);
        $statusaktifdosen->restore();
        return redirect('admin/trash/statusaktifdosen/index')->with('success', 'Restore berhasil.');
      
      case 'statuskerja':
        $statuskerja = sip_statuskerja::onlyTrashed()->where('id', $id);
        $statuskerja->restore();
        return redirect('admin/trash/statuskerja/index')->with('success', 'Restore berhasil.');
      
      case 'statuspegawai':
        $statuspegawai = sip_statuspegawai::onlyTrashed()->where('id', $id);
        $statuspegawai->restore();
        return redirect('admin/trash/statuspegawai/index')->with('success', 'Restore berhasil.');
      
      case 'dosen-homebase':
        $dosen_homebase = sip_dosen_homebase::onlyTrashed()->where('id', $id);
        $dosen_homebase->restore();
        return redirect('admin/trash/dosen-homebase/index')->with('success', 'Restore berhasil.');
      
      case 'pegawai':
        $pegawai = sip_pegawai::onlyTrashed()->where('id', $id)->first();
        $pegawai->restore();
        return redirect('admin/trash/pegawai/index')->with('success', 'Restore berhasil.');

      case 'dosen':
        $dosen = sip_dosen::onlyTrashed()->where('id', $id)->first();
        $dosen->restore();
        return redirect('admin/trash/dosen/index')->with('success', 'Restore berhasil.');
      
      case 'jam-kerja':
        $pegawai = sip_jam_kerja::onlyTrashed()->where('id', $id);
        $pegawai->restore();
        return redirect('jam_kerja/trash')->with('success', 'Restore berhasil.');

      case 'jam_kerja_pegawai':
        $pegawai = sip_jam_kerja_pegawai::onlyTrashed()->where('id', $id);
        $pegawai->restore();
        return redirect('jam_kerja_pegawai/trash')->with('success', 'Restore berhasil.');

      default:
        abort(404);
        break;
      }
  }

  public function force_delete($model, $id)
  {
    switch ($model) {
      case 'agama':
        $agama = sip_agama::onlyTrashed()->where('id', $id);
        $agama->forceDelete();
        return redirect('admin/trash/agama/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'divisi':
        $divisi = sip_divisi::onlyTrashed()->where('id', $id);
        $divisi->forceDelete();
        return redirect('admin/trash/divisi/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'goldar':
        $goldar = sip_golongandarah::onlyTrashed()->where('id', $id);
        $goldar->forceDelete();
        return redirect('admin/trash/goldar/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'golongan':
        $golongan = sip_golongan::onlyTrashed()->where('id', $id);
        $golongan->forceDelete();
        return redirect('admin/trash/golongan/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'jabatan':
        $jabatan = sip_jabatan::onlyTrashed()->where('id', $id);
        $jabatan->forceDelete();
        return redirect('admin/trash/jabatan/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'jabatan-fungsional':
        $jabatan = sip_jabatan_fungsional::onlyTrashed()->where('id', $id);
        $jabatan->forceDelete();
        return redirect('admin/trash/jabatan-fungsional/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'jeniskelamin':
        $jeniskelamin = sip_jeniskelamin::onlyTrashed()->where('id', $id);
        $jeniskelamin->forceDelete();
        return redirect('admin/trash/jeniskelamin/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'kewarganegaraan':
        $kewarganegaraan = sip_kewarganegaraan::onlyTrashed()->where('id', $id);
        $kewarganegaraan->forceDelete();
        return redirect('admin/trash/kewarganegaraan/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'pendidikan':
        $pendidikan = sip_pendidikan::onlyTrashed()->where('id', $id);
        $pendidikan->forceDelete();
        return redirect('admin/trash/pendidikan/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'role':
        $role = Role::onlyTrashed()->where('id', $id);
        $role->forceDelete();
        return redirect('admin/trash/role/index')->with('success', 'Hapus permanen berhasil.');          
        
      case 'userrole':
        $userrole = UserRole::onlyTrashed()->where('id', $id);
        $userrole->forceDelete();
        return redirect('admin/trash/userrole/index')->with('success', 'Hapus permanen berhasil.');          
        
      case 'statusdosen':
        $statusdosen = sip_statusdosen::onlyTrashed()->where('id', $id);
        $statusdosen->forceDelete();
        return redirect('admin/trash/statusdosen/index')->with('success', 'Hapus permanen berhasil.');          
      case 'statusaktifdosen':
        $statusaktifdosen = sip_statusaktifdosen::onlyTrashed()->where('id', $id);
        $statusaktifdosen->forceDelete();
        return redirect('admin/trash/statusaktifdosen/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'statuskerja':
        $statuskerja = sip_statuskerja::onlyTrashed()->where('id', $id);
        $statuskerja->forceDelete();
        return redirect('admin/trash/statuskerja/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'statuspegawai':
        $statuspegawai = sip_statuspegawai::onlyTrashed()->where('id', $id);
        $statuspegawai->forceDelete();
        return redirect('admin/trash/statuspegawai/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'dosen-homebase':
        $dosen_homebase = sip_dosen_homebase::onlyTrashed()->where('id', $id);
        $dosen_homebase->forceDelete();
        return redirect('admin/trash/dosen-homebase/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'pegawai':
        $pegawai = sip_pegawai::onlyTrashed()->where('id', $id);
        $pegawai->forceDelete();
        return redirect('admin/trash/pegawai/index')->with('success', 'Hapus permanen berhasil.');          

      case 'dosen':
        $dosen = sip_dosen::onlyTrashed()->where('id', $id)->first();
        $dosen->forceDelete();
        return redirect('admin/trash/dosen/index')->with('success', 'Hapus permanen berhasil.');          
      
      case 'jam-kerja':
        $pegawai = sip_jam_kerja::onlyTrashed()->where('id', $id);
        $pegawai->forceDelete();
        return redirect('jam_kerja/trash')->with('success', 'Hapus permanen berhasil.');     

      case 'jam_kerja_pegawai':
        $pegawai = sip_jam_kerja_pegawai::onlyTrashed()->where('id', $id);
        $pegawai->forceDelete();
        return redirect('jam_kerja_pegawai/trash')->with('success', 'Hapus permanen berhasil.');     
      
      default:
        abort(404);
        break;
    }
  }

  public function laporanAbsensi(Request $request)
    {
      $months =[];
      if ($request->month) {
        $month = Carbon::parse($request->month);
      }else{
        $month = Carbon::now();
      }
      if ($request->from_day && $request->end_day) {
        $months [] = Carbon::parse("$request->from_day");
        for($i=1; $i < $now = Carbon::parse("$request->from_day")->diffInDays( Carbon::parse($request->end_day) ); $i++){
          $day = Carbon::parse("$request->from_day")->addDays($i);
          if ($day->isoFormat("dddd") != "Minggu" || $day->isoFormat("dddd") != "sabtu"){
            $months [] = $day;
          }
        }
      }else{
        for($i=1; $i < $month->daysInMonth +1; $i++){
          $day = Carbon::parse("{$month->format('Y-m')}-$i");
          if ($day->isoFormat("dddd") != "Minggu" || $day->isoFormat("dddd") != "sabtu"){
            $months [] = $day;
          }
        }
      }
      $pegawai = sip_pegawai::with("absensi")->get();

      return view("admin.laporan.absensi-index", compact("pegawai", "months"));
    }
    public function laporanAbsensiDetail(Request $request, $pegawai)
    {
      $months =[];
      if ($request->month) {
        $month = Carbon::parse($request->month);
      }else{
        $month = Carbon::now();
      }
      if ($request->from_day && $request->end_day) {
        $months [] = Carbon::parse("$request->from_day");
        for($i=1; $i < $now = Carbon::parse("$request->from_day")->diffInDays( Carbon::parse($request->end_day) ); $i++){
          $day = Carbon::parse("$request->from_day")->addDays($i);
          if ($day->isoFormat("dddd") != "Minggu" && $day->isoFormat("dddd") != "Sabtu"){
            $months [] = $day;
          }
        }
      }else{
        for($i=1; $i < $month->daysInMonth +1; $i++){
          $day = Carbon::parse("{$month->format('Y-m')}-$i");
          if ($day->isoFormat("dddd") != "Minggu" && $day->isoFormat("dddd") != "Sabtu"){
            $months [] = $day;
          }
        }
      }
      $pegawai = sip_pegawai::where("id",$pegawai)->with(["absensi", "jam_kerja"])->first();
      $data["pegawai"] = $pegawai;
      $data["absensi"] = $pegawai->absensi;
      $data["months"] = $months;
      $data["now"] = Carbon::now();
      return view("admin.laporan.absensi-detail", $data);
    }
}

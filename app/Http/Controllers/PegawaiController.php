<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\sip_divisi;
use App\sip_statuspegawai;
use App\sip_statuskerja;
use App\sip_pegawai;
use App\sip_agama;
use App\sip_jeniskelamin;
use App\sip_golongandarah;
use App\sip_golongan;
use App\sip_kewarganegaraan;
use App\sip_riwayatgolongan;
use App\sip_jabatan;
use App\sip_provinsi;
use App\sip_biodata;
use App\UserRole;
use App\User;
use Auth;
use DB;


class PegawaiController extends Controller
{
    public function index()
    {
        $data["cari"] = 0;
        $data["divisi"] = sip_divisi::all();
        $data["statuspegawai"] = sip_statuspegawai::all();
        $data["statuskerja"] = sip_statuskerja::all();
        $data["jabatan"] = sip_jabatan::all();
        $data["pegawai"] = sip_pegawai::all();
        return view('admin.pegawai.pegawai-index', $data);
    }

    public function create()
    {
        $data["divisi"] = sip_divisi::all();
        $data["statuskerja"] = sip_statuskerja::all();
        $data["jabatan"] = sip_jabatan::all();
        $data["statuspegawai"] = sip_statuspegawai::all();
        return view('admin.pegawai.pegawai-create', $data);
    }

    public function store(Request $request)
    {
        $user = User::firstOrCreate(
            [
                "name" => $request->nama,
                "username" => $request->username,
                "email" => $request->email,
            ],
            [
                "level" => 5,
                "password" => bcrypt($request->password),    
            ]
        );
        $user->level = 5;
        $user->password = bcrypt($request->password);
        $user->save();

        UserRole::create([
            "username" => $request->username,
            "kode_role" => 5,
        ]);

        $pegawai = sip_pegawai::create([
            "user" => $user->username,
            "namagelar" => $request->namagelar,
            "divisi" => $request->divisi,
            "statuskerja" => $request->statuskerja,
            "jabatan" => $request->jabatan,
            "statuspegawai" => $request->statuspegawai,
        ]);

        $biodata = sip_biodata::create([
            "user" => $user->username
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "create", $pegawai->namagelar, "Data pegawai", "Menambahkan data $pegawai->namagelar ke data Pegawai");
        $this->activity($name, "create", $user->name, "Data user", "Menambahkan data $user->name ke data User");
        
        return redirect()->route("pegawai.index")->with('success', "Data $user->name berhasil ditambah . . ."); 
    }

    public function edit($id)
    {
        $pegawai =  sip_pegawai::with("userz")->where('id', $id)->first();
        return $pegawai;
    }

    public function update(Request $request, $id)
    {
        $pegawai = sip_pegawai::findOrFail($id);
        $user = User::where('username', $pegawai->user)->first();
        $request->validate(
            [
                "username" => "required|unique:users,username,$user->id",
                'nama' => "required",
                "email" => "required",
            ],
            [
                'required' => 'The :attribute field is required.',
                'unique' => ':attribute is already used or In TRASH',
            ]
        );
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        $pegawai->namagelar = $request->namagelar;
        $pegawai->divisi = $request->divisi;
        $pegawai->statuskerja = $request->statuskerja;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->statuspegawai = $request->statuspegawai;
        $pegawai->save();

        $this->activity(auth()->user()->name, "update", $pegawai->namagelar, "Data pegawai", "Mengubah data $pegawai->namagelar");
        $this->activity(auth()->user()->name, "update", $user->name, "Data user", "Mengubah data $user->name");
        return redirect()->route("pegawai.index")->with('success', "Data $user->name berhasil di ubah . . ."); 
        
    }

    public function show($id)
    {
        $data["pegawai"] = sip_pegawai::findOrFail($id);
        $data["agama"] = sip_agama::whereNull('deleted_at')->orderBy('agama', 'asc')->get();
        $data["jeniskelamin"] = sip_jeniskelamin::whereNull('deleted_at')->orderBy('jeniskelamin', 'asc')->get();
        $data["goldar"] = sip_golongandarah::whereNull('deleted_at')->orderBy('goldar', 'asc')->get();
        $data["kewarganegaraan"] = sip_kewarganegaraan::whereNull('deleted_at')->orderBy('kewarganegaraan', 'asc')->get();
        $data["provinsi"] = sip_provinsi::orderBy('id', 'asc')->get();
        $data["kota"] = DB::table('indonesia_cities')->orderBy('id', 'asc')->get();
        $data["kecamatan"] = DB::table('indonesia_districts')->orderBy('id', 'asc')->get();
        $data["kelurahan"] = DB::table('indonesia_villages')->orderBy('id', 'asc')->get();
        return view("admin.pegawai.pegawai-detail", $data);
    }

    public function destroy($id)
    {
        $pegawai = sip_pegawai::findOrFail($id);
        
        $this->activity(auth()->user()->name, "delete", $pegawai->namagelar, "data pegawai", "Menghapus [$pegawai->namagelar] dari data pegawai");
        $pegawai->delete();
        
        return redirect()->route("pegawai.index")->with('success', 'Data berhasil dihapus . . .');
    }

    public function search(Request $request)
    {
        $data["divisi"] = sip_divisi::all();
        $data["statuspegawai"] = sip_statuspegawai::all();
        $data["statuskerja"] = sip_statuskerja::all();
        $data["pegawai"] = sip_pegawai::where('namagelar', 'like', "%$request->q%")->all();
        $data["query"] = $request->q;
        $data["total"] = count(sip_pegawai::all());

        return view('admin.pegawai.pegawai-index', $data);
    }
    
    public function filter($id, $column)
    {
        $pegawai = sip_pegawai::where('user', "!=", 0);
        switch ($column) {
            case 'divisi':
                $pegawai = $pegawai->where("divisi", $id);
                break;

            case 'statuskerja':
                $pegawai->where("statuskerja", $id);
                break;

            case 'statuspegawai':
                $pegawai->where("statuspegawai", $id);
                break;
            
            default:
                # code...
                break;
        }
        $data["divisi"] = sip_divisi::all();
        $data["statuspegawai"] = sip_statuspegawai::all();
        $data["statuskerja"] = sip_statuskerja::all();
        $data["jabatan"] = sip_jabatan::all();
        $data["filter"] = "$column";
        $data["total"] = count(sip_pegawai::all());
        $pegawai = $pegawai->get();
        return view('admin.pegawai.pegawai-index', $data, compact('pegawai'));
    }

    public function updateFoto(Request $request, $id)
    {
        $user = sip_pegawai::findOrFail($id);
        if($fotolama = $user->userz->foto ){
            Storage::disk('ftp')->delete("simpeg/foto_user/$fotolama");
        }

        $username = $user->userz->username;

        $image = str_replace('data:image/png;base64,', '', $request['foto']);
        $image = str_replace(' ', '+', $image);
        $file = base64_decode($image);

        $safeName = "foto-$username.png";
        Storage::disk('ftp')->put("simpeg/foto_user/$safeName", $file);
        $user->userz->foto= $safeName;
        $user->userz->save();

        $this->activity(Auth::user()->name, "update", $user->namagelar, "Foto Profile", "Update Foto [$username-$user->namagelar]");
        
    }
    public function createBiodata(Request $request, sip_pegawai $id)
    {
        sip_biodata::create([
            'user' => $id->user
        ]);
        return redirect()->route("pegawai.show", $id->id)->with('success', "Biodata $id->user berhasil ditambah . . ."); 
    }
    public function updateBiodata(Request $request, $id)
    {
        $biodata = sip_biodata::findOrFail($id);

        $biodata->nomorktp = $request->nik;
        $biodata->jeniskelamin = $request->jeniskelamin;
        $biodata->goldar = $request->goldar;
        $biodata->agama = $request->agama;
        $biodata->kewarganegaraan = $request->kewarganegaraan;
        $biodata->tempatlahir = $request->tempatlahir;
        $biodata->tanggallahir = $request->tanggallahir;
        $biodata->alamat = $request->alamat;
        $biodata->rt = $request->rt;
        $biodata->rw = $request->rw;
        $biodata->kelurahan = $request->kelurahan;
        $biodata->kecamatan = $request->kecamatan;
        $biodata->kota = $request->kota;
        $biodata->provinsi = $request->provinsi;
        $biodata->kodepos = $request->kodepos;
        $biodata->notelprumah = $request->notelprumah;
        $biodata->nohp = $request->nohp;
        $biodata->npwp = $request->npwp;
        $biodata->save();

        $this->activity(auth()->user()->username, "update", $biodata->User->name, "data biodata", "Memperbarui data biodata dengan id => [$id - {$biodata->User->name}]");

        return redirect()->back()->with('success', "Biodata {$biodata->User->username} berhasil diupdate . . .");
    }

    // ID CARD
    public function idCardShow($id)
    {
      $pegawai = sip_pegawai::findOrFail($id);
      return view("admin.idcard.pegawai.show", compact("pegawai"));
    }
  
    public function idCardIndex()
    {
      $data["cari"] = 0;
      $data["divisi"] = sip_divisi::all();
      $data["statuspegawai"] = sip_statuspegawai::all();
      $data["statuskerja"] = sip_statuskerja::all();
      $data["jabatan"] = sip_jabatan::all();
      $data["pegawai"] = sip_pegawai::all();
      return view("idcard.pegawai", $data);
    }
    // END IDCARD

}

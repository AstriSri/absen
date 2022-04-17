<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\sip_agama;
use App\sip_biodata;
use App\sip_divisi;
use App\sip_dosen_homebase;
use App\sip_dosen;
use App\sip_jabatan_fungsional;
use App\sip_golongandarah;
use App\sip_golongan;
use App\sip_jeniskelamin;
use App\sip_kewarganegaraan;
use App\sip_provinsi;
use App\sip_statusdosen;
use App\sip_statusaktifdosen;
use App\UserRole;
use App\User;
use Auth;
use DB;


class DosenController extends Controller
{
    public function index()
    {
        $data["cari"] = 0;
        $data["statusdosen"] = sip_statusdosen::all();
        $data["statusaktifdosen"] = sip_statusaktifdosen::all();
        $data["homebase"] = sip_dosen_homebase::all();
        $data["jabatan_fungsional"] = sip_jabatan_fungsional::all();
        $data["dosen"] = sip_dosen::all();
        return view('admin.dosen.dosen-index', $data);
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
                "password" => bcrypt($request->password),
            ]
        );
        $user->password = bcrypt($request->password);
        $user->save();

        UserRole::create([
            "username" => $request->username,
            "kode_role" => 7,
        ]);

        $dosen = sip_dosen::create([
            "user" => $user->username,
            "namagelar" => $request->namagelar,
            "divisi" => $request->divisi,
            "homebase" => $request->homebase,
            "jabatan_fungsional" => $request->jabatan,
            "statusdosen" => $request->statusdosen,
            "nidn" => $request->nidn,
            "statusaktifdosen" => $request->statusaktifdosen,
        ]);

        $biodata = sip_biodata::create([
            "user" => $user->username
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "create", $dosen->nama, "Data dosen", "Menambahkan data $dosen->nama ke data dosen");
        $this->activity($name, "create", $user->name, "Data user", "Menambahkan data $user->name ke data User");
        
        return redirect()->route("dosen.index")->with('success', "Data $user->name berhasil ditambah . . ."); 
    }

    public function edit($id)
    {
        $dosen =  sip_dosen::with("userz")->where('id', $id)->first();
        return $dosen;
    }

    public function update(Request $request, $id)
    {
        $dosen = sip_dosen::findOrFail($id);
        $user = User::where('username', $dosen->user)->first();
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
        $dosen->namagelar = $request->namagelar;
        $dosen->homebase = $request->homebase;
        $dosen->jabatan_fungsional = $request->jabatan;
        $dosen->nidn = $request->nidn;
        $dosen->statusaktifdosen = $request->statusaktifdosen;
        $dosen->statusdosen = $request->statusdosen;
        $dosen->save();

        $this->activity(auth()->user()->name, "update", $dosen->namagelar, "Data dosen", "Mengubah data $dosen->namagelar");
        $this->activity(auth()->user()->name, "update", $user->name, "Data user", "Mengubah data $user->name");
        return redirect()->route("dosen.index")->with('success', "Data $user->name berhasil di ubah . . ."); 
        
    }

    public function show($id)
    {
        $data["dosen"] = sip_dosen::findOrFail($id);
        $data["agama"] = sip_agama::whereNull('deleted_at')->orderBy('agama', 'asc')->get();
        $data["jeniskelamin"] = sip_jeniskelamin::whereNull('deleted_at')->orderBy('jeniskelamin', 'asc')->get();
        $data["goldar"] = sip_golongandarah::whereNull('deleted_at')->orderBy('goldar', 'asc')->get();
        $data["kewarganegaraan"] = sip_kewarganegaraan::whereNull('deleted_at')->orderBy('kewarganegaraan', 'asc')->get();
        $data["provinsi"] = sip_provinsi::orderBy('id', 'asc')->get();
        $data["kota"] = DB::table('indonesia_cities')->orderBy('id', 'asc')->get();
        $data["kecamatan"] = DB::table('indonesia_districts')->orderBy('id', 'asc')->get();
        $data["kelurahan"] = DB::table('indonesia_villages')->orderBy('id', 'asc')->get();
        return view("admin.dosen.dosen-detail", $data);
    }

    public function destroy($id)
    {
        $dosen = sip_dosen::findOrFail($id);
        
        $this->activity(auth()->user()->name, "delete", $dosen->namagelar, "data dosen", "Menghapus [$dosen->namagelar] dari data dosen");
        $dosen->delete();
        
        return redirect()->route("dosen.index")->with('success', 'Data berhasil dihapus . . .');
    }
    
    public function filter($id, $column)
    {
        $dosen = sip_dosen::where('user', "!=", 0);
        switch ($column) {
            case 'homebase':
                $dosen->where("homebase", $id);
                break;
            case 'statusdosen':
                $dosen->where("statusdosen", $id);
                break;
            case 'statusaktifdosen':
                $dosen->where("statusaktifdosen", $id);
                break;
            default:
                # code...
                break;
        }
        $data["statusdosen"] = sip_statusdosen::all();
        $data["statusaktifdosen"] = sip_statusaktifdosen::all();
        $data["homebase"] = sip_dosen_homebase::all();
        $data["jabatan_fungsional"] = sip_jabatan_fungsional::all();
        $data["filter"] = "$column";
        $data["total"] = count(sip_dosen::all());
        $dosen = $dosen->get();
        
        return view('admin.dosen.dosen-index', $data, compact('dosen'));
    }

    public function updateFoto(Request $request, $id)
    {
        $user = sip_dosen::findOrFail($id);
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

    public function createBiodata(Request $request, sip_dosen $id)
    {
        sip_biodata::create([
            'user' => $id->user
        ]);
        return redirect()->route("dosen.show", $id->id)->with('success', "Biodata $id->user berhasil ditambah . . ."); 
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
      $dosen = sip_dosen::findOrFail($id);
      return view("admin.idcard.dosen.show", compact("dosen"));
    }
  
    public function idCardIndex()
    {
      $data["cari"] = 0;
      $data["divisi"] = sip_divisi::all();
      $data["statusdosen"] = sip_statusdosen::all();
      $data["jabatan_fungsional"] = sip_jabatan_fungsional::all();
      $data["dosen"] = sip_dosen::all();
      return view("admin.idcard.dosen.index", $data);
    }
    public function idCardCetak(Request $request)
    {
      foreach($request->id as $i){
        $id[] = sip_dosen::findOrFail($i);
      }
      return view("admin.idcard.dosen.cetak", compact("id"));
    }
    // END IDCARD
}

<?php

namespace App\Http\Controllers\Riwayat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sip_pendidikan;
use App\sip_pegawai;
use App\sip_dosen;
use App\sip_riwayatpendidikan;

class RiwayatPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["pendidikan"] = sip_pendidikan::whereNull('deleted_at')->orderBy('pendidikan', 'asc')->get();
        return view('riwayat.riwayatpendidikan-tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "pendidikan" => "required",
                "tahunlulus" => "required",
                "namasekolah" => "required",
                "noijazah" => "required",
            ],
            [
                'required' => 'The :attribute field is required.',
                'unique' => ':attribute is already used or In TRASH',
            ]
        );
        $username = auth()->user()->username;
        $riwayat = sip_riwayatpendidikan::create([
            "user" => $username,
            "pendidikan" => $request->pendidikan,
            "tahunlulus" => $request->tahunlulus,
            "namasekolah" => $request->namasekolah,
            "noijazah" => $request->noijazah,
        ]);
        if (auth()->user()->role->first()->kode_role == "5") {
            $namagelar = sip_pegawai::where("user", $username)->first()->namagelar;
        }else{
            $namagelar = sip_dosen::where("user", $username)->first()->namagelar;
        }
        $this->activity( auth()->user()->name, "create", $namagelar, "Data riwayat pendidikan pegawai", "Menambahkan riwayat pendidikan [$username $namagelar]");

        return redirect()->route("profil")->with('success', "Data {$riwayat->Pendidikan->pendidikan} berhasil ditambah . . ."); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["pendidikan"] = sip_pendidikan::whereNull('deleted_at')->orderBy('pendidikan', 'asc')->get();
        $data["riwayatpendidikan"] = sip_riwayatpendidikan::findOrfail($id);

        return view('riwayat.riwayatpendidikan-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                "pendidikan" => "required",
                "tahunlulus" => "required",
                "namasekolah" => "required",
                "noijazah" => "required",
            ],
            [
                'required' => 'The :attribute field is required.',
                'unique' => ':attribute is already used or In TRASH',
            ]
        );
        $username = auth()->user()->username;
        sip_riwayatpendidikan::findOrFail($id)->update([
            "user" => $username,
            "pendidikan" => $request->pendidikan,
            "tahunlulus" => $request->tahunlulus,
            "namasekolah" => $request->namasekolah,
            "noijazah" => $request->noijazah,
        ]);
        if (auth()->user()->role->first()->kode_role == "5") {
            $namagelar = sip_pegawai::where("user", $username)->first()->namagelar;
        }else{
            $namagelar = sip_dosen::where("user", $username)->first()->namagelar;
        }
        $riwayat = sip_riwayatpendidikan::findOrFail($id);
        $this->activity( auth()->user()->name, "create", $namagelar, "Data riwayat pendidikan", "Menambahkan riwayat pendidikan [$username $namagelar]");

        return redirect()->route("profil")->with('success', "Data {$riwayat->Pendidikan->pendidikan} berhasil diubah . . ."); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sip_pegawai $pegawai, $id)
    {
        if (auth()->user()->role->first()->kode_role == "5") {
            $namagelar = sip_pegawai::where("user", auth()->user()->username)->first()->namagelar;
        }else{
            $namagelar = sip_dosen::where("user", auth()->user()->username)->first()->namagelar;
        }
        $riwayat = sip_riwayatpendidikan::findOrFail($id);
        $this->activity(auth()->user()->name, "delete", $riwayat->noijazah, "data Riwayat pendidikan", "Menghapus [$riwayat->noijazah $namagelar] dari data Riwayat pendidikan");
        $riwayat->forceDelete();

        return redirect()->route("profil")->with('success', "Data [$riwayat->noijazah $namagelar] berhasil dihapus . . .");
    }
}

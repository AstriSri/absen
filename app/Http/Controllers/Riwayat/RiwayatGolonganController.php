<?php

namespace App\Http\Controllers\Riwayat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sip_golongan;
use App\sip_pegawai;
use App\sip_dosen;
use App\sip_riwayatgolongan;

class RiwayatGolonganController extends Controller
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
        $data["golongan"] = sip_golongan::whereNull('deleted_at')->orderBy('golongan', 'asc')->get();
        return view('riwayat.riwayatgolongan-tambah', $data);
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
                'no_sk' => "required|unique:sip_riwayatgolongan",
                "golongan" => "required",
                "tanggal_sk" => "required",
                "tanggal_mulai" => "required",
                "nama_ttd" => "required",
                "tmt" => "required",
            ],
            [
                'required' => 'The :attribute field is required.',
                'unique' => ':attribute is already used or In TRASH',
            ]
        );
        $username = auth()->user()->username;
        $riwayat = sip_riwayatgolongan::create([
            "user" => $username,
            "golongan" => $request->golongan,
            "no_sk" => $request->no_sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "nama_ttd" => $request->nama_ttd,
            "tmt" => $request->tmt,
        ]);

        if (auth()->user()->role->first()->kode_role == "5") {
            $namagelar = sip_pegawai::where("user", $username)->first()->namagelar;
        }else{
            $namagelar = sip_dosen::where("user", $username)->first()->namagelar;
        }
        $this->activity( auth()->user()->name, "create", $namagelar, "Data riwayat golongan", "Menambahkan riwayat golongan [$username $namagelar]");

        return redirect()->route("profil")->with('success', "Data {$riwayat->Golongan->golongan} berhasil ditambah . . ."); 
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
        $data["golongan"] = sip_golongan::whereNull('deleted_at')->orderBy('golongan', 'asc')->get();
        $data["riwayatgolongan"] = sip_riwayatgolongan::findOrfail($id);

        return view('riwayat.riwayatgolongan-edit', $data);
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
                'no_sk' => "required",
                "golongan" => "required",
                "tanggal_sk" => "required",
                "tanggal_mulai" => "required",
                "nama_ttd" => "required",
                "tmt" => "required",
            ],
            [
                'required' => 'The :attribute field is required.',
                'unique' => ':attribute is already used or In TRASH',
            ]
        );
        $username = auth()->user()->username;
        sip_riwayatgolongan::find($id)->update([
            "user" => $username,
            "golongan" => $request->golongan,
            "no_sk" => $request->no_sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "nama_ttd" => $request->nama_ttd,
            "tmt" => $request->tmt,
        ]);
        $riwayat = sip_riwayatgolongan::find($id);
        if (auth()->user()->role->first()->kode_role == "5") {
            $namagelar = sip_pegawai::where("user", $username)->first()->namagelar;
        }else{
            $namagelar = sip_dosen::where("user", $username)->first()->namagelar;
        }
        $this->activity( auth()->user()->name, "create", $namagelar, "Data riwayat golongan", "Mengubah riwayat golongan [$username $namagelar]");

        return redirect()->route("profil")->with('success', "Data {$riwayat->Golongan->golongan} berhasil diubah . . ."); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->role->first()->kode_role == "5") {
            $namagelar = sip_pegawai::where("user",auth()->user()->username)->first()->namagelar;
        }else{
            $namagelar = sip_dosen::where("user",auth()->user()->username)->first()->namagelar;
        }
        $riwayat = sip_riwayatgolongan::findOrFail($id);
        $this->activity(auth()->user()->name, "delete", $riwayat->no_sk, "data Riwayat Golongan", "Menghapus [$riwayat->no_sk $namagelar] dari data Riwayat Golongan");
        $riwayat->forceDelete();
        
        return redirect()->route("profil")->with('success', "Data [$riwayat->no_sk $namagelar] berhasil dihapus . . .");
    }
}

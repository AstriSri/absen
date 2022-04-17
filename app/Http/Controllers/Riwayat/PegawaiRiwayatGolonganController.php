<?php

namespace App\Http\Controllers\Riwayat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sip_golongan;
use App\sip_pegawai;
use App\sip_riwayatgolongan;

class PegawaiRiwayatGolonganController extends Controller
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
    public function create($id)
    {
        $data["pegawai"] = sip_pegawai::findOrFail($id);
        $data["golongan"] = sip_golongan::whereNull('deleted_at')->orderBy('golongan', 'asc')->get();
        return view('admin.pegawai.riwayat.pegawai-riwayatgolongan-tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
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
        $pegawai = sip_pegawai::findOrFail($id);
        $riwayat = sip_riwayatgolongan::create([
            "user" => $pegawai->user,
            "golongan" => $request->golongan,
            "no_sk" => $request->no_sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "nama_ttd" => $request->nama_ttd,
            "tmt" => $request->tmt,
        ]);

        $this->activity( auth()->user()->name, "create", $pegawai->namagelar, "Data riwayat golongan pegawai", "Menambahkan riwayat golongan [$pegawai->user $pegawai->namagelar]");

        return redirect()->route("pegawai.show", $id)->with('success', "Data {$riwayat->Golongan->golongan} berhasil ditambah . . ."); 
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
    public function edit($pegawai, $id)
    {
        $data["pegawai"] = sip_pegawai::findOrFail($pegawai);
        $data["golongan"] = sip_golongan::whereNull('deleted_at')->orderBy('golongan', 'asc')->get();
        $data["riwayatgolongan"] = sip_riwayatgolongan::findOrfail($id);

        return view('admin.pegawai.riwayat.pegawai-riwayatgolongan-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sip_pegawai $pegawai, $id)
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
        
        sip_riwayatgolongan::find($id)->update([
            "user" => $pegawai->user,
            "golongan" => $request->golongan,
            "no_sk" => $request->no_sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "nama_ttd" => $request->nama_ttd,
            "tmt" => $request->tmt,
        ]);
        $riwayat = sip_riwayatgolongan::find($id);
        $this->activity( auth()->user()->name, "create", $pegawai->namagelar, "Data riwayat golongan pegawai", "Mengubah riwayat golongan [$pegawai->user $pegawai->namagelar]");

        return redirect()->route("pegawai.show", $pegawai->id)->with('success', "Data {$riwayat->Golongan->golongan} berhasil diubah . . ."); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sip_pegawai $pegawai, $id)
    {
        $riwayat = sip_riwayatgolongan::findOrFail($id);
        $this->activity(auth()->user()->name, "delete", $riwayat->no_sk, "data Riwayat Golongan", "Menghapus [$riwayat->no_sk $pegawai->namagelar] dari data Riwayat Golongan");
        $riwayat->delete();
        
        return redirect()->back()->with('success', "Data [$riwayat->no_sk $pegawai->namagelar] berhasil dihapus . . .");
    }
}

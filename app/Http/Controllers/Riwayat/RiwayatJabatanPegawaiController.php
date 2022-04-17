<?php

namespace App\Http\Controllers\Riwayat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sip_jabatan;
use App\sip_pegawai;
use App\sip_riwayatjabatanpegawai;

class RiwayatJabatanPegawaiController extends Controller
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
        $data["jabatan"] = sip_jabatan::whereNull('deleted_at')->orderBy('jabatan', 'asc')->get();
        return view('riwayat.pegawai-riwayatjabatan-tambah', $data);
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
                'no_sk' => "required|unique:sip_riwayatjabatanpegawai",
                "jabatan" => "required",
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
        $riwayat = sip_riwayatjabatanpegawai::create([
            "user" => $username,
            "jabatan" => $request->jabatan,
            "no_sk" => $request->no_sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "nama_ttd" => $request->nama_ttd,
            "tmt" => $request->tmt,
        ]);
        $namagelar = sip_pegawai::where("user", $username)->first()->namagelar;
        $this->activity( auth()->user()->name, "create", $namagelar, "Data riwayat jabatan", "Menambahkan riwayat jabatan [$username $namagelar]");

        return redirect()->route("profil")->with('success', "Data {$riwayat->Jabatan->jabatan} berhasil ditambah . . ."); 
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
        $data["jabatan"] = sip_jabatan::whereNull('deleted_at')->orderBy('jabatan', 'asc')->get();
        $data["riwayatjabatanpegawai"] = sip_riwayatjabatanpegawai::findOrfail($id);

        return view('riwayat.pegawai-riwayatjabatan-edit', $data);
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
                "jabatan" => "required",
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
        sip_riwayatjabatanpegawai::findOrFail($id)->update([
            "user" => $username,
            "jabatan" => $request->jabatan,
            "no_sk" => $request->no_sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "nama_ttd" => $request->nama_ttd,
            "tmt" => $request->tmt,
        ]);
        $riwayat = sip_riwayatjabatanpegawai::findOrFail($id);
        $namagelar = sip_pegawai::where("user", $username)->first()->namagelar;
        $this->activity( auth()->user()->name, "create", $namagelar, "Data riwayat jabatan", "Menambahkan riwayat jabatan [$username $namagelar]");

        return redirect()->route("profil")->with('success', "Data {$riwayat->Jabatan->jabatan} berhasil diubah . . ."); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $riwayat = sip_riwayatjabatanpegawai::findOrFail($id);
        $namagelar = sip_pegawai::where("user", auth()->user()->username)->first()->namagelar;
        $this->activity(auth()->user()->name, "delete", $riwayat->no_sk, "Data Riwayat Jabatan", "Menghapus [$riwayat->no_sk $namagelar] dari data Riwayat Jabatan");
        $riwayat->forceDelete();

        return redirect()->route("profil")->with('success', "Data [$riwayat->no_sk $namagelar] berhasil dihapus . . .");
    }
}

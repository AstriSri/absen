<?php

namespace App\Http\Controllers\Riwayat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sip_jabatan;
use App\sip_dosen;
use App\sip_riwayatjabatandosen;

class DosenRiwayatjabatanController extends Controller
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
        $data["dosen"] = sip_dosen::findOrFail($id);
        $data["jabatan"] = sip_jabatan::whereNull('deleted_at')->orderBy('jabatan', 'asc')->get();
        return view('admin.dosen.riwayat.dosen-riwayatjabatan-tambah', $data);
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
                'no_sk' => "required|unique:sip_riwayatjabatandosen",
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
        $dosen = sip_dosen::findOrFail($id);
        $riwayat = sip_riwayatjabatandosen::create([
            "user" => $dosen->user,
            "jabatan" => $request->jabatan,
            "no_sk" => $request->no_sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "nama_ttd" => $request->nama_ttd,
            "tmt" => $request->tmt,
        ]);
        $this->activity( auth()->user()->name, "create", $dosen->namagelar, "Data riwayat jabatan dosen", "Menambahkan riwayat jabatan [$dosen->user $dosen->namagelar]");

        return redirect()->route("dosen.show", $id)->with('success', "Data {$riwayat->Jabatan->jabatan} berhasil ditambah . . ."); 
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
    public function edit($dosen, $id)
    {
        $data["dosen"] = sip_dosen::findOrFail($dosen);
        $data["jabatan"] = sip_jabatan::whereNull('deleted_at')->orderBy('jabatan', 'asc')->get();
        $data["riwayatjabatan"] = sip_riwayatjabatandosen::findOrfail($id);

        return view('admin.dosen.riwayat.dosen-riwayatjabatan-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sip_dosen $dosen, $id)
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
        sip_riwayatjabatandosen::findOrFail($id)->update([
            "user" => $dosen->user,
            "jabatan" => $request->jabatan,
            "no_sk" => $request->no_sk,
            "tanggal_sk" => $request->tanggal_sk,
            "tanggal_mulai" => $request->tanggal_mulai,
            "nama_ttd" => $request->nama_ttd,
            "tmt" => $request->tmt,
        ]);
        $riwayat = sip_riwayatjabatandosen::findOrFail($id);
        $this->activity( auth()->user()->name, "create", $dosen->namagelar, "Data riwayat jabatan dosen", "Menambahkan riwayat jabatan [$dosen->user $dosen->namagelar]");

        return redirect()->route("dosen.show", $dosen->id)->with('success', "Data {$riwayat->Jabatan->jabatan} berhasil diubah . . ."); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sip_dosen $dosen, $id)
    {
        $riwayat = sip_riwayatjabatandosen::findOrFail($id);
        $this->activity(auth()->user()->name, "delete", $riwayat->no_sk, "data Riwayat Jabatan", "Menghapus [$riwayat->no_sk $dosen->namagelar] dari data Riwayat Jabatan");
        $riwayat->delete();

        return redirect()->back()->with('success', "Data [$riwayat->no_sk $dosen->namagelar] berhasil dihapus . . .");
    }
}

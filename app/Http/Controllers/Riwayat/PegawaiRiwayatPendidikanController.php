<?php

namespace App\Http\Controllers\Riwayat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sip_pendidikan;
use App\sip_pegawai;
use App\sip_riwayatpendidikan;

class PegawaiRiwayatPendidikanController extends Controller
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
        $data["pendidikan"] = sip_pendidikan::whereNull('deleted_at')->orderBy('pendidikan', 'asc')->get();
        return view('admin.pegawai.riwayat.pegawai-riwayatpendidikan-tambah', $data);
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
        $pegawai = sip_pegawai::findOrFail($id);
        $riwayat = sip_riwayatpendidikan::create([
            "user" => $pegawai->user,
            "pendidikan" => $request->pendidikan,
            "tahunlulus" => $request->tahunlulus,
            "namasekolah" => $request->namasekolah,
            "noijazah" => $request->noijazah,
        ]);
        $this->activity( auth()->user()->name, "create", $pegawai->namagelar, "Data riwayat pendidikan pegawai", "Menambahkan riwayat pendidikan [$pegawai->user $pegawai->namagelar]");

        return redirect()->route("pegawai.show", $id)->with('success', "Data {$riwayat->Pendidikan->pendidikan} berhasil ditambah . . ."); 
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
        $data["pendidikan"] = sip_pendidikan::whereNull('deleted_at')->orderBy('pendidikan', 'asc')->get();
        $data["riwayatpendidikan"] = sip_riwayatpendidikan::findOrfail($id);

        return view('admin.pegawai.riwayat.pegawai-riwayatpendidikan-edit', $data);
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
        sip_riwayatpendidikan::findOrFail($id)->update([
            "user" => $pegawai->user,
            "pendidikan" => $request->pendidikan,
            "tahunlulus" => $request->tahunlulus,
            "namasekolah" => $request->namasekolah,
            "noijazah" => $request->noijazah,
        ]);
        $riwayat = sip_riwayatpendidikan::findOrFail($id);
        $this->activity( auth()->user()->name, "create", $pegawai->namagelar, "Data riwayat pendidikan pegawai", "Menambahkan riwayat pendidikan [$pegawai->user $pegawai->namagelar]");

        return redirect()->route("pegawai.show", $pegawai->id)->with('success', "Data {$riwayat->Pendidikan->pendidikan} berhasil diubah . . ."); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sip_pegawai $pegawai, $id)
    {
        $riwayat = sip_riwayatpendidikan::findOrFail($id);
        $this->activity(auth()->user()->name, "delete", $riwayat->noijazah, "data Riwayat pendidikan", "Menghapus [$riwayat->noijazah $pegawai->namagelar] dari data Riwayat pendidikan");
        $riwayat->delete();

        return redirect()->back()->with('success', "Data [$riwayat->noijazah $pegawai->namagelar] berhasil dihapus . . .");
    }
}

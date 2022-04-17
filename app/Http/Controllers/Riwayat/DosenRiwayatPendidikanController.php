<?php

namespace App\Http\Controllers\Riwayat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sip_pendidikan;
use App\sip_dosen;
use App\sip_riwayatpendidikan;

class DosenRiwayatPendidikanController extends Controller
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
        $data["pendidikan"] = sip_pendidikan::whereNull('deleted_at')->orderBy('pendidikan', 'asc')->get();
        return view('admin.dosen.riwayat.dosen-riwayatpendidikan-tambah', $data);
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
        $dosen = sip_dosen::findOrFail($id);
        $riwayat = sip_riwayatpendidikan::create([
            "user" => $dosen->user,
            "pendidikan" => $request->pendidikan,
            "tahunlulus" => $request->tahunlulus,
            "namasekolah" => $request->namasekolah,
            "noijazah" => $request->noijazah,
        ]);
        $this->activity( auth()->user()->name, "create", $dosen->namagelar, "Data riwayat pendidikan dosen", "Menambahkan riwayat pendidikan [$dosen->user $dosen->namagelar]");

        return redirect()->route("dosen.show", $id)->with('success', "Data {$riwayat->Pendidikan->pendidikan} berhasil ditambah . . ."); 
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
        $data["pendidikan"] = sip_pendidikan::whereNull('deleted_at')->orderBy('pendidikan', 'asc')->get();
        $data["riwayatpendidikan"] = sip_riwayatpendidikan::findOrfail($id);

        return view('admin.dosen.riwayat.dosen-riwayatpendidikan-edit', $data);
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
            "user" => $dosen->user,
            "pendidikan" => $request->pendidikan,
            "tahunlulus" => $request->tahunlulus,
            "namasekolah" => $request->namasekolah,
            "noijazah" => $request->noijazah,
        ]);
        $riwayat = sip_riwayatpendidikan::findOrFail($id);
        $this->activity( auth()->user()->name, "create", $dosen->namagelar, "Data riwayat pendidikan dosen", "Menambahkan riwayat pendidikan [$dosen->user $dosen->namagelar]");

        return redirect()->route("dosen.show", $dosen->id)->with('success', "Data {$riwayat->Pendidikan->pendidikan} berhasil diubah . . ."); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sip_dosen $dosen, $id)
    {
        $riwayat = sip_riwayatpendidikan::findOrFail($id);
        $this->activity(auth()->user()->name, "delete", $riwayat->noijazah, "data Riwayat pendidikan", "Menghapus [$riwayat->noijazah $dosen->namagelar] dari data Riwayat pendidikan");
        $riwayat->delete();

        return redirect()->back()->with('success', "Data [$riwayat->noijazah $dosen->namagelar] berhasil dihapus . . .");
    }
}

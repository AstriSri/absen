<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_kewarganegaraan;

class KewarganegaraanController extends Controller
{
    public function index()
    {
        $data["kewarganegaraan"] = sip_kewarganegaraan::orderBy('kewarganegaraan', 'asc')->get();
        return view('admin.kewarganegaraan.kewarganegaraan-index', $data);
    }

    public function show($id)
    {
        abort(404);
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
                'kewarganegaraan' => "required|unique:sip_kewarganegaraan",
                'kode' => "required|unique:sip_kewarganegaraan",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $kewarganegaraan = sip_kewarganegaraan::create([
            "kewarganegaraan" => $request->kewarganegaraan,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $kewarganegaraan->kewarganegaraan, "data kewarganegaraan", "Menambah data kewarganegaraan dengan id => [$kewarganegaraan->id - $kewarganegaraan->kewarganegaraan]");

        return redirect()->route("kewarganegaraan.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["kewarganegaraan"] = sip_kewarganegaraan::where("id", "=", $id)->first();

        return view('admin.kewarganegaraan.kewarganegaraan-edit', $data);
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
                'kewarganegaraan' => "required|unique:sip_kewarganegaraan,kewarganegaraan,$id",
                'kode' => "required|unique:sip_kewarganegaraan,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $kewarganegaraan = sip_kewarganegaraan::findOrFail($id);
        $kewarganegaraan->kewarganegaraan = $request->kewarganegaraan;
        $kewarganegaraan->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $kewarganegaraan->kewarganegaraan, "data kewarganegaraan", "Memperbarui data kewarganegaraan dengan id => [$id - $kewarganegaraan->kewarganegaraan]");
        
        $kewarganegaraan->save();

        return redirect()->route('kewarganegaraan.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kewarganegaraan = sip_kewarganegaraan::findOrFail($id);
        $kewarganegaraan->delete();
        $this->activity(auth()->user()->name, "delete", $kewarganegaraan->kewarganegaraan, "data kewarganegaraan", "Menghapus [$kewarganegaraan->kewarganegaraan] dari data kewarganegaraan");

        return redirect()->route("kewarganegaraan.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_jabatan_fungsional;

class JabatanFungsionalController extends Controller
{
    public function index()
    {
        $data["jabatan_fungsional"] = sip_jabatan_fungsional::orderBy('jabatan', 'asc')->get();
        return view('admin.jabatan_fungsional.jabatan_fungsional-index', $data);
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
                'jabatan' => "required|unique:sip_jabatan_fungsional",
                'kode' => "required|unique:sip_jabatan_fungsional",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $jabatan_fungsional = sip_jabatan_fungsional::create([
            "jabatan" => $request->jabatan,
            "kode" => $request->kode,
            "keterangan" => $request->keterangan,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $jabatan_fungsional->jabatan_fungsional, "data jabatan_fungsional", "Menambah data jabatan_fungsional dengan id => [$jabatan_fungsional->id - $jabatan_fungsional->jabatan_fungsional]");

        return redirect()->route("jabatan-fungsional.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["jabatan_fungsional"] = sip_jabatan_fungsional::where("id", "=", $id)->first();

        return view('admin.jabatan_fungsional.jabatan_fungsional-edit', $data);
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
                'jabatan' => "required|unique:sip_jabatan_fungsional,jabatan,$id",
                'kode' => "required|unique:sip_jabatan_fungsional,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $jabatan_fungsional = sip_jabatan_fungsional::findOrFail($id);
        $jabatan_fungsional->jabatan = $request->jabatan;
        $jabatan_fungsional->kode = $request->kode;
        $jabatan_fungsional->keterangan = $request->keterangan;
        $name = auth()->user()->name;
        $this->activity($name, "update", $jabatan_fungsional->jabatan, "data jabatan_fungsional", "Memperbarui data jabatan_fungsional dengan id => [$id - $jabatan_fungsional->jabatan]");
        
        $jabatan_fungsional->save();

        return redirect()->route('jabatan-fungsional.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan_fungsional = sip_jabatan_fungsional::findOrFail($id);
        $jabatan_fungsional->delete();
        $this->activity(auth()->user()->name, "delete", $jabatan_fungsional->jabatan, "data jabatan_fungsional", "Menghapus [$jabatan_fungsional->jabatan] dari data jabatan_fungsional");

        return redirect()->route("jabatan-fungsional.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_jabatan;

class JabatanController extends Controller
{
    public function index()
    {
        $data["jabatan"] = sip_jabatan::orderBy('jabatan', 'asc')->get();
        return view('admin.jabatan.jabatan-index', $data);
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
                'jabatan' => "required|unique:sip_jabatan",
                'kode' => "required|unique:sip_jabatan",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $jabatan = sip_jabatan::create([
            "jabatan" => $request->jabatan,
            "kode" => $request->kode,
            "keterangan" => $request->keterangan,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $jabatan->jabatan, "data jabatan", "Menambah data jabatan dengan id => [$jabatan->id - $jabatan->jabatan]");

        return redirect()->route("jabatan.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["jabatan"] = sip_jabatan::where("id", "=", $id)->first();

        return view('admin.jabatan.jabatan-edit', $data);
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
                'jabatan' => "required|unique:sip_jabatan,jabatan,$id",
                'kode' => "required|unique:sip_jabatan,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $jabatan = sip_jabatan::findOrFail($id);
        $jabatan->jabatan = $request->jabatan;
        $jabatan->kode = $request->kode;
        $jabatan->keterangan = $request->keterangan;
        $name = auth()->user()->name;
        $this->activity($name, "update", $jabatan->jabatan, "data jabatan", "Memperbarui data jabatan dengan id => [$id - $jabatan->jabatan]");
        
        $jabatan->save();

        return redirect()->route('jabatan.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = sip_jabatan::findOrFail($id);
        $jabatan->delete();
        $this->activity(auth()->user()->name, "delete", $jabatan->jabatan, "data jabatan", "Menghapus [$jabatan->jabatan] dari data jabatan");

        return redirect()->route("jabatan.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

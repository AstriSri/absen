<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_dosen_homebase;

class DosenHomebaseController extends Controller
{
    public function index()
    {
        $data["homebase"] = sip_dosen_homebase::orderBy('homebase', 'asc')->get();
        return view('admin.dosen-homebase.dosen-homebase-index', $data);
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
                'homebase' => "required|unique:sip_dosen_homebase",
                'kode' => "required|unique:sip_dosen_homebase",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $homebase = sip_dosen_homebase::create([
            "homebase" => $request->homebase,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $homebase->homebase, "data homebase", "Menambah data homebase dengan id => [$homebase->id - $homebase->homebase]");

        return redirect()->route("dosen-homebase.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["homebase"] = sip_dosen_homebase::where("id", "=", $id)->first();

        return view('admin.dosen-homebase.dosen-homebase-edit', $data);
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
                'homebase' => "required|unique:sip_dosen_homebase,homebase,$id",
                'kode' => "required|unique:sip_dosen_homebase,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $homebase = sip_dosen_homebase::findOrFail($id);
        $homebase->homebase = $request->homebase;
        $homebase->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $homebase->homebase, "data homebase", "Memperbarui data homebase dengan id => [$id - $homebase->homebase]");
        
        $homebase->save();

        return redirect()->route('dosen-homebase.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homebase = sip_dosen_homebase::findOrFail($id);
        $homebase->delete();
        $this->activity(auth()->user()->name, "delete", $homebase->homebase, "data homebase", "Menghapus [$homebase->homebase] dari data homebase");

        return redirect()->route("dosen-homebase.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

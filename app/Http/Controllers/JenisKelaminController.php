<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_jeniskelamin;

class JenisKelaminController extends Controller
{
    
    public function index()
    {
        $data["jeniskelamin"] = sip_jeniskelamin::orderBy('jeniskelamin', 'asc')->get();
        return view('admin.jeniskelamin.jeniskelamin-index', $data);
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
                'jeniskelamin' => "required|unique:sip_jeniskelamin",
                'kode' => "required|unique:sip_jeniskelamin",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $jeniskelamin = sip_jeniskelamin::create([
            "jeniskelamin" => $request->jeniskelamin,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $jeniskelamin->jeniskelamin, "data jeniskelamin", "Memperbarui data jeniskelamin dengan id => [$jeniskelamin->id - $jeniskelamin->jeniskelamin]");

        return redirect()->route("jeniskelamin.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["jeniskelamin"] = sip_jeniskelamin::where("id", "=", $id)->first();

        return view('admin.jeniskelamin.jeniskelamin-edit', $data);
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
                'jeniskelamin' => "required|unique:sip_jeniskelamin,jeniskelamin,$id",
                'kode' => "required|unique:sip_jeniskelamin,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $jeniskelamin = sip_jeniskelamin::findOrFail($id);
        $jeniskelamin->jeniskelamin = $request->jeniskelamin;
        $jeniskelamin->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $jeniskelamin->jeniskelamin, "data jeniskelamin", "Memperbarui data jeniskelamin dengan id => [$id - $jeniskelamin->jeniskelamin]");
        
        $jeniskelamin->save();

        return redirect()->route('jeniskelamin.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jeniskelamin = sip_jeniskelamin::findOrFail($id);
        $jeniskelamin->delete();
        $this->activity(auth()->user()->name, "delete", $jeniskelamin->jeniskelamin, "data jeniskelamin", "Menghapus [$jeniskelamin->jeniskelamin] dari data jeniskelamin");

        return redirect()->route("jeniskelamin.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

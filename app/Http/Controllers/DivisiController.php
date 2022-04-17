<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_divisi;

class DivisiController extends Controller
{
    public function index()
    {
        $data["divisi"] = sip_divisi::orderBy('divisi', 'asc')->get();
        return view('admin.divisi.divisi-index', $data);
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
                'divisi' => "required|unique:sip_divisi",
                'kode' => "required|unique:sip_divisi",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $divisi = sip_divisi::create([
            "divisi" => $request->divisi,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $divisi->divisi, "data divisi", "Menambah data divisi dengan id => [$divisi->id - $divisi->divisi]");

        return redirect()->route("divisi.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["divisi"] = sip_divisi::where("id", "=", $id)->first();

        return view('admin.divisi.divisi-edit', $data);
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
                'divisi' => "required|unique:sip_divisi,divisi,$id",
                'kode' => "required|unique:sip_divisi,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $divisi = sip_divisi::findOrFail($id);
        $divisi->divisi = $request->divisi;
        $divisi->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $divisi->divisi, "data divisi", "Memperbarui data divisi dengan id => [$id - $divisi->divisi]");
        
        $divisi->save();

        return redirect()->route('divisi.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $divisi = sip_divisi::findOrFail($id);
        $divisi->delete();
        $this->activity(auth()->user()->name, "delete", $divisi->divisi, "data divisi", "Menghapus [$divisi->divisi] dari data divisi");

        return redirect()->route("divisi.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_pendidikan;
class PendidikanController extends Controller
{
    public function index()
    {
        $data["pendidikan"] = sip_pendidikan::orderBy('pendidikan', 'asc')->get();
        return view('admin.pendidikan.pendidikan-index', $data);
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
                'pendidikan' => "required|unique:sip_pendidikan",
                'kode' => "required|unique:sip_pendidikan",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $pendidikan = sip_pendidikan::create([
            "pendidikan" => $request->pendidikan,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $pendidikan->pendidikan, "data pendidikan", "Menambah data pendidikan dengan id => [$pendidikan->id - $pendidikan->pendidikan]");

        return redirect()->route("pendidikan.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["pendidikan"] = sip_pendidikan::where("id", "=", $id)->first();

        return view('admin.pendidikan.pendidikan-edit', $data);
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
                'pendidikan' => "required|unique:sip_pendidikan,pendidikan,$id",
                'kode' => "required|unique:sip_pendidikan,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $pendidikan = sip_pendidikan::findOrFail($id);
        $pendidikan->pendidikan = $request->pendidikan;
        $pendidikan->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $pendidikan->pendidikan, "data pendidikan", "Memperbarui data pendidikan dengan id => [$id - $pendidikan->pendidikan]");
        
        $pendidikan->save();

        return redirect()->route('pendidikan.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pendidikan = sip_pendidikan::findOrFail($id);
        $pendidikan->delete();
        $this->activity(auth()->user()->name, "delete", $pendidikan->pendidikan, "data pendidikan", "Menghapus [$pendidikan->pendidikan] dari data pendidikan");

        return redirect()->route("pendidikan.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

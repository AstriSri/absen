<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_agama;

class AgamaController extends Controller
{
    public function index()
    {
        $data["agama"] = sip_agama::orderBy('agama', 'asc')->get();
        return view('admin.agama.agama-index', $data);
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
                'agama' => "required|unique:sip_agama",
                'kode' => "required|unique:sip_agama",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $agama = sip_agama::create([
            "agama" => $request->agama,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $agama->agama, "data agama", "Menambah data agama dengan id => [$agama->id - $agama->agama]");

        return redirect()->route("agama.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["agama"] = sip_agama::where("id", "=", $id)->first();

        return view('admin.agama.agama-edit', $data);
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
                'agama' => "required|unique:sip_agama,agama,$id",
                'kode' => "required|unique:sip_agama,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $agama = sip_agama::findOrFail($id);
        $agama->agama = $request->agama;
        $agama->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $agama->agama, "data agama", "Memperbarui data agama dengan id => [$id - $agama->agama]");
        
        $agama->save();

        return redirect()->route('agama.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agama = sip_agama::findOrFail($id);
        $agama->delete();
        $this->activity(auth()->user()->name, "delete", $agama->agama, "data agama", "Menghapus [$agama->agama] dari data agama");

        return redirect()->route("agama.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

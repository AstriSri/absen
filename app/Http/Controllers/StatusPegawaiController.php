<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_statuspegawai;

class StatusPegawaiController extends Controller
{
    public function index()
    {
        $data["status"] = sip_statuspegawai::orderBy('status', 'asc')->get();
        return view('admin.statuspegawai.statuspegawai-index', $data);
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
                'status' => "required|unique:sip_statuspegawai",
                'kode' => "required|unique:sip_statuspegawai",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $statuspegawai = sip_statuspegawai::create([
            "status" => $request->status,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $statuspegawai->status, "data statuspegawai", "Menambah data statuspegawai dengan id => [$statuspegawai->id - $statuspegawai->statuspegawai]");

        return redirect()->route("statuspegawai.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["status"] = sip_statuspegawai::where("id", "=", $id)->first();

        return view('admin.statuspegawai.statuspegawai-edit', $data);
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
                'status' => "required|unique:sip_statuspegawai,status,$id",
                'kode' => "required|unique:sip_statuspegawai,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $statuspegawai = sip_statuspegawai::findOrFail($id);
        $statuspegawai->status = $request->status;
        $statuspegawai->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $statuspegawai->status, "data statuspegawai", "Memperbarui data statuspegawai dengan id => [$id - $statuspegawai->statuspegawai]");
        
        $statuspegawai->save();

        return redirect()->route('statuspegawai.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statuspegawai = sip_statuspegawai::findOrFail($id);
        $statuspegawai->delete();
        $this->activity(auth()->user()->name, "delete", $statuspegawai->status, "data statuspegawai", "Menghapus [$statuspegawai->statuspegawai] dari data statuspegawai");

        return redirect()->route("statuspegawai.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

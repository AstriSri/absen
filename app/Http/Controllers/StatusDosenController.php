<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_statusdosen;

class StatusDosenController extends Controller
{
    public function index()
    {
        $data["status"] = sip_statusdosen::orderBy('status', 'asc')->get();
        return view('admin.statusdosen.statusdosen-index', $data);
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
                'status' => "required|unique:sip_statusdosen",
                'kode' => "required|unique:sip_statusdosen",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $statusdosen = sip_statusdosen::create([
            "status" => $request->status,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $statusdosen->status, "data statusdosen", "Menambah data statusdosen dengan id => [$statusdosen->id - $statusdosen->statusdosen]");

        return redirect()->route("statusdosen.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["status"] = sip_statusdosen::where("id", "=", $id)->first();

        return view('admin.statusdosen.statusdosen-edit', $data);
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
                'status' => "required|unique:sip_statusdosen,status,$id",
                'kode' => "required|unique:sip_statusdosen,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $statusdosen = sip_statusdosen::findOrFail($id);
        $statusdosen->status = $request->status;
        $statusdosen->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $statusdosen->status, "data statusdosen", "Memperbarui data statusdosen dengan id => [$id - $statusdosen->statusdosen]");
        
        $statusdosen->save();

        return redirect()->route('statusdosen.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statusdosen = sip_statusdosen::findOrFail($id);
        $statusdosen->delete();
        $this->activity(auth()->user()->name, "delete", $statusdosen->status, "data statusdosen", "Menghapus [$statusdosen->statusdosen] dari data statusdosen");

        return redirect()->route("statusdosen.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

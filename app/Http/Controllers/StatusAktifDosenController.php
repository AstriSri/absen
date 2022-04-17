<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_statusaktifdosen;

class StatusAktifDosenController extends Controller
{
    public function index()
    {
        $data["status"] = sip_statusaktifdosen::orderBy('status', 'asc')->get();
        return view('admin.statusaktifdosen.statusaktifdosen-index', $data);
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
                'status' => "required|unique:sip_statusaktifdosen",
                'kode' => "required|unique:sip_statusaktifdosen",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $statusaktifdosen = sip_statusaktifdosen::create([
            "status" => $request->status,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $statusaktifdosen->status, "data statusaktifdosen", "Memperbarui data statusaktifdosen dengan id => [$statusaktifdosen->id - $statusaktifdosen->statusaktifdosen]");

        return redirect()->route("statusaktifdosen.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["status"] = sip_statusaktifdosen::where("id", "=", $id)->first();

        return view('admin.statusaktifdosen.statusaktifdosen-edit', $data);
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
                'status' => "required|unique:sip_statusaktifdosen,status,$id",
                'kode' => "required|unique:sip_statusaktifdosen,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $statusaktifdosen = sip_statusaktifdosen::findOrFail($id);
        $statusaktifdosen->status = $request->status;
        $statusaktifdosen->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $statusaktifdosen->status, "data statusaktifdosen", "Memperbarui data statusaktifdosen dengan id => [$id - $statusaktifdosen->statusaktifdosen]");
        
        $statusaktifdosen->save();

        return redirect()->route('statusaktifdosen.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statusaktifdosen = sip_statusaktifdosen::findOrFail($id);
        $statusaktifdosen->delete();
        $this->activity(auth()->user()->name, "delete", $statusaktifdosen->status, "data statusaktifdosen", "Menghapus [$statusaktifdosen->statusaktifdosen] dari data statusaktifdosen");

        return redirect()->route("statusaktifdosen.index")->with('success', 'Data berhasil dihapus . . .');
    }
}
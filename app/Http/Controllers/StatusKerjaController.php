<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_statuskerja;

class StatusKerjaController extends Controller
{
    public function index()
    {
        $data["status"] = sip_statuskerja::orderBy('status', 'asc')->get();
        return view('admin.statuskerja.statuskerja-index', $data);
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
                'status' => "required|unique:sip_statuskerja",
                'kode' => "required|unique:sip_statuskerja",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $statuskerja = sip_statuskerja::create([
            "status" => $request->status,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $statuskerja->status, "data statuskerja", "Menambah data statuskerja dengan id => [$statuskerja->id - $statuskerja->statuskerja]");

        return redirect()->route("statuskerja.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["status"] = sip_statuskerja::where("id", "=", $id)->first();

        return view('admin.statuskerja.statuskerja-edit', $data);
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
                'status' => "required|unique:sip_statuskerja,status,$id",
                'kode' => "required|unique:sip_statuskerja,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $statuskerja = sip_statuskerja::findOrFail($id);
        $statuskerja->status = $request->status;
        $statuskerja->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $statuskerja->status, "data statuskerja", "Memperbarui data statuskerja dengan id => [$id - $statuskerja->statuskerja]");
        
        $statuskerja->save();

        return redirect()->route('statuskerja.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statuskerja = sip_statuskerja::findOrFail($id);
        $statuskerja->delete();
        $this->activity(auth()->user()->name, "delete", $statuskerja->status, "data statuskerja", "Menghapus [$statuskerja->statuskerja] dari data statuskerja");

        return redirect()->route("statuskerja.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

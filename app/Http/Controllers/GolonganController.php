<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_golongan;

class GolonganController extends Controller
{
    public function index()
    {
        $data["golongan"] = sip_golongan::orderBy('golongan', 'asc')->get();
        return view('admin.golongan.golongan-index', $data);
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
                'golongan' => "required|unique:sip_golongan",
                'kode' => "required|unique:sip_golongan",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $golongan = sip_golongan::create([
            "golongan" => $request->golongan,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $golongan->golongan, "data golongan", "Menambah data golongan dengan id => [$golongan->id - $golongan->golongan]");

        return redirect()->route("golongan.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["golongan"] = sip_golongan::where("id", "=", $id)->first();

        return view('admin.golongan.golongan-edit', $data);
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
                'golongan' => "required|unique:sip_golongan,golongan,$id",
                'kode' => "required|unique:sip_golongan,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $golongan = sip_golongan::findOrFail($id);
        $golongan->golongan = $request->golongan;
        $golongan->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $golongan->golongan, "data golongan", "Memperbarui data golongan dengan id => [$id - $golongan->golongan]");
        
        $golongan->save();

        return redirect()->route('golongan.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $golongan = sip_golongan::findOrFail($id);
        $golongan->delete();
        $this->activity(auth()->user()->name, "delete", $golongan->golongan, "data golongan", "Menghapus [$golongan->golongan] dari data golongan");

        return redirect()->route("golongan.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

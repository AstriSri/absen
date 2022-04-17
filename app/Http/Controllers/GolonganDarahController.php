<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_golongandarah;
class GolonganDarahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["goldar"] = sip_golongandarah::orderBy('goldar', 'asc')->get();
        return view('admin.goldar.goldar-index', $data);
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
                'goldar' => "required|unique:sip_golongandarah",
                'kode' => "required|unique:sip_golongandarah",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
                ]
            );
        $goldar = sip_golongandarah::create([
            "goldar" => $request->goldar,
            "kode" => $request->kode,
        ]);

        $name = auth()->user()->name;
        $this->activity($name, "update", $goldar->goldar, "data goldar", "Menambah data goldar dengan id => [$goldar->id - $goldar->goldar]");

        return redirect()->route("goldar.index")->with('success', 'Data berhasil ditambah . . .'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["goldar"] = sip_golongandarah::where("id", "=", $id)->first();

        return view('admin.goldar.goldar-edit', $data);
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
                'goldar' => "required|unique:sip_golongandarah,goldar,$id",
                'kode' => "required|unique:sip_golongandarah,kode,$id",
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );
        $goldar = sip_golongandarah::findOrFail($id);
        $goldar->goldar = $request->goldar;
        $goldar->kode = $request->kode;
        $name = auth()->user()->name;
        $this->activity($name, "update", $goldar->goldar, "data goldar", "Memperbarui data goldar dengan id => [$id - $goldar->goldar]");
        
        $goldar->save();

        return redirect()->route('goldar.index')->with('success', 'Data berhasil diperbarui . . .'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goldar = sip_golongandarah::findOrFail($id);
        $goldar->delete();
        $this->activity(auth()->user()->name, "delete", $goldar->goldar, "data goldar", "Menghapus [$goldar->goldar] dari data goldar");

        return redirect()->route("goldar.index")->with('success', 'Data berhasil dihapus . . .');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_jam_kerja;

class Jam_kerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jam_kerja = sip_jam_kerja::all();
        return view('admin.jam_kerja.index', compact("jam_kerja"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        sip_jam_kerja::create([
            'nama' => $request->nama,
            'jenis_kerja' => $request->jenis_kerja,
            'jam_datang' => $request->jam_datang,
            'jam_pulang' => $request->jam_pulang,
        ]);

        return redirect()->route("jam-kerja.index")->with("success", "Data jam Berhasil ditambahkan ...!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(sip_jam_kerja $jam_kerja)
    {
        return view('admin.jam_kerja.edit', compact("jam_kerja"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sip_jam_kerja $jam_kerja)
    {
        $jam_kerja->nama = $request->nama;
        $jam_kerja->jenis_kerja = $request->jenis_kerja;
        $jam_kerja->jam_datang = $request->jam_datang;
        $jam_kerja->jam_pulang = $request->jam_pulang;
        $jam_kerja->save();

        return redirect()->route("jam-kerja.index")->with("success", "Data Berhasi Di update ..!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(sip_jam_kerja $jam_kerja)
    {
        $jam_kerja->delete();
        return redirect()->route("jam-kerja.index")->with("success", "Data Berhasi Di hapus ..!");
    }
}

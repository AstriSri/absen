<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_jam_kerja_pegawai;
use App\sip_pegawai;
use App\sip_jam_kerja;

class Jam_kerja_pegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jam_kerja = sip_jam_kerja::all();
        $pegawai = sip_pegawai::all();
        $jam_kerja_pegawai = sip_jam_kerja_pegawai::all();
        return view('admin.jam_kerja_pegawai.index', compact("jam_kerja_pegawai", "jam_kerja", "pegawai"));
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
                'user'=> 'required|unique:sip_jam_kerja_pegawai',
                'jam_kerja'=>'required',
            ],
            [
                'required'  => 'The :attribute field is required.',
                'unique'    => ':attribute is already used or In TRASH please EDIT the data'
            ]
        );

        $jam_kerja = sip_jam_kerja::find($request->jam_kerja);
        $sip_jam_kerja_pegawai = sip_jam_kerja_pegawai::withTrashed()->firstOrCreate([
                'user' => $request->user,
                'jenis_kerja' => $jam_kerja->jenis_kerja,
            ],[
                'jam_kerja' => $request->jam_kerja,
                'jam_datang' => $jam_kerja->jam_datang,
                'jam_pulang' => $jam_kerja->jam_pulang,
            ]
        );
        $sip_jam_kerja_pegawai->jam_kerja = $request->jam_kerja;
        $sip_jam_kerja_pegawai->jenis_kerja = $jam_kerja->jenis_kerja;
        $sip_jam_kerja_pegawai->jam_datang = $jam_kerja->jam_datang;
        $sip_jam_kerja_pegawai->jam_pulang = $jam_kerja->jam_pulang;
        $sip_jam_kerja_pegawai->save();

        return redirect()->route("jam-kerja-pegawai.index")->with("success", "Data jam kerja  Berhasil ditambahkan ...!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(sip_jam_kerja_pegawai $jam_kerja_pegawai)
    {
        $jam_kerja = sip_jam_kerja::all();
        
        return view('admin.jam_kerja_pegawai.edit', compact("jam_kerja_pegawai", "jam_kerja"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sip_jam_kerja_pegawai $jam_kerja_pegawai)
    {
        $jam_kerja = sip_jam_kerja::find($request->jam_kerja);

        $jam_kerja_pegawai->jam_kerja = $request->jam_kerja;
        $jam_kerja_pegawai->jam_datang = $jam_kerja->jam_datang;
        $jam_kerja_pegawai->jam_pulang = $jam_kerja->jam_pulang;
        $jam_kerja_pegawai->save();

        return redirect()->route("jam-kerja-pegawai.index")->with("success", "Data Berhasi Di update ..!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(sip_jam_kerja_pegawai $jam_kerja_pegawai)
    {
        $jam_kerja_pegawai->delete();
        return redirect()->route("jam-kerja-pegawai.index")->with("success", "Data Berhasi Di hapus ..!");
    }

    public function userUpdate(Request $request)
    {
        $request->validate(
            [
                'jam_kerja'=>'required',
            ],
            [
                'required'  => 'The :attribute field is required.',
            ]
        );

        $jam_kerja = sip_jam_kerja::find($request->jam_kerja);
        $sip_jam_kerja_pegawai = sip_jam_kerja_pegawai::withTrashed()->firstOrCreate([
            'user' => auth()->user()->username,
        ],[
            'jenis_kerja' => $jam_kerja->jenis_kerja,
            'jam_kerja' => $request->jam_kerja,
            'jam_datang' => $jam_kerja->jam_datang,
            'jam_pulang' => $jam_kerja->jam_pulang,
            ]
        );
        $sip_jam_kerja_pegawai->jenis_kerja = $jam_kerja->jenis_kerja;
        $sip_jam_kerja_pegawai->jam_kerja = $request->jam_kerja;
        $sip_jam_kerja_pegawai->jam_datang = $jam_kerja->jam_datang;
        $sip_jam_kerja_pegawai->jam_pulang = $jam_kerja->jam_pulang;
        $sip_jam_kerja_pegawai->save();
        $sip_jam_kerja_pegawai->restore();

        return redirect()->route("absensi.index")->with("success", "Data jam kerja  Berhasil Update ...!");
    }
}

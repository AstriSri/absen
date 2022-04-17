<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_kegiatan;
use App\sip_absensi;
use Carbon\Carbon;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = sip_kegiatan::whereTanggal( Carbon::now()->format("Y-m-d") )->get();
        return view("pegawai.kegiatan.index", compact("kegiatan"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pegawai.kegiatan.create");
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
                'kegiatan'=> 'required',
                'volume'=> 'required',
                'satuan'=>'required',
                'keluaran'=>'required',
            ],
            [
                'required'  => 'The :attribute field is required.',
            ]
        );
        
        $datetime = \Carbon\Carbon::now();
        $tanggal = $datetime->format("Y-m-d");
        $username = auth()->user()->username;

        $absensi = sip_absensi::whereUser( $username )->whereTanggal( $tanggal )->first();
        if ($absensi != null) {
            sip_kegiatan::create([
                'user' => $username,
                'tanggal' => $absensi->tanggal,
                'kegiatan' => $request->kegiatan,
                'keluaran' => $request->keluaran,
                'volume' => $request->volume,
                'satuan' => $request->satuan,
            ]);
            return redirect()->route("kegiatan.index")->with("success", "Kegiatan telah ditambahkan ...!");
        }
        return redirect()->route("kegiatan.index")->with("error", "Ada kesalahan, silahkan cek absen anda ..!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kegiatan = sip_kegiatan::find($id);
        return view("pegawai.kegiatan.edit", compact("kegiatan"));
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
        sip_kegiatan::find($id)->update([
            "kegiatan" => $request->kegiatan,
            "keluaran" => $request->keluaran,
            "volume" => $request->volume,
            "satuan" => $request->satuan,
        ]);

        return redirect()->route("kegiatan.index")->with("success", "Kegiatan telah di Update ...!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(sip_kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route("kegiatan.index")->with("error", "Kegiatan $kegiatan->kegiatan telah di dihapus ...!");
    }
}

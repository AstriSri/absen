<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_kegiatan;
use App\sip_absensi;
use \Carbon\Carbon;

class LaporanController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $nip)
    {
        // dd(auth()->user()->username, $nip);
        $username = auth()->user()->username;
        $kegiatan = sip_kegiatan::where("user", $username)->get();
        $absensi = sip_absensi::where("user", $username)->get();
        $datetime = Carbon::now();
        $tanggal = $datetime->format("Y-m");
        return view("pegawai.absensi.laporan.index", compact("kegiatan", "absensi", "tanggal"));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nip)
    {
        $kegiatan = sip_kegiatan::whereUser($nip)->get();
        $absensi = sip_absensi::whereuser($nip)->get();
        $tanggal = $request->bulan;

        return view("pegawai.absensi.laporan.index", compact("kegiatan", "absensi", "tanggal"));
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

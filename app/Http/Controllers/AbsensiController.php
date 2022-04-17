<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sip_absensi;
use App\sip_jam_kerja;
use App\sip_kegiatan;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jam_kerja = sip_jam_kerja::all();
        $jadwal_datang = auth()->user()->pegawai->jam_kerja == null ? "not set" : Carbon::createFromFormat('H:i:s', auth()->user()->pegawai->jam_kerja->jam_datang)->addHours(-1)->format("H:i");
        $jadwal_pulang = auth()->user()->pegawai->jam_kerja == null ? "not set" : Carbon::createFromFormat('H:i:s', auth()->user()->pegawai->jam_kerja->jam_pulang)->format("H:i");
        $tanggal = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $absensi = sip_absensi::whereUser(auth()->user()->username)->whereTanggal( Carbon::now()->format("Y-m-d") )->first();
        
        $kegiatan = sip_kegiatan::whereTanggal( Carbon::now()->format("Y-m-d") )->count();
        return view('pegawai.absensi.index', compact("absensi", "kegiatan", "jam_kerja", "tanggal", "jadwal_datang", "jadwal_pulang"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datetime = Carbon::now();
        $tanggal = $datetime->format("Y-m-d");
        $time = $datetime->format("H:i:s");

        $jadwal_datang = auth()->user()->pegawai->jam_kerja == null ? "not set" : Carbon::createFromFormat('H:i:s', auth()->user()->pegawai->jam_kerja->jam_datang)->format("H:i");
        $jadwal_pulang = auth()->user()->pegawai->jam_kerja == null ? "not set" : Carbon::createFromFormat('H:i:s', auth()->user()->pegawai->jam_kerja->jam_pulang)->format("H:i");

        if ($jadwal_datang > $time || $jadwal_pulang < $time) {
            return redirect()->route("absensi.index")->with("error", "[$time] :". auth()->user()->name." [".auth()->user()->username."]. Telah melakukan pelanggaran absensi harap hati-hati");
        }
        
        
        $absensi = sip_absensi::whereUser( auth()->user()->username )->whereTanggal( $tanggal )->first();
        if ($absensi == null) {
            sip_absensi::create([
                'user' => auth()->user()->username,
                'tanggal' => $tanggal,
                'jam_datang' => $time,
                'jam_datang_jadwal' => $request->jam_datang_jadwal,
                'jam_pulang_jadwal' => $request->jam_pulang_jadwal,
            ]);
            return redirect()->route("absensi.index")->with("success", "Terimakasih ".auth()->user()->name." [".auth()->user()->username."]. Telah melakukan absensi datang ...!");
        }
        return redirect()->route("absensi.index")->with("info", auth()->user()->name." [".auth()->user()->username."]. Telah melakukan absensi datang pada $absensi->jam_datang ...!");
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
        $datetime = Carbon::now();
        $time = $datetime->format("H:i:s");
        
        if(sip_kegiatan::all()->count() <= 0){
            return redirect()->route("absensi.index")->with("error", "[$time] :". auth()->user()->name." [".auth()->user()->username."]. Telah melakukan pelanggaran absensi harap isi kegiatan dan berhati-hatilah... !");
        }
        sip_absensi::find($id)->update([
            "jam_pulang" => $time
        ]);

        return redirect()->route("absensi.index")->with("success", auth()->user()->name." [".auth()->user()->username."]. Telah melakukan absensi pulang pada $time ...!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showLaporan(Request $request)
    {
        $username = auth()->user()->username;
        $kegiatan = sip_kegiatan::where("user", $username)->get();
        $absensi = sip_absensi::where("user", $username)->get();
        $tanggal = Carbon::now()->format("Y-m");
        if ($request->bulan) {
            $tanggal = $request->bulan;
        }
        return view("pegawai.absensi.laporan.index", compact("kegiatan", "absensi", "tanggal"));
    }
    
    public function destroy(sip_absensi $sip_absensi)
    {
        $sip_absensi->delete();
        return redirect()->route("jam-kerja.index")->with("success", "Data Berhasi Di hapus ..!");
    }
}

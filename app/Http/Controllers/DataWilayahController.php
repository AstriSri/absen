<?php

namespace App\Http\Controllers;

use App\sip_desa;
use App\sip_kecamatan;
use App\sip_kota;


class DataWilayahController extends Controller
{
    public function getKota()
    {
        $kota = sip_kota::whereHas('provinsi', function ($query) {
            $query->whereId(request()->input('id_provinsi', 0));
        })->pluck('name', 'id');

        return response()->json($kota);
    }

    public function getDistrik()
    {

        $distrik = sip_kecamatan::whereHas('kota', function ($query) {
            $query->whereId(request()->input('id_kota', 0));
        })->pluck('name', 'id');

        return response()->json($distrik);
    }

    public function getDesa()
    {
        $desa = sip_desa::whereHas('kecamatan', function ($query) {
            $query->whereId(request()->input('id_distrik', 0));
        })->pluck('name', 'id');
        return response()->json($desa);
    }
}

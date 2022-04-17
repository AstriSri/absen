<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sip_kota extends Model
{


    protected $table = 'indonesia_cities';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function provinsi()
    {
        return $this->belongsTo('App\sip_provinsi', 'province_id');
    }

    public function kecamatan()
    {
        return $this->hasMany('App\sip_kecamatan', 'city_id');
    }
}

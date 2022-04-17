<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sip_kecamatan extends Model
{
    protected $guarded = [];

    protected $table = 'indonesia_districts';
    protected $primaryKey = 'id';

    public function kota()
    {
        return $this->belongsTo('App\sip_kota', 'city_id');
    }

    public function desa()
    {
        return $this->hasMany('App\sip_desa', 'district_id');
    }
}

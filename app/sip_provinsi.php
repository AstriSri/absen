<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sip_provinsi extends Model
{

    protected $table = 'indonesia_provinces';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function kota()
    {
        return $this->hasMany('App\sip_kota', 'province_id');
    }
}

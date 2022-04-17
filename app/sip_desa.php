<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sip_desa extends Model
{
    protected $guarded = [];

    protected $table = 'indonesia_villages';
    protected $primaryKey = 'id';

    public function kecamatan()
    {
        return $this->belongsTo('App\sip_kecamatan', 'district_id');
    }
}

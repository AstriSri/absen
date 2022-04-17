<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_jam_kerja extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $table = 'sip_jam_kerja';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        "nama",
        "jam_datang",
        "jam_pulang",
    ];
    // protected $cascadeDeletes = ['sip_biodatas'];
    // protected $primaryKey = 'kode';
    
}

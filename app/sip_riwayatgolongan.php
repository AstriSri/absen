<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_riwayatgolongan extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_riwayatgolongan';
  	protected $dates = ['deleted_at', "tanggal_sk", "tanggal_mulai", "tmt"];
    // protected $cascadeDeletes = ['sip_pegawais'];
    protected $fillable = [
      "user",
      "golongan",
      "no_sk",
      "tanggal_sk",
      "tanggal_mulai",
      "nama_ttd",
      "tmt",
    ];

    public function user(){
	    return $this->belongsTo('App\User');
    }

    public function Golongan(){
      return $this->belongsTo(sip_golongan::class, 'golongan');
    }
    //
}

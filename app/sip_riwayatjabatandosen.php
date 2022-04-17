<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_riwayatjabatandosen extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_riwayatjabatandosen';
  	protected $dates = ['deleted_at', "tanggal_sk", "tanggal_mulai", "tmt"];
    
    protected $fillable = [
      "user",
      "jabatan",
      "no_sk",
      "tanggal_sk",
      "tanggal_mulai",
      "nama_ttd",
      "tmt",
    ];

    public function user(){
	    return $this->belongsTo('App\User');
    }

    public function Jabatan(){
      return $this->belongsTo(sip_jabatan_fungsional::class, 'jabatan');
    }
    //
}

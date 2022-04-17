<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_jabatan_fungsional extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_jabatan_fungsional';
  	protected $dates = ['deleted_at'];
    // protected $cascadeDeletes = ['riwayatjabatan'];
    protected $fillable = [
      "jabatan",
      "kode",
      "keterangan",
    ];

    public function user(){
	    return $this->belongsTo('App\User');
    }
    
    // public function riwayatjabatan(){
    //     return $this->hasMany(sip_riwayatjabatan::class, 'jabatan');
    // }
    //
}

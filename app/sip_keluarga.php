<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_keluarga extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_keluargas';
  	protected $dates = ['deleted_at'];
    // protected $cascadeDeletes = ['sip_biodatas'];
    // protected $primaryKey = 'kode';

    public function user(){
	    return $this->belongsTo('App\User');
    }
    
    public function jeniskelamin(){
		return $this->belongsTo(sip_jeniskelamin::class, 'jeniskelamin');
	}
    
    public function pendidikan(){
		return $this->belongsTo(sip_pendidikan::class, 'pendidikan');
	}
    
    public function agama(){
		return $this->belongsTo(sip_agama::class, 'agama');
	}
    
    public function kewarganegaraan(){
		return $this->belongsTo(sip_kewarganegaraan::class, 'kewarganegaraan');
	}
    //
}

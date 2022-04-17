<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_pendidikan extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_pendidikan';
  	protected $dates = ['deleted_at'];
    // protected $cascadeDeletes = ['sip_biodatas'];
    protected $fillable = [
      "pendidikan",
      "kode"
    ];
    public function user(){
	    return $this->belongsTo('App\User');
    }
    
    public function riwayatpendidikan(){
        return $this->hasMany(sip_riwayatpendidikan::class, 'pendidikan');
    }
    //
}

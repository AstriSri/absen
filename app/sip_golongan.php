<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_golongan extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_golongan';
  	protected $dates = ['deleted_at'];
    protected $cascadeDeletes = ['riwayatgolongan'];
    protected $fillable = [
      "golongan",
      "kode"
    ];
    // protected $primaryKey = 'kode';

    public function user(){
	    return $this->belongsTo('App\User');
    }
    
    public function riwayatgolongan(){
        return $this->hasMany(sip_riwayatgolongan::class, 'golongan');
    }
    //
}

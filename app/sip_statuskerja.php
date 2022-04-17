<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_statuskerja extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_statuskerja';
  	protected $dates = ['deleted_at'];
    protected $fillable =[
      "status",
      "kode",
    ];
    // protected $cascadeDeletes = ['sip_biodatas'];
    // protected $primaryKey = 'kode';

    public function user(){
		  return $this->belongsTo('App\User');
    }
    
    public function pegawai(){
      return $this->hasMany(sip_pegawai::class, 'statuskerja');
    }
    //
}

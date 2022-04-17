<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_agama extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_agama';
  	protected $fillable = [
      "agama",
      "kode",
    ];
  	protected $dates = ['deleted_at'];
    protected $cascadeDeletes = ['biodata'];
    // protected $primaryKey = 'kode';

    public function user(){
		  return $this->belongsTo('App\User');
    }
    
    public function biodata(){
      return $this->hasMany(sip_biodata::class, 'agama');
    }
    //
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_golongandarah extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_golongandarah';
  	protected $dates = ['deleted_at'];
    protected $cascadeDeletes = ['biodata'];
    protected $fillable = [
      "goldar",
      "kode"
    ];

    public function user(){
	    return $this->belongsTo('App\User');
    }
    
    public function biodata(){
        return $this->hasMany(sip_biodata::class, 'goldar');
    }
}

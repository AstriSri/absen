<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_statusdosen extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_statusdosen';
  	protected $dates = ['deleted_at'];
    protected $fillable =[
      "status",
      "kode",
    ];

    public function user(){
		  return $this->belongsTo('App\User');
    }
    
    public function dosen(){
      return $this->hasMany(sip_dosen::class, 'statusdosen');
    }
    //
}

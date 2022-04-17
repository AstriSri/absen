<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_dosen_homebase extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_dosen_homebase';
  	protected $dates = ['deleted_at'];
    protected $fillable = [
        'homebase',
        'kode'
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function dosen(){
        return $this->hasMany(sip_dosen::class, 'homebase');
    }
}

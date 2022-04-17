<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_divisi extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_divisi';
  	protected $dates = ['deleted_at'];
    protected $cascadeDeletes = ['pegawai'];
    protected $fillable = [
      'divisi',
      'kode'
    ];
    // protected $primaryKey = 'kode';

    public function user(){
	    return $this->belongsTo('App\User');
    }
    
    public function pegawai(){
        return $this->hasMany(sip_pegawai::class, 'divisi');
    }
    //
}

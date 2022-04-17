<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_riwayatpendidikan extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_riwayatpendidikan';
  	protected $dates = ['deleted_at'];
    
    protected $fillable = [
      "user",
      "pendidikan",
      "tahunlulus",
      "namasekolah",
      "noijazah",
    ];

    public function user(){
	    return $this->belongsTo('App\User');
    }

    public function Pendidikan(){
		return $this->belongsTo(sip_pendidikan::class, 'pendidikan');
	}
  
}

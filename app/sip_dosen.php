<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_dosen extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_dosen';
  	protected $dates = ['deleted_at'];
    protected $fillable = [
      "user",
      "nidn",
      "namagelar",
      "statusdosen",
      "statusaktifdosen",
      "jabatan_fungsional",
      "homebase",
    ];

    public function userz(){
	    return $this->belongsTo(User::class, 'user');
    }

    public function Homebase(){
		  return $this->belongsTo(sip_dosen_homebase::class, 'homebase');
	  }

    public function Statusdosen(){
		  return $this->belongsTo(sip_statusdosen::class, 'statusdosen');
	  }

    public function Statusaktifdosen(){
		  return $this->belongsTo(sip_statusaktifdosen::class, 'statusaktifdosen');
	  }

    public function Jabatan_fungsional(){
		  return $this->belongsTo(sip_jabatan_fungsional::class, 'jabatan_fungsional');
	  }
    
    public function biodata(){
      return $this->hasOne(sip_biodata::class, 'user', 'user');
    }

    public function riwayatgolongan(){
      return $this->hasMany(sip_riwayatgolongan::class, 'user', 'user', );
    }

    public function riwayatjabatan(){
      return $this->hasMany(sip_riwayatjabatandosen::class, 'user', 'user');
    }

    public function riwayatpendidikan(){
      return $this->hasMany(sip_riwayatpendidikan::class, 'user', 'user');
    }

    public function dokumen(){
      return $this->hasMany(sip_dokumen::class, 'user', 'user');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_biodata extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_biodata';
  	protected $dates = ['deleted_at', 'tanggallahir'];
    // protected $cascadeDeletes = ['sip_biodatas'];
    // protected $primaryKey = 'kode';
	protected $fillable = [
		"user",
		"nomorktp",
		"jeniskelamin",
		"goldar",
		"agama",
		"kewarganegaraan",
		"tempatlahir",
		"tanggallahir",
		"alamat",
		"rt",
		"rw",
		"kelurahan",
		"kecamatan",
		"kota",
		"provinsi",
		"kodepos",
		"notelprumah",
		"nohp",
		"npwp",
	];

    public function User(){
		return $this->belongsTo('App\User', 'user');
    }
    
    public function Jeniskelamin(){
		return $this->belongsTo(sip_jeniskelamin::class, 'jeniskelamin');
	}
    
    public function Golongandarah(){
		return $this->belongsTo(sip_golongandarah::class, 'goldar');
	}
    
    public function Agama(){
		return $this->belongsTo(sip_agama::class, 'agama');
	}
    
    public function Kewarganegaraan(){
		return $this->belongsTo(sip_kewarganegaraan::class, 'kewarganegaraan');
	}
    public function Kelurahan(){
		return $this->belongsTo(sip_desa::class, 'kelurahan');
	}
    public function Kecamatan(){
		return $this->belongsTo(sip_kecamatan::class, 'kecamatan');
	}
    public function Kota(){
		return $this->belongsTo(sip_kota::class, 'kota');
	}
    public function Provinsi(){
		return $this->belongsTo(sip_provinsi::class, 'provinsi');
	}
    //
}

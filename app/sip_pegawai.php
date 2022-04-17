<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_pegawai extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_pegawai';
  	protected $dates = ['deleted_at'];
    protected $cascadeDeletes = ['biodata'];
    protected $fillable = [
        "user",
        "namagelar",
        "divisi",
        "statuskerja",
        "statuspegawai",
        "jabatan",

    ];
    // protected $primaryKey = 'user';

    public function userz(){
	    return $this->belongsTo(User::class, 'user');
    }

    public function Divisi(){
		return $this->belongsTo(sip_divisi::class, 'divisi');
	}

    public function Statuskerja(){
		return $this->belongsTo(sip_statuskerja::class, 'statuskerja');
    }
    
    public function Statuspegawai(){
		return $this->belongsTo(sip_statuspegawai::class, 'statuspegawai');
	}
    
    public function Jabatan(){
        return $this->belongsTo(sip_jabatan::class, 'jabatan');
    }

    public function biodata(){
        return $this->hasOneThrough(sip_biodata::class, User::class, "username", 'user', 'user', "username");
    }

    public function riwayatgolongan(){
        return $this->hasMany(sip_riwayatgolongan::class, 'user', 'user', );
    }

    public function riwayatjabatan(){
        return $this->hasMany(sip_riwayatjabatanpegawai::class, 'user', 'user');
    }

    public function riwayatpendidikan(){
        return $this->hasMany(sip_riwayatpendidikan::class, 'user', 'user');
    }

    public function dokumen(){
        return $this->hasMany(sip_dokumen::class, 'user', 'user');
    }

    public function jam_kerja(){
        return $this->hasOne(sip_jam_kerja_pegawai::class, 'user', 'user');
    }
    

    public function absensi(){
        return $this->hasMany(sip_absensi::class, 'user', 'user');
    }
    //
}

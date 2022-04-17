<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sip_ketidakhadiran extends Model
{
    protected $table = 'sip_ketidakhadirab';
  	protected $dates = ['deleted_at'];

    protected $fillable = [
        "name",
        "username",
        "departemen",
        "status_ketidakhadiran",
        "tanggal_mulai",
        "tanggal_selesai",
        "jumlah_hari",
        "sisa_hari",
        "dokumen",
        "option"
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}

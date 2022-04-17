<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class sip_absensi extends Model
{
  	protected $table = 'sip_absensi';
  	protected $dates = ['deleted_at'];

    protected $fillable = [
        "user",
        "tanggal",
        "jam_datang",
        "jam_pulang",
        "jam_datang_jadwal",
        "jam_pulang_jadwal",
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getDurationAttribute()
    {
        if ($this->jam_pulang == null) {
            return "➖";
        }
        $in = Carbon::createFromFormat('H:i:s',$this->jam_datang);
	    $out =  Carbon::createFromFormat('H:i:s',$this->jam_pulang);
       
	    return  Carbon::parse($in->diffAsCarbonInterval($out)->format("%H:%i"))->format("H:i");
    }

    public function getTelatAttribute()
    {
        if ($this->jam_datang > $this->jam_datang_jadwal) {
            $datang = Carbon::createFromFormat('H:i:s',$this->jam_datang);
            $jadwal =  Carbon::createFromFormat('H:i:s',$this->jam_datang_jadwal);
            
            return  Carbon::parse($datang->diffAsCarbonInterval($jadwal)->format("%H:%i"))->format("H:i");
        }
    }

    public function getAwalAttribute()
    {
        if ($this->jam_pulang == null) {
            return "➖";
        }
        if ($this->jam_pulang < $this->jam_pulang_jadwal) {
            $pulang = Carbon::createFromFormat('H:i:s',$this->jam_pulang);
            $jadwal =  Carbon::createFromFormat('H:i:s',$this->jam_pulang_jadwal);
            
            return  Carbon::parse($pulang->diffAsCarbonInterval($jadwal)->format("%H:%i"))->format("H:i");
        }
    }



    
}

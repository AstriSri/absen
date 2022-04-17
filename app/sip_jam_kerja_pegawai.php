<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_jam_kerja_pegawai extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $table = 'sip_jam_kerja_pegawai';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        "user",
        "jam_kerja",
        "jam_datang",
        "jam_pulang",
    ];

    /**
     * Get the pegawai associated with the sip_jam_kerja_pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pegawai()
    {
        return $this->hasOne(sip_pegawai::class, 'user', 'user');
    }

    /**
     * Get the jam_kerja that owns the sip_jam_kerja_pegawai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Jam_kerja()
    {
        return $this->belongsTo(sip_jam_kerja::class, 'jam_kerja', 'id');
    }

    public function getDurationAttribute()
    {
        $in = Carbon::createFromFormat('H:i:s',$this->jam_datang);
	    $out =  Carbon::createFromFormat('H:i:s',$this->jam_pulang);
	    return  Carbon::parse($in->diffAsCarbonInterval($out)->format("%h:%i"))->format("h:i");
    }
    // protected $cascadeDeletes = ['sip_biodatas'];
    // protected $primaryKey = 'kode';
    
}

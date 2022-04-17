<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sip_kegiatan extends Model
{
    protected $table = 'sip_kegiatan';
    protected $dates = ['deleted_at'];
    // protected $cascadeDeletes = ['riwayatjabatan'];
    // protected $primaryKey = 'kode';

    protected $fillable = [
        'user',
        'tanggal',
        'kegiatan',
        'keluaran',
        'volume',
        'satuan',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}

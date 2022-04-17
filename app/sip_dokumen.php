<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class sip_dokumen extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
  	protected $table = 'sip_dokumen';
  	protected $dates = ['deleted_at'];
    protected $fillable = [
      "user",
      "jenis",
      "dokumen",
      "keterangan",
      "uploader",
    ];

    public function userz(){
	    return $this->belongsTo(User::class, 'user');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Role extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $table = 'roles';
  	protected $dates = ['deleted_at'];

    protected $fillable = [
        "role",
        "kode_role",
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}

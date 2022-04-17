<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class UserRole extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $table = 'user_role';
  	protected $dates = ['deleted_at'];

    protected $fillable = [
        "username",
        "kode_role",
    ];
    
    public function user(){
        return $this->belongsTo('App\User', 'username', "username");
    }

    public function role(){
        return $this->belongsTo('App\Role', "kode_role", "kode_role");
    }
}

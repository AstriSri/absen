<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';

    public function pegawai(){
        return $this->hasOne(sip_pegawai::class, 'user');
    }

    public function dosen(){
        return $this->hasOne(sip_dosen::class, 'user');
    }

    public function role(){
        return $this->hasManyThrough(Role::class, UserRole::class, 'username', "kode_role", "username", "kode_role");
    }

    public function setTokenAttribute($token)
    {
        $this->attributes['remember_token'] = $token;
        $this->save();
    }

    public function setNullTokenAttribute($token)
    {
        $this->attributes['remember_token'] = $token;
        $this->save();
    }

    public function getLevelAttribute()
    {
        return $this->role->pluck("kode_role")->first();
    }
    
    public function getLevelsAttribute()
    {
        return $this->role->pluck("kode_role")->toArray();
    }

    public function getIsAdminAttribute()
    {
        return in_array(100, $this->levels);
    }

    public function scopeOfRole($query, $e = "", $r = "")
    {
        $role = $r == "" ? $e : $r;
        $equal = $r == "" ? "="  : $e;
        $query->whereHas("role", function($q) use($equal,$role)
        {
            $q->where("roles.kode_role", $equal , $role);
        });
        return $query;
    }
}

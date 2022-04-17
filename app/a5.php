<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class a5 extends Model
{
	use SoftDeletes, CascadeSoftDeletes;
	protected $table = 'a5';
  	protected $dates = ['deleted_at'];

	public function user(){
		return $this->belongsTo('App\User', 'user');
	}
    //
}

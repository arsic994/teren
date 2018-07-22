<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
	use SoftDeletes;

	protected $table = 'trips';
	protected $dates = ['deleted_at'];
    protected $fillable = ['package_id'];

}

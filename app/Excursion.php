<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Excursion extends Model
{
    use SoftDeletes;

    protected $table = 'excursions';
	protected $dates = ['deleted_at'];
    //protected $fillable = ['question_text'];
}

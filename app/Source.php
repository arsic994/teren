<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{
    use SoftDeletes;

    protected $table = 'sources';
    protected $fillable = ['id', 'source_data'];

    //db relation structures
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionsOption extends Model
{
    use SoftDeletes;

    protected $table = 'question_options';
	protected $dates = ['deleted_at'];
    protected $fillable = ['option', 'is_correct', 'question_id'];

    //db relation structures
    public function questions()
    {
    	return $this->belongsToMany(Question::class, 'question_id')->withTrashed();
	}
}

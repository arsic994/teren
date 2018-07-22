<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class QuestionTopic extends Model
{
    use SoftDeletes;

    protected $table = 'question_topics';
	protected $dates = ['deleted_at'];
	protected $fillable = ['question_id', 'topic_id'];

	//db relation structures
	public function question()
	{
		return $this->belongsTo(Question::class, 'question_id');
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class, 'topic_id');
	}
}

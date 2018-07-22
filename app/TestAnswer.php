<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestAnswer extends Model
{
    use SoftDeletes;

    protected $table = 'tests_answers';
    protected $fillable = ['user_id', 'test_id', 'question_id', 'option_id', 'is_correct'];

    //db relation structures
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function options()
    {
        return $this->belongsTo(QuestionsOption::class, 'option_id');
    }
}

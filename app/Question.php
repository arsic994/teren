<?php
  
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';
	protected $dates = ['deleted_at'];
    protected $fillable = ['question_text'];

    //db relation structures
    public function topics()
    {
    	return $this->belongsToMany(QuestionTopic::class);
	}

	public function testAnswers()
	{
    	return $this->belongsToMany(TestAnswer::class);
	}

	public function options()
	{
		return $this->has_many(QuestionsOption::class);
	}
}

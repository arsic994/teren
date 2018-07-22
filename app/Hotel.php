<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use SoftDeletes;

    protected $table = 'hotels';
	protected $dates = ['deleted_at'];
    protected $fillable = ['hotel_name'];

/*    //db relation structures
    public function trips()
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
	*/
}

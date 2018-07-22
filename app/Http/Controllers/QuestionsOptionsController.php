<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionsOption;
use App\Question;
use Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionsOptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    //Checking if question has only one correct answer
    public function maxOneCorrect($question_id)
    {
        $options = QuestionsOption::where('question_id', $question_id)->get();
        $count = count($options);

        if ($count >0) {
            $temp = 0;
            foreach ($options as $option) {
                if ($option->is_correct == 1) {
                    $temp = $temp + 1;
                }
            }
            if ($temp == 0) {
                return 0;
            } elseif ($temp == 1) {
                return 1;
            } else {
                return 2;
            }
        }
    }

    //Display a listing of the resource
    public function index($topic_id, $question_id)
    {
        $max_one_correct = self::maxOneCorrect($question_id);
        $question = Question::where('id', $question_id)->first();
        $questions_options = QuestionsOption::where('question_id', $question_id)->get();
        
        return view('admin.questions_options.index', compact('questions_options', 'question', 'max_one_correct', 'topic_id', 'question_id'));
    }

    //Show the form for creating a new resource.
    public function create($topic_id, $question_id)
    {
        return view('admin.questions_options.create', compact('question_id', 'topic_id'));
    }

    //Store a newly created resource in storage.
    public function store(Request $request, $topic_id, $question_id)
    {
        $this -> validate($request, [
            'option' => 'required|min:1|max:255',
        ]);

        $questions_option = new QuestionsOption;
        $questions_option->option = $request->input('option');
        $questions_option->question_id = $question_id;

        if ($request->input('is_correct') == 'on') {
            $questions_option->is_correct = 1;
        } 

        $questions_option->save();

        return redirect()->route('options.index', ['topic_id' => $topic_id, 'question_id' => $question_id]);
    }

    //Show the form for editing the specified resource.
    public function edit($topic_id, $question_id, $option_id)
    {   
        $option = QuestionsOption::find($option_id);

        return view('admin.questions_options.edit', compact('option', 'question_id', 'topic_id'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, $topic_id, $question_id, $option_id)
    {
        $this -> validate($request, [
            'option' => 'required|min:1|max:255',
        ]);

        $questions_option = QuestionsOption::find($option_id);
        $questions_option->option = $request->input('option');

        if ($request->input('is_correct') == 'on') {
            $questions_option->is_correct = 1;
        } else {
            $questions_option->is_correct = 0;
        }

        $questions_option->save();

        return redirect()->route('options.index', ['topic_id' => $topic_id, 'question_id' => $question_id]);
    }


     //Remove the specified resource from storage.
     public function delete($topic_id, $question_id, $option_id)
     {
        $questions_option = QuestionsOption::find($option_id)->first();

        return view('admin.questions_options.delete', compact('questions_option', 'question_id', 'topic_id'));
    }

    //Remove the specified resource from storage.
    public function destroy($topic_id, $question_id, $option_id)
    {
        $questions_option = QuestionsOption::find($option_id);
        $questions_option->delete();

        return redirect()->route('options.index', ['topic_id' => $topic_id, 'question_id' => $question_id]);
    }
}

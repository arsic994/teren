<?php
  
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Question;
use App\QuestionsOption;
use App\Topic;
use App\User;
use App\QuestionTopic;
use App\TestAnswer;
use Auth;

class QuestionController extends Controller{

    public function __construct()
    {
        $this->middleware('admin');
    }

    //Display a listing of the resource
    public function index($topic_id)
    {
        $topic = Topic::where('id', $topic_id)->first();
        $questions = QuestionTopic::where('topic_id', $topic_id)->get();

        return view('/admin/questions/show_question', compact('questions', 'topic', 'topic_id')); 
    }

    //Display the specified resource
    public function show($topic_id, $question_id)
    {
        $question = Question::find($question_id);
        $true = TestAnswer::where('question_id', $question_id)->where('is_correct', 1)->count();
        $false = TestAnswer::where('question_id', $question_id)->where('is_correct', 0)->count();
        $notAnswered = TestAnswer::where('question_id', $question_id)->where('option_id', null)->count();

        return view('admin/questions/question', compact('question', 'true', 'false', 'notAnswered', 'topic_id'));
    }

    //Show the form for creating a new resource.
    public function create($topic_id){
        return view('admin/questions/create_question', compact('topic_id'));
    }

    //Store a newly created resource in storage.
    public function store()
    {
        $this->validate(request(), [
            'question_text' => 'required'
            ]);

        $new_question_id = Question::create([
            'question_text' => request('question_text')
            ])->id;
        
        QuestionTopic::create([
            'question_id' => $new_question_id,
            'topic_id' => request('topic_id'),
            ]);

        return redirect()->route('questions.index', ['topic_id' => request('topic_id')]);    
    }

    //Show the form for editing the specified resource.
    public function edit($topic_id, $question_id)
    {
         $question = Question::find($question_id);

         return view('admin/questions/edit_question', compact('question', 'topic_id'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, $topic_id, $question_id)
    {
         $this -> validate($request, [
        'question_text' => 'required'
        ]);

        $question = Question::find($question_id);
        $question->question_text = $request->input('question_text');
        $question->save();

        return redirect()->route('questions.index', ['topic_id' => $topic_id]);
    }

    //Remove the specified resource from storage.
    public function delete($topic_id, $question_id)
    {
         $question = Question::find($question_id);
         
         return view('admin/questions/delete_question', compact('question', 'topic_id'));
    }

    //Remove the specified resource from storage.
    public function destroy($topic_id, $question_id)
    {   
        $question = Question::find($question_id);
        $question->delete();
        QuestionTopic::where('question_id', $question_id)->delete();
        QuestionsOption::where('question_id', $question_id)->delete();

        return redirect()->route('questions.index', ['topic_id' => $topic_id]);
    }

}

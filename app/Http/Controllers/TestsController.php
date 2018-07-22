<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Setting;
use App\Test;
use App\TestAnswer;
use App\Topic;
use App\Question;
use App\QuestionTopic;
use App\QuestionsOption;
use Illuminate\Http\Request;


class TestsController extends Controller
{ 
    //Display a listing of all online topics (tests)
    public function index()
    {
        $id = Auth::id();
        $topics = Topic::where('online', 1)->get();

        //Checking if only online tests have been passed
        $passed = [];
        foreach ($topics as $topic) {
            $topic_id = Test::where([
                'user_id' => $id,
                'passed' => 1,
                'topic_id' => $topic->id,
                ])->value('topic_id');

            if ($topic_id != NULL) {
                $passed[] = $topic_id;
            }
        }
   
        $final = 0;

        //Check if all topics have been passed
        if (count($topics) == count($passed)) {
            $final = 1;
            $passed_finals = Test::where([
                'user_id' => $id,
                'passed' => 1,
                'final_quiz' => 1,
                ])->value('passed');
        }

        $quiz_duration = Setting::where(['key' => 'quiz_duration'])->pluck('value')->first();
        
        return view('tests.index', compact('topics', 'passed', 'final', 'passed_finals', 'quiz_duration'));
    }

    //Create test
    public function create($test)
    {
        $topic = Topic::find($test);
        $question_topic = QuestionTopic::where('topic_id', $topic->id)->get();

        $test = Test::create([
            'user_id' => Auth::id(),
            'topic_id' => $topic->id,
            'final_quiz' => 0,
        ]);

        $test_id = $test->id;

        //Get all question related to this test
        foreach ($question_topic as $question_id) {
            $temp[] = $question_id->question_id;
        }

        $questions = Question::inRandomOrder()
                        ->whereIn('id', $temp)
                        ->limit($topic->number_of_questions)
                        ->get();
                        //->paginate(1);

        //Get all answers for a certain question 
        foreach ($questions as $question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        $quiz_duration = Setting::where(['key' => 'quiz_duration'])->pluck('value')->first();
        
        //Flag not used for this instance
        $number_of_questions=0;
        return view('tests.create', compact('questions', 'test_id', 'quiz_duration', 'number_of_questions'));
    }    

    //Create Final test
    public function createFinal()
    {
        $topic = Topic::all();
        $question_topic = QuestionTopic::all();

        $test = Test::create([
            'user_id' => Auth::id(),
            'topic_id' => NULL,
            'final_quiz' => 1,
        ]);

        $test_id = $test->id;

        //Get ids for passed tests
        $passed_tests_ids = Test::where([
                'user_id' => Auth::id(),
                'passed' => 1,
                ])->pluck('id')->all();

        //Get questions that appeared in passed tests
        foreach ($passed_tests_ids as $passed_tests_id) {
            $used_questions_array[] = TestAnswer::where([
                'test_id' => $passed_tests_id,
                ])->pluck('question_id')->all();

            $used_questions= call_user_func_array('array_merge', $used_questions_array);
        }

        //Get all questions that are not used and can appear in Final test
        foreach ($question_topic as $question_id) {
            $found = 0;
            foreach ($used_questions as $used_question) {
                if ($question_id->question_id == $used_question) {
                    $found = 1;
                }
            }
            if ($found==0) {
                $temp[] = $question_id->question_id;
            }            
        }

        $limit_questions = Setting::where(['key' => 'final_quiz_questions'])->pluck('value')->first();
        $topics = Topic::where('online', 1)->get();

        $questions = Question::inRandomOrder()
                        ->whereIn('id', $temp)
                        ->limit($limit_questions)
                        ->get();
                        //->paginate(1);

        //Get all answers for a certain question
        foreach ($questions as $question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        $quiz_duration = Setting::where(['key' => 'quiz_duration'])->pluck('value')->first();
        $number_of_questions = count($questions);
        
        return view('tests.create', compact('questions', 'test_id', 'quiz_duration', 'number_of_questions'));    
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $result = 0;
        $test_id = $request->input('test_id');
        $is_final = Test::where('id', $test_id)->value('final_quiz'); 

        //Get all answers
        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;

            if ($request->input('answers.'.$question) != null
                && QuestionsOption::find($request->input('answers.'.$question))->is_correct
            ) {
                $status = 1;
                ++$result;
            }

            TestAnswer::create([
                'user_id'     => Auth::id(),
                'test_id'     => $test_id,
                'question_id' => $question,
                'option_id'   => $request->input('answers.'.$question),
                'is_correct'     => $status,
            ]);
        }

        //If test is Final, result required for passing is different then forregular ones
        if ($is_final == 1) {
           $number_of_questions = $request->input('number_of_questions');
           $max_wrong = Setting::where(['key' => 'final_quiz_max_negative'])->pluck('value')->first();
           $required_result = $number_of_questions - $max_wrong;
        }
        else {
            $topic_id = Test::where('id', $test_id)->value('topic_id');
            $required_result = Topic::where('id', $topic_id)->value('correct_answers');
        }
        
        //Has user passed the test
        if ($result >= $required_result) {
            DB::table('tests')
                    ->where('id', $test_id)
                    ->update([
                        'finished_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        'passed' => 1,
                    ]);
        } else {
            DB::table('tests')
                    ->where('id', $test_id)
                    ->update([
                        'finished_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        'passed' => 0,
                    ]);
        }
        
        $results = Test::where('user_id', Auth::id())->get();

        return redirect()->action('ResultsController@index');
    }
}

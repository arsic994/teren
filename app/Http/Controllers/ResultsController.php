<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Test;
use App\TestAnswer;

class ResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Display a listing of the resource
    public function index()
    {
        $results = Test::where('user_id', Auth::id())->get();
        
        return view('results.index', compact('results'));
    }

    //Display the specified resource
    public function show($id)
    {
        $test = Test::find($id);

        if ($test) {
            $results = TestAnswer::where('test_id', $id)
                ->get();
        }

        return view('results.show', compact('test', 'results'));
    }
}

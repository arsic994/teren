<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\User;
use Setting;
use Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    //Display a listing of the resource
    public function index()
    {
        $settings = Setting::all();

        return view('admin.settings.index')->with('settings', $settings);
    }
    
    //Show the form for creating a new resource
    public function create()
    {
        return view('admin.settings.create');
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $this -> validate($request, [
            'quiz_duration'=>'numeric|min:0',
            'activation_timeout_minutes'=>'numeric|min:0',
            'final_quiz_questions'=>'integer|min:0',
            'questions_per_page'=>'integer|min:0',
            'final_quiz_max_negative'=>'integer|min:0',
     ]);

        Setting::set('quiz_duration', $request->input('quiz_duration'));    
        Setting::set('activation_timeout_minutes', $request->input('activation_timeout_minutes'));
        Setting::set('final_quiz_questions', $request->input('final_quiz_questions'));
        Setting::set('questions_per_page', $request->input('questions_per_page'));
        Setting::set('final_quiz_max_negative', $request->input('final_quiz_max_negative'));
        Setting::save();

        return redirect('/admin/settings');
    }

    //Show the form for editing the specified resource.
    public function edit()
    { 
        return view('admin.settings.edit');
    }

    //Update the specified resource in storage.
    public function update(Request $request)
    {
        $this -> validate($request, [
            'quiz_duration'=>'numeric|min:0',
            'activation_timeout_minutes'=>'numeric|min:0',
            'final_quiz_questions'=>'integer|min:0',
            'questions_per_page'=>'integer|min:0',
            'final_quiz_max_negative'=>'integer|min:0',
     ]);
        
        if ($request->input('quiz_duration')) {
            Setting::set('quiz_duration', $request->input('quiz_duration'));
        } else {
            Setting::forget('quiz_duration');
        }

        if ($request->input('activation_timeout_minutes')) {
            Setting::set('activation_timeout_minutes', $request->input('activation_timeout_minutes'));
        } else {
            Setting::forget('activation_timeout_minutes');
        }

        if ($request->input('final_quiz_questions')) {
            Setting::set('final_quiz_questions', $request->input('final_quiz_questions'));
        } else {
            Setting::forget('final_quiz_questions');
        }

        if ($request->input('questions_per_page')) {
            Setting::set('questions_per_page', $request->input('questions_per_page'));
        } else {
            Setting::forget('questions_per_page');
        }

        if ($request->input('final_quiz_max_negative')) {
           Setting::set('final_quiz_max_negative', $request->input('final_quiz_max_negative'));
        } else {
             Setting::forget('final_quiz_max_negative');
        }

        Setting::save();
        
        return redirect('/admin/settings');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Auth;
use App\User;
use App\Test;
use App\Question;
use Redirect;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //creating certificate
    public function downloadPDF()
    {
    	$user = new User();
        $id = Auth::id(); 
        
        //getting user data if user exist
        if($id != null){
    	    $name = User::find($id)->name;
            $user_name = $user->latin_to_cyrilic($name); //name to cyrilc
    	    $date = Test::where(['user_id'=> $id, 'final_quiz' => 1, 'passed' => 1])->pluck('finished_at')->first();

            //if final test is passed, print certificate
    	    if($user->isPassedFinal() == true){
    	        $pdf = PDF::loadView('pdf', compact('date', 'user_name'));
                return $pdf->download('diploma.pdf');
    	    }
            return Redirect::back();
        }
        return Redirect::back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\redirect;
use Illuminate\Http\Request;
use Illuminate\Html;
use App\Source;
use DB;
use Illuminate\Support\Facades\Input;

class SourceController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }

    //Display a listing of the resource
	public function index() 
	{
		$source_data = Source::all();

		return view ('source.index', compact('source_data'));
	}

	//Get data in DB
	function getData() 
	{
		$source_data = Source::all();

		return view ('/auth/register', compact('source_data'));
	}

	//Store a newly created resource in storage.
	public function insert(Request $request) 
	{
        $this -> validate($request, [
            'source_data' => 'required',
        ]);

		$source_data = Source::all();
		$Source_data = $request->input('source_data');
		$data = array('source_data' => $Source_data, );
		DB::table('sources')->insert($data);

		return redirect('/source');
	}
	
	//Remove the specified resource from storage.
	public function delete($id) 
	{
		$data = Source::find($id);
        $data->delete();

		return redirect('/source');
	}

	//Remove the specified resource from storage.
	public function update(Request $request, $id) 
	{
        $data = Source::find($id);
        $data->source_data = $request->input('source_data');
        $data->save();

        return redirect('/source');
	}
}


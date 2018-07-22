<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trip;
use App\Bus;
use App\Hotel;
use App\Excursion;
use App\Package;

class TripsController extends Controller
{   
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    //Display a listing of the resource
    public function index()
    {
        $trips = Trip::all();

        return view('admin.trips.index_trip', compact('trips'));
    }

    //Show the form for creating a new resource.
    public function create()
    {
        return view('admin.trips.create_trip');
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $this -> validate($request, [
            'title' => 'required|string|max:255',
        ]);

        $trip = new Trip;
        $trip->title = $request->input('title');
        $trip->save();

        return redirect('/trips')->with('Success'); 
    }

    //Display the specified resource
    public function show($trip_id)
    {
        $trip = Trip::find($trip_id);
        $buses = Bus::where('trip_id', $trip_id)->get();
        $hotels = Hotel::where('trip_id', $trip_id)->get();
        $excursions = Excursion::where('trip_id', $trip_id)->get();
        $packages = Package::where('trip_id', $trip_id)->get();



        return view('admin.trips.show_trip', compact('trip', 'buses', 'hotels', 'excursions', 'packages'));
    }

    //Show the form for editing the specified resource.
    public function edit($trip_id)
    {
        $trip = Trip::find($trip_id); 
            return view('admin.trips.edit_trip', compact('trip'));
    } 

    //Update the specified resource in storage.
    public function update(Request $request, $trip_id)
    {
        $this -> validate($request, [
            'title' => 'required|string|max:255',
        ]);

        $trip = Trip::find($trip_id);
        $trip->title = $request->input('title');

        if ($request->input('active') =='on') {
            $trip->active = true;
        } else {
             $trip->active = false;
        }

        $trip->save();

        return redirect('/trips');
    }

    //Remove the specified resource from storage.
    public function delete($trip_id)
    {
        $trip = Trip::find($trip_id);
        
        return view('admin.trips.delete_trip', compact('trip'));
    }

    //Remove the specified resource from storage.
    public function destroy($trip_id)
    {   
        Trip::find($trip_id)->delete();
                
        return redirect('/trips');
    }
}

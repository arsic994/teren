<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trip;
use App\User;
use App\Bus;
use Auth;

class BusesController extends Controller
{
     public function __construct()
    {
        $this->middleware('admin');
    }

    //Show the form for creating a new resource.
    public function create($trip_id)
    {
        return view('admin/buses/create_bus', compact('trip_id'));
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
    	$this -> validate($request, [
            'title' => 'required|string|max:255',
            'guide' => 'required|string|max:255',
        ]);

        $bus = new Bus;
        $bus->title = $request->input('title');
        $bus->guide_id = $request->input('guide');
        $bus->trip_id = $request->input('trip_id');
        $bus->save();

        //return redirect('/trips/'.$request->input('trip_id'))->with('Success'); 

        return redirect()->route('trips.trip', ['trip_id' => request('trip_id')]);    
    }

    //Show the form for editing the specified resource.
    public function edit($trip_id, $bus_id)
    {
         $bus = bus::find($bus_id);

         return view('admin/buses/edit_bus', compact('bus', 'trip_id'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, $trip_id, $bus_id)
    {
         $this -> validate($request, [
            'title' => 'required|string|max:255',
            'guide' => 'required|string|max:255',
        ]);

        $bus = bus::find($bus_id);
        $bus->title = $request->input('title');
        $bus->guide_id = $request->input('guide');
        $bus->save();

       return redirect()->route('trips.trip', ['trip_id' => request('trip_id')]); 
    }

    //Remove the specified resource from storage.
    public function delete($trip_id, $bus_id)
    {
         $bus = Bus::find($bus_id);
         
         return view('admin/buses/delete_bus', compact('bus', 'trip_id'));
    }

    //Remove the specified resource from storage.
    public function destroy($trip_id, $bus_id)
    {   
        Bus::find($bus_id)->delete();

        return redirect()->route('trips.trip', $trip_id); 
    }
}

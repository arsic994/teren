<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Trip;
use App\User;
use App\Hotel;
use Auth;

class HotelsController extends Controller
{
     public function __construct()
    {
        $this->middleware('admin');
    }

    //Show the form for creating a new resource.
    public function create($trip_id)
    {
        return view('admin/hotels/create_hotel', compact('trip_id'));
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
    	$this -> validate($request, [
            'title' => 'required|string|max:255',
        ]);

        $hotel = new Hotel;
        $hotel->title = $request->input('title');
        $hotel->trip_id = $request->input('trip_id');
        $hotel->save();

        //return redirect('/trips/'.$request->input('trip_id'))->with('Success'); 

        return redirect()->route('trips.trip', ['trip_id' => request('trip_id')]);    
    }

    //Show the form for editing the specified resource.
    public function edit($trip_id, $hotel_id)
    {
         $hotel = hotel::find($hotel_id);

         return view('admin/hotels/edit_hotel', compact('hotel', 'trip_id'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, $trip_id, $hotel_id)
    {
         $this -> validate($request, [
            'title' => 'required|string|max:255',
        ]);

        $hotel = hotel::find($hotel_id);
        $hotel->title = $request->input('title');
        $hotel->save();

       return redirect()->route('trips.trip', ['trip_id' => request('trip_id')]); 
    }

    //Remove the specified resource from storage.
    public function delete($trip_id, $hotel_id)
    {
         $hotel = Hotel::find($hotel_id);
         
         return view('admin/hotels/delete_hotel', compact('hotel', 'trip_id'));
    }

    //Remove the specified resource from storage.
    public function destroy($trip_id, $hotel_id)
    {   
        hotel::find($hotel_id)->delete();

        return redirect()->route('trips.trip', $trip_id); 
    }
}

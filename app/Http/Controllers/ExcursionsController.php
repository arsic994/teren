<?php

namespace App\Http\Controllers;

use App\Excursion;
use Illuminate\Http\Request;
use App\Trip;

class ExcursionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    //Show the form for creating a new resource.
    public function create($trip_id)
    {
        return view('admin/excursions/create_excursion', compact('trip_id'));
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $this -> validate($request, [
            'title' => 'required|string|max:255',
            'price' => 'required',
        ]);

        $excursion = new Excursion;
        $excursion->title = $request->input('title');
        $excursion->price = $request->input('price');
        $excursion->trip_id = $request->input('trip_id');
        $excursion->save();

        return redirect()->route('trips.trip', ['trip_id' => request('trip_id')]);    
    }

    //Show the form for editing the specified resource.
    public function edit($trip_id, $excursion_id)
    {
         $excursion = Excursion::find($excursion_id);

         return view('admin/excursions/edit_excursion', compact('excursion', 'trip_id'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, $trip_id, $excursion_id)
    {
         $this -> validate($request, [
            'title' => 'required|string|max:255',
            'price' => 'required',
        ]);

        $excursion = Excursion::find($excursion_id);
        $excursion->title = $request->input('title');
        $excursion->price = $request->input('price');
        $excursion->save();

       return redirect()->route('trips.trip', ['trip_id' => request('trip_id')]); 
    }

    //Remove the specified resource from storage.
    public function delete($trip_id, $excursion_id)
    {
         $excursion = Excursion::find($excursion_id);
         
         return view('admin/excursions/delete_excursion', compact('excursion', 'trip_id'));
    }

    //Remove the specified resource from storage.
    public function destroy($trip_id, $excursion_id)
    {   
        Excursion::find($excursion_id)->delete();

        return redirect()->route('trips.trip', $trip_id); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use App\Trip;
use App\Excursion;

class PackagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    //Show the form for creating a new resource.
    public function create($trip_id)
    {
        $excursions = Excursion::where('trip_id', $trip_id)->get();
        return view('admin/packages/create_package', compact('trip_id', 'excursions'));
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $this -> validate($request, [
            'title' => 'required|string|max:255',
            'price' => 'required',
        ]);

        $excursions = $request->input('excursions');
        $jsonExcursions = json_encode($excursions);

        $package = new Package;
        $package->title = $request->input('title');
        $package->price = $request->input('price');
        $package->excursions = $jsonExcursions;
        $package->trip_id = $request->input('trip_id');
        $package->save();

        return redirect()->route('trips.trip', ['trip_id' => request('trip_id')]);    
    }

    //Show the form for editing the specified resource.
    public function edit($trip_id, $package_id)
    {
        $excursions = Excursion::where('trip_id', $trip_id)->get();
        $package = Package::find($package_id);
        $selected_excursions = json_decode($package->excursions, true);

        return view('admin/packages/edit_package', compact('package', 'trip_id', 'excursions', 'selected_excursions'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, $trip_id, $package_id)
    {
         $this -> validate($request, [
            'title' => 'required|string|max:255',
            'price' => 'required',
        ]);

        $excursions = $request->input('excursions');
        $jsonExcursions = json_encode($excursions);

        $package = Package::find($package_id);
        $package->title = $request->input('title');
        $package->price = $request->input('price');
        $package->excursions = $jsonExcursions;
        $package->save();

       return redirect()->route('trips.trip', ['trip_id' => request('trip_id')]); 
    }

    //Remove the specified resource from storage.
    public function delete($trip_id, $package_id)
    {
         $package = Package::find($package_id);
         
         return view('admin/packages/delete_package', compact('package', 'trip_id'));
    }

    //Remove the specified resource from storage.
    public function destroy($trip_id, $package_id)
    {   
        Package::find($package_id)->delete();

        return redirect()->route('trips.trip', $trip_id); 
    }
}

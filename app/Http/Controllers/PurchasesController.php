<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use App\Trip;
use App\Bus;
use App\Hotel;
use App\Excursion;
use App\Package;

class PurchasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //Display a listing of the resource
    public function index($trip_id)
    {   
        $trip = Trip::where('id', $trip_id)->get();
        $purchases = Purchase::where('trip_id', $trip_id)->get();
        return view('purchases.index_purchase', compact('purchases', 'trip'));
    }

    /*Show the form for creating a new resource.
    public function create($trip_id)
    {
        $buses = Bus::where('trip_id', $trip_id)->get();
        $hotels = Hotel::where('trip_id', $trip_id)->get();
        $excursions = Excursion::where('trip_id', $trip_id)->get();
        $packages = Package::where('trip_id', $trip_id)->get();
        return view('purchases.create_purchase', compact('buses', 'hotels', 'excursions', 'packages'));
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $this -> validate($request, [
            'name' => 'required|string|max:255',
            'hotel' => 'required',
            'bus' => 'required',
        ]);

        //obracun cena, encode/dekode json

        $purchase = new Purchase;
        $purchase->name = $request->input('name');
        $purchase->trip_id = $request->input('trip_id');
        $purchase->hotel_id = $request->input('hotel');
        $purchase->bus_id = $request->input('bus');
        $purchase->paid = $request->input('paid');
        $purchase->save();

        return redirect('/purchases')->with('Success'); 
    }

    //Display the specified resource
    public function show($purchase_id)
    {
        $purchase = Purchase::find($purchase_id);
        $buses = Bus::where('purchase_id', $purchase_id)->get();
        $hotels = Hotel::where('purchase_id', $purchase_id)->get();
        $excursions = Excursion::where('purchase_id', $purchase_id)->get();
        $packages = Package::where('purchase_id', $purchase_id)->get();



        return view('purchases.show_purchase', compact('purchase', 'buses', 'hotels', 'excursions', 'packages'));
    }

    //Show the form for editing the specified resource.
    public function edit($purchase_id)
    {
        $purchase = Purchase::find($purchase_id); 
            return view('purchases.edit_purchase', compact('purchase'));
    } 

    //Update the specified resource in storage.
    public function update(Request $request, $purchase_id)
    {
        $this -> validate($request, [
            'title' => 'required|string|max:255',
        ]);

        $purchase = Purchase::find($purchase_id);
        $purchase->title = $request->input('title');

        if ($request->input('active') =='on') {
            $purchase->active = true;
        } else {
             $purchase->active = false;
        }

        $purchase->save();

        return redirect('/purchases');
    }

    //Remove the specified resource from storage.
    public function delete($purchase_id)
    {
        $purchase = Purchase::find($purchase_id);
        
        return view('purchases.delete_purchase', compact('purchase'));
    }

    //Remove the specified resource from storage.
    public function destroy($purchase_id)
    {   
        Purchase::find($purchase_id)->delete();
                
        return redirect('/purchases');
    }*/
}

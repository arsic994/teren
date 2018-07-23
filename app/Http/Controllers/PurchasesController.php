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
        $trip = Trip::where('id', $trip_id)->first();
        $purchases = Purchase::where('trip_id', $trip_id)->get();
        return view('purchases.index_purchase', compact('purchases', 'trip'));
    }

    //Show the form for creating a new resource.
    public function create($trip_id)
    {
        $trip = Trip::find($trip_id);
        $buses = Bus::where('trip_id', $trip_id)->get();
        $hotels = Hotel::where('trip_id', $trip_id)->get();
        $excursions = Excursion::where('trip_id', $trip_id)->get();
        $packages = Package::where('trip_id', $trip_id)->get();
        return view('purchases.create_purchase', compact('trip', 'buses', 'hotels', 'excursions', 'packages'));
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $this -> validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $excursions = $request->input('excursions');
        $packages = $request->input('packages');

        $price = 0;

        if($packages){
            foreach ($packages as $p) {
                $temp = Package::select('price')->where('id', $p)->first();
                $price += $temp->price;
            }
        }

        if($excursions){
            foreach ($excursions as $e) {
                $temp = Excursion::select('price')->where('id', $e)->first();
                $price += $temp->price;
            }
        }
        
        $jsonExcursions = json_encode($excursions);
        $jsonPackages = json_encode($packages);
        $purchase = new Purchase;
        $purchase->name = $request->input('name');
        $purchase->trip_id = $request->input('trip_id');
        $purchase->guide_id = Auth::id();
        $purchase->hotel_id = $request->input('hotel');
        $purchase->bus_id = $request->input('bus');
        $purchase->bought_excursions = $jsonExcursions;
        $purchase->bought_packages = $jsonPackages;
        $purchase->price = $price;
        $purchase->save();

        return redirect()->route('purchases.confirm', ['trip_id' => $purchase->trip_id, 'purchase_id' => $purchase->id,]);
    }

    //Confirm paying a newly created resource in storage.
    public function confirmPurchase($trip_id, $purchase_id)
    {
        $purchase = Purchase::where('id', $purchase_id)->first();
        $bought_excursions = json_decode($purchase->bought_excursions, true);
        $bought_packages = json_decode($purchase->bought_packages, true);

        $excursions = Excursion::where('trip_id', $trip_id)->get();
        $packages = Package::where('trip_id', $trip_id)->get();
             
        return view('purchases.confirm_purchase', compact('purchase', 'bought_excursions', 'bought_packages', 'excursions', 'packages'));
    }

    //Confirm paying a newly created resource in storage.
    public function confirmedPurchase(Request $request, $trip_id, $purchase_id)
    {
        $purchase = Purchase::where('id', $purchase_id)->first();

        if ($request->input('paid') == 'on') 
        {
            $purchase->paid = 1;
        }
        else {
            $purchase->paid = 0;
        }

        $purchase->save();
        
        return redirect()->route('purchases.index', ['trip_id' => $purchase->trip_id]);
    }

    //Show the form for editing the specified resource.
    public function edit($trip_id, $purchase_id)
    {
        $purchase = Purchase::find($purchase_id); 
        $bought_excursions = json_decode($purchase->bought_excursions, true);
        $bought_packages = json_decode($purchase->bought_packages, true);

        $trip = Trip::find($trip_id);
        $buses = Bus::where('trip_id', $trip_id)->get();
        $hotels = Hotel::where('trip_id', $trip_id)->get();
        $excursions = Excursion::where('trip_id', $trip_id)->get();
        $packages = Package::where('trip_id', $trip_id)->get();

        return view('purchases.edit_purchase', compact('purchase', 'bought_excursions', 'bought_packages', 'excursions', 'packages', 'trip', 'buses', 'hotels'));
    } 

    //Update the specified resource in storage.
    public function update(Request $request, $purchase_id)
    {
        $this -> validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $excursions = $request->input('excursions');
        $packages = $request->input('packages');

        $price = 0;

        if($packages){
            foreach ($packages as $p) {
                $temp = Package::select('price')->where('id', $p)->first();
                $price += $temp->price;
            }
        }

        if($excursions){
            foreach ($excursions as $e) {
                $temp = Excursion::select('price')->where('id', $e)->first();
                $price += $temp->price;
            }
        }
        
        $jsonExcursions = json_encode($excursions);
        $jsonPackages = json_encode($packages);

        $purchase = Purchase::find($purchase_id);
        $purchase->name = $request->input('name');
        $purchase->trip_id = $request->input('trip_id');
        $purchase->guide_id = Auth::id();
        $purchase->hotel_id = $request->input('hotel');
        $purchase->bus_id = $request->input('bus');
        $purchase->bought_excursions = $jsonExcursions;
        $purchase->bought_packages = $jsonPackages;
        $purchase->price = $price;
        $purchase->save();

        return redirect()->route('purchases.confirm', ['trip_id' => $purchase->trip_id, 'purchase_id' => $purchase->id,]);
    }

    //Remove the specified resource from storage.
    public function delete($trip_id, $purchase_id)
    {
        $purchase = Purchase::find($purchase_id);
        return view('purchases.delete_purchase', compact('purchase'));
    }

    //Remove the specified resource from storage.
    public function destroy($trip_id, $purchase_id)
    {   
        Purchase::find($purchase_id)->delete();
                
        return redirect()->route('purchases.index', ['trip_id' => $trip_id]);
    }
}

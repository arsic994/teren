@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Potvrdi kupovinu</h3></div>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ route('purchases.confirmed', ['trip_id' => $purchase->trip_id, 'purchase_id' => $purchase->id,]) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <h4 class="col-md-4 control-label">ID kupovine:</h4>
                            <div class="col-md-6"><h4>{{$purchase->id}}</h4></div>
                        </div>

                        <div class="form-group">
                            <h4 class="col-md-4 control-label">Ime i prezime:</h4>
                            <div class="col-md-6"><h4>{{$purchase->name}}</h4></div>
                        </div>

                        <div class="form-group">
                            <h4 class="col-md-4 control-label">Hotel:</h4>
                            <div class="col-md-6"><h4>{{$purchase->hotel_id}} ime umesto id-a</h4></div>
                        </div>

                        <div class="form-group">
                            <h4 class="col-md-4 control-label">Bus:</h3>
                            <div class="col-md-6"><h4>{{$purchase->bus_id}} ime umesto id-a</h4></div>
                        </div>

                        <div class="form-group">
                            <h4 class="col-md-4 control-label">Kupljeni paketi:</h4>
                            <div class="col-md-6"><h4>
                            @if (count($bought_packages) > 0)
                                @foreach($packages as $package)
                                    @if(in_array($package->id, $bought_packages))
                                        <h4>{{$package->title}} - {{$package->price}}€</h4>
                                    @endif
                                @endforeach
                             @endif
                            </h4></div>
                        </div>

                        <div class="form-group">
                            <h4 class="col-md-4 control-label">Kupljeni izleti</h4>
                            <div class="col-md-6"><h4>
                            @if (count($bought_excursions) > 0)
                                @foreach($excursions as $excursion)
                                    @if(in_array($excursion->id, $bought_excursions))
                                        <h4>{{$excursion->title}} - {{$excursion->price}}€</h4>
                                    @endif
                                @endforeach
                             @endif
                         </h4></div>
                        </div>

                        <div class="form-group">
                            <h4 class="col-md-4 control-label">Cena za naplatu:</h4>
                            <div class="col-md-6" style="color: red;"><h2>{{$purchase->price}}€</h2></div>
                        </div>

                        <div class="form-group">
                            <label for="paid" class="col-md-4 control-label">Placeno:</label>
                            <div class="col-md-6">
                               @if ($purchase->paid == true)
                                    <input id="paid" type="checkbox" class="form-control" name="paid" autofocus checked>
                               @else
                                    <input id="paid" type="checkbox" class="form-control" name="paid" autofocus>
                               @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Sačuvaj
                                </button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
           <a href="{{ URL::route('purchases.index', $purchase->trip_id)}}"><button class='btn btn-primary'>Nazad</button></a>
        </div>
    </div>
</div>
@endsection

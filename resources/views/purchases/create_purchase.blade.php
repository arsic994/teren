@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Kreiraj novu kupovinu</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('purchases.store', $trip->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Ime i prezime</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <input id="trip_id" type="hidden" name="trip_id" value="{{$trip->id}}">

                        <div class="form-group{{ $errors->has('hotel') ? ' has-error' : '' }}">
                            <label for="hotel" class="col-md-4 control-label">Hotel</label>
                            <div class="col-md-6">
                                <select class="form-control" name="hotel" id="hotel">
                                    @if (count($hotels) > 0)
                                    @foreach($hotels as $hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->title}}</option>
                                    @endforeach
                                    @else
                                        <option value="0">Ne postoji dodati hotel</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('bus') ? ' has-error' : '' }}">
                            <label for="bus" class="col-md-4 control-label">Autobus</label>
                            <div class="col-md-6">
                                <select class="form-control" name="bus" id="bus">
                                    @if (count($buses) > 0)
                                        @foreach($buses as $bus)
                                            <option value="{{$bus->id}}">{{$bus->title}}</option>
                                        @endforeach
                                    @else
                                        <option value="0">Ne postoji dodati autobus</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('package') ? ' has-error' : '' }}">
                            <label for="package" class="col-md-4 control-label">Paketi</label>
                                <div class="col-md-6">
                                    @if (count($packages) > 0)
                                        @foreach($packages as $package)
                                            <h4><input type="checkbox" id="packages" name="packages[]" value="{{$package->id}}">{{$package->title}} - {{$package->price}}€</h4>
                                        @endforeach
                                    @else
                                        <h3>Ne postoje paketi za ovo putovanje<h3>
                                    @endif
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('excursion') ? ' has-error' : '' }}">
                            <label for="excursion" class="col-md-4 control-label">Pojedinačni izleti</label>
                                <div class="col-md-6">
                                    @if (count($excursions) > 0)
                                        @foreach($excursions as $excursion)
                                            <h4><input type="checkbox" id="excursions" name="excursions[]" value="{{$excursion->id}}">{{$excursion->title}} - {{$excursion->price}}€</h4>
                                        @endforeach
                                    @else
                                        <h3>Ne postoje pojedinačni izleti za ovo putovanje<h3>
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
           <a href="{{ URL::route('purchases.index', $trip->id)}}"><button class='btn btn-primary'>Nazad</button></a>
        </div>
    </div>
</div>
@endsection

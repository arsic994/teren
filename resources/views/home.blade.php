@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3>Aktuelna putovanja</h3>
                    </div>

                    <div class="panel-body">
                       @if (count($trips) > 0)
                       @foreach($trips as $trip)
                            <div class="form-group">
                            <h3>{{$trip->title}}</h3>
                            <a href="/trips/{{$trip->id}}/purchase"><button class='btn btn-primary'>Otvori turu</button></a>
                            </div>
                        @endforeach
                        @else
                            <h3>Nema aktivnih tura</h3>
                        @endif
                    </div>
                </div>
                <div>
                    <h3>Ovo su dugmad koje ce samo admin vidi</h3>
                    <a href="{{ URL::route('trips.index')}}"><button class='btn btn-primary'>Upravljaj turama</button></a>
                    <a href="{{ URL::route('users.index')}}"><button class='btn btn-primary'>Vodici</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

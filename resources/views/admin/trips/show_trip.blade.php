@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div>
                <a href="{{ URL::route('trips.index')}}"><button class='btn btn-primary'>Nazad</button></a>
            </div>
                
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{$trip->title}}</h3>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Autobusi</h3>
                </div>
                <div class="panel-body">
                    @if (count($buses) > 0)
                    @foreach($buses as $bus)
                    <div class="form-group">
                        <h3>{{$bus->title}} - vodič {{$bus->guide_id}} ime umesto id</h3>
                        <a href="/trips/{{$trip->id}}/bus/{{$bus->id}}/edit"><button class='btn btn-primary'>Izmeni bus</button></a>
                        <a href="/trips/{{$trip->id}}/bus/{{$bus->id}}/delete"><button class='btn btn-danger'>Obriši bus</button></a>
                    </div>
                    @endforeach
                    @else
                    <h3>Nema dodatih autobusa</h3>
                    @endif
                </div>
            </div>

            <p>
                <a href="/trips/{{$trip->id}}/bus/create"><button class='btn btn-primary'>Dodaj autobuse</button></a>
            </p>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Hoteli</h3>
                </div>
                <div class="panel-body">
                    @if (count($hotels) > 0)
                    @foreach($hotels as $hotel)
                    <div class="form-group">
                        <h3>{{$hotel->title}}</h3>
                        <a href="/trips/{{$trip->id}}/hotel/{{$hotel->id}}/edit"><button class='btn btn-primary'>Izmeni hotel</button></a>
                        <a href="/trips/{{$trip->id}}/hotel/{{$hotel->id}}/delete"><button class='btn btn-danger'>Obriši hotel</button></a>
                    </div>
                    @endforeach
                    @else
                    <h3>Nema dodatih hotela</h3>
                    @endif
                </div>
            </div>

            <p>
                <a href="/trips/{{$trip->id}}/hotel/create"><button class='btn btn-primary'>Dodaj hotel</button></a>
            </p>

            <div class="panel panel-default">
               <div class="panel-heading">
                    <h3>Paketi</h3>
                </div>
                 <div class="panel-body">

                    <p>
                        <a href="/trips/{{$trip->id}}/package/create"><button class='btn btn-primary'>Napravi paket</button></a>
                    </p>
                    @if (count($packages) > 0)
                    @foreach($packages as $package)
                    <div class="form-group">
                        <h3>{{$package->title}} - {{$package->price}}€</h3>
                        <a href="/trips/{{$trip->id}}/package/{{$package->id}}/edit"><button class='btn btn-primary'>Izmeni Paket</button></a>
                        <a href="/trips/{{$trip->id}}/package/{{$package->id}}/delete"><button class='btn btn-danger'>Obriši Paket</button></a>
                    </div>
                    @endforeach
                    @else
                    <h3>Nema dodatih paketa</h3>
                    @endif
                </div>
                

                <div class="panel-heading">
                    <h3>Izleti</h3>
                </div>
                <div class="panel-body">
                    @if (count($excursions) > 0)
                    @foreach($excursions as $excursion)
                    <div class="form-group">
                        <h3>{{$excursion->title}} - {{$excursion->price}}€</h3>
                        <a href="/trips/{{$trip->id}}/excursion/{{$excursion->id}}/edit"><button class='btn btn-primary'>Izmeni Izlet</button></a>
                        <a href="/trips/{{$trip->id}}/excursion/{{$excursion->id}}/delete"><button class='btn btn-danger'>Obriši Izlet</button></a>
                    </div>
                    @endforeach
                    @else
                    <h3>Nema dodatih izleta</h3>
                    @endif
                </div>
            </div>

            <p>
                <a href="/trips/{{$trip->id}}/excursion/create"><button class='btn btn-primary'>Dodaj izlet</button></a>
            </p>
            
        </div>
    </div>
</div>
</div>
@endsection

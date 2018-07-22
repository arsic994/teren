@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default"> 
                <div class="panel-heading">
                    <h3>Izmena izleta</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="update">
                        {{ csrf_field() }}     
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Ime izleta</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $excursion->title}}"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label">Cena izleta</label>
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="{{ $excursion->price}}"> 
                            </div>
                        </div>


                        <input id="trip_id" type="hidden" name="trip_id" value="{{$trip_id}}">
 
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Izmeni izlet
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <a href="{{ URL::route('trips.trip', $trip_id)}}"><button class='btn btn-primary'>Nazad</button></a>
            </div>
        </div>
    </div>
</div>
@endsection


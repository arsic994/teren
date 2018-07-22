@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Unesi autobus</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="store">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Ime autobusa</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Ime vodica - srediti dropdown</label>
                            <div class="col-md-6">
                                <input id="guide" type="text" class="form-control" name="guide" value="{{ old('guide') }}" autofocus> 
                            </div>
                        </div>

                        <input id="trip_id" type="hidden" name="trip_id" value="{{$trip_id}}">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Unesi autobus
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ URL::route('trips.trip', $trip_id)}}"><button class='btn btn-primary'>Nazad</button></a>
        </div>
    </div>
</div>
</div>
@endsection

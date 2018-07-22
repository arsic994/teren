@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Izmena putovanja</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="update">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Naslov</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $trip->title }}" required autofocus>
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                            <label for="active" class="col-md-4 control-label">Aktivno putovanje</label>
                            <div class="col-md-6">
                                @if ($trip->active == 1)
                                    <input id="active" type="checkbox" class="form-control" name="active" autofocus checked>
                                @else
                                    <input id="active" type="checkbox" class="form-control" name="active" autofocus>
                                @endif

                                @if (count($errors))
                                <div class="form-group">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
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
            <a href="{{ URL::route('trips.index')}}"><button class='btn btn-primary'>Nazad</button></a>
        </div>
    </div>
</div>
@endsection

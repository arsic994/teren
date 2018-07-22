@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Izmena Vodica</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="update">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Ime i prezime:</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Telefon:</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$user->phone}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-mail:</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{$user->email}}"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="admin" class="col-md-4 control-label">Admin:</label>
                            <div class="col-md-6">
                               @if ($user->is_admin == 1)
                               <input id="is_admin" type="checkbox" class="form-control" name="is_admin" autofocus checked>
                               @else
                               <input id="is_admin" type="checkbox" class="form-control" name="is_admin" autofocus>
                               @endif
                            </div>
                        </div>
                       
                        @if (count($errors))
                        <div class="form-group">
                            <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>          
                        </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Potvrdi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ URL::route('users.index')}}"><button class='btn btn-primary'>Nazad</button></a>
        </div>
    </div>
</div>
@endsection


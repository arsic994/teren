@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Unesi novog vodica</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Ime i prezime:</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Telefon:</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-mail:</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Sifra:</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_admin" class="col-md-4 control-label">Admin:</label>
                            <div class="col-md-6">
                               <input id="is_admin" type="checkbox" class="form-control" name="is_admin" autofocus>
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
                                    Sačuvaj
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

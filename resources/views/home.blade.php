@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Programi</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3>Ovde ide provera da li je dodeljen na nekoj turi</h3>
                        <h3>Trenutno nemas dodeljene ture</h3>
                    </div>
                </div>
                <div>
                    <h3>Ovo je dugme koje samo admin vidi</h3>
                    <a href="{{ URL::route('trips.index')}}"><button class='btn btn-primary'>Upravljaj turama</button></a>
                    <a href="{{ URL::route('users.index')}}"><button class='btn btn-primary'>Vodici</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

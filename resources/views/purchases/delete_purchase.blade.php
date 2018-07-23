@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Da li ste sigurni da zelite da obrišete?</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="GET" action="destroy">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <br>
                                <button type="submit" class="btn btn-danger">
                                    Obriši
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
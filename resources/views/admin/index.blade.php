@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Администрација</div>
                <div class="panel-body">
                    <form class="form">
                        <button type="button" class="btn btn-primary btn-lg col-md-12" onclick="window.location='{{ url('/admin/topics') }}'" style="margin-bottom: 10px">Администрација квизова</button>
                        <hr>
                        <button type="button" class="btn btn-primary btn-lg col-md-12" onclick="window.location='{{ url('/admin/settings') }}'" style="margin-bottom: 10px">Администрација апликације</button>
                        <hr>
                        <button type="button" class="btn btn-primary btn-lg col-md-12" onclick="window.location='{{ url('/users') }}'" style="margin-bottom: 10px">Администрација корисника</button>
                        <hr>
                        <button type="button" class="btn btn-primary btn-lg col-md-12" onclick="window.location='{{ url('/source') }}'" style="margin-bottom: 10px">Администрација уноса извора</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default alert alert-warning ">
                <div >
                    <br><h3>404! Страница није пронађена!</h3><br><br>
                </div>
            </div>
            
            <div>
            	<button type="button" class="btn btn-primary" onclick="window.location='{{ url()->previous() }}'">Назад</button>
			</div>
        </div>
    </div>
</div>
@endsection

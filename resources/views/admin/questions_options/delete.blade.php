@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Да ли сте сигурни да желите да обришете?</h3></div>
                <form class="form-horizontal" method="GET" action="destroy">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <br>
                            <button type="submit" class="btn btn-danger">
                                Обриши
                            </button>
                            <a href="{{ URL::route('options.index', [$topic_id, $question_id])}}"><button class='btn btn-primary'>Назад</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
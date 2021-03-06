@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Унос питања</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="store">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Питање</label>
                            <div class="col-md-6">
                                <input id="question_text" type="text" class="form-control" name="question_text"> 
                            </div>
                        </div>
                        <input id="topic_id" type="hidden" name="topic_id" value="{{$topic_id}}">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Унеси питање
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <a href="{{ URL::route('questions.index', $topic_id)}}"><button class='btn btn-primary'>Назад</button></a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

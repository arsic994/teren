@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="panel-heading"><b>Питање:</b> {{$question->question_text}}</div>
                <hr>
                <div class="panel-heading"><b>Статистика питања:</b></div> 
                <div class="panel-heading">Тачно одговорено: {{$true}} </div>
                <div class="panel-heading">Нетачно одговорено: {{$false}} </div>
                <div class="panel-heading">Изостављен одговор: {{$notAnswered}} </div>
                </div>
            </div>
            <a href="{{ URL::route('questions.index', $topic_id)}}"><button class='btn btn-primary'>Назад</button></a>
            <a href="{{$question->id}}/edit_question"><button class='btn btn-primary'>Измени</button></a>
        </div>
    </div>
</div>
</div>
@endsection

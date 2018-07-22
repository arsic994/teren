@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Приказ унетих питања за квиз <b>{{$topic->title}}</b></h3></div>
                <div class="panel-body">
                    <ul>
                        @if (count($questions) > 0)
                            @foreach($questions as $question)
                            <div class="form-group">
                                <h3>{{$question->question['question_text']}}</h3>
                                <a href="questions/{{$question->question_id}}"><button class='btn btn-primary'>Погледај питање</button></a>
                                <a href="questions/{{$question->question_id}}/edit_question"><button class='btn btn-primary'>Измени</button></a>
                                <a href="questions/{{$question->question_id}}/delete_question"><button class='btn btn-danger'>Обриши</button></a>
                                <a href="questions/{{$question->question_id}}/options"><button class='btn btn-primary'>Додај одговоре</button></a>
                            </div>
                            @endforeach
                        @else
                            <h3>Не постоји ни једно питање</h3>
                        @endif
                    </ul>
                    <a href="questions/create_question"><button class='btn btn-primary'>Креирај ново питање</button></a>
                </div>
            </div>
            <button class='btn btn-primary' type="button" onclick="window.location='{{ url('admin/topics') }}'">Назад</button>
        </div>
    </div>
</div>
@endsection


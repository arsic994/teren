@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Понуђени одговори за питање:</h3><h3>{{$question->question_text}}</h3></div>
                <div class="panel-body">
                    @if ($max_one_correct == 0)
                        <h3 style="color: red">Питању није додељен тачан одговор!</h3>
                    @elseif ($max_one_correct == 2)
                        <h3 style="color: red">Питању је додељено више од једног тачног одговора!</h3>
                    @endif
                    @if (count($questions_options) > 0)
                    @foreach ($questions_options as $questions_option)
                    <div class="form-group">
                        <div class="col-md-6">
                            <h4>{{$questions_option->option}}</h4>
                        </div>
                        <div class="col-md-6">
                            <h5>Тачан: {{$questions_option->is_correct == 1 ? 'Да' : 'Не'}}</h5>
                        </div>
                        <div class="col-md-12">
                            <a href="options/{{$questions_option->id}}/edit"><button class='btn btn-primary'>Измени одговор</button></a>
                            <a href="options/{{$questions_option->id}}/delete"><button class='btn btn-danger'>Обриши одговор</button></a>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>Нема унетих одговора за ово питање</p>
                    @endif
                </div>
                <a href="options/create"><button type="button" class='btn btn-primary'>Додај нови одговор</button></a>
            </div>
            <a href="{{ URL::route('questions.index', $topic_id)}}"><button class='btn btn-primary'>Назад</button></a>
        </div>
    </div>  
</div>
@endsection

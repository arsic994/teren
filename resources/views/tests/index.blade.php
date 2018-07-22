@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
             <div class="panel-heading"><strong>Онлајн тестови</strong></div>
             <div class="panel-body">
                @if(count($topics) >0)
                    @foreach($topics as $topic)
                    <div>
                        <?php $test=0; ?>
                        @foreach($passed as $passed_topic)
                            @if ($passed_topic == $topic->id)
                                <?php $test=1; ?>
                            @endif
                        @endforeach
                        @if ($test == 1)
                            <h3 style="color: green">{{$topic->title}} - Квиз је положен</h3>
                            <hr>
                        @else
                            <h3>{{$topic->title}}</h3>
                            <form class="form-horizontal" method="get" action="{{ route('tests.create', $topic->id) }}">
                                <input type="hidden" name="id" value="{{$topic->id}}">
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-6">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#topic">Покрени</button>
                                    </div>
                                    <div class="modal fade" id="topic" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="topic"><strong>Трајање квиза: {{$quiz_duration}} minuta</strong></h4>   
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Назад</button>
                                                        <button type="submit" class="btn btn-primary">Покрени тест</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                <hr>
                        @endif
                    </div>
                    @endforeach
                    @if ($final)
                        @if ($passed_finals == 1)
                            <h3 style="color: green">Финални квиз је положен</h3>
                            <hr>
                        @else
                            <hr>
                            <h3>Финални квиз</h3>
                            <form class="form-horizontal" method="get" action="{{ route('tests.final') }}">
                                <input type="hidden" name="id" value="{{$topic->id}}">
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-6">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#topic">Покрени</button>
                                    </div>
                                    <div class="modal fade" id="topic" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="topic"><strong>Трајање финалног квиза: {{$quiz_duration}} minuta</strong></h4>   
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Назад</button>
                                                        <button type="submit" class="btn btn-primary">Покрени тест</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif

                    @endif
                @endif
                <a href="{{ route('results.index') }}" class="btn btn-default">Резултати полагања</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

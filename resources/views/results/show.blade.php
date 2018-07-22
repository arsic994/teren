@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="page-title">Резултати</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>{{ $test->created_at or '' }}</td>
                            <td>{{ $test->topic_id }}</td>
                            @if ($test->passed === NULL)
                                <td>Тест је прекинут</td>
                            @elseif ( $test->passed ==0)
                                <td>Неуспешан</td>
                            @else 
                                <td>Положен</td>
                            @endif
                        </tr>
                    </table>
                    <?php $i = 1 ?>
                    @foreach($results as $result)
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 10%">Питање #{{ $i }}</th>
                            <th>{{ $result->question->question_text or '' }}</th>
                        </tr>
                        <tr>
                            <td>Тачан одговор</td>
                            @if ($result->option_id == NULL)
                                  <td style="color: red;">Нисте дали одговор
                            @else
                                @if ($result->is_correct == 1)
                                    <td style="color: green;">Да
                                @else 
                                    <td style="color: red;">Не            
                                @endif
                            @endif
                        </td>
                    </tr>
                </table>
                <?php $i++ ?>
                @endforeach
                <p>&nbsp;</p>
                <a href="{{ route('tests.index') }}" class="btn btn-default">Покрени нови квиз</a>
                <a href="{{ route('results.index') }}" class="btn btn-default">Погледај све резултате</a>
            </div>
        </div>
    </div>
</div>
</div>
@stop

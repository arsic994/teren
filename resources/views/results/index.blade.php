@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3 class="page-title">Резултати</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped {{ count($results) > 0 ? 'datatable' : '' }}">
                        <tbody>
                            @if (count($results) > 0)
                            <tr>
                                <td>Датум полагања</td>
                                <td>Име квиза</td>
                                <td>Положен</td>
                                <td>Одговори</td>
                            </tr>
                            @foreach ($results as $result)
                            <tr>
                                @if(Auth::user())
                                <td>{{ $result->created_at or '' }}</td>
                                <td>
                                    @if ($result->topic['title'])
                                        {{ $result->topic['title'] }}
                                    @else
                                        Финални квиз
                                    @endif
                                </td>
                                @if ($result->passed === NULL)
                                    <td style="color: red">Тест је прекинут</td>
                                @elseif ($result->passed ==0)
                                    <td style="color: red">Неуспешан</td>
                                @else
                                    <td style="color: green">Положен</td>
                                @endif
                                <td>
                                    <a href="{{ route('results.show',[$result->id]) }}" class="btn btn-xs btn-primary">Одговори</a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6">Нисте полагали ни један тест!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <a href="{{ route('tests.index') }}" class="btn btn-default">Покрени нови квиз</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Унос новог одговора</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="store">
                        {{ csrf_field() }}                 
                        <div class="form-group{{ $errors->has('option') ? ' has-error' : '' }}">
                            <label for="option" class="col-md-4 control-label">Наслов</label>
                            <div class="col-md-6">
                                <input id="option" type="text" class="form-control" name="option" required autofocus>

                                @if ($errors->has('option'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('option') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('is_correct') ? ' has-error' : '' }}">
                            <label for="is_correct" class="col-md-4 control-label">Да ли је овај одговор тачан</label>
                            <div class="col-md-6">
                                <input id="is_correct" type="checkbox" class="form-control" name="is_correct" autofocus>

                                @if ($errors->has('is_correct'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('is_correct') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Сачувај
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{ URL::route('options.index', [$topic_id, $question_id])}}"><button class='btn btn-primary'>Назад</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

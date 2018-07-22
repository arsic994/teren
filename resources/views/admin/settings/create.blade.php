@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Унеси нови</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.settings.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('quiz_duration') ? ' has-error' : '' }}">
                            <label for="quiz_duration" class="col-md-4 control-label">Дужина квиза</label>
                            <div class="col-md-6">
                                <input id="quiz_duration" type="number" class="form-control" name="quiz_duration" required>
                                @if ($errors->has('quiz_duration'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quiz_duration') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('activation_timeout_minutes') ? ' has-error' : '' }}">
                            <label for="activation_timeout_minutes" class="col-md-4 control-label">Време-колико је линк активан</label>
                            <div class="col-md-6">
                                <input id="activation_timeout_minutes" type="number" class="form-control" name="activation_timeout_minutes" required>
                                @if ($errors->has('activation_timeout_minutes'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('activation_timeout_minutes') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('final_quiz_questions') ? ' has-error' : '' }}">
                            <label for="final_quiz_questions" class="col-md-4 control-label">Број питања по квизу</label>
                            <div class="col-md-6">
                                <input id="final_quiz_questions" type="number" class="form-control" name="final_quiz_questions" required>
                                @if ($errors->has('final_quiz_questions'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('final_quiz_questions') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('questions_per_page') ? ' has-error' : '' }}">
                            <label for="questions_per_page" class="col-md-4 control-label">Број питања по страни</label>
                            <div class="col-md-6">
                                <input id="questions_per_page" type="number" class="form-control" name="questions_per_page" required>
                                @if ($errors->has('questions_per_page'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('questions_per_page') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('final_quiz_max_negative') ? ' has-error' : '' }}">
                            <label for="final_quiz_max_negative" class="col-md-4 control-label">Финални квиз - дозвољен број погрешних одговора</label>
                            <div class="col-md-6">
                                <input id="final_quiz_max_negative" type="number" class="form-control" name="final_quiz_max_negative" required>
                                @if ($errors->has('final_quiz_max_negative'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('final_quiz_max_negative') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="btn-group col-sm-6 col-md-offset-4 ">
                            <button type="submit" class="btn btn-primary">Унеси</button>
                            <button type="button" class="btn btn-primary" onclick="window.location='{{ url('/admin/settings') }}'">Назад</button>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>
</div>
@endsection

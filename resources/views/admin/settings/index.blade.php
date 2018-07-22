@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Листа подешаваања</h3></div>
				@if($settings)
				<form class="form-horizontal" method="POST">
					{{ csrf_field() }}
					<div class="form-group{{ $errors->has('quiz_duration') ? ' has-error' : '' }}">
						<label for="quiz_duration" class="col-md-4 control-label">Дужина квиза</label>
						<div class="col-md-6">
							<p>{{Setting::get('quiz_duration', 10)}}</p>
						</div>
					</div>
					<div class="form-group{{ $errors->has('activation_timeout_minutes') ? ' has-error' : '' }}">
						<label for="activation_timeout_minutes" class="col-md-4 control-label">Време-колико је линк активан</label>
						<div class="col-md-6">
							<p>{{Setting::get('activation_timeout_minutes', 20)}}</p>
						</div>
					</div>
					<div class="form-group{{ $errors->has('final_quiz_questions') ? ' has-error' : '' }}">
						<label for="final_quiz_questions" class="col-md-4 control-label">Број питања по квизу</label>
						<div class="col-md-6">
							<p>{{Setting::get('final_quiz_questions', 10)}}</p>
						</div>
					</div>
					<div class="form-group{{ $errors->has('questions_per_page') ? ' has-error' : '' }}">
						<label for="questions_per_page" class="col-md-4 control-label">Број питања по страни</label>
						<div class="col-md-6">
							<p>{{Setting::get('questions_per_page', 10)}}</p>
						</div>
					</div>
					<div class="form-group{{ $errors->has('final_quiz_max_negative') ? ' has-error' : '' }}">
						<label for="final_quiz_max_negative" class="col-md-4 control-label">Финални квиз - дозвољен број погрешних одговора</label>
						<div class="col-md-6">
							<p>{{Setting::get('final_quiz_max_negative', 10)}}</p>
						</div>
					</div>
					<div class="btn-group col-sm-6 col-md-offset-4 ">
						<button type="button" class="btn btn-primary" onclick="window.location='{{ url('admin/settings/edit') }}'">Измени</button>
					</div>
				</form>
				@else
				<button class='btn btn-primary' style="margin-top: 50px" type="button" onclick="window.location='{{ url('admin/settings/create') }}'">Креирај нови</button>
				@endif	
			</div>
			<button class='btn btn-primary' type="button" onclick="window.location='{{ url('admin/') }}'">Назад</button>
		</div>
	</div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<p>
				<a href="{{ url('trips/create') }}"><button class='btn btn-primary'>Napravi novu turu</button></a>
			</p>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Lista Aktivnih Putovanja</h3>
				</div>
				<div class="panel-body"> 
					@if(count($trips) >0)
						@foreach($trips as $trip)
							@if($trip->active >0)
							<div>
								<h3>{{$trip->title}}</h3>
								<a href="/trips/{{$trip->id}}"><button class='btn btn-primary'>Pogledaj putovanje</button></a>
								<a href="/trips/{{$trip->id}}/edit"><button class='btn btn-primary'>Izmeni putovanje</button></a>
								<a href="/trips/{{$trip->id}}/delete"><button class='btn btn-danger'>Obriši putovanje</button></a>
							</div>
							@endif
						@endforeach
					@endif
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading"><h3>Lista Neaktivnih Putovanja</h3>
				</div>
				<div class="panel-body"> 
					@if(count($trips) > 0)
						@foreach($trips as $trip)
							@if($trip->active == 0)
							<div>
								<h3>{{$trip->title}}</h3>
								<a href="/trips/{{$trip->id}}"><button class='btn btn-primary'>Pogledaj putovanje</button></a>
								<a href="/trips/{{$trip->id}}/edit"><button class='btn btn-primary'>Izmeni putovanje</button></a>
								<a href="/trips/{{$trip->id}}/delete"><button class='btn btn-danger'>Obriši putovanje</button></a>
							</div>
							@endif
						@endforeach
					@endif
				</div>
			</div>
			<a href="{{ URL::route('home')}}"><button class='btn btn-primary'>Nazad</button></a>		
		</div>
	</div>
</div>
@endsection

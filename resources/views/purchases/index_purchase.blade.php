@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Prodaja fakultativa za</h3>
				</div>
				{{--<p>
					<a href="{{ URL::route('purchases.create', $purchase->trip_id)}}"><button class='btn btn-primary'>Nova kupovina</button></a>
				</p>--}}
				<div class="panel-body"> 
					@if(count($purchases) >0)
						@foreach($purchases as $purchase)
							<div>
								<h3>{{$purchase->name}} - {{$purchase->hotel_id}} - {{$purchase->price}}</h3>
								<a href="purchase/{{$purchase->id}}"><button class='btn btn-primary'>Pogledaj kupovinu</button></a>
								<a href="purchase/{{$purchase->id}}/edit"><button class='btn btn-primary'>Izmeni kupovinu</button></a>
								{{--<a href="/trips/{{$trip->id}}/purchase/{{$purchase->id}}/delete"><button class='btn btn-danger'>Obriši kupovinu</button></a>--}}
								<a href="purchase/{{$purchase->id}}/delete"><button class='btn btn-danger'>Obriši kupovinu</button></a>
							</div>
						@endforeach
					@endif
				</div>
			</div>

			{{--<a href="{{ URL::route('purchases.index', $purchase->trip_id)}}"><button class='btn btn-primary'>Nazad</button></a>	--}}	
		</div>
	</div>
</div>
@endsection

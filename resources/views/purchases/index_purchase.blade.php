@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Prodaja fakultativa za {{$trip->title}}</h3>
				</div>
				
				<div class="panel-body"> 
					<p>
							<a href="{{ URL::route('purchases.create', $trip->id)}}"><button class='btn btn-primary'>Nova kupovina</button></a>
					</p>
				</div>

				<div class="panel-heading">
					<h3>Odradjene kupovine</h3>
				</div>
				
				<div class="panel-body"> 
					
					@if(count($purchases) >0)
					<table class="table table-bordered">
						<tr>
							<th>ID</th>
							<th>Ime i preime</th>
							<th>Hotel</th> 
							<th>Bus</th>
							{{--<th>Kupljeno</th>--}}
							<th>Cena</th>
							<th>Placeno</th>
							<th></th>
						</tr>
						@foreach($purchases as $purchase)
						<tr>
							<th>{{$purchase->id}}</th>
							<th>{{$purchase->name}}</th>
							<th>{{$purchase->hotel_id}} - ime da se doda</th>
							<th>{{$purchase->bus_id}} - ime da se doda</th>
							{{--<th>Pak: {{$purchase->bought_packages}} | Izl: {{$purchase->bought_excursions}}</th>--}}
							<th>{{$purchase->price}}</th>
							@if( $purchase->paid == true)
								<th style="background-color: green; color: white;">DA</th>
							@else
								<th style="background-color: red; color: white;">NE</th>
							@endif
							<th>
								<a href="purchase/{{$purchase->id}}/edit"><button class='btn btn-primary'>Izmeni kupovinu</button></a>
								<a href="purchase/{{$purchase->id}}/show"><button class='btn btn-primary'>Pogledaj/potvrdi kupovinu</button></a>
								<a href="purchase/{{$purchase->id}}/delete"><button class='btn btn-danger'>Obriši kupovinu</button></a>
								
							</th>
						</tr>
						@endforeach
					</table>
					@else
							<h3>Nema kupovina za ovu turu.</h3>
					@endif
				
				</div>
			</div>	
		</div>
	</div>
</div>
@endsection

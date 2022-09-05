@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h3>Saya mencari {{ $data[0]->title }}</h3>
			<p>{{ $data[0]->name.', '.$data[0]->address }}</p>
		</div>
	</div>
	<hr>
	<p>{{ $data[0]->description }}</p>
	<p><strong>Berat yang dibutuhkan : {{ $data[0]->weight }} kg</strong></p>
	<hr>
	<h4>Ajukan penawaran</h4>
	<p>Pilih persediaan dibawah untuk mengirimkan penawaran</p>

	@foreach($stocks as $stock)
	<div class="card mb-3 d-inline-block" style="width: 24rem">
		<img src="{{ asset('storage/img/product/'.$stock->img) }}" class="card-img-top img-thumbnail" style="width: 100%; height: 230px; overflow: hidden;">
		<div class="card-body">
			<h5 class="card-title">{{ $stock->stock }} - Nelayan {{ $stock->fisher_name }}</h5>

			<p class="card-text">Total persediaan (kg) : {{ $stock->total_stock }} kg</p>

			<p class="card-text">Harga /kg : Rp {{ $stock->price }}</p>

			<p class="card-text">Tanggal penangkapan : {{ $stock->date }}</p>

			<hr>
			<a class="btn btn-primary @if($data[0]->weight > $stock->total_stock) disabled @endif" onclick="event.preventDefault(); document.getElementById('submit-offer-{{ $stock->stock_id }}').submit()">Pilih persediaan</a>
			<form style="display: none;" action="{{ route('offer.store') }}" method="POST" id="submit-offer-{{ $stock->stock_id }}">
				@csrf
				<input type="text" name="stock_id" value="{{ $stock->stock_id }}">
				<input type="text" name="order_id" value="{{ $data[0]->order_id }}">
			</form>
		</div>
	</div>
	@endforeach
</div>

@endsection
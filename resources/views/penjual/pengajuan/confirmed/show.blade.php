@extends('layouts.app')

@section('tawaran-active', 'active')

@section('content')

<div class="container">
	<h3>{{ $offers[0]->name }} mencari {{ $offers[0]->title }}</h3>
	<hr>
	<div class="mt-3">
		<p><b>Berat yang dibutuhkan : {{ $offers[0]->weight }} kg</b></p>
		<p>Deskripsi pesanan : {{ $offers[0]->description }}</p>
		<p>Penawaran anda : {{ $offers[0]->stock }}, Rp {{ $offers[0]->price }}/kg</p>
		@if($offers[0]->confirmed_payment == 'no' )
		<p>Status pembayaran : <b>BELUM BAYAR</b></p>
		@else
		<p>Total harga : Rp {{ $offers[0]->total_price }}</p>
		<p>Status pembayaran : <b>SUDAH BAYAR</b>, <a href="{{ asset('storage/img/payment/'.$offers[0]->bill) }}">Cek bukti pembayaran</a></p>
		@endif
		<hr>
		<p>Alamat pengiriman : {{ $offers[0]->name }}, {{ $offers[0]->owner }}, {{ $offers[0]->address }}</p>

		@if($offers[0]->confirmed_payment == 'yes')
		<hr>
		<p>Feedback : </p>
		<ul>
			@foreach($feedback as $fdb)
			<li>{{ $fdb->feedback }}</li>
			@endforeach
		</ul>
		@endif
	</div>
</div>

@endsection
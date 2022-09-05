@extends('layouts.app')

@section('tawaran-active', 'active')

@section('content')

<div class="container">
	<h3>Penawaran anda</h3>
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Permintaan</th>
	      <th scope="col">Berat permintaan</th>
	      <th scope="col">Penawaran anda</th>
	      <th scope="col">Nelayan</th>
	      <th scope="col">Status pembayaran</th>
	      <th scope="col">Aksi</th>
	    </tr>
	  </thead>
	  <tbody>
	@foreach($offers as $offer)
	    <tr>
			<td>{{ $offer->name }} mencari {{ $offer->title }}</td>
			<td>{{ $offer->weight }} kg</td>
			<td>{{ $offer->stock }} ({{ $offer->total_stock }} kg), Rp {{ $offer->price }}/kg</td>
			<td>{{ $offer->fisher_name }}</td>
			<td>
				@if($offer->confirmed_payment == 'yes')
				<b>SUDAH DIBAYAR</b>
				@else
				<b>BELUM DIBAYAR</b>
				@endif
			</td>
			<td>
				<span href="" class="badge rounded-pill bg-success" style="text-decoration: none; cursor: pointer;" onclick="event.preventDefault(); document.getElementById('show-{{ $offer->offer_id }}').submit()">Detail</span>
				<form action="{{ route('confirmed_offer.show', $offer->offer_id) }}" method="POST" id="show-{{ $offer->offer_id }}">
					@csrf
					@method('get')
					<input type="hidden" name="payment" value="{{ $offer->confirmed_payment }}">
				</form>
			</td>
	    </tr>
	@endforeach
	  </tbody>
	</table>
</div>

@endsection
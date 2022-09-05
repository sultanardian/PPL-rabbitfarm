@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h3>Saya mencari {{ $order['title'] }}</h3>
		</div>
		<div class="col text-right">
			<a href="{{ route('order.edit', $order['id']) }}" style="text-decoration: none;">
				<i class="far fa-edit mx-1" style="color: green"></i>
			</a>
		</div>
	</div>
	<hr>
	<p>{{ $order['description'] }}</p>
	<p><strong>Berat yang dibutuhkan : {{ $order['weight'] }} kg</strong></p>
	<hr>
	<h4>Respon penjual / penyedia</h4>
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Jenis penawaran</th>
	      <th scope="col">Berat tersedia</th>
	      <th scope="col">Harga yang ditawarkan</th>
	      <th scope="col">Tanggal penangkapan</th>
	      <th scope="col">Status</th>
	      <th scope="col">Aksi</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	    	@foreach($offers as $offer)
			<td>
				<p>
					<a href="{{ asset('storage/img/product/'.$offer->img) }}" style="text-decoration: none;">
						<img src="{{ asset('storage/img/product/'.$offer->img) }}" class="img-thumbnail" style="width: 50px; height: 50px">
					</a>
					{{ $offer->stock }}
				</p>

			</td>
			<td>{{ $offer->total_stock }} kg</td>
			<td>{{ $offer->price }} /kg</td>
			<td>{{ $offer->date }}</td>
			<td>
				@if($payments)
					<span class="badge rounded-pill bg-success">Sudah bayar</span>
				@else
					@if( $offer->total_stock > ($order['weight'] + 5) )
						<span class="badge rounded-pill bg-success">Tersedia</span>

					@elseif( $order['weight'] <= $offer->total_stock and $offer->total_stock <= ($order['weight'] + 5) )
						<span class="badge rounded-pill bg-warning">Hampir habis</span>

					@else
						<span class="badge rounded-pill bg-danger">Habis / Diluar permintaan</span>
					@endif
				@endif
			</td>

			@if($payments)
			<td>
				@if($offer->confirmed_payment == 'yes')
				<a href="" data-bs-toggle="modal" data-bs-target="#feedback">
				  Tambahkan feedback
				</a>

				<!-- Modal -->
				<div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="feedbackLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="feedbackLabel">Feedback</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
				      <div class="modal-body">
				        <form action="{{ route('feedback.store') }}" method="POST">
				        	@csrf
							<div class="mb-3">
								<label for="feedback" class="form-label">Beri kami penilaian</label>
								<textarea class="form-control" name="feedback" id="feedback" rows="3" required></textarea>
							</div>

				        	<div class="mb-3">
								<input type="hidden" class="form-control" name="offer_id" value="{{ $offer->offer_id }}">
							</div>

							<button type="Submit" class="btn btn-success">Submit</button>
				        </form>

				      </div>
				    </div>
				  </div>
				</div>
				@endif
			</td>
			@else
			<td>
				
				<!-- Button trigger modal -->
				<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
				  Bayar sekarang
				</a>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Detail pembayaran dan pengiriman</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
				      <div class="modal-body">
				      	<p>Total harga : Rp {{ $offer->price * $order['weight'] }}</p>
				      	<p>Silakan transfer ke nomor rekening : <b>{{ $admin_profile[0]->bank }} {{ $admin_profile[0]->bank_account }} an SeaFood.co</b></p>
				      	<p>Dikirim dari : {{ $admin_profile[0]->address }}</p>
					    <p>Ke : {{ $buyer_profile[0]->address }}</p>

				        <form enctype="multipart/form-data" action="{{ route('payment.store') }}" method="POST">
				        	@csrf
				        	<div class="mb-3">
								<input type="hidden" class="form-control" name="offer_id" value="{{ $offer->offer_id }}">
							</div>

				        	<div class="mb-3">
								<input type="hidden" class="form-control" name="total_price" value="{{ $offer->price * $order['weight'] }}">
							</div>

							<div class="mb-3">
								<input type="hidden" class="form-control" name="weight" value="{{ $order['weight'] }}">
							</div>

							<div class="mb-3">
								<label for="formFile" class="form-label">Upload bukti pembayaran</label>
								<input class="form-control" name="bill" type="file" id="formFile" required>
							</div>

							<input type="hidden" name="offer_id" value="{{ $offers[0]->offer_id }}">

							<input type="hidden" name="stock_id" value="{{ $offers[0]->stock_id }}">
							
							<button type="Submit" class="btn btn-success">Submit</button>
				        </form>

				      </div>
				    </div>
				  </div>
				</div>
				
			</td>
			@endif
			@endforeach
	    </tr>
	  </tbody>
	</table>
</div>

@endsection
@extends('layouts.app')

@section('pesanan-active', 'active')

@section('content')
<div class="container">
	<h3>Ajukan permintaan</h3>
	<hr>
	@if(!$profile)
	<p>Silakan lengkapi profil terlebih dahulu, <a href="{{ route('buyer_profile.index') }}">klik disini</a></p>
	@else
	<form action="{{ route('order.store') }}" method="POST">
		@csrf
		<div class="row mb-3">
			<label for="name" class="col-sm-3 form-label">Nama Perusahaan</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" disabled>
			</div>
		</div>

		<div class="row mb-3">
			<label for="title" class="col-sm-3 form-label">Judul permintaan</label>
			<div class="col-sm-9">
				<div class="input-group mb-3">
					<span class="input-group-text" id="title">Saya mencari</span>
					<input type="text" name="title" class="form-control" placeholder="ex: ikan tuna segar 10 kg" aria-describedby="title" autocomplete="off" required autofocus>
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<label for="description" class="col-sm-3 form-label">Deskripsi permintaan</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="description" placeholder="Deskripsi permintaan disini" id="description" rows="3" required></textarea>
			</div>
		</div>

		<div class="row mb-3">
			<label for="weight" class="col-sm-3 form-label">Berat yang dibutuhkan <i class="far fa-exclamation-circle"  data-toggle="tooltip" data-placement="right" title="Berat minimal permintaan adalah 1 kg."></i></label>
			<div class="col-sm-2">
				<div class="input-group mb-3">
					<input type="number" name="weight" min="1" class="form-control"aria-describedby="weight" autocomplete="off" required>
					<span class="input-group-text" id="weight">kg</span>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Tambah permintaan</button>
	</form>
	@endif
</div>
@endsection
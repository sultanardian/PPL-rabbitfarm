@extends('layouts.app')

@section('content')
<div class="container">
	<form action="{{ route('order.update', $order['id']) }}" method="POST">
		@csrf
		@method('put')
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
					<input type="text" name="title" class="form-control" placeholder="ex: ikan tuna segar 10 kg" value="{{ $order['title'] }}" aria-describedby="title" autocomplete="off" autofocus>
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<label for="description" class="col-sm-3 form-label">Deskripsi permintaan</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="description" placeholder="Deskripsi permintaan disini" id="description" rows="3">{{ $order['description'] }}</textarea>
			</div>
		</div>

		<div class="row mb-3">
			<label for="weight" class="col-sm-3 form-label">Berat yang dibutuhkan <i class="far fa-exclamation-circle"  data-toggle="tooltip" data-placement="right" title="Berat minimal permintaan adalah 1 kg."></i></label>
			<div class="col-sm-2">
				<div class="input-group mb-3">
					<input type="number" name="weight" min="1" class="form-control" value="{{ $order['weight'] }}" aria-describedby="weight" autocomplete="off">
					<span class="input-group-text" id="weight">kg</span>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Ubah permintaan</button>
	</form>
</div>
@endsection
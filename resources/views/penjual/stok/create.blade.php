@extends('layouts.app')

@section('stok-active', 'active')
@section('content')
<div class="container">
	<form action="{{ route('stock.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row mb-3">
			<label for="stock" class="col-sm-3 form-label">Nama Persediaan</label>
			<div class="col-sm-9">
				<input type="text" name="stock" class="form-control" placeholder="ex: Ikan tuna" aria-describedby="stock" autocomplete="off" required autofocus>
			</div>
		</div>

		<div class="row mb-3">
			<label for="total_stock" class="col-sm-3 form-label">Berat persediaan <i class="far fa-exclamation-circle"  data-toggle="tooltip" data-placement="right" title="Berat minimal persediaan adalah 1 kg."></i></label>
			<div class="col-sm-3">
				<div class="input-group mb-3">
					<input type="number" name="total_stock" min="1" class="form-control"aria-describedby="total_stock" autocomplete="off" required>
					<span class="input-group-text" id="total_stock">kg</span>
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<label for="price" class="col-sm-3 form-label">Harga persediaan per kg <i class="far fa-exclamation-circle"  data-toggle="tooltip" data-placement="right" title="Harga persediaan adalah untuk per kilogramnya. Harga ini akan menjadi pertimbangan pihak pembeli"></i></label>
			<div class="col-sm-3">
				<div class="input-group mb-3">
					<span class="input-group-text" id="price">Rp</span>
					<input type="number" name="price" min="1000" class="form-control"aria-describedby="price" autocomplete="off" required>
					<span class="input-group-text" id="price">/kg</span>
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<label for="date" class="col-sm-3 form-label">Tanggal penangkapan <i class="far fa-exclamation-circle"  data-toggle="tooltip" data-placement="right" title="Tanggal penangkapan disini adalah tanggal dimana persediaan dipanen/ditangkap"></i></label>
			<div class="col-sm-2">
				<input type="date" name="date" class="form-control"aria-describedby="date" autocomplete="off" required>
			</div>
		</div>

		<div class="row mb-3">
			<label for="fisher" class="col-sm-3 form-label">Nelayan <i class="far fa-exclamation-circle"  data-toggle="tooltip" data-placement="right" title="Silakan pilih nama nelayan yang telah terdaftar. Apabila tidak ada yang sesuai, silakan daftar nelayan terlebih dahulu."></i></label>
			<div class="col-sm-2">
				<select class="form-select" aria-label="Default select example" name="fisher_id" required>
					@foreach($fishers as $fisher)
						<option value="{{ $fisher->id }}">{{ $fisher->fisher_name }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="row mb-3">
			<label for="image" class="col-sm-3 form-label">Foto produk</label>
			<div class="col-sm-4">
				<input type="file" name="image" class="form-control" aria-describedby="image" accept=".jpg, .jpeg, .png" >
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Tambah persediaan</button>
	</form>
</div>
@endsection
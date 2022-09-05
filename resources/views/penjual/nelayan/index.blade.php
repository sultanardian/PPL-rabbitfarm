@extends('layouts.app')

@section('content')
<div class="container">
	<h3>Daftar nelayan</h3>
	<button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#addFisher">Tambah data nelayan</button>

	<div class="modal fade" id="addFisher" tabindex="-1" aria-labelledby="addFisherLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="addFisherLabel">Tambah data nelayan</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <form action="{{ route('fisher.store') }}" method="POST">
	        	@csrf
	        	<div class="mb-3">
				  <label for="fisher_name" class="form-label">Nama nelayan</label>
				  <input type="text" name="fisher_name" class="form-control" id="fisher_name" required autocomplete="off">
				</div>
				<div class="mb-3">
				  <label for="fisher_address" class="form-label">Alamat nelayan</label>
				  <input type="text" name="fisher_address" class="form-control" id="fisher_address" required autocomplete="off">
				</div>
				<button type="submit" class="btn btn-success">Submit</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<table class="table mt-3">
		<thead class="table-dark">
			<tr>
				<th class="border" scope="col" width="250">Nama nelayan</th>
				<th class="border" scope="col">Alamat</th>
				<th class="border text-center" scope="col" width="180">Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($fishers as $fisher)
			<tr>
				<td class="border">{{ $fisher->fisher_name }}</td>
				<td class="border">{{ $fisher->fisher_address }}</td>
				<td class="border text-center">
					<span class="badge bg-success"  data-bs-toggle="modal" data-bs-target="#checkFisher{{ $fisher->id }}" style="cursor: pointer;">Cek</span>
					<div class="modal fade" id="checkFisher{{ $fisher->id }}" tabindex="-1" aria-labelledby="checkFisher{{ $fisher->id }}Label" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">

					      <!-- CEK DATA NELAYAN -->
					      <div class="modal-header">
					        <h5 class="modal-title" id="checkFisher{{ $fisher->id }}Label">Cek data nelayan</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					      	<div class="accordion" id="accordionExample">
							  <div class="accordion-item">
							    <h2 class="accordion-header" id="headingOne">
							      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							        Cek stok nelayan {{ $fisher->fisher_name }}
							      </button>
							    </h2>
							    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
							      <div class="accordion-body">
							        <table class="table mt-3">
										<thead class="table-dark">
											<tr>
												<th class="border" scope="col" width="250">Stok</th>
												<th class="border" scope="col">Stok tersedia</th>
											</tr>
										</thead>
										<tbody>
											@foreach($stocks as $stock)
											@if($stock->id == $fisher->id)
											<tr>
												<td class="text-left">{{ $stock->stock }}</td>
												<td>{{ $stock->total_stock }} kg</td>
											</tr>
											@endif
											@endforeach
										</tbody>
									</table>
							      </div>
							    </div>
							  </div>
							</div>
					      </div>
					    </div>
					  </div>
					</div>

					<span class="badge bg-warning"  data-bs-toggle="modal" data-bs-target="#editFisher" style="cursor: pointer;">Ubah</span>
					<div class="modal fade" id="editFisher" tabindex="-1" aria-labelledby="editFisherLabel" aria-hidden="true">
					  <div class="modal-dialog text-left">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="checkFisherLabel">Ubah data nelayan</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					        <form action="{{ route('fisher.update', $fisher->id) }}" method="POST">
					        	@csrf
					        	@method('put')
					        	<div class="mb-3">
								  <label for="fisher_name" class="form-label">Nama nelayan</label>
								  <input type="text" name="fisher_name" class="form-control" id="fisher_name" value="{{ $fisher->fisher_name }}" required autocomplete="off">
								</div>
								<div class="mb-3">
								  <label for="fisher_address" class="form-label">Alamat nelayan</label>
								  <input type="text" name="fisher_address" class="form-control" id="fisher_address" value="{{ $fisher->fisher_address }}" required autocomplete="off">
								</div>
								<button type="submit" class="btn btn-success">Submit</button>
					        </form>
					      </div>
					    </div>
					  </div>
					</div>

					<span class="badge bg-danger" onclick="event.preventDefault(); document.getElementById('delete-{{ $fisher->id }}').submit()" style="cursor: pointer;">Hapus</span>
					<form action="{{ route('fisher.destroy', $fisher->id) }}" method="POST" id="delete-{{ $fisher->id }}" hidden>
						@csrf
						@method('delete')
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</div>
@endsection
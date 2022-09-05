@extends('layouts.app')

@section('content')

<div class="container">
	<h3>Permintaan anda</h3>
	<hr>
	@foreach($datas as $data)
	<div class="card mb-3">
		<div class="card-body">
			<h5 class="card-title">Saya mencari {{ $data->title }}</h5>
			<p class="card-text">{{ $data->description }}</p>
			<hr>
			<p>{{ Auth::user()->name }}</p>
			<a href="{{ route('order.show', $data->id) }}" class="btn btn-primary">Lihat permintaan ini</a>
		</div>
	</div>
	@endforeach
</div>

@endsection
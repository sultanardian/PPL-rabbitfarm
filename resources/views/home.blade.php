@extends('layouts.app')

@section('beranda-active', 'active')

@section('content')

	@guest
		
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="flex-fill">
						<img class="img-thumbnail" src="{{ URL::asset('img/src/seafood1.jpg') }}">
					</div>
				</div>
				<div class="col">
					<h3>BEST SUPPLIER FOR YOUR SEAFOOD</h3>
					<p><b>SeaFood.co</b> adalah suplier berbagai macam kebutuhan seafood untuk usaha anda. Kami menyediakan ikan laut, tambak, udang, kerang, cumi cumi, dan masih banyak hasil akuakultur kami. Didapatkan langsung dari banyak nelayan dan dijamin kesegarannya.</p>
				</div>
			</div>
		</div>

	@else
		@if(Auth::user()->vendor == 1)
			@include('pembeli.index')
		@elseif(Auth::user()->vendor == 2)
			@include('penjual.index')
		@endif
	@endguest

@endsection

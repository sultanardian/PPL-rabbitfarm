@extends('layouts.app')

@section('register-active', 'active')

@section('content')

<!-- Register Form -->
<div class="container mb-3" id="register">
  <div class="mx-auto" id="form-signin">
    <form class="form-signin mb-3" action="{{ route('register') }}" method="POST">
        @csrf
        <h1 class="text-center h3 mb-5 font-weight-normal">Silakan mendaftar</h1>

        <input type="text" id="name" class="form-control mt-4 @error('name') is-invalid @enderror" name="name" placeholder="Nama perusahaan, restoran atau usaha lainnya"  autocomplete="off" autofocus>
        @error('name')
          <span class="invalid-feedback" role="alert">
              {{ $message }}
          </span>
        @enderror

        <input type="email" id="email" class="form-control mt-4 @error('email') is-invalid @enderror" name="email" placeholder="Alamat email"  autocomplete="off" autofocus>
        @error('email')
          <span class="invalid-feedback" role="alert">
              {{ $message }}
          </span>
        @enderror

        <input type="password" id="password" class="form-control mt-4 @error('password') is-invalid @enderror" name="password" placeholder="Password"  autocomplete="off">
        @error('password')
          <span class="invalid-feedback" role="alert">
              {{ $message }}
          </span>
        @enderror

        <input id="password-confirm" type="password" class="form-control mt-4" placeholder="Konfirmasi password" name="password_confirmation"  autocomplete="off">

        <div class="d-grid gap-2">
            <button class="btn btn-primary mt-4" type="submit">Daftar</button>
        </div>
    </form>
  </div> 
</div>
@endsection

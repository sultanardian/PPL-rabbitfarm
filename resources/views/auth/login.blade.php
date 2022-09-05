@extends('layouts.app')

@section('login-active', 'active')

@section('content')

<!-- Login Form -->
<div class="container mb-5" id="login">
  <div class="row">
    <div class="col">
      <div class="flex-fill">
        <img src="/img/logo01.png" class="mb-3">
      </div>
    </div>
    <div class="col">
      <div class="text-center mx-auto" id="form-login">
        
        <form class="form-signin mb-3" action="{{ route('login') }}" method="POST">
          @csrf

          <input type="email" id="email" class="form-control mt-5 @error('email') is-invalid @enderror" name="email" placeholder="Alamat email" autocomplete="off" autofocus >
          @error('email')
              <span class="invalid-feedback mb-1 text-left" role="alert">
                  {{ $message }}
              </span>
          @enderror

          <input type="password" id="password" class="form-control mt-5 @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="off">
          @error('password')
              <span class="invalid-feedback mb-1 text-left" role="alert">
                  {{ $message }}
              </span>
          @enderror

          <div class="d-grid gap-2">
            <button class="btn btn-primary mt-5" type="submit">Masuk</button>
          </div>
        </form>

        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
      </div>       
    </div>
  </div>
</div>
@endsection

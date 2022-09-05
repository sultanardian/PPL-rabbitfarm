@extends('layouts.app')

@section('profil-active', 'active')

@section('content')

<div class="container">
  <h3>Profil</h3>
  <hr>
  <div class="mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ubahProfil">
      Ubah profil
    </button>

    <!-- Modal -->
    <div class="modal fade" id="ubahProfil" tabindex="-1" aria-labelledby="ubahProfilLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ubahProfilLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form action="@if(empty($profile[0])) {{ route('admin_profile.store') }} @else {{ route('admin_profile.update', $profile[0]->id) }} @endif" method="POST">
              @csrf
              @if(!empty($profile[0]))
              @method('put')
              @endif
              <div class="mb-3">
                <label for="name" class="form-label">Nama usaha</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}" required autocomplete="off">
              </div>

              <div class="mb-3">
                <label for="year" class="form-label">Tahun berdiri</label>
                <input type="number" name="year" class="form-control" id="year" @if(!empty($profile[0])) value="{{ $profile[0]->year }}" @endif required autocomplete="off">
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Deskripsi usaha</label>
                <textarea class="form-control" name="description" id="description" rows="3" required>@if(!empty($profile[0])) {{ $profile[0]->description }} @endif</textarea>
              </div>

              <div class="mb-3">
                <label for="address" class="form-label">Alamat lengkap</label>
                <textarea class="form-control" name="address" id="address" rows="3" required>@if(!empty($profile[0])) {{ $profile[0]->address }} @endif</textarea>
              </div>

              <div class="mb-3">
                <label for="bank" class="form-label">Nama Bank</label>
                <input type="text" name="bank" class="form-control" id="bank" @if(!empty($profile[0])) value="{{ $profile[0]->bank }}" @endif required autocomplete="off">
              </div>

              <div class="mb-3">
                <label for="bank_account" class="form-label">Nomor rekening</label>
                <input type="text" name="bank_account" class="form-control" id="bank_account" @if(!empty($profile[0])) value="{{ $profile[0]->bank_account }}" @endif required autocomplete="off">
              </div>

              <button class="btn btn-primary" type="submit">Submit</button>

            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-3">
      <p>Nama usaha : {{ Auth::user()->name }}</p>
      <p>Tahun berdiri : @if(!empty($profile[0])) {{ $profile[0]->year }} @endif</p>
      <p>Deskripsi usaha : @if(!empty($profile[0])) {{ $profile[0]->description }} @endif</p>
      <p>Alamat : @if(!empty($profile[0])) {{ $profile[0]->address }} @endif</p>
      <p>Bank : @if(!empty($profile[0])) {{ $profile[0]->bank }} @endif</p>
      <p>Nomor rekening : @if(!empty($profile[0])) {{ $profile[0]->bank_account }} @endif</p>
    </div>
  </div>
</div>

@endsection
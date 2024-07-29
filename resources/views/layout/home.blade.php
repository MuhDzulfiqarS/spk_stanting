@extends('layout.main')

@section('judul')
{{ $user->name }}
@endsection

@section('isi')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Hello, {{ $user->name }}</h3>
  </div>
  <div class="card-body">
    <div class="alert alert-success">
      Selamat Datang di Sistem Pendukung Keputusan Penentuan Stunting di Puskesmas Togo-Togo Kecamatan Batang Kabupaten Jeneponto
    </div>
  </div>
</div>

@endsection

      

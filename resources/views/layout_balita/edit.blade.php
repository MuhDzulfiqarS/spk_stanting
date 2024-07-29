@extends('layout.main')

@section('judul')
Alternatif
@endsection

@section('subjudul')
Form Edit Data Alternatif
@endsection

@section('isi')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Data Alternatif</h5>
            <form action="/balita/{{$balita->id}}" method="POST">
            @csrf
            @method('put')
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$balita->nama_balita}}" name="nama_balita"> 
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" value="{{$balita->jenis_kelamin}}" name="jenis_kelamin">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki" @if ($balita->jenis_kelamin == "Laki-Laki") selected @endif>Laki-Laki</option>
                    <option value="Perempuan"@if ($balita->jenis_kelamin == "Perempuan") selected @endif>Perempuan</option>
                </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$balita->tempat_lahir}}" name="tempat_lahir">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" value="{{$balita->tanggal_lahir}}" name="tanggal_lahir">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$balita->nama_orangtua}}" name="nama_orangtua">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                    <button type="submit" name="submit" value="Update" class="btn btn-primary">Update</button>
                </div>
            </div>

            </form>

        </div>
    </div>

</section>
@endsection
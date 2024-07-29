@extends('layout.main')

@section('judul')
Sub Kriteria
@endsection

@section('subjudul')
Form Edit Data Sub Kriteria
@endsection

@section('isi')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Data Sub Kriteria</h5>
            <form action="/sub_kriteria/{{$sub_kriteria->id}}" method="POST">
            @csrf
            @method('put')
            <div class="row mb-3">

            <div class="col-md-12" style="margin-top: 15px;">
                <label for="inputText" class="col-sm-2 col-form-label">Kriteria</label>
                <div class="input-group">
                    <select class="form-select" aria-label="Default select example" name="kriteria_id" id="kriteria_id">
                        <option selected>Pilih Kriteria</option>
                        @foreach ($kriteria as $kat)
                            <option value="{{$kat->id}}" {{ $kat->id == $sub_kriteria->kriteria_id ? "selected" : "" }}>{{ $kat->nama_kriteria }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 15px;">
                <label for="inputNumber" class="col-sm-2 col-form-label">Nama Sub Kriteria</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$sub_kriteria->nama_subkriteria}}" name="nama_subkriteria">
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 15px;">
                <label for="inputNumber" class="col-sm-2 col-form-label">Nilai</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  value="{{$sub_kriteria->nilai}}" name="nilai">
                </div>
            </div>

          

            <div class="row mb-3" style="margin-top: 15px;">
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
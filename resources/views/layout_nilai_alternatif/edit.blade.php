@extends('layout.main')

@section('judul')
Nilai Alternatif
@endsection

@section('subjudul')
Form Edit Data Nilai Alternatif
@endsection

@section('isi')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Data Nilai Alternatif</h5>
            <form action="/nilai_alternatif/{{$nilai_alternatif->id}}" method="POST">
            @csrf
            @method('put')
            <div class="row mb-3">

            <div class="col-md-12" style="margin-top: 15px;">
                <label for="inputText" class="col-sm-2 col-form-label">Alternatif</label>
                <div class="input-group">
                    <select class="form-select" aria-label="Default select example" name="balita_id" id="balita_id">
                        <option selected>Pilih Alternatif</option>
                        @foreach ($balita as $kat)
                            <option value="{{$kat->id}}" {{ $kat->id == $nilai_alternatif->balita_id ? "selected" : "" }}>{{ $kat->nama_balita }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 15px;">
                <label for="inputText" class="col-sm-2 col-form-label">Sub Kriteria</label>
                <div class="input-group">
                    <select class="form-select" aria-label="Default select example" name="sub_kriteria_id" id="sub_kriteria_id">
                        <option selected>Pilih Sub Kriteria</option>
                        @foreach ($sub_kriteria as $kat)
                            <option value="{{$kat->id}}" {{ $kat->id == $nilai_alternatif->sub_kriteria_id ? "selected" : "" }}>{{ $kat->nama_subkriteria }}</option>
                        @endforeach
                    </select>
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
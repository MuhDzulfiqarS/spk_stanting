@extends('layout.main')

@section('judul')
Kriteria
@endsection

@section('subjudul')
Form Edit Data Kriteria
@endsection

@section('isi')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Data Kriteria</h5>
            <!-- Form Identitas Kriteria -->
            <form action="/kriteria/{{$kriteria->id}}" method="POST">
            @csrf
            @method('put')
            <div class="col-md-12">
                <label for="inputText" class="col-sm-2 col-form-label">Nama Kriteria</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$kriteria->nama_kriteria}}" name="nama_kriteria"> 
                </div>
            </div>

            <div class="col-md-12">
                <label for="inputText" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$kriteria->keterangan}}" name="keterangan"> 
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 15px;">
                <label for="inputNumber" class="col-sm-2 col-form-label">Bobot</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" value="{{$kriteria->bobot}}" name="bobot" step="any" min="0">

                </div>
            </div>

            <div class="row mb-3" style="margin-top: 15px;">
                <div class="col-sm-10">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                    <button type="submit" name="submit" value="Update" class="btn btn-primary">Update</button>
                </div>
            </div>

            </form><!-- Form Identitas Kriteria -->

        </div>
    </div>

</section>
@endsection
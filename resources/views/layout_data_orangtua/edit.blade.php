@extends('layout.main')

@section('judul')
Orang Tua
@endsection

@section('subjudul')
Form Edit Data Orang Tua
@endsection

@section('isi')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Edit Data Orang Tua</h5>
            <!-- Form Identitas Orang Tua -->
            <form action="/data_orangtua/{{$data_orangtua->id}}" method="POST">
            @csrf
            @method('put')
            <div class="col-md-12">
                <label for="inputText" class="col-sm-2 col-form-label">Nama Orang Tua</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$data_orangtua->nama_orangtua}}" name="nama_orangtua"> 
                </div>
            </div>

            <div class="col-md-12">
                <label for="inputText" class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$data_orangtua->pekerjaan}}" name="pekerjaan"> 
                </div>
            </div>

            <div class="col-md-12">
                <label for="inputText" class="col-sm-2 col-form-label">No HP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$data_orangtua->no_hp}}" name="no_hp"> 
                </div>
            </div>

            <div class="col-md-12">
                <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$data_orangtua->alamat}}" name="alamat"> 
                </div>
            </div>


            <div class="row mb-3" style="margin-top: 15px;">
                <div class="col-sm-10">
                    <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                    <button type="submit" name="submit" value="Update" class="btn btn-primary">Update</button>
                </div>
            </div>

            </form><!-- Form Identitas data_orangtua -->

        </div>
    </div>

</section>
@endsection
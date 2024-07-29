@extends('layout.main')

@section('judul')
Sub Kriteria
@endsection

@section('subjudul')
Form Tambah Data Sub Kriteria
@endsection

@section('isi')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning  alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Perhatian!!</h4>
                <p>1. Mohon pastikan bahwa seluruh data telah diisi dengan lengkap sebelum disimpan. Hal ini penting untuk memastikan kelengkapan informasi</p>
                <p>2.   Silakan gunakan tanda "-" pada kolom yang bersangkutan jika data tidak ada atau tidak tersedia.  Hal ini akan membantu memahami bahwa kolom tersebut sengaja kosong dan bukan karena kesalahan pengisian.</p>
                <hr>
                <p class="mb-0">Terima kasih atas perhatiannya dalam pengisian data   <i class="fa-solid fa-face-smile"></i></p>
            </div>
        </div>
    </div>
</section>


<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Data Sub Kriteria</h5>
            <form action="store" method="POST">
                @csrf 
                <div class="col-md-12" style="margin-top: 15px;">
                    <label class="form-label">Kriteria</label>
                    <div class="input-group">
                        <select class="form-select @error('kriteria_id') is-invalid @enderror" name="kriteria_id" id="kriteria_id" aria-label="Default select example">
                            <option value="">Pilih Kriteria</option>
                            @foreach ($kriteria as $kat)
                            <option value="{{$kat->id}}">{{$kat->nama_kriteria}}</option>
                            @endforeach
                        </select>
                        @error('kriteria_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
                    <label class="form-label">Nama Kriteria</label>
                    <div class="input-group">
                        <input type="text" class="form-control
                        @error('nama_subkriteria')
                        is-invalid
                        @enderror
                        " placeholder="Masukkan nama subkriteria" name="nama subkriteria" id="nama_subkriteria">
                        @error('nama_subkriteria')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
                    <label class="form-label">Nilai</label>
                    <div class="input-group">
                        <input type="number" class="form-control
                        @error('nilai')
                        is-invalid
                        @enderror
                        " placeholder="Masukkan Nilai" name="nilai" id="nilai">
                        @error('nilai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3" style="margin-top: 15px;">
                    <div class="col-sm-10">
                        <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                        <button type="submit" name="submit" value="Save" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</section>  
@endsection
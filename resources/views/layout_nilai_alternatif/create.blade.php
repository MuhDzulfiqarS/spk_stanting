@extends('layout.main')

@section('judul')
Nilai Alternatif
@endsection

@section('subjudul')
Form Tambah Data Nilai Alternatif
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
            <h5 class="card-title">Form Data Nilai Alternatif</h5>
            <form action="store" method="POST">
                @csrf
                <div class="col-md-12">
                    <label class="form-label">Alternatif</label>
                    <div class="input-group">
                        <select class="form-select @error('balita_id') is-invalid @enderror" name="balita_id" id="balita_id" aria-label="Default select example">
                            <option value="">Pilih Alternatif</option>
                            @foreach ($balita as $kat)
                            <option value="{{$kat->id}}">{{$kat->nama_balita}}</option>
                            @endforeach
                        </select>
                        @error('balita_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-12" style="margin-top: 15px;">
                    <label class="form-label">Sub Kriteria</label>
                    <div class="input-group">
                        <select class="form-select @error('sub_kriteria_id') is-invalid @enderror" name="sub_kriteria_id" id="sub_kriteria_id" aria-label="Default select example">
                            <option value="">Pilih Sub Kriteria</option>
                            @foreach ($sub_kriteria as $kat)
                            <option value="{{$kat->id}}">{{$kat->kriteria->nama_kriteria}} - {{$kat->nama_subkriteria}} - {{$kat->nilai}}</option>
                            @endforeach
                        </select>
                        @error('sub_kriteria_id')
                        <div class="invalid-feedback">
                            {{$message}}
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
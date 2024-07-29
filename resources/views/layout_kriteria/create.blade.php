@extends('layout.main')

@section('judul')
Form Tambah Kriteria
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
            <h5 class="card-title">Form Kriteria</h5>
            <!-- Form Kriteria -->
            <form action="store" method="POST">
                @csrf
                <div class="col-md-12">
                    <label for="inputText" class="col-sm-2 required-label">Nama Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control
                        @error('nama_kriteria')
                        is-invalid
                        @enderror" placeholder="Masukkan nama kriteria" name="nama_kriteria" id="nama_kriteria">
                        @error('nama_kriteria')
                        <div class="invalid-feedback" id="invalidCheck3Feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
                    <label for="inputText" class="col-sm-2 required-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control
                        @error('keterangan')
                        is-invalid
                        @enderror" placeholder="Masukkan keterangan" name="keterangan" id="keterangan">
                        @error('keterangan')
                        <div class="invalid-feedback" id="invalidCheck3Feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
                    <label for="inputText" class="col-sm-2 required-label">Bobot</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('bobot') is-invalid @enderror" placeholder="Masukkan bobot" name="bobot" id="bobot">
                        @error('bobot')
                        <div class="invalid-feedback" id="invalidCheck3Feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                
                <div class="row mb-3"  style="margin-top: 15px;">
                    <div class="col-sm-10">
                        <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i><span>     Kembali</span></a>
                        <button type="submit" name="submit" value="Save" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form><!-- Form Karyawan -->

        </div>
    </div>

</section>  
@endsection
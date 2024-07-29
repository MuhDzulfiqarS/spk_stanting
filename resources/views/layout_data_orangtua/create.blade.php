@extends('layout.main')

@section('judul')
Form Tambah Orang Tua
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
            <h5 class="card-title">Form Orang Tua</h5>
            <!-- Form Orang Tua -->
            <form action="store" method="POST">
                @csrf
                <div class="col-md-12">
                    <label for="inputText" class="col-sm-2 required-label">Nama Orang Tua</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control
                        @error('nama_orangtua')
                        is-invalid
                        @enderror" placeholder="Masukkan nama Orang Tua" name="nama_orangtua" id="nama_orangtua">
                        @error('nama_orangtua')
                        <div class="invalid-feedback" id="invalidCheck3Feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
                    <label for="inputText" class="col-sm-2 required-label">Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control
                        @error('pekerjaan')
                        is-invalid
                        @enderror" placeholder="Masukkan pekerjaan" name="pekerjaan" id="pekerjaan">
                        @error('pekerjaan')
                        <div class="invalid-feedback" id="invalidCheck3Feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
                    <label for="inputText" class="col-sm-2 required-label">No HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Masukkan Nomor HP" name="no_hp" id="no_hp">
                        @error('no_hp')
                        <div class="invalid-feedback" id="invalidCheck3Feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
                    <label for="inputText" class="col-sm-2 required-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Nomor HP" name="alamat" id="alamat">
                        @error('alamat')
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
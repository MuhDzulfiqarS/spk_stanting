@extends('layout.main')

@section('judul')
Data Orang Tua
@endsection

{{-- @section('subjudul')
Data data_orangtua
@endsection --}}

@section('isi')
<a href="data_orangtua/create" class="btn btn-primary"><i class="fa-solid fa-plus"></i><span>    Tambah Data Orang Tua</span></a>

<div class="row">
    <div class="col-md">
        <div class="table-responsive">
        <h1 class="card-title">Data Orang Tua</h1>
    <table id="data_orangtua" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Orang Tua</th>
                <th>Pekerjaan</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        </table>
    </div>
    </div>
</div>

<script>
   $(document).ready(function() {
    $('#data_orangtua').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('data_orangtua') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_orangtua', name: 'nama_orangtua' },
            { data: 'pekerjaan', name: 'pekerjaan' },
            { data: 'no_hp', name: 'no_hp' },
            { data: 'alamat', name: 'alamat' },
            { data: 'action', name: 'action' },
        ]
    });

     $('#data_orangtua').on('click', '.delete-button', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda Akan menghapus data orang tua ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('data_orangtua.destroy', '') }}" + '/' + id,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            swal(response.success,{
                                icon: "success",
                            })
                            .then((result) => {
                                location.reload();
                            });
                        }
                    });
                }else{
                    swal("Data tidak jadi dihapus");
                }
            });
        });
    });
</script>
@endsection
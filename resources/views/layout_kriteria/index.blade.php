@extends('layout.main')

@section('judul')
Kriteria
@endsection

@section('subjudul')
Data Kriteria
@endsection

@section('isi')
<a href="kriteria/create" class="btn btn-primary"><i class="fa-solid fa-plus"></i><span>    Tambah Kriteria</span></a>

<div class="row">
    <div class="col-md">
        <div class="table-responsive">
        <h1 class="card-title">Data Kriteria</h1>
    <table id="kriteria" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Keterangan</th>
                <th>Bobot</th>
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
    $('#kriteria').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('kriteria') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_kriteria', name: 'nama_kriteria' },
            { data: 'keterangan', name: 'keterangan' },
            { data: 'bobot', name: 'bobot' },
            { data: 'action', name: 'action' },
        ]
    });

     $('#kriteria').on('click', '.delete-button', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda Akan menghapus data kriteria ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('kriteria.destroy', '') }}" + '/' + id,
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
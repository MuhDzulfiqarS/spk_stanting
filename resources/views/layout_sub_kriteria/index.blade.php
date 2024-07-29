@extends('layout.main')

@section('judul')
Sub Kriteria
@endsection

@section('subjudul')
Data Sub Kriteria
@endsection

@section('isi')
<a href="sub_kriteria/create" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span>Tambah Sub Kriteria</span></a>

<div class="row">
    <div class="col-md">
        <div class="table-responsive">
        <h1 class="card-title">Data Sub Kriteria</h1>
    <table id="sub_kriteria" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Sub Kriteria</th>
                <th>Nilai</th>
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
    $('#sub_kriteria').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('sub_kriteria') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kriteria', name: 'kriteria' },
            { data: 'nama_subkriteria', name: 'nama_subkriteria' },
            { data: 'nilai', name: 'nilai' },
            { data: 'action', name: 'action' },
        ]
    });

     $('#sub_kriteria').on('click', '.delete-button', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda Akan menghapus data sub kriteria ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('sub_kriteria.destroy', '') }}" + '/' + id,
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
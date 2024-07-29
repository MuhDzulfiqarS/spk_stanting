@extends('layout.main')

@section('judul')
Nilai Alternatif
@endsection

@section('subjudul')
Data Nilai Alternatif
@endsection

@section('isi')
<a href="nilai_alternatif/create" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span>Tambah Nilai Alternatif</span></a>

<div class="row">
    <div class="col-md">
        <div class="table-responsive">
        <h1 class="card-title">Data Nilai Alternatif</h1>
    <table id="nilai_alternatif" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>Sub Kriteria</th>
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
    $('#nilai_alternatif').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('nilai_alternatif') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'alternatif', name: 'alternatif'},
            { data: 'subkriteria', name: 'subkriteria' },
            { data: 'action', name: 'action' },
        ]
    });

     $('#nilai_alternatif').on('click', '.delete-button', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            swal({
                    title: "Apakah anda yakin?",
                    text: "Anda Akan menghapus data nilai alternataif ini!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('nilai_alternatif.destroy', '') }}" + '/' + id,
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
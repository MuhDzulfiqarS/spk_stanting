@extends('layout.main')

@section('judul')
Data Hasil Keputusan
@endsection

@section('isi')

<div class="row">
    <div class="col-md-12">
        <a href="{{ route('hasil_keputusan.export.excel') }}" class="btn btn-success">Download Excel</a>
        <a href="{{ route('hasil_keputusan.export.pdf') }}" class="btn btn-danger">Download PDF</a>
    </div>
</div>

<div class="row">
    <div class="col-md">
        <div class="table-responsive">
            <h1 class="card-title">Data Hasil Keputusan</h1>
            <table id="keputusanTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Balita</th>
                        <th>Skor</th>
                        <th>Hasil Keputusan</th>
                        <th>Rangking</th>
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
        $('#keputusanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('hasil_keputusan') }}", // Sesuaikan route dengan yang ada di routes/web.php
            columns: [
                { data: 'balita', name: 'balita' },
                { data: 'nilai_preferensi', name: 'nilai_preferensi' },
                { data: 'hasil_keputusan', name: 'hasil_keputusan' },
                { data: 'rank', name: 'rank' }
            ]
        });
    });
</script>


@endsection

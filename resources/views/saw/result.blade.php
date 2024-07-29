@extends('layout.main')

@section('judul')
Result
@endsection

@section('subjudul')

@endsection

@section('isi')


<div class="container">
    <h2>Hasil Perhitungan SAW</h2>

    <!-- 1. Menentukan bobot untuk masing-masing kriteria -->
    <h3>1. Menentukan Bobot untuk Masing-Masing Kriteria</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bobot_kriteria as $kriteria_id => $bobot)
                <tr>
                    <td>{{ $kriteria->find($kriteria_id)->nama_kriteria }}</td>
                    <td>{{ $bobot }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 2. Melakukan normalisasi -->
    <h3>2. Melakukan Normalisasi</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Balita</th>
                @foreach($bobot_kriteria as $kriteria_id => $bobot)
                    <th>Nilai {{ $kriteria->find($kriteria_id)->nama_kriteria }}</th>
                    {{-- <th>Max Nilai Sub-Kriteria {{ $kriteria->find($kriteria_id)->subkriteria->first()->nama_subkriteria }}</th> --}}
                    <th>Max Nilai</th>
                    <th>Normalisasi (Nilai / Max)</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($alternatifs as $balita)
                <tr>
                    <td>{{ $balita->nama_balita }}</td>
                    @foreach($bobot_kriteria as $k_id => $bobot)
                        @php
                            $nilai = $nilai_alternatif->where('balita_id', $balita->id)
                                                     ->where('sub_kriteria.kriteria_id', $k_id)
                                                     ->first()
                                                     ?->sub_kriteria
                                                     ?->nilai ?? 0;
                            $maxValue = $nilai_alternatif->where('sub_kriteria.kriteria_id', $k_id)
                                                         ->max(function($na) {
                                                             return $na->sub_kriteria->nilai;
                                                         });
                            $normalizedValue = $maxValue ? $nilai / $maxValue : 0;
                        @endphp
                        <td>{{ $nilai }}</td>
                        <td>{{ $maxValue }}</td>
                        <td>{{ $maxValue ? "$nilai / $maxValue = $normalizedValue" : '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 3. Hasil normalisasi -->
    <h3>3. Hasil Normalisasi</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Balita</th>
                @foreach($bobot_kriteria as $kriteria_id => $bobot)
                    <th>Kriteria {{ $kriteria->find($kriteria_id)->nama_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($alternatifs as $balita)
                <tr>
                    <td>{{ $balita->nama_balita }}</td>
                    @foreach($bobot_kriteria as $k_id => $bobot)
                        <td>{{ isset($normalized[$balita->id][$k_id]) ? $normalized[$balita->id][$k_id] : '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 4. Menghitung nilai preferensi untuk tiap balita -->
    <h3>4. Menghitung Nilai Preferensi untuk Tiap Balita</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Balita</th>
                @foreach($bobot_kriteria as $kriteria_id => $bobot)
                    <th>Kriteria {{ $kriteria->find($kriteria_id)->nama_kriteria }}</th>
                @endforeach
                {{-- <th>Nilai Preferensi</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($preferensi as $balita_id => $nilai)
                <tr>
                    <td>{{ $alternatifs->find($balita_id)->nama_balita }}</td>
                    @foreach($bobot_kriteria as $k_id => $bobot)
                        <td>{{ isset($normalized[$balita_id][$k_id]) ? $normalized[$balita_id][$k_id] . ' x ' . $bobot . ' = ' . $normalized[$balita_id][$k_id] * $bobot : '-' }}</td>
                        {{-- <td>{{ isset($normalized[$balita_id][$k_id]) ? $normalized[$balita_id][$k_id] . ' x ' . $bobot : '-' }}</td> --}}

                    @endforeach
                    {{-- <td style="background-color: #A9A9A9">{{ $nilai }}</td> --}}
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Bobot Kriteria</th>
                @foreach($bobot_kriteria as $kriteria_id => $bobot)
                    <th style="background-color: #A9A9A9" colspan="1">{{ $kriteria->find($kriteria_id)->nama_kriteria }}: {{ $bobot }}</th>
                @endforeach
            </tr>
        </tfoot>
    </table>

    <!-- 5. Hasil nilai preferensi tiap balita -->
    <h3>5. Hasil Nilai Preferensi Tiap Balita</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Balita</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($preferensi as $balita_id => $nilai)
                <tr>
                    <td>{{ $alternatifs->find($balita_id)->nama_balita }}</td>
                    <td>{{ $nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 6. Menghitung total nilai preferensi -->
    {{-- <h3>6. Menghitung Total Nilai Preferensi</h3>
    <p>Total Nilai Preferensi untuk setiap balita:</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Balita</th>
                <th>Total Nilai Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($preferensi as $balita_id => $nilai)
                <tr>
                    <td>{{ $alternatifs->find($balita_id)->nama_balita }}</td>
                    <td>{{ $nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}

    <h3>7. Perangkingan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Peringkat</th>
                <th>Balita</th>
                <th>Nilai Preferensi (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ranking as $index => $balita_id)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $alternatifs->find($balita_id)->nama_balita }}</td>
                    <td>{{ number_format($preferensi[$balita_id] * 100, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>8. Hasil Keputusan</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Balita</th>
                <th>Nilai Preferensi (%)</th>
                <th>Hasil Keputusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ranking as $index => $balita_id)
                <tr>
                    <td>{{ $alternatifs->find($balita_id)->nama_balita }}</td>
                    <td>{{ number_format($preferensi[$balita_id] * 100, 2) }}</td>
                    <td>{{ $keputusan[$balita_id] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Menu hasil keputusan -->
    <h3>Hasil Keputusan</h3>
    <p>Balita dengan nilai preferensi tertinggi adalah balita yang terkenda stanting..</p>
</div>







@endsection

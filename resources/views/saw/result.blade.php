@extends('layout.main')

@section('judul')
Proses Perhitungan
@endsection

@section('subjudul')

@endsection

@section('isi')


<div class="container">


    <!-- 1. Menentukan bobot untuk masing-masing kriteria -->
    <h3 style="margin-top: 10px; font-family: 'Raleway', sans-serif;">1. Menentukan Bobot untuk Masing-Masing Kriteria</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="background-color: #E2E2DF; width: 50px;">No</th>
                <th style="background-color: #E2E2DF">Kriteria</th>
                <th style="background-color: #E2E2DF">Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bobot_kriteria as $kriteria_id => $bobot)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kriteria->find($kriteria_id)->nama_kriteria }}</td>
                    <td>{{ $bobot }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 2. Melakukan normalisasi -->
    <h3 style="margin-top: 50px; font-family: 'Raleway', sans-serif;">2. Melakukan Normalisasi</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="background-color: #E2E2DF; width: 50px;">No</th>
                <th style="background-color: #E2E2DF">Balita</th>
                @foreach($bobot_kriteria as $kriteria_id => $bobot)
                    <th style="background-color: #E2E2DF">Nilai {{ $kriteria->find($kriteria_id)->nama_kriteria }}</th>
                    {{-- <th>Max Nilai Sub-Kriteria {{ $kriteria->find($kriteria_id)->subkriteria->first()->nama_subkriteria }}</th> --}}
                    <th style="background-color: #E2E2DF">Max Nilai  {{ $kriteria->find($kriteria_id)->nama_kriteria }}</th>
                    <th style="background-color: #E2E2DF">Normalisasi (Nilai / Max)  {{ $kriteria->find($kriteria_id)->nama_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($alternatifs as $balita)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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
                        <td>{{ $maxValue ? "$nilai / $maxValue" : '-' }}</td>
                        {{-- <td>{{ $maxValue ? "$nilai / $maxValue = $normalizedValue" : '-' }}</td> --}}
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 3. Hasil normalisasi -->
    <h3 style="margin-top: 50px; font-family: 'Raleway', sans-serif;">3. Hasil Normalisasi</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="background-color: #E2E2DF; width: 50px;">No</th>
                <th style="background-color: #E2E2DF">Balita</th>
                @foreach($bobot_kriteria as $kriteria_id => $bobot)
                    <th style="background-color: #E2E2DF">Kriteria {{ $kriteria->find($kriteria_id)->nama_kriteria }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($alternatifs as $balita)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $balita->nama_balita }}</td>
                    @foreach($bobot_kriteria as $k_id => $bobot)
                        <td>{{ isset($normalized[$balita->id][$k_id]) ? $normalized[$balita->id][$k_id] : '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 4. Menghitung nilai preferensi -->
    <h3 style="margin-top: 50px; font-family: 'Raleway', sans-serif;">4. Menghitung Nilai Preferensi</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="background-color: #E2E2DF; width: 50px;">No</th>
                <th style="background-color: #E2E2DF">Balita</th>
                @foreach($bobot_kriteria as $kriteria_id => $bobot)
                    <th style="background-color: #E2E2DF">Kriteria {{ $kriteria->find($kriteria_id)->nama_kriteria }}</th>
                @endforeach
                {{-- <th>Nilai Preferensi</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($preferensi as $balita_id => $nilai)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $alternatifs->find($balita_id)->nama_balita }}</td>
                    @foreach($bobot_kriteria as $k_id => $bobot)
                        {{-- <td>{{ isset($normalized[$balita_id][$k_id]) ? $normalized[$balita_id][$k_id] . ' x ' . $bobot . ' = ' . $normalized[$balita_id][$k_id] * $bobot : '-' }}</td> --}}
                        <td>{{ isset($normalized[$balita_id][$k_id]) ? $normalized[$balita_id][$k_id] . ' x ' . $bobot : '-' }}</td>

                    @endforeach
                    {{-- <td style="background-color: #A9A9A9">{{ $nilai }}</td> --}}
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Bobot Kriteria</th>
                @foreach($bobot_kriteria as $kriteria_id => $bobot)
                    <th style="background-color: #A9A9A9">{{ $kriteria->find($kriteria_id)->nama_kriteria }}: {{ $bobot }}</th>
                @endforeach
            </tr>
        </tfoot>
    </table>

    <!-- 5. Hasil nilai preferensi -->
    <h3 style="margin-top: 50px; font-family: 'Raleway', sans-serif;">5. Hasil Preferensi</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="background-color: #E2E2DF; width: 50px;">No</th>
                <th style="background-color: #E2E2DF">Balita</th>
                @foreach($bobot_kriteria as $kriteria_id => $bobot)
                    <th style="background-color: #E2E2DF">Kriteria {{ $kriteria->find($kriteria_id)->nama_kriteria }}</th>
                @endforeach
                <th style="background-color: #E2E2DF">Total Preferensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($preferensi as $balita_id => $nilai)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $alternatifs->find($balita_id)->nama_balita }}</td>
                    @php
                        $total_preferensi = 0;
                    @endphp
                    @foreach($bobot_kriteria as $k_id => $bobot)
                        @php
                            $hasil_perkalian = isset($normalized[$balita_id][$k_id]) ? $normalized[$balita_id][$k_id] * $bobot : 0;
                            $total_preferensi += $hasil_perkalian;
                        @endphp
                        <td>{{ $hasil_perkalian }}</td>
                    @endforeach
                    <td style="background-color: #A9A9A9">{{ $total_preferensi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <!-- 6. Hasil nilai preferensi tiap balita -->
    <h3>6. Hasil Nilai Preferensi Tiap Balita</h3>
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
    </table> --}}

    <!-- 6. Perangkingan -->
    <h3 style="margin-top: 50px; font-family: 'Raleway', sans-serif;">6. Perangkingan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="background-color: #E2E2DF; width: 50px;">No</th>
                <th style="background-color: #E2E2DF">Balita</th>
                <th style="background-color: #E2E2DF">Nilai Preferensi (%)</th>
                <th style="background-color: #E2E2DF">Peringkat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ranking as $index => $balita_id)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $alternatifs->find($balita_id)->nama_balita }}</td>
                    <td>{{ number_format($preferensi[$balita_id] * 100, 2) }}</td>
                    <td style="background-color: #A9A9A9">{{ $index + 1 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- 7. Hasil Keputusan -->
    <h3 style="margin-top: 50px; font-family: 'Raleway', sans-serif;">7. Hasil Keputusan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="background-color: #E2E2DF; width: 50px;">No</th>
                <th style="background-color: #E2E2DF">Balita</th>
                <th style="background-color: #E2E2DF">Nilai Preferensi (%)</th>
                <th style="background-color: #E2E2DF">Hasil Keputusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ranking as $index => $balita_id)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $alternatifs->find($balita_id)->nama_balita }}</td>
                    <td>{{ number_format($preferensi[$balita_id] * 100, 2) }}</td>
                    <td style="background-color: #A9A9A9">{{ $keputusan[$balita_id] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Berdasarkan Hasil Perhitungan Keputusan dengan nilai > 70 Normal dan < 70 Stanting maka didapatkan status:</p>
    <p>Jumlah Balita dengan Keputusan Stanting: {{ $jumlah_stanting }}</p>
    <p>Jumlah Balita dengan Keputusan Normal: {{ $jumlah_normal }}</p>
</div>







@endsection

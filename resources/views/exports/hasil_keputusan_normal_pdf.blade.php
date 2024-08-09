<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Data Hasil Keputusan</title>
    <style type="text/css">
        .rangkasurat{
            width: 90%;
            margin: 0 auto;
            background-color: #fff;
            padding: 1%;
        }
        .table{
            border-bottom: 3px solid #000;
            padding: 1%;
        }
        .tengah{
            text-align: center;
            line-height: 9%;
        }
        .paragraf{
            text-align: center;
            margin-top: 5%;
            /* font-weight: 500; */
        }
    </style>
</head>
<body>
    <div class="rangkasurat">
        <table width="100%" class="table">
            <tr>
                <td>
                    <img src="{{ public_path('assets/img/dinaslogo.png') }}" width="120px" alt="" style="margin-top: 25px;">
                <td class="tengah">
                    <h5>PEMERINTAHAN KABUPATEN JENEPONTO</h5>
                    <h5>DINAS KESEHATAN</h5>
                    <h4>PUSKESMAS TOGO-TOGO</h4>
                    <p style="margin-top: 40px;">Jl. Poros Jeneponto Bantaeng, Togo-Togo</p>
                </td>
                <td>
                    <img src="{{ public_path('assets/img/PuskesmasLogo.png') }}" width="100px" alt="" style="margin-top: 35px;">
                </td>
            </tr>
        </table>
    </div>
    <table width="50%" class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Balita</th>
                <th>Skor</th>
                <th>Hasil Keputusan</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($keputusan as $row)
                @if($row['hasil_keputusan'] == 'Normal')
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row['balita'] }}</td>
                        <td>{{ $row['nilai_preferensi'] }}</td>
                        <td>{{ $row['hasil_keputusan'] }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>

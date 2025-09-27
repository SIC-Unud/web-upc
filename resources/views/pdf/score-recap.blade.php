<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
         @font-face {
            font-family: 'PlusJakartaSans';
            font-style: normal;
            font-weight: 400;
            src: url('{{ public_path('assets/fonts/PlusJakartaSans-Regular.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'PlusJakartaSans';
            font-style: normal;
            font-weight: bold;
            src: url('{{ public_path('assets/fonts/PlusJakartaSans-Bold.ttf') }}') format('truetype');
        }
        * {
            font-family: 'PlusJakartaSans', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        html{
            margin: 0;
        }
        body{
            margin-top: 190px;
            margin-bottom: 120px;
            margin-left: 40px;
            margin-right: 40px;
        }
        header, footer {
            position: fixed;
            left: 0;
            right: 0;
            z-index: -1;
        }
        header {
            top: 0;
            height: 130px;
        }
        footer {
            bottom: 0;
            height: 100px;
        }
        .header-img, .footer-img {
            width: 100%;
            height: auto;
        }
        .header-img, .footer-img {
            width: 100%;
            height: auto;
        }
        h1 {
            line-height: 20px;
            margin-left: 40px ;
            margin-right: 40px ;
            font-size: 24px;
            text-align: center;
        }
        table, th, tr, td {
            border: solid 1px black;
            border-collapse: collapse;
        }
        table {
            width: 100%;
        }
        .no {
            width: 5%
        }
        .no-peserta {
            width: 20%
        }
        .nama-lengkap {
            width: 35%
        }
        .nilai {
            width: 10%
        }
        .predikat {
            width: 10%
        }
        th, td {
            padding: 4px 2px;
        }
        thead {
            border: solid 1px black;
            background-color: rgba(217, 217, 217, 1) ;
        }
        .finalis {
            background-color: rgba(0, 196, 130, 0.39);
            text-align: center;
        }
        .not-finalis {
            text-align: center;
        }
        
    </style>
</head>
<body>
    <header>
        <img src="{{ public_path('assets/invoice/header.png') }}" class="header-img">
    </header>

    <footer>
        <img src="{{ public_path('assets/invoice/footer.png') }}" class="footer-img">
    </footer>

    <div class="main-container">
        <div class="font-bold">
            <h1>REKAP PENILAIAN PENYISIHAN {{ strtoupper($competition->name ?? 'KOMPETISI') }}</h1>
            <h1>UDAYANA PHYSICS CHAMPIONSHIP</h1>
            <h1 style="margin-bottom: 24px">{{ $year ?? date('Y') }}</h1>
        </div>
        <table>
            <thead>
                <tr class="header-row">
                    <th class="no">No.</th>
                    <th class="no-peserta">No. Peserta</th>
                    <th class="nama-lengkap">Nama Lengkap</th>
                    <th class="nilai">Nilai</th>
                    <th class="predikat">Predikat</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                    $finalis = 1;
                @endphp
                @foreach($attempts as $i => $attempt)
                    <tr class="{{ $i < 25 ? 'finalis' : 'not-finalis' }}">
                        <td>{{ $i + 1 }}.</td>
                        <td>{{ $attempt->participant->no_participant }}</td>
                        <td>{{ $attempt->participant->leader_name }}</td>
                        <td>{{ $attempt->score ?? 0 }}</td>
                        <td>{{ $i + 1 }}</td>
                    </tr>
                    @php
                        $count++;
                        if($finalis < 25) {
                            $finalis++;
                        }
                    @endphp
                @endforeach
                @foreach($userNotAttempts as $user)
                    <tr class="{{ $finalis < 25 && $count <= 25 ? 'finalis' : 'not-finalis' }}">
                        <td>{{ $count }}.</td>
                        <td>{{ $user->no_participant }}</td>
                        <td>{{ $user->leader_name }}</td>
                        <td>{{ 0 }}</td>
                        <td>{{ $count++ }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

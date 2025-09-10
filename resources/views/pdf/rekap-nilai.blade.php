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
        header, footer {
            position: fixed;
            left: 0;
            right: 0;
            z-index: -1;
        }
        header {
            top: 0px;
            height: 130px;
        }
        footer {
            bottom: 10;
            height: 90px;
        }
        .header-img, .footer-img {
            width: 100%;
            height: auto;
        }
        .main-container {
            margin: 192px 40px 0px;
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
            <h1>REKAP PENILAIAN PENYISIHAN FISIKA SMP</h1>
            <h1>UDAYANA PHYSICS CHAMPIONSHIP</h1>
            <h1 style="margin-bottom: 28px">2025</h1>
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
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="not-finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="not-finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="not-finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="not-finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="not-finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="not-finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
                <tr class="not-finalis">
                    <td>1.</td>
                    <td>SMP-001</td>
                    <td>uda yappingnya?
                    </td>
                    <td>100</td>
                    <td>1</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

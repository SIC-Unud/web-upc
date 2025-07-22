<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Formulir Pendaftaran UPC</title>
  <style>
    @page {
        margin: 180px 0 0 0;
    }
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
    body {
        font-family: 'PlusJakartaSans', sans-serif;
        font-size: 10px;
        margin: 0;
        padding: 0;
    }
    header, footer {
        position: fixed;
        left: 0;
        right: 0;
        z-index: -1;
    }
    header {
        top: -180px;
        height: 130px;
    }
    footer {
        bottom: 0;
        height: 90px;
    }
    .header-img, .footer-img {
        width: 100%;
        height: auto;
    }
    .container {
        padding: 0 40px 120px 40px;
    }
    .border{
        border: 1px solid #000;
    }
    .border-l{
        border-left: 1px solid #000;
    }
    .border-b{
        border-bottom: 1px solid #000;
    }
    .anggota-title {
        font-weight: bold;
        margin-bottom: 5px;
        text-align: center;
        font-size: 14px;
    }
    .font-bold{
        font-weight: bold;
    }
    .title{
        font-size: 18px;
        font-weight: bold;
    }
    .bg-img{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: .2;
        z-index: 0;
        width: 60%;
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

    <img src="{{ public_path('assets/logo-with-name.png') }}" class="bg-img">

    <div class="container">
        <table class="border" style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 150px; padding:10px;">
                    <div style="width:100%; display:flex; align-items:center; justify-content:center;">
                        <img src="{{ public_path('storage/' . $data->pass_photo) }}" style="width: 130px; height: 180px; object-fit: cover;">
                    </div>
                </td>
                <td style="padding: 10px;" class="border-l">
                    <table style="width: 100%;">
                        <tr><td class="font-bold">No. Registrasi</td><td>:</td><td>{{ $data->no_registration }}</td></tr>
                        <tr><td class="font-bold">Waktu Registrasi</td><td>:</td><td>{{ $data->created_at }}</td></tr>
                        <tr><td class="font-bold">Nama Lengkap</td><td>:</td><td>{{ $data->leader_name }}</td></tr>
                        <tr><td class="font-bold">NISN / NIM</td><td>:</td><td>{{ $data->leader_student_id }}</td></tr>
                        <tr><td class="font-bold">Tanggal Lahir</td><td>:</td><td>{{ $data->leader_date_of_birth }}</td></tr>
                        <tr><td class="font-bold">Jenis Kelamin</td><td>:</td><td>{{ $data->leader_gender == 'l' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                        <tr><td class="font-bold">No. Handphone</td><td>:</td><td>{{ $data->leader_no_wa }}</td></tr>
                        <tr><td class="font-bold">Email</td><td>:</td><td>{{ $data->user->email }}</td></tr>
                        <tr><td class="font-bold">Asal Sekolah</td><td>:</td><td>{{ $data->institution }}</td></tr>
                        <tr><td class="font-bold">Provinsi</td><td>:</td><td>{{ $data->institution_province }}</td></tr>
                        <tr><td class="font-bold">Kabupaten/Kota</td><td>:</td><td>{{ $data->institution_city }}</td></tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="border title" style="padding: 10px; margin-bottom: 10px;">
            Kategori Kompetisi : {{ $data->competition->name }}
        </div>

        <table class="border" style="width:100%; padding: 10px; margin-bottom: 10px;">
            <tr class="border-b">
                <td colspan="2" class="title">Rincian Pembayaran:</td>
            </tr>
            <tr>
                <td>Biaya Pendaftaran Kompetisi {{ $data->competition->name }}</td>
                <td style="text-align: right;">{{ rupiah($data->subtotal) }}</td>
            </tr>
            {{-- <tr>
                <td>Biaya Admin</td>
                <td style="text-align: right;">{{ rupiah(1000) }}</td>
            </tr> --}}
            <tr>
                <td>Potongan Kupon</td>
                <td style="text-align: right;">{{ rupiah($data->subtotal - $data->total) }}</td>
            </tr>
            <tr class="font-bold" style="font-size: 18px;">
                <td>Total</td>
                <td style="text-align: right;">{{ rupiah($data->total) }}</td>
            </tr>
        </table>

        <table class="border" style="padding:10px;">
            <tr>
                <td>Gunakan formulir ini sebagai bukti valid pendaftaran Anda dalam kegiatan <span class="font-bold">Udayana Physics Championship (UPC) 2025</span> sebagaimana mestinya. Bila Anda merasa terdapat kesalahan, maka dipersilahkan untuk menghubungi <a href="{{ config('const.link_cp_humas') }}" target="_blank" rel="noopener noreferrer">CP Humas UPC 2025</a> yang tertera pada bagian header formulir ini.</td>
            </tr>
        </table>
    </div>
</body>
</html>
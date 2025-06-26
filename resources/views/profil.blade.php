@extends ('layouts.side-bar')

@section('title', 'Profile')

@section('content')

<div class="font-jakarta ">
    <h1 class="text-3xl md:text-5xl font-bold text-[#4C4C4C] pt-8">
        Profil
    </h1>
    <div class="text-[10px] md:text-lg mb-6 bg-white w-full font-jakarta rounded-3xl mx-auto my-7 p-6 md:p-[52px] shadow-md shadow-gray-400">
        <div class="grid grid-cols-1 md:grid-cols-[max-content_auto] gap-x-15 gap-y-4">
            <div class="md:w-full w-1/2 mx-auto">
                <img src="/assets/profile-peserta.png" alt="">
            </div>
            <div class="grid break-all grid-cols-[max-content_1fr] md:grid-cols-[max-content_auto] gap-x-2 gap-y-4 max-w-full">
                <span class="font-bold">No. Peserta</span>
                <span>: FAST-001</span>
                <span class="font-bold">No. Registrasi</span>
                <span>: 198788099 </span>
                <span class="font-bold">Waktu Registrasi</span>
                <span>: 29-05-2025  17:30:00 </span>
                <span class="font-bold">Nama Lengkap</span>
                <span>: YUDHISTIRA ARIMBAWA SAPUTRA</span>
                <span class="font-bold">NISN/NIM</span>
                <span>: 003525676 </span>
                <span class="font-bold">Tanggal Lahir</span>
                <span>: 03-02-2005 </span>
                <span class="font-bold">Jenis Kelamin</span>
                <span>: Laki-laki</span>
                <span class="font-bold">No Handphone</span>
                <span>: 081xxx</span>
                <span class="font-bold">Email</span>
                <span>: yukeno@gmail.com </span>
                <span class="font-bold">Asal Sekolah</span>
                <span>: SMA Negeri 2 Kuta</span>
                <span class="font-bold">Provinsi</span>
                <span>: Kuta </span>
                <span class="font-bold">Kabupaten/Kota</span>
                <span>: Badung </span>
                <span class="font-bold">Jenis Kompetisi</span>
                <span>: Astronomi </span>
            </div>
        </div>
    </div>
</div>
@endsection
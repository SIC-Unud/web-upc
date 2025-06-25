@extends ('layouts.side-bar')

@section('title', 'Profile')

@section('content')

<div class="font-jakarta ">
    <h1 class="text-3xl md:text-5xl font-bold text-[#4C4C4C] pt-8">
        Profil
    </h1>
    <div class="text-[10px] md:text-lg mb-6 bg-white w-full font-jakarta rounded-3xl mx-auto my-7 p-6 md:p-[52px] shadow-md shadow-gray-400">
        @if($user && $user->participant)
        <div class="grid grid-cols-1 md:grid-cols-[max-content_auto] gap-x-15 gap-y-4">
            <div class="md:w-full w-1/2 mx-auto">
                <img src="/assets/profile-peserta.png" alt="">
            </div>
            <div class="grid break-all grid-cols-[max-content_1fr] md:grid-cols-[max-content_auto] gap-x-2 gap-y-4 max-w-full">
                <span class="font-bold">No. Peserta</span>
                <span>: {{ $user->participant->no_participant ?? 'Belum Tersedia' }}</span>
                <span class="font-bold">No. Registrasi</span>
                <span>: {{ $user->participant->no_registration ?? 'N/A' }}</span>
                <span class="font-bold">Waktu Registrasi</span>
                <span>: {{ $user->participant->created_at->format('d-m-Y H:i:s') }}</span>
                <span class="font-bold">Nama Lengkap</span>
                <span>: {{ $user->participant->name ?? 'N/A' }}</span>
                <span class="font-bold">NISN/NIM</span>
                <span>: {{ $user->participant->student_id ?? 'N/A' }}</span>
                <span class="font-bold">Tanggal Lahir</span>
                <span>: {{ \Carbon\Carbon::parse($user->participant->date_of_birth)->format('d-m-Y') }}</span>
                <span class="font-bold">Jenis Kelamin</span>
                <span>: {{ $user->participant->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                <span class="font-bold">No Handphone</span>
                <span>: {{ $user->participant->no_wa ?? 'N/A' }}</span>
                <span class="font-bold">Email</span>
                <span>: {{ $user->email }}</span>
                <span class="font-bold">Asal Sekolah</span>
                <span>: {{ $user->participant->institution ?? 'N/A' }}</span>
                <span class="font-bold">Kabupaten/Kota</span>
                <span>: {{ $user->participant->institution_city ?? 'N/A' }}</span>
                <span class="font-bold">Provinsi</span>
                <span>: {{ $user->participant->institution_province ?? 'N/A' }}</span>
                <span class="font-bold">Jenis Kompetisi</span>
                <span>: {{ $user->participant->competition->name ?? 'N/A' }}</span>
            </div>
        </div>
        @else
        <p class="text-center">Data profil tidak ditemukan.</p>
        @endif
    </div>
</div>
@endsection

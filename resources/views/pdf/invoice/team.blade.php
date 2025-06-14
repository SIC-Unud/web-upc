<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulir Pendaftaran UPC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body class="bg-white text-sm font-sans relative h-screen">
    <header>
        <img src="{{ public_path('assets/header1.png') }}" alt="">
    </header>
    <div class="py-2 mt-2 px-12 w-[100%] mx-auto ">
    <!-- Header -->
        <div class="flex border-b mb-2 w-[100%] border border-gray-800">
            <div class="flex items-center justify-center w-[30%] border-r-[1px] border-gray-800">
                <img src="{{ public_path('storage/' . $data->pass_photo) }}" alt="Avatar" class="w-[160px] h-[200px] object-cover rounded-md border">
            </div>
            {{-- <div class="ml-6 grid grid-cols-[30%,70%] text-[12px] w-[70%] my-2">
                <div class="font-bold">No. Registrasi</div><div>: {{ $data->no_registration }} </div>
                <div class="font-bold">Waktu Registrasi</div><div>: {{ $data->created_at }}</div>
                <div class="font-bold">Nama Lengkap</div><div>: {{ $data->leader_name }}</div>
                <div class="font-bold">NISN / NIM</div><div>: {{ $data->leader_student_id }}</div>
                <div class="font-bold">Tanggal Lahir</div><div>: {{ $data->leader_date_of_birth }}</div>
                <div class="font-bold">Jenis Kelamin</div><div>: {{ $data->leader_gender }}</div>
                <div class="font-bold">No. Handphone</div><div>: {{ $data->leader_no_wa }}</div>
                <div class="font-bold">Email</div><div>: {{ $data->user->email }}</div>
                <div class="font-bold">Asal Sekolah</div><div>: {{ $data->institution }}</div>
                <div class="font-bold">Provinsi</div><div>: {{ $data->institution_province }}</div>
                <div class="font-bold">Kabupaten / Kota</div><div>: {{ $data->institution_city }}</div>
            </div> --}}
            <div class="ml-6 grid grid-cols-[38%,2%,60%] text-[12px] w-[70%] my-2">
                <div class="font-bold">No. Registrasi</div><div>:</div><div>{{ $data->no_registration }}</div>
                <div class="font-bold">Waktu Registrasi</div><div>:</div><div>{{ $data->created_at }}</div>
                <div class="font-bold">Nama Lengkap</div><div>:</div><div>{{ $data->leader_name }}</div>
                <div class="font-bold">NISN / NIM</div><div>:</div><div>{{ $data->leader_student_id }}</div>
                <div class="font-bold">Tanggal Lahir</div><div>:</div><div>{{ $data->leader_date_of_birth }}</div>
                <div class="font-bold">Jenis Kelamin</div><div>:</div><div>{{ $data->leader_gender }}</div>
                <div class="font-bold">No. Handphone</div><div>:</div><div>{{ $data->leader_no_wa }}</div>
                <div class="font-bold">Email</div><div>:</div><div>{{ $data->user->email }}</div>
                <div class="font-bold">Asal Sekolah</div><div>:</div><div>{{ $data->institution }}</div>
                <div class="font-bold">Provinsi</div><div>:</div><div>{{ $data->institution_province }}</div>
                <div class="font-bold">Kabupaten / Kota</div><div>:</div><div>{{ $data->institution_city }}</div>
            </div>
        </div>

        <div class="flex justify-between gap-2 mb-2">
            <div class="flex flex-col border border-gray-800 w-[50%]">
                <p class="text-[20px] font-bold mt-2.5 text-center">Anggota 1</p>
                {{-- <div class="ml-6 grid grid-cols-[40%,60%] text-[12px] w-[70%] my-2">
                    <div class="font-bold">Nama Lengkap</div><div>: {{ $data->members[0]->name }}</div>
                    <div class="font-bold">NISN / NIM</div><div>: {{ $data->members[0]->participant_id }}</div>
                    <div class="font-bold">Tanggal Lahir</div><div>: {{ $data->members[0]->date_of_birth }}</div>
                    <div class="font-bold">No. Handphone</div><div>: {{ $data->members[0]->no_wa }}</div>
                    <div class="font-bold">Email</div><div>: {{ $data->members[0]->email }}</div>
                </div> --}}
                <div class="ml-6 grid grid-cols-[38%,2%,60%] text-[12px] w-[90%] my-2">
                    <div class="font-bold">Nama Lengkap</div><div>:</div><div>{{ $data->members[0]->name }}</div>
                    <div class="font-bold">NISN / NIM</div><div>:</div><div>{{ $data->members[0]->participant_id }}</div>
                    <div class="font-bold">Tanggal Lahir</div><div>:</div><div>{{ $data->members[0]->date_of_birth }}</div>
                    <div class="font-bold">No. Handphone</div><div>:</div><div>{{ $data->members[0]->no_wa }}</div>
                    <div class="font-bold">Email</div><div>:</div><div>{{ $data->members[0]->email }}</div>
                    <div class="font-bold">Gender</div><div>:</div><div>{{ $data->members[0]->gender }}</div>
                </div>
            </div>
            <div class="flex flex-col border border-gray-800 w-[50%]">
                <p class="text-[20px] font-bold mt-2.5 text-center">Anggota 2</p>
                {{-- <div class="ml-6 grid grid-cols-[40%,60%] text-[12px] w-[70%] my-2">
                    <div class="font-bold">Nama Lengkap</div><div>: {{ $data->members[1]->name }}</div>
                    <div class="font-bold">NISN / NIM</div><div>: {{ $data->members[1]->participant_id }}</div>
                    <div class="font-bold">Tanggal Lahir</div><div>: {{ $data->members[1]->date_of_birth }}</div>
                    <div class="font-bold">No. Handphone</div><div>: {{ $data->members[1]->no_wa }}</div>
                    <div class="font-bold">Email</div><div>: {{ $data->members[1]->email }}</div>
                </div> --}}
                <div class="ml-6 grid grid-cols-[38%,2%,60%] text-[12px] w-[90%] my-2">
                    <div class="font-bold">Nama Lengkap</div><div>:</div><div>{{ $data->members[1]->name }}</div>
                    <div class="font-bold">NISN / NIM</div><div>:</div><div>{{ $data->members[1]->participant_id }}</div>
                    <div class="font-bold">Tanggal Lahir</div><div>:</div><div>{{ $data->members[1]->date_of_birth }}</div>
                    <div class="font-bold">No. Handphone</div><div>:</div><div>{{ $data->members[1]->no_wa }}</div>
                    <div class="font-bold">Email</div><div>:</div><div>{{ $data->members[1]->email }}</div>
                    <div class="font-bold">Gender</div><div>:</div><div>{{ $data->members[0]->gender }}</div>
                </div>
            </div>
        </div>

        <!-- Kategori Kompetisi -->
        <div class="border border-gray-800 px-3 py-1.5 mb-2 flex w-[100%]">
            <div class="font-bold text-xl w-[50%]">Kategori Kompetisi</div>
            <div class="text-xl font-semibold text-blue-800 flex items-center w-[50%]">
                : {{ $data->competition->name }}
            </div>
        </div>

        <!-- Rincian Pembayaran -->
        <div class="border border-gray-800 mb-2.5">
            <div class="font-bold mb-2 border-b border-gray-800 p-2 text-xl ">Rincian Pembayaran:</div>
            <div class="flex justify-between pb-1 px-3">
                <span>Biaya Pendaftaran kompetisi Fisika Astronomi</span>
                <span>Rp. {{ $data->subtotal }}</span>
            </div>
            <div class="flex justify-between pb-1 px-3">
                <span>Biaya Aplikasi</span>
                <span>Rp. 1.000</span>
            </div>
            <div class="flex justify-between pb-1 px-3">
                <span>Potongan Kupon</span>
                <span>-Rp. {{ $data->subtotal - $data->total }}</span>
            </div>
            <div class="flex justify-between font-bold pt-2 text-lg px-3">
                <span>Total</span>
                <span>Rp. {{ $data->total }}</span>
            </div>
        </div>

        

        <!-- Catatan -->
        <p class="text-xs text-justify leading-relaxed border border-gray-800 p-2">
            Gunakan formulir ini sebagai bukti valid pendaftaran Anda dalam kegiatan <span class="font-semibold">Udayana Physics Championship (UPC) 2025</span> sebagaimana mestinya. Bila Anda merasa terdapat kesalahan, maka dipersilakan untuk menghubungi CP Humas UPC 2025 yang tertera pada bagian header formulir.
        </p>
    </div>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 -z-40">
        <img src="{{ public_path('assets/hero.png') }}" alt="">
    </div>

    <footer class="absolute bottom-0">
        <img src="{{ public_path('assets/footer1.png') }}" alt="">
    </footer>
</body>
</html>

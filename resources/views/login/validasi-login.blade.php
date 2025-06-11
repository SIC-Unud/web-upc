<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Validasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@extends('layouts.main')
@section('title', 'Status Validasi')
@section('content')

<!-- Reuse whole login page layout as blurred background -->
<div class="relative min-h-screen overflow-hidden">
  <!-- Background image layer -->
  <div class="absolute inset-0 z-0">
    <div class="bg-[url('/assets/login/bg.png')] bg-cover bg-center w-full h-full"></div>
  </div>

  <!-- Blur overlay over full page -->
  <div class="absolute inset-0 backdrop-blur-md z-10"></div>

  <!-- Foreground content -->
  <div class="relative z-20 flex items-center justify-center min-h-screen px-4">
    <div class="relative bg-black/80 border border-white px-6 py-10 max-w-xl w-full">
        <img class="absolute -top-4 -left-4 w-28" src="/assets/login/l-corner.png" alt="">
        <img class="absolute -bottom-4 -right-4 w-28" src="/assets/login/r-corner.png" alt="">
        <div class="absolute -top-[1px] -right-[6px] bg-white w-[6px] h-6"></div>
        <div class="absolute -top-[1px] -right-[2px] bg-white w-[1.5px] h-15"></div>

        <h1 class="text-3xl font-bold mb-4 text-white">Yudhistira Arimbawa Saputra</h1>
        <div class="mb-4">
            <span class="inline-block bg-yellow-400 text-black font-semibold px-4 py-1 rounded-full text-sm">Sedang divalidasi.</span>
        </div>
        <div class="space-y-2 text-sm md:text-base text-white">
            <p><strong>Nama Instansi</strong>: SMA Negeri 2 Kuta</p>
            <p><strong>Kategori Kompetisi</strong>: Kompetisi Astronomi</p>
            <p><strong>Tanggal Registrasi</strong>: 29–05–2025 17:30:00</p>
        </div>

        <p class="mt-6 text-sm leading-relaxed text-white">
            Akun anda sedang dalam peninjauan oleh pihak panitia. Peninjauan akan memakan waktu paling lambat H+3 hari kerja. Jika anda merasa tidak terdapat perubahan setelah waktu yang ditentukan, dipersilahkan untuk menghubungi cp humas UPC dengan mencantumkan no. registrasi anda dan bukti pembayaran.
        </p>

        <div class="mt-8 text-center">
            <button class="bg-gradient-to-r from-[#12B1EB] to-[#FFD900] px-6 py-2 text-black font-bold rounded-md">OK</button>
        </div>
    </div>
  </div>
</div>

@endsection
</body>
</html>

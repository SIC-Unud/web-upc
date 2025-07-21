@extends('layouts.main')

@section('title', 'Registration')

@section('content')
     {{-- content --}}
     <div class="bg-[url(../../public/assets/register/bg.png)] font-jakarta min-h-screen pt-18">
         <div class="backdrop-blur-2xl bg-black/55 min-h-screen flex items-center justify-center flex-col gap-4">
             <h1 class="font-bold text-4xl md:text-5xl text-center text-white">{{ $isLate ? 'Registrasi Sudah Berakhir' : 'Registrasi Belum Dibuka' }}</h1>
             <a href="/"
                 class="mx-5 cursor-pointer relative z-10 flex w-fit justify-center items-center py-4 px-[12px] backdrop-blur-sm bg-white/10 md:py-[30px] md:px-[30px]">
                 <div class="absolute w-px h-full left-0 top-0 bg-[#12B1EB]"></div>
                 <div class="absolute w-px h-full right-0 top-0 bg-[#FFD900]"></div>
                 <div class="absolute top-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                 <div class="absolute bottom-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                 <div class="text-[13px] text-white leading-6 mr-[8px] font-julius md:mr-6 md:text-2xl">KE BERANDA
                 </div>
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-3 md:size-6  text-white">
                 <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                 </svg>
             </a>
         </div>
     </div>
@endsection
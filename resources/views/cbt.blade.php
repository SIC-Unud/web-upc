@extends('layouts.cbt-peserta')

@section('title', 'Soal')

@section('content')
   @php
      $pilihan = [
          'A. Jupiter adalah planet terkecil di tata surya.',
          "B. Pluto masih dianggap sebagai planet
               utama hingga saat ini.",
          "C. Planet dalam (terestrial) sebagian besar
               terdiri dari gas.",
          "D. Merkurius merupakan planet terdekat
               dengan Matahari.",
          "E. Uranus termasuk dalam kelompok planet
               terestrial.",
      ];

      $NoSoal = [
          '1',
          '2',
          '3',
          '4',
          '5',
          '6',
          '7',
          '8',
          '9',
          '10',
          '11',
          '12',
          '13',
          '14',
          '15',
          '16',
          '17',
          '18',
          '19',
          '20',
          '21',
          '22',
          '23',
          '24',
          '25',
          '26',
          '27',
          '28',
          '29',
          '30',
          '31',
          '32',
          '33',
          '34',
          '35',
          '36',
          '37',
          '38',
          '39',
          '40',
      ];
   @endphp
   <div class="flex flex-col font-jakarta gap-5 lg:gap-9 md:flex-row">

      {{-- Tombol SideBar di Mobile & Tablet --}}
      <div x-bind:class="isOpen ? 'left-44' : 'left-0'"
         class="py-1 px-3 flex gap-2 items-center fixed top-11 z-20 bg-white shadow-[0_0_30px_rgba(0,0,0,0.25)] rounded-br-xl lg:hidden">
         <button x-on:click="isOpen = !isOpen" class="cursor-pointer" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
               <path fill-rule="evenodd"
                  d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z"
                  clip-rule="evenodd" />
            </svg>
         </button>
         <h2 class="font-bold">Soal</h2>
      </div>
      {{-- Tombol SideBar di Mobile & Tablet --}}

      {{-- Countdown di Mobile & Tablet --}}
      <div
         class="fixed top-11 right-0 z-20 bg-white shadow-[0_0_30px_rgba(0,0,0,0.25)] rounded-bl-xl py-1 px-5 text-center font-bold lg:hidden">
         119:20
      </div>
      {{-- Countdown di tablet --}}

      {{-- Soal --}}
      <div class="drop-shadow-xl bg-white rounded-2xl p-3 lg:p-6 md:w-3/5 lg:w-2/5">
         <h2 class="font-bold mb-3 lg:mb-6 md:text-xl lg:text-2xl">Soal No. 1</h2>
         <div class="flex justify-center">
            <img src="/assets/contoh-soal.png" alt="" class="mb-3 items-center w-85 md:w-90 lg:w-auto lg:mb-6">
         </div>
         <p class="text-[12px] md:text-sm text-justify">Tata surya kita terdiri dari Matahari sebagai pusatnya dan berbagai
            benda langit
            yang
            mengitarinya, termasuk
            planet, asteroid, komet, dan meteoroid. Planet-planet di tata surya terbagi menjadi dua kelompok utama, yaitu
            planet dalam (terestrial) yang berbatu dan planet luar (gas raksasa) yang sebagian besar terdiri dari gas.
            Planet terdekat dari Matahari adalah Merkurius, sedangkan planet terbesar adalah Jupiter. Selain itu, Pluto
            yang dahulu dianggap sebagai planet kini diklasifikasikan sebagai planet katai. Berdasarkan paragraf di atas,
            manakah pernyataan yang benar tentang tata surya?
         </p>
      </div>
      {{-- Soal --}}

      {{-- Pilihan --}}
      <div class=" md:w-2/5">
         <h2 class="font-bold md:text-xl lg:text-2xl mb-3 lg:mb-6">Pilihan</h2>
         <div class="flex flex-col gap-2 md:gap-3">
            @foreach ($pilihan as $pil)
               <div
                  class="drop-shadow-sm text-wrap bg-white rounded-lg  cursor-pointer hover:bg-[#007BFF] hover:text-white text-[12px] py-2 px-3 md:text-sm lg:py-4 lg:px-5">
                  {{ $pil }}</div>
            @endforeach
         </div>
      </div>
      {{-- Pilihan --}}

      <div class="lg:w-1/5 lg:block hidden">
         {{-- Menu Soal --}}
         <div class="drop-shadow-xl bg-white rounded-2xl p-6 lg:mb-6">
            <h2 class="font-bold text-2xl mb-4">Soal</h2>
            <div class="grid grid-cols-6 gap-2">
               @foreach ($NoSoal as $No)
                  <button
                     class="bg-white drop-shadow-lg size-7 items-center text-[12px] md:text-sm rounded-sm cursor-pointer hover:bg-[#007BFF] hover:text-white">{{ $No }}</button>
               @endforeach
            </div>

         </div>
         {{-- Menu Soal --}}

         {{-- Countdown di Desktop --}}
         <div class="drop-shadow-xl bg-white rounded-2xl py-8 px-4 text-center font-bold text-xl">
            119:20
         </div>
         {{-- Countdown di Desktop --}}
      </div>

   </div>


@endsection

@section('modal')
   {{-- Modal Pas Masuk --}}
   {{-- <x-cbtModal></x-cbtModal> --}}
   {{-- Modal Pas Masuk --}}

   {{-- Modal Kalo User mau Keluar dari Tes --}}
   {{-- <x-cbtAlert></x-cbtAlert> --}}
   {{-- Modal Kalo User mau Keluar dari Tes --}}

   {{-- Modal kalo User dah kelar buat Tes --}}
   {{-- <x-cbt-finish-modal></x-cbt-finish-modal> --}}
   {{-- Modal kalo User dah kelar buat Tes --}}
@endsection

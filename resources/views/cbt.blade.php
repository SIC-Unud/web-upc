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
   <div class="flex font-jakarta gap-9">
      {{-- Soal --}}
      <div class="drop-shadow-xl bg-white rounded-2xl py-6 px-6 w-2/5">
         <h2 class="font-bold text-2xl mb-6">Soal No. 1</h2>
         <div class="flex justify-center">
            <img src="/assets/contoh-soal.png" alt="" class="mb-6 items-center ">
         </div>
         <p class="text-sm text-justify">Tata surya kita terdiri dari Matahari sebagai pusatnya dan berbagai benda langit
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
      <div class=" w-2/5">
         <h2 class="font-bold text-2xl mb-6">Pilihan</h2>
         <div class="flex flex-col gap-3">
            @foreach ($pilihan as $pil)
               <div class="drop-shadow-sm text-wrap bg-white rounded-lg py-4 px-5 cursor-pointer">{{ $pil }}</div>
            @endforeach
         </div>
      </div>
      {{-- Pilihan --}}


      <div class="w-1/5">
         {{-- Menu Soal --}}
         <div class="drop-shadow-xl bg-white rounded-2xl py-6 px-6 mb-6">
            <h2 class="font-bold text-2xl mb-4">Soal</h2>
            <div class="grid grid-cols-6 gap-2">
               @foreach ($NoSoal as $No)
                  <button
                     class="bg-white drop-shadow-lg size-7 items-center text-sm rounded-sm cursor-pointer">{{ $No }}</button>
               @endforeach
            </div>

         </div>
         {{-- Menu Soal --}}

         {{-- Countdown --}}
         <div class="drop-shadow-xl bg-white rounded-2xl py-8 px-4 text-center font-bold text-xl">
            119:20
         </div>
         {{-- Countdown --}}
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

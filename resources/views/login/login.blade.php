@extends('layouts.main')
@section('title', 'Home')
@section('content')
@php
   $data = session('data');
@endphp

<div class="bg-black flex justify-between relative overflow-visible px-4">
   <img src="/assets/Logolayout.png" alt="" class="w-11 py-4 md:w-28 md:pl-[30px] md:py-[19px]">
   <button class="tombolMenu cursor-pointer">
      <img src="/assets/garis3.png" alt="" class="w-5 py-4 md:w-18 md:py-[19px] md:pr-[30px]">
   </button>
   <div
      class="h-1 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
   </div>
   <div
      class="h-1 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
   </div>

   <div class="menu hidden absolute z-50 right-4 border border-white bg-black text-2xl -bottom-27 md:-bottom-70 md:w-[383px]">
      <div class="text-white py-3 md:py-12 md:px-8">
         <div class="relative text-center font-julius px-3 mx-3 text-xs pb-2 md:pb-5 md:text-2xl">
            <a href="/register">DAFTAR</a>
            <div class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
            </div>
            <div class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
            </div>
         </div>
         <div class="relative text-center font-julius px-3 mx-3 text-xs py-2 md:py-5 md:text-2xl">
            <a href="/login">MASUK</a>
            <div class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
            </div>
            <div class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
            </div>
         </div>
         <div class="text-center font-julius px-3 mx-3 text-xs pt-2 md:pt-5 md:text-2xl">
            <a href="">PETUNJUK TEKNIS</a>
         </div>
      </div>
   </div>
</div>

   <div class="bg-[url(../../../public/assets/login/bg.png)] bg-cover bg-no-repeat bg-center bg-scroll">
   <div class="flex justify-center items-center">
      <div class="text-center w-fit mx-auto mb-2 pt-6">
         <h1 class="font-julius text-white text-[10px]">UDAYANA PHYSICS CHAMPIONSHIP</h1>
         <img class="w-[200px] pt-2" src="/assets/login/Logo.png" alt="logo UPC">
      </div>
   </div>  
   <div class="flex justify-center items-start">
      <img class="hidden lg:block" src="/assets/login/PurpleCat.png" alt="">
      <form  action="{{ route('loginpost') }}" method="POST" class="mt-5">
         @csrf
         <div>
            <div class="border relative border-white bg-black/70 w-fit px-4 pb-7 pt-5 max-w-full mx-10 md:w-[525px] md:px-7 md:py-10">
               <img class="absolute -top-1 md:-top-1.5 -left-1.25 md:-left-2 w-16 md:w-24" src="/assets/login/l-corner.png" alt="">
               <img class="absolute -bottom-1.25 md:-bottom-1.75 -right-1.25 md:-right-1.75 w-16 md:w-24" src="/assets/login/r-corner.png" alt="">
               <div class="absolute -top-[1px] -right-[6px] bg-white w-[6px] h-6"></div>
               <div class="absolute -top-[1px] -right-[2px] bg-white w-[1.5px] h-15"></div>
               <h1 class="text-white font-jakarta text-[44px] md:text-7xl font-bold text-center">Masuk</h1>
               <input type="email" name="email" placeholder="Email" class="border bg-gray-100 rounded-none w-full mt-5 md:mt-10 p-1">
               <input type="password" name="password" placeholder="Password" class="border bg-gray-100 rounded-none w-full mt-7 p-1 z-100">
            </div>
            <div class="flex justify-center">
               <button type="submit" class="bg-black/65 justify-center items-center cursor-pointer relative z-10 flex my-8 py-4 w-[150px] md:w-[300px]">
                  <div class="absolute w-px h-full left-0 top-0 bg-[#12B1EB]"></div>
                  <div class="absolute w-px h-full right-0 top-0 bg-[#FFD900]"></div>
                  <div class="absolute top-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                  <div class="absolute bottom-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                  <p class="font-julius text-white text-base md:text-xl text-center">Masuk</p>
               </button>
            </div>
         </div>        
      </form>
         <img class="hidden lg:block" src="assets/login/kuning.png" alt="">
   </div>
   </div>


<!-- POPUP VALIDASI -->
@if($data)
   <div id="PopUpValidasi" class="fixed inset-0 backdrop-blur-md bg-scroll flex items-center justify-center z-50 hidden">
      <div class="relative bg-black border border-white text-white mx-7 md:w-[62rem] h-fit p-11 font-jakarta">
         <div class="max-h-[70vh] overflow-y-auto pr-2">
         @if ($data->participant->leader_name)
            <h1 class="font-jakarta text-xl md:text-3xl font-bold mb-2">{{ $data->participant->leader_name }}</h1>
         @endif
         
         @if($data->participant->is_rejected)
         <div class="inline-block bg-[#FF0000] text-white font-bold px-5 py-1 rounded-full mb-6 text-sm md:text-lg">
            Gagal validasi.
         </div>
         @else
         <div class="inline-block bg-[#DEBD00] text-white font-bold px-5 py-1 rounded-full mb-6 text-sm md:text-lg">
         Sedang divalidasi.
         </div>
         @endif

         <div class="grid grid-cols-[min-content_auto] md:grid-cols-[max-content_auto] gap-x-2 gap-y-4 text-sm md:text-lg mb-6">
            <span class="font-bold">Nama Instansi</span>
            <span>: {{ $data->participant->institution }}</span>
            <span class="font-bold">Kategori Kompetisi</span>
            <span>: {{ $data->participant->competition->name }}</span>
            <span class="font-bold">Tanggal Registrasi</span>
            <span>: {{ $data->participant->created_at }}</span>
         </div>

         @if($data->participant->is_rejected)
            <p class="text-sm md:text-lg leading-relaxed mb-2 text-justify">Catatan</p>
            <p class="text-sm md:text-lg leading-relaxed mb-6 text-justify">{{ $data->participant->reject_message }}</p>
         @else
            <p class="text-sm md:text-lg leading-relaxed mb-6 text-justify">
            Akun anda sedang dalam peninjauan oleh pihak panitia. Peninjauan akan memakan waktu paling lambat H+3 hari kerja. Jika anda merasa tidak terdapat perubahan setelah waktu yang ditentukan, dipersilahkan untuk menghubungi cp humas UPC dengan mencantumkan no. registrasi anda dan bukti pembayaran.
            </p>
         @endif

         <div class="flex justify-end mt-8">
            <button>
               <div class="bg-black/65 justify-center items-center cursor-pointer relative z-100 flex py-4 w-[75px] md:w-[150px]">
                  @if($data->participant->is_rejected)
                     <div class="absolute w-px h-full left-0 top-0 bg-[#12B1EB]"></div>
                     <div class="absolute w-px h-full right-0 top-0 bg-[#FFD900]"></div>
                     <div class="absolute top-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <div class="absolute bottom-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <p class="font-julius text-white text-lg md:text-xl text-center">PERBAIKI FORMULIR</p>
                  @else
                     <div class="absolute w-px h-full left-0 top-0 bg-[#12B1EB]"></div>
                     <div class="absolute w-px h-full right-0 top-0 bg-[#FFD900]"></div>
                     <div class="absolute top-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <div class="absolute bottom-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <p class="font-julius text-white text-lg md:text-xl text-center">OK</p>
                  @endif
               </div>
            </button>
         </div>
      </div>

      <!-- Corner images -->
      <img class="absolute -top-2 -left-2 z-50 w-28" src="/assets/login/l-corner.png" alt="">
      <img class="absolute -bottom-2 -right-2 z-50 w-28" src="/assets/login/r-corner.png" alt="">
      <div class="absolute -top-[1px] -right-[6px] bg-white z-50 w-[6px] h-6"></div>
      <div class="absolute -top-[1px] -right-[2px] bg-white z-50 w-[1.5px] h-16"></div>

      </div>
   </div>
@endif
</div>
@endsection

@section('script')
@if($data)
<script>
   window.addEventListener('load', function () {
      const popupValidasi = document.getElementById('PopUpValidasi');
      if (popupValidasi && popupValidasi.classList.contains('hidden')) {
         popupValidasi.classList.remove('hidden');
         popupValidasi.classList.add('flex');
      }

      const tombolOK = popupValidasi.querySelector('button');
      tombolOK?.addEventListener('click', function () {
         popupValidasi.classList.add('hidden');
         popupValidasi.classList.remove('flex');
      });
   });
</script>
@endif
{{-- <script>
   // Toggle menu
   const tombol = document.querySelector('.tombolMenu')
   const menu = document.querySelector('.menu')
   tombol?.addEventListener('click', (event) => {
      event.preventDefault()
      menu?.classList.toggle('hidden')
   })

   // Jalankan saat halaman selesai dimuat
   window.addEventListener('load', function () {
      const popupValidasi = document.getElementById('PopUpValidasi');
      const tombolOK = popupValidasi?.querySelector('button');

      // Jika popup aktif (class "flex"), pasang handler tombol OK
      if (popupValidasi?.classList.contains('flex')) {
         tombolOK?.addEventListener('click', function () {
            popupValidasi.classList.add('hidden');
            popupValidasi.classList.remove('flex');
         });
      }
   });
</script> --}}
{{-- <script>
   const tombol = document.querySelector('.tombolMenu')
   const menu = document.querySelector('.menu')
   tombol.addEventListener('click', (event) => {
      event.preventDefault()
      if (menu.classList.contains('hidden')) {
         menu.classList.remove('hidden')
      } else menu.classList.add('hidden')
   })

   window.addEventListener('load', function () {
   const form = document.querySelector('form');
   const popupValidasi = document.getElementById('PopUpValidasi');

   if (form && popupValidasi) {
      form.addEventListener('submit', function (e) {
         e.preventDefault();
         popupValidasi.classList.remove('hidden');
         popupValidasi.classList.add('flex');
      });

      // tombol OK
      const tombolOK = popupValidasi.querySelector('button');
      tombolOK?.addEventListener('click', function () {
         popupValidasi.classList.add('hidden');
         popupValidasi.classList.remove('flex');
      });
   }
});
</script> --}}
@endsection

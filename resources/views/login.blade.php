@extends('layouts.main')
@section('title', 'Login')
@section('content')
@php
   $data = session('data');
@endphp
   <div class="bg-[url(../../public/assets/login/bg.png)] bg-cover py-25 md:pb-0 overflow-hidden">
      <div class="flex justify-center items-center flex-col">
         <h1 class="text-white text-xs text-center font-julius">UDAYANA PHYSICS CHAMPIONSHIP</h1>
         <img class="w-[100px] md:w-[250px] mt-5" src="/assets/login/Logo.png" alt="logo UPC">
      </div>  
      <div class="flex justify-center items-center">
         <img class="hidden lg:block" src="/assets/cat/purple.png" alt="">
         <form  action="{{ route('login.post') }}" method="POST" class="mb-2">
            @csrf
            <div>
               <div class="border relative border-white bg-black/70 w-fit px-2 pb-7 pt-3 max-w-full my-4 mx-12 md:w-[525px] md:px-5 md:py-8">
                  <img class="absolute -top-1 md:-top-1.5 -left-1.25 md:-left-2 w-16 md:w-24" src="/assets/login/l-corner.png" alt="">
                  <img class="absolute -bottom-1.25 md:-bottom-1.75 -right-1.25 md:-right-1.75 w-16 md:w-24" src="/assets/login/r-corner.png" alt="">
                  <div class="absolute -top-[1px] -right-[6px] bg-white w-[6px] h-6"></div>
                  <div class="absolute -top-[1px] -right-[2px] bg-white w-[1.5px] h-15"></div>
                  <h1 class="text-white font-jakarta text-xl md:text-5xl font-bold text-center">Masuk</h1>
                  <input type="email" name="email" placeholder="Email" class="border bg-gray-100 rounded-none text-sm md:text-base w-full mt-5 md:mt-7 p-2 h-9 md:h-12">
                  @error('email')
                     <div class="text-red-500">{{ $message }}</div>
                  @enderror
                  <input type="password" name="password" placeholder="Password" class="border bg-gray-100 rounded-none text-sm md:text-base w-full mt-5 h-9 md:h-12 p-2 z-100">
               </div>
               <div class="flex justify-center">
                  <button type="submit" class="bg-black/65 justify-center items-center cursor-pointer relative z-10 flex my-3 py-3 h-10 md:w-fit md:px-20 md:py-7 w-full mx-12">
                     <div class="absolute w-px h-full left-0 top-0 bg-[#12B1EB]"></div>
                     <div class="absolute w-px h-full right-0 top-0 bg-[#FFD900]"></div>
                     <div class="absolute top-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <div class="absolute bottom-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <p class="font-julius text-white text-xs md:text-xl text-center">Masuk</p>
                  </button>
               </div>
            </div>        
         </form>
         <img class="hidden lg:block" src="/assets/cat/yellow.png" alt="">
      </div>
   </div>


<!-- POPUP VALIDASI -->
@if($data)
   <div id="PopUpValidasi" class="fixed inset-0 backdrop-blur-md bg-scroll flex items-center justify-center z-[999999] hidden">
      <div class="relative bg-black border border-white text-white mx-7  md:w-[62rem] h-fit p-5 md:p-11 mt-5 mb-15 md:mb-0 font-jakarta">
         <div class="max-h-[50vh] overflow-y-auto pr-2">
         @if ($data->participant->leader_name)
            <h1 class="font-jakarta  text-xs md:text-3xl font-bold mb-1 md:mb-2">{{ $data->participant->leader_name }}</h1>
         @endif
         
         @if($data->participant->is_rejected)
         <div class="inline-block bg-[#FF0000] text-white font-bold px-5 py-1 rounded-full mb-3 md:mb-6 text-[8px] md:text-lg">
            Gagal validasi.
         </div>
         @else
         <div class="inline-block bg-[#DEBD00] text-white font-bold px-5 py-1 rounded-full mb-3 md:mb-6 text-[8px] md:text-lg">
         Sedang divalidasi.
         </div>
         @endif

         <div class="grid grid-cols-[max-content_auto] gap-x-2 gap-y-2 md:gap-y-4 text-[8px] md:text-lg mb-3 md:mb-6">
            <span class="font-bold">Nama Instansi</span>
            <span>: {{ $data->participant->institution }}</span>
            <span class="font-bold">Kategori Kompetisi</span>
            <span>: {{ $data->participant->competition->name }}</span>
            <span class="font-bold">Tanggal Registrasi</span>
            <span>: {{ $data->participant->created_at }}</span>
         </div>

         @if($data->participant->is_rejected)
            <p class="text-[8px] md:text-lg leading-relaxed mb-2 text-justify font-bold">Catatan</p>
            <p class="text-[8px] md:text-lg leading-relaxed mb-3 md:mb-6 text-justify">{{ $data->participant->reject_message }}</p>
         @else
            <p class="text-[8px] md:text-lg leading-relaxed mb-3 md:mb-6 text-justify">
            Akun anda sedang dalam peninjauan oleh pihak panitia. Peninjauan akan memakan waktu paling lambat H+3 hari kerja. Jika anda merasa tidak terdapat perubahan setelah waktu yang ditentukan, dipersilahkan untuk menghubungi cp humas UPC dengan mencantumkan no. registrasi anda dan bukti pembayaran.
            </p>
         @endif

         <div class="flex justify-end mt-4 md:mt-8">
            <button>
               @if($data->participant->is_rejected)
                  <a href="{{ route('update-participant') }}" class="bg-black/65 justify-center items-center cursor-pointer relative z-100 flex py-2 md:py-4 w-[75px] md:w-[150px]">
                     <div class="absolute w-px h-full left-0 top-0 bg-[#12B1EB]"></div>
                     <div class="absolute w-px h-full right-0 top-0 bg-[#FFD900]"></div>
                     <div class="absolute top-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <div class="absolute bottom-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <p class="font-julius text-white text-[10px] md:text-xl text-center">PERBAIKI FORMULIR</p>
                  </a>
               @else
                  <div class="bg-black/65 justify-center items-center cursor-pointer relative z-100 flex py-2 md:py-4 w-[75px] md:w-[150px]">
                     <div class="absolute w-px h-full left-0 top-0 bg-[#12B1EB]"></div>
                     <div class="absolute w-px h-full right-0 top-0 bg-[#FFD900]"></div>
                     <div class="absolute top-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <div class="absolute bottom-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                     <p class="font-julius text-white text-[10px] md:text-xl text-center">OK</p>
                  </div>
               @endif
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
@endsection

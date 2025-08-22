@extends('layouts.side-bar')

@section('content')
     <div x-data="{ showConfirm = true }" class="font-jakarta" >
          
          <header class="flex justify-between lg:mb-4 mb-2">
               <h1 class="text-[#4C4C4C] font-bold lg:text-4xl text-2xl">Kompetisi</h1>
               <button x-on:click="showConfirm = true" class="bg-[#00C482] rounded-md lg:px-6 px-3 lg:py-3 py-1.5 cursor-pointer flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 lg:size-5" fill="white" viewBox="0 0 16 16">
                         <path d="M11 2H9v3h2z"/>
                         <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                    </svg>
                    <p class="hidden md:block md:text-base lg:text-lg text-white font-semibold">Simpan</p>
               </button>
          </header>

          <main class="block md:flex justify-between lg:gap-5 md:gap-3 ">
               <div class="bg-white rounded-md lg:px-12 px-6 lg:py-8 py-4 w-fit grow shadow-lg mb-2 md:mb-0">
                    <h2 class="md:text-xl text-base font-semibold lg:mb-4 mb-2">Penyisihan Astronomi</h2>
                    <label class="border w-full lg:h-30 h-20 flex lg:py-4 py-2 justify-center items-center gap-4 mb-4 rounded-md" for="test">
                         <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-8 w-6 lg:h-7 h-5"  fill="currentColor" class="bi bi-file-earmark-image" viewBox="0 0 16 16">
                              <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                              <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1z"/>
                         </svg>
                         <p class="lg:text-2xl md:text-lg hidden md:block">Tambahkan Gambar</p>
                    </label>
                    <input class="hidden" type="file" name="" id="test">

                    <textarea class="border rounded-md lg:p-3 p-1.5 w-full lg:mb-4 mb-2 h-auto min-h-15 lg:min-h-0 resize-y lg:text-base text-xs" rows="2" placeholder="Ketik soal..."></textarea>

                    <div class="grid grid-cols-[repeat(6,1fr)_auto] gap-x-2 gap-y-4 justify-center">
                         <div class="flex col-span-2 gap-2 items-center">
                              <label class="text-xs lg:text-base w-1/2">Banyak Opsi</label>
                              <select class="bg-[#D9D9D9] lg:w-12 md:w-1/2 text-center cursor-pointer" name="" id="">
                                   <option value="">1</option>
                                   <option value="">1</option>
                                   <option value="">1</option>
                              </select>
                         </div>
                         <div class="col-span-2 flex gap-2 items-center">
                              <label class="text-xs lg:text-base w-1/2">Poin Soal</label>
                              <select class="bg-[#D9D9D9] lg:w-12 md:w-1/2 text-center cursor-pointer" name="" id="">
                                   <option value="">1</option>
                                   <option value="">10</option>
                                   <option value="">1</option>
                              </select>
                         </div>
                         <div class="col-span-2 flex gap-2 items-center">
                              <label class="text-xs lg:text-base">Soal HOTS</label>
                              <input class="lg:size-4 size-3" type="checkbox" name="" id="">
                         </div>
                         <p class="flex place-self-center text-xs lg:text-base">Kunci</p>
                         
                         @for ($i = 1; $i <= 5; $i++)
                              <textarea class="lg:p-2 p-1 lg:text-base text-xs border col-span-6 rounded-md resize-y" rows="1" placeholder="Ketik Opsi {{ $i }}"></textarea>
                              <input class="flex place-self-center lg:size-6 size-4" type="checkbox" name="\" id="">
                         @endfor
                    </div>
               </div>

               <div class="flex flex-col gap-2 md:gap-4 ">
                    <div class="bg-white lg:px-4 lg:py-3 px-4 py-3 rounded-lg w-full md:w-fit shadow-lg order-2 md:order-1">
                         <h2 class="lg:text-lg sm:text-base font-bold md:pl-2 lg:mb-2 mb-1">Soal</h2>
                         <div class="sm:max-h-75 lg:max-h-fit lg:h-fit p-0 md:p-2 sm:overflow-y-auto lg:overflow-y-clip ">
                              <div class="grid lg:grid-cols-6 md:grid-cols-4 grid-cols-10 lg:grid-rows-9 gap-2">
                                   @for ($i = 1; $i <= 50; $i++)
                                        <button class="bg-white aspect-square p-1.5 flex justify-center items-center rounded-lg shadow-[0_0_10px_rgba(0,0,0,0.2)] cursor-pointer text-[10px] lg:text-[14px]">{{$i}}</button>
                                   @endfor
                              </div>
                         </div>
                    </div>
                    <div class="bg-white px-4 md:px-6 py-3 rounded-lg w-full shadow-lg order-1 md:order-2">
                         <h2 class="lg:text-lg sm:text-base font-bold lg:mb-2 sm:mb-1">Waktu</h2>
                         <div class="flex justify-start items-center gap-2">
                              <select class="bg-[#D9D9D9] text-center w-1/2 cursor-pointer " name="" id="">
                                   <option value="">1</option>
                                   <option value="">1</option>
                                   <option value="">1</option>
                              </select>                                   
                              <label class="lg:text-base sm:text-xs" for="">Menit</label>
                         </div>
                    </div>
               </div>
          </main>

          {{-- popup --}}
          <div
               x-show="showConfirm"
               x-transition.opacity
               x-cloak
               class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm"
               >
                    <div
                         class="bg-white p-6 rounded-lg shadow-xl w-80"
                         x-on:click.outside="showConfirm = false"
                    >
                         <h2 class="text-lg font-semibold mb-4">Konfirmasi Log Out</h2>
                         <p class="mb-2">Anda yakin ingin keluar dari akun? Pastikan semua perubahan telah disimpan.</p>
                         <div class="flex justify-end gap-3">
                              <button
                                   x-on:click="showConfirm = false"
                                   class="bg-gray-600 text-white px-4 py-1 rounded hover:bg-gray-800 cursor-pointer">
                                   Batal
                              </button>
     
                              <button 
                                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded cursor-pointer">
                                   Ya, Keluar
                              </button>
                         </div>
                    </div>
               </div>
          </div>

     </div>
     

@endsection
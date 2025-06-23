@extends('layouts.side-bar')
@section('content')
    <div class="bg-gray-100 w-full h-screen font-jakarta">
          <div class="flex justify-between items-center mb-4 lg:mb-8">
               <x-header>Manajemen User</x-header>
               <button class="flex items-center justify-between gap-2 bg-[#00C482] hover:bg-[#16ad7a] rounded-lg px-3 py-1 lg:px-5 lg:py-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-3 lg:size-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <p class="lg:text-base text-sm text-white">Export</p>
               </button>
          </div>
          <div x-data="{filter: false}" class="relative flex bg-white rounded-lg lg:gap-4 gap-2 items-center lg:px-8 lg:py-6 lg:mb-8 px-4 py-3 mb-4 shadow-xl">
               <div class="grow relative">
                    <input class="border lg:text-base text-sm rounded-lg lg:px-8 lg:py-2 px-5 py-1 w-full" type="text"  placeholder="Telusuri User...">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                         viewBox="0 0 24 24" stroke-width="1.5" 
                         stroke="currentColor" 
                         class="absolute lg:top-2 top-1.5 left-1 lg:size-6 size-4  ">
                         <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
               </div>
               <button @@click="filter = !filter" class="relative flex items-center justify-between gap-2 bg-[#007BFF] hover:bg-[#0062ff] rounded-lg lg:px-5 px-3 lg:py-3 py-1.5 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                         viewBox="0 0 24 24" stroke-width="1.5" 
                         stroke="white" class="size-4 lg:size-6">
                         <path stroke-linecap="round" stroke-linejoin="round" 
                              d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    <p class="lg:text-base text-sm text-white">Filter</p>
               </button>
               {{-- pop-up filter --}}
               <div x-show="filter"
                    class="lg:w-80 w-60 lg:h-65 h-fit max-w-full bg-[#ebebeb] rounded-lg shadow-2xl absolute lg:top-20 top-12 lg:right-8 right-4 z-50">
                    <div class="text-start lg:px-4 p-3 h-full w-full lg:py-3">
                         <div class="grid gap-2 items-center">
                              <div class="flex flex-col justify-between gap-2">
                                   <label class="block lg:text-base text-xs" for="">Status</label>
                                   <select class="lg:px-3 w-full p-1 lg:py-2 border bg-white border-white lg:text-base text-xs text-black" name="" id="">
                                        <option class="lg:text-base text-xs" value="">Pilih...</option>
                                        <option class="lg:text-base text-xs" value="">Diterima</option>
                                        <option class="lg:text-base text-xs" value="">Ditolak</option>
                                        <option class="lg:text-base text-xs" value="">Menunggu</option>
                                   </select>
                              </div>
                              <div class="flex flex-col justify-between gap-2">
                                   <label class="block lg:text-base text-xs" for="">Kompetisi</label>
                                   <select class="lg:px-3 p-1 lg:py-2 border bg-white border-white text-black lg:text-base text-xs" name="" id="">
                                        <option class="lg:text-base text-xs" value="">Pilih...</option>
                                        <option value="">Cerdas cermat SD (kelompok)</option>
                                        <option class="lg:text-base text-xs" value="">Fisika SMP</option>
                                        <option class="lg:text-base text-xs" value="">Fisika SMA</option>
                                        <option class="lg:text-base text-xs" value="">Kebumian</option>
                                        <option class="lg:text-base text-xs" value="">Astronomi</option>
                                        <option class="lg:text-base text-xs" value="">Esai (kelompok)</option>
                                        <option class="lg:text-base text-xs" value="">Poster Ilmiah (kelompok)</option>
                                   </select>
                              </div>
                              <div class="flex flex-col justify-between gap-2">
                                   <label class="block lg:text-base text-xs" for="">Waktu Registrasi</label>
                                   <input type="datetime-local" class="lg:text-base text-xs lg:px-3 p-1 lg:py-2 border bg-white border-white text-black" name="" id="">
                              </div>
                         </div>    
                    </div>
               </div>
          </div>

          <div class="overflow-x-auto mb-8 rounded-lg shadow-xl">
               <table class="min-w-full table-auto bg-[#D9D9D999]">
                    <thead class="border border-collapse border-b-3 border-gray-400">
                         <tr>
                              @foreach ($headers as $header)
                                   <th class="lg:py-3 lg:px-4 py-1 px-2 font-extralight lg:text-base text-sm">{{ $header }}</th>
                              @endforeach
                         </tr>
                    </thead>
                    <tbody class="bg-white">
                         @foreach ($users as $user)
                              <x-tbody :user="$user"/>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
@endsection
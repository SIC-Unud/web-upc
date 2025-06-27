@extends('layouts.side-bar')
@section('title', 'Manajemen User')
@section('content')
     <div class="bg-gray-100 w-full min-h-full flex flex-col font-jakarta">
          <div class="flex justify-between items-center mb-4 lg:mb-8">
               <x-header>Manajemen User</x-header>
               <a href="{{ route('participants.export', request()->query()) }}" class="flex items-center justify-between gap-2 bg-[#00C482] hover:bg-[#16ad7a] rounded-lg px-3 py-1 lg:px-5 lg:py-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="white" 
                         class="size-3 lg:size-6">
                         <path stroke-linecap="round" stroke-linejoin="round" 
                                   d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <p class="lg:text-base text-sm text-white">Export</p>
               </a>
          </div>
          <div x-data="{filter: false}" class="relative flex bg-white rounded-lg gap-2 items-center lg:px-8 lg:py-6 lg:mb-8 px-4 py-3 mb-4 shadow-xl">
               {{-- <div class="grow relative">
                    <input class="border lg:text-base text-sm rounded-lg lg:px-8 lg:py-2 px-5 py-1 w-full" type="text"  placeholder="Telusuri User...">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                         viewBox="0 0 24 24" stroke-width="1.5" 
                         stroke="currentColor" 
                         class="absolute lg:top-2 top-1.5 left-1 lg:size-6 size-4  ">
                         <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
               </div> --}}
               <form method="GET" class="flex grow items-center gap-2 relative w-full">
                    <div class="grow relative">
                         <input 
                              name="search"
                              value="{{ request('search') }}"
                              class="border lg:text-base text-sm rounded-lg lg:px-8 lg:py-2 px-5 py-1 w-full"
                              type="text"
                              placeholder="Telusuri User...">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                              viewBox="0 0 24 24" stroke-width="1.5" 
                              stroke="currentColor" 
                              class="absolute lg:top-2 top-1.5 left-1 lg:size-6 size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                         </svg>
                    </div>
                    <button type="submit" class="flex items-center justify-between gap-1 bg-[#00C482] hover:bg-[#16ad7a] rounded-lg lg:px-5 px-3 lg:py-2.5 py-1.5 cursor-pointer">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                              viewBox="0 0 24 24" stroke-width="1.5" 
                              stroke="white" 
                              class="lg:size-5 size-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                         </svg>
                         <p class="lg:text-base text-sm hidden lg:block text-white">Telusuri</p>
                    </button>
               </form>
               <button @@click="filter = !filter" class="relative flex items-center justify-between gap-2 bg-[#007BFF] hover:bg-[#0062ff] rounded-lg lg:px-5 px-3 lg:py-2.5 py-1.5 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                         viewBox="0 0 24 24" stroke-width="1.5" 
                         stroke="white" class="size-4 lg:size-6">
                         <path stroke-linecap="round" stroke-linejoin="round" 
                              d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    <p class="lg:text-base text-sm hidden lg:block text-white">Filter</p>
               </button>
               {{-- <button class="flex items-center justify-between gap-1 bg-[#00C482] hover:bg-[#16ad7a] rounded-lg lg:px-5 px-3 lg:py-2.5 py-1.5 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                         viewBox="0 0 24 24" stroke-width="1.5" 
                         stroke="white" 
                         class="lg:size-5 size-4">
                         <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <p class="lg:text-base text-sm hidden lg:block text-white">Telusuri</p>
               </button> --}}
               

               {{-- pop-up filter --}}
               <div x-show="filter"
                    x-cloak
                    x-transition
                    class="lg:w-80 w-64 max-w-full bg-[#ebebeb] rounded-lg shadow-2xl absolute lg:top-20 top-12 lg:right-40 right-16 z-50 overflow-hidden">
                    
                    <form method="GET" class="text-start px-4 py-3 w-full">
                         <div class="grid gap-4 w-full">
                              <div class="flex flex-col gap-1 w-full">
                                   <label class="text-xs lg:text-base">Status</label>
                                   <select name="status" class="w-full p-2 bg-white text-black text-xs lg:text-base rounded">
                                        <option value="">Pilih...</option>
                                        <option value="diterima">Diterima</option>
                                        <option value="ditolak">Ditolak</option>
                                        <option value="menunggu">Menunggu</option>
                                   </select>
                              </div>
                              <div class="flex flex-col gap-1 w-full">
                                   <label class="text-xs lg:text-base">Kompetisi</label>
                                   <select name="kompetisi" class="w-full p-2 bg-white text-black text-xs lg:text-base rounded">
                                        <option value="">Pilih...</option>
                                        @foreach ($competitions as $key => $competition)
                                             <option value="{{ $competition->id }}">{{ $competition->name }} {{ ($competition->is_team_competition ? '(kelompok)' : '') }}</option>
                                        @endforeach
                                        {{-- <option value="1">Cerdas cermat SD (kelompok)</option>
                                        <option value="2">Fisika SMP</option>
                                        <option value="3">Fisika SMA</option>
                                        <option value="4">Kebumian</option>
                                        <option value="5">Astronomi</option>
                                        <option value="6">Esai (kelompok)</option>
                                        <option value="7">Poster Ilmiah (kelompok)</option> --}}
                                   </select> 
                              </div>
                              {{-- <div class="flex flex-col gap-1 w-full">
                                   <label class="text-xs lg:text-base">Waktu Registrasi</label>
                                   <input name="waktu" type="datetime-local" class="w-full p-2 bg-white text-black text-xs lg:text-base rounded" />
                              </div> --}}
                              <div class="flex justify-center">
                                   <button type="submit" class="w-1/2 px-4 py-2 bg-[#007BFF] hover:bg-[#0062ff] text-xs lg:text-base text-white rounded-lg">
                              {{-- <div 
                                   class="flex justify-center"
                                   @@click="filter = false"> --}}
                                   {{-- <button class="w-1/2 px-4 py-2 bg-[#007BFF] hover:bg-[#0062ff] text-xs lg:text-base text-white rounded-lg"> --}}
                                        Cari
                                   </button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>

          <div class="overflow-x-auto mb-8 rounded-lg shadow-xl">
               <table class="min-w-full table-auto bg-[#D9D9D999]">
                    <thead class="border border-collapse border-b-3 border-gray-400">
                         <tr>
                              @foreach ($headers as $header)
                                   <th class="lg:py-2 lg:px-3 p-1 font-extralight lg:text-base text-sm">{{ $header }}</th>
                              @endforeach
                         </tr>
                    </thead>
                    <tbody class="bg-white">
                         {{-- @foreach ($users as $user) --}}
                         @foreach ($participants as $user)
                              <x-t2body :user="$user"/>
                         @endforeach
                    </tbody>
               </table>
               <div>
                    {{-- {{ $users->links() }} --}}
                    {{ $participants->links() }}
               </div>
          </div>
     </div>
@endsection
   {{-- <div class="bg-gray-100 w-full min-h-full flex flex-col font-jakarta">
      <div class="lg:flex justify-between items-center mb-4 lg:mb-8">
         <x-header>Manajemen User</x-header>
         <button
            class="flex items-center justify-between gap-2 bg-[#00C482] hover:bg-[#16ad7a] mt-2 lg:mt-0 rounded-lg px-3 py-1 lg:px-5 lg:py-2 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
               class="size-3 lg:size-6">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>
            <p class="lg:text-base text-xs text-white">Export</p>
         </button>
      </div>
      <div x-data="{ filter: false }"
         class="relative flex bg-white rounded-lg gap-2 items-center lg:px-8 lg:py-6 lg:mb-8 px-4 py-3 mb-4 shadow-xl">
         <div class="grow relative">
            <input class="border lg:text-base text-sm rounded-lg lg:px-8 lg:py-2 px-5 py-1 w-full" type="text"
               placeholder="Telusuri User...">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
               stroke="currentColor" class="absolute lg:top-2 top-1.5 left-1 lg:size-6 size-4  ">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
         </div>
         <button x-on:click="filter = !filter"
            class="relative flex items-center justify-between gap-2 bg-[#007BFF] hover:bg-[#0062ff] rounded-lg lg:px-5 px-3 lg:py-2.5 py-1.5 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
               class="size-4 lg:size-6">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>
            <p class="lg:text-base text-sm hidden lg:block text-white">Filter</p>
         </button>
         <button
            class="flex items-center justify-between gap-1 bg-[#00C482] hover:bg-[#16ad7a] rounded-lg lg:px-5 px-3 lg:py-2.5 py-1.5 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
               class="lg:size-5 size-4">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <p class="lg:text-base text-sm hidden lg:block text-white">Telusuri</p>
         </button>
         <div x-show="filter" x-cloak x-transition
            class="lg:w-80 w-40 max-w-full bg-[#ebebeb] rounded-lg shadow-2xl absolute lg:top-20 top-12 lg:right-40 right-16 z-50 overflow-hidden">
            <div class="text-start px-4 py-3 w-full">
               <div class="grid gap-4 w-full">
                  <div class="flex flex-col gap-1 w-full">
                     <label class="text-xs lg:text-base">Status</label>
                     <select class="w-full p-2 bg-white text-black text-xs lg:text-base rounded">
                        <option value="">Pilih...</option>
                        <option>Diterima</option>
                        <option>Ditolak</option>
                        <option>Menunggu</option>
                     </select>
                  </div>
                  <div class="flex flex-col gap-1 w-full">
                     <label class="text-xs lg:text-base">Kompetisi</label>
                     <select class="w-full p-2 bg-white text-black text-xs lg:text-base rounded">
                        <option value="">Pilih...</option>
                        <option>Cerdas cermat SD (kelompok)</option>
                        <option>Fisika SMP</option>
                        <option>Fisika SMA</option>
                        <option>Kebumian</option>
                        <option>Astronomi</option>
                        <option>Esai (kelompok)</option>
                        <option>Poster Ilmiah (kelompok)</option>
                     </select>
                  </div>
                  <div class="flex justify-center" x-on:click="filter = false">
                     <button
                        class="w-1/2 px-4 py-2 bg-[#007BFF] hover:bg-[#0062ff] text-xs lg:text-base text-white rounded-lg">
                        Cari
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="overflow-x-auto mb-8 rounded-lg shadow-xl">
         <table class="min-w-full table-auto bg-[#D9D9D999]">
            <thead class="border-b-3 border-gray-400">
               <tr>
                  @foreach ($headers as $header)
                     <th class="lg:py-2 lg:px-3 p-1 font-extralight lg:text-base text-xs">{{ $header }}</th>
                  @endforeach
               </tr>
            </thead>
            <tbody class="bg-white">
               @foreach ($paginatedUsers as $user)
                  <x-tbody :user="$user" />
               @endforeach
            </tbody>
         </table>
         <div>
            {{ $paginatedUsers->links() }}
         </div>
      </div>
   </div>
@endsection --}}

@extends('layouts.side-bar')

@section('title', 'Competitions')

@section('content')
   <div>
      <x-header class="mb-5 lg:mb-9">Kompetisi</x-header>
      <div 
            x-data="{
               showConfirm: false,
               selectedCompetition: null,
               countQuestionCompetition: null,
               statusCompetition: null
            }" 
            class="grid w-fit gap-3 grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 lg:gap-5"
      > 
         @foreach ($competitions as $competition)
            <div 
               class="cursor-pointer" 
               @click="
                  titleCompetition = '{{ $competition['title'] }}',
                  countQuestionCompetition = '{{ $competition['countQuestion'] }}'
                  statusCompetition = '{{ $competition['status'] }}'
                  showConfirm = '{{ $competition['is_cbt'] }}'
               "
            >
               <x-jadwal :is_cbt="$competition['is_cbt']">
                  <x-slot:title>{{ $competition['title'] }}</x-slot:title>
                  <x-slot:date>{{ $competition['date'] }}</x-slot:date>
                  <x-slot:status>{{ $competition['status'] }}</x-slot:status>
               </x-jadwal>
            </div>
         @endforeach
         <template x-if="showConfirm" transition.opacity>
            <div
                  class="fixed inset-0 flex bg-black/50 items-center justify-center w-screen h-screen backdrop-blur-sm z-50 font-jakarta">
                  <div class="bg-white p-6 rounded-lg shadow-xl w-120 max-w-full font-jakarta flex items-start gap-4">
                     <img src="{{ asset('/assets/competition/kompetisi.png') }}" class="max-w-32 w-full aspect-square object-cover" alt="Image Competition">
                     <div class="">
                        <div class="mb-10">
                           <h1 class="mb-3 font-bold text-xl" x-text="titleCompetition"></h1>
                           <template x-if="statusCompetition == 'Sedang Berlangsung'">
                              <p class="text-justify">
                                 Kompetisi ini terdiri atas 
                                 <span x-text="countQuestionCompetition"></span> 
                                 butir soal pilihan ganda
                              </p>
                           </template>
                           <template x-if="statusCompetition == 'Sudah Dikerjakan'">
                              <p class="text-success">Anda sudah menyelesaikan kompetisi ini.</p>
                           </template>
                           <template x-if="statusCompetition == 'Terlewati'">
                              <p class="text-danger">Waktu kompetisi sudah berakhir.</p>
                           </template>
                           <template x-if="statusCompetition != 'Sedang Berlangsung' && statusCompetition != 'Sudah Dikerjakan' && statusCompetition != 'Terlewati'">
                              <p class="text-warning">Kompetisi belum dimulai. Harap menunggu.</p>
                           </template>
                        </div>
                        <div class="flex justify-end">
                           <div class="flex gap-5 text-sm">
                                 <button class="bg-[#FF0000] text-white py-2 px-6 text-lg md:text-base cursor-pointer"
                                    x-on:click="showConfirm = false">Batal</button>
                                 <template x-if="statusCompetition != 'Sedang Berlangsung'">
                                    <button class="bg-[#4C4C4C] text-white py-2 px-6 text-lg md:text-base cursor-pointer">Mulai</button>
                                 </template>
                                 <template x-if="statusCompetition == 'Sedang Berlangsung'">
                                    <button class="bg-[#029161] text-white py-2 px-6 text-lg md:text-base cursor-pointer">Mulai</button>
                                 </template>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </template>
      </div>
   </div>
@endsection

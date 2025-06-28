@extends('layouts.side-bar')

@section('title', 'Dashboard')

@section('content')
   <div>
      <x-header>Dashboard</x-header>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-10">
         <x-statistik-section class="text-[#029161]">
            <x-slot:jumlah>{{ $countPartisipan }}</x-slot:jumlah>
            <x-slot:icon>
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                  <path
                     d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
               </svg>
            </x-slot:icon>
            Pendaftar
         </x-statistik-section>
         <x-statistik-section class="text-[#FFD900]">
            <x-slot:jumlah>{{ $countWaiting }}</x-slot:jumlah>
            <x-slot:icon>
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                  <path fill-rule="evenodd"
                     d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z"
                     clip-rule="evenodd" />
               </svg>
            </x-slot:icon>
            Menunggu
         </x-statistik-section>
         <x-statistik-section class="text-[#FF0000]">
            <x-slot:jumlah>{{ $countFailed }}</x-slot:jumlah>
            <x-slot:icon>
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                  <path fill-rule="evenodd"
                     d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                     clip-rule="evenodd" />
               </svg>
            </x-slot:icon>
            Gagal
         </x-statistik-section>
         <x-statistik-section class="text-[#029161]">
            <x-slot:jumlah>{{ $countSuccess }}</x-slot:jumlah>
            <x-slot:icon>
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                  <path fill-rule="evenodd"
                     d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z"
                     clip-rule="evenodd" />
               </svg>
            </x-slot:icon>
            Berhasil
         </x-statistik-section>
      </div>

      {{-- Grafik --}}
      <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
         <div class="w-full bg-white shadow-lg p-3 md:p-5 rounded-lg">
            <h1 class="text-lg md:text-xl lg:text-2xl font-extrabold mb-2 ml-2 md:mb-4 md:ml-4 ">Grafik Persebaran</h1>
            <canvas id="GrafikPersebaran" width="full"></canvas>
         </div>
         <livewire:trend-pendaftaran />
      </div>
   </div>
@endsection

@section('script')
   <script type="module">
      const ctx1 = document.getElementById('GrafikPersebaran')

      new Chart(ctx1, {
         type: 'bar',
         data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
               label: 'Peserta',
               data: {!! json_encode($totals) !!},
               borderWidth: 0,
               indexAxis: 'y',
               backgroundColor: [
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
                  '#D9D9D9',
               ]
            }]
         },
         options: {
            scales: {
               indexAxis: 'y',
            }
         }
      });
   </script>
   <script>
      document.addEventListener('alpine:init', () => {
         Alpine.data('trendChartComponent', () => ({
               chart: null,

               initChart(labels, data) {
                  this.renderChart(labels, data);

                  window.addEventListener('update-trend-chart', (event) => {
                     const detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;
                     const { labels, data } = detail;
                     this.renderChart(labels, data);
                  });
               },

               renderChart(labels, data) {
                  setTimeout(() => {
                     const canvas = document.getElementById('TrendPendaftar');
                     if (!canvas) return console.warn('Canvas tidak ditemukan');
                     
                     const ctx = canvas.getContext('2d');
                     if (!ctx) return console.warn('Context null');

                     if (this.chart) this.chart.destroy();

                     this.chart = new Chart(ctx, {
                           type: 'bar',
                           data: {
                              labels: [...labels],
                              datasets: [{
                                 label: 'Pendaftar',
                                 data: [...data],
                                 backgroundColor: '#D9D9D9'
                              }]
                           },
                           options: {
                              responsive: true,
                              maintainAspectRatio: false,
                              scales: {
                                 y: {
                                       beginAtZero: true,
                                       ticks: {
                                          stepSize: 10
                                       }
                                 }
                              }
                           }
                     });
                  }, 50);
               }
         }))
      })
   </script>
@endsection

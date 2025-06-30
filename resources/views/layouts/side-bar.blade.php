<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>UPC | @yield('title')</title>
   
   <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.ico') }}">
   {{-- SEO Meta Tags --}}
   <meta name="description" content="Udayana Physics Championship (UPC) adalah kompetisi fisika nasional yang diikuti pelajar dan mahasiswa dari seluruh Indonesia.">
   <meta name="keywords" content="Udayana, Physics, Championship, Kompetisi Fisika, Nasional, UPC Udayana, Olimpiade Fisika, Event Sains, Lomba Fisika, upc, upc unud, upc udayana, udayana upc">
   <meta name="author" content="Himpunan Mahasiswa Fisika Universitas Udayana">
   <link rel="canonical" href="https://upcunud.com/">
   {{-- Open Graph Meta Tags --}}
   <meta property="og:url" content="https://upcunud.com/">
   <meta property="og:type" content="website">
   <meta property="og:title" content="UPC Udayana 2025">
   <meta property="og:description" content="Udayana Physics Championship (UPC) merupakan ajang kompetisi skala nasional dengan partisipasi dari pelajar hingga mahasiswa dari berbagai daerah di Indonesia.">
   <meta property="og:image" content="https://upcunud.com/assets/logo-in-slide.png">
   <meta property="og:image:width" content="1920">
   <meta property="og:image:height" content="1080">

   {{-- Twitter Meta Tags --}}
   <meta name="twitter:card" content="summary_large_image">
   <meta property="twitter:domain" content="upcunud.com">
   <meta property="twitter:url" content="https://upcunud.com/">
   <meta name="twitter:title" content="UPC Udayana 2025">
   <meta name="twitter:description" content="Udayana Physics Championship (UPC) merupakan ajang kompetisi skala nasional dengan partisipasi dari pelajar hingga mahasiswa dari berbagai daerah di Indonesia.">
   <meta name="twitter:image" content="https://upcunud.com/assets/logo-in-slide.png">

   {{-- Structured Data (JSON-LD for SEO) --}}
   <script type="application/ld+json">
   {
     "@context": "https://schema.org",
     "@type": "Event",
     "name": "Udayana Physics Championship 2025",
     "startDate": "2025-07-01",
     "endDate": "2025-09-01",
     "eventAttendanceMode": "https://schema.org/MixedEventAttendanceMode",
     "eventStatus": "https://schema.org/EventScheduled",
     "location": {
       "@type": "Place",
       "name": "Universitas Udayana",
       "address": {
         "@type": "PostalAddress",
         "addressLocality": "Bali",
         "addressCountry": "ID"
       }
     },
     "image": ["https://upcunud.com/assets/logo-in-slide.png"],
     "description": "Kompetisi fisika nasional oleh Universitas Udayana yang diikuti siswa dan mahasiswa dari seluruh Indonesia.",
     "organizer": {
       "@type": "Organization",
       "name": "Himpunan Mahasiswa Fisika Universitas Udayana",
       "url": "https://upcunud.com"
     }
   }
   </script>
   
   <link rel="stylesheet" href="{{ asset('build/assets/app-BTe-iNix.css') }}">
   <script src="{{ asset('build/assets/app-Dc4bBNVK.js') }}" defer></script>
   @livewireStyles
</head>

<body>
   <div x-data="{ isOpen: false }" x-cloak class="flex font-jakarta">
      {{-- Sidebar Tablet dan Laptop --}}
      <nav id="sidebar" x-bind:class="isOpen ? 'lg:w-60 w-50' : 'w-30'"
         class="bg-white transition-all duration-300 min-h-screen md:block hidden z-50 top-0 left-0 bottom-0 shadow-[0_0_30px_rgba(0,0,0,0.25)] fixed ">
         <div class="border-b mx-2">
            <img src="/assets/competition/logo-sidebar.png" class="mb-2 mt-3 lg:mt-4 ml-3 w-10 lg:w-20" alt="">
         </div>
         <div class="text-center mx-2 py-5 border-b">
            <div class="text-center mx-2 py-5 border-b">
               <div class="h-fit mx-auto mb-2 bg-[#5ACEF2] rounded-full w-10 lg:w-15">
                  @if (auth()->user()->role)
                     <img src="/assets/landing/profil.png" alt="">
                  @else
                     <img src="{{ asset('/storage/'.auth()->user()->participant->pass_photo) }}" class="aspect-square w-full object-cover rounded-full" alt="">
                  @endif
               </div>
               <h1 x-show="isOpen" class="sidebar-text text-wrap mb-[2px] text-[10px] lg:text-base">{{ auth()->user()->role ? auth()->user()->email : auth()->user()->participant->leader_name }}</h1>
               <h1 x-show="isOpen" class="sidebar-text text-[8px] lg:text-sm">{{ auth()->user()->role ? 'Administrator' : auth()->user()->participant->competition->name }}</h1>
            </div>
            @if (auth()->user()->role)
                @include('partials.navbar-admin')
            @else
                @include('partials.navbar-peserta')
            @endif
        </nav>
        <main x-bind:class="isOpen ? 'lg:ml-60 md:ml-50' : 'md:ml-30'" x-data="{ open: false }" id="main"
            class="relative w-full min-h-screen transition-all duration-300">
            {{-- Nav Bar --}}
            <header id="mainHeader" x-bind:class="isOpen ? 'lg:ml-60 md:ml-50' : 'md:ml-30'"
                class="transition-all overflow-visible duration-300 fixed px-5 py-1 left-0 top-0 right-0 z-40 flex justify-between items-center bg-white ">
                {{-- Burger Button --}}
                <button x-on:click="isOpen = !isOpen" id="sidebar-btn" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-7 lg:size-12">
                        <path fill-rule="evenodd"
                            d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                {{-- Log out Button --}}
                <button x-on:click="open = true" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-6 lg:size-9">
                        <path fill-rule="evenodd"
                            d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="absolute w-full h-[1px] bottom-0 left-0 flex">
                    <div class="w-1/2 bg-gradient-to-r from-gray-100 via-[#12B1EB]/95 to-white from-0% via-5% to-40% ">
                    </div>
                    <div class="w-1/2 bg-gradient-to-l from-gray-100 via-[#FFD900] to-white from-0% via-5% to-40% ">
                    </div>
                </div>
            </header>
            {{-- Sidebar Mobile --}}
            <nav x-show="isOpen" x-transition.delay.50ms
                class="fixed inset-0 bg-black/60 backdrop-blur-lg z-30 md:hidden">
                <div :class="isOpen? 'top-9' : '-top-100' " x-transition.duration.300ms
                    class="fixed pb-5 right-0 left-0 bg-white ">
                    <div class="flex gap-4 items-center m-5">
                        <div class="h-fit bg-[#5ACEF2] rounded-full w-12">
                            <img src="/assets/landing/profil.png" alt="">
                        </div>
                        <div>
                            <h1 class="sidebar-text text-wrap mb-[2px] text-sm">YUDHISTIRA ARIMBAWA
                                SAPUTRA</h1>
                            <h1 class="sidebar-text text-sm">Kompetisi Astronomi</h1>
                        </div>
                    </div>

                    @if (auth()->user()->role)
                        @include('partials.navbar-admin')
                    @else
                        @include('partials.navbar-peserta')
                    @endif
                </div>
            </nav>

            {{-- Content --}}
            <div id="mainContent" class="bg-gray-100 w-full h-full min-h-screen px-5 lg:px-9 py-10 lg:py-18">
                @yield('content')
            </div>

            {{-- Footer --}}
            <footer id="mainFooter" x-bind:class="isOpen ? 'lg:ml-60 md:ml-50' : 'md:ml-30'"
                class="transition-all max-h-fit min-h-fit duration-300 fixed z-40 bg-white bottom-0 right-0 left-0 ">
                <h3 class="text-[#4C4C4C] mx-10 my-1 lg:my-4 text-[8px] lg:text-base font-light">&copy; 2025
                    UDAYANAPHYSICSCHAMPIONSHIP. All rights reserved.</h3>
            </footer>


         {{-- Modal Logout --}}
         <div x-show="open" x-cloak class="fixed inset-0 bg-black/60 backdrop-blur-lg z-50 flex justify-center items-center">
            <div x-show="open" x-on:click.outside="open = false" x-transition.duration.300ms
               class="md:w-115 w-50 bg-white p-4 md:p-8 rounded-lg">
               <div class="mb-5 md:mb-10">
                  <h1 class="font-bold mb-1 md:mb-3 text-sm md:text-lg">Konfirmasi Log Out</h1>
                  <p class="text-[10px] md:text-sm">Anda yakin ingin keluar dari akun? Pastikan semua perubahan telah
                     disimpan.</p>
               </div>
               <form method="POST" action="/logout" class="flex justify-end text-white gap-3 md:gap-5">
                  @csrf
                  <x-button type="button" x-on:click="open = false" class="bg-[#4C4C4C]">Batal</x-button>
                  <x-button type="submit" class="bg-[#FF0000]">Ya, Keluar</x-button>
               </form>
            </div>
         </div>
      </main>
   </div>
   {{-- Script --}}
   @yield('script')
   @livewireScripts
</body>

</html>
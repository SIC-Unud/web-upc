<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Udayana Physics Championship @yield('title')</title>
   <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.ico') }}">
   {{-- SEO Meta Tags --}}
   <meta name="description" content="Udayana Physics Championship (UPC) adalah kompetisi fisika nasional yang diikuti pelajar dan mahasiswa dari seluruh Indonesia.">
   <meta name="keywords" content="Udayana, Physics, Championship, Kompetisi Fisika, Nasional, UPC Udayana, Olimpiade Fisika, Event Sains, Lomba Fisika, upc, upc unud, upc udayana, udayana upc, UPC">
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
   {{-- navbar --}}
   <nav class="bg-black flex justify-between overflow-visible px-4 fixed top-0 w-full z-[9999]">
      <a href="{{ route('home') }}">
         <img src="/assets/logo.png" alt="" class="w-11 py-4 md:w-28 md:pl-[30px] md:py-[19px]">
      </a>
      <button class="tombolMenu cursor-pointer">
         <img src="/assets/humberger.png" alt="" class="w-5 py-4 md:w-18 md:py-[19px] md:pr-[30px]">
      </button>
      <div
         class="h-1 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
      </div>
      <div
         class="h-1 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
      </div>

      <div
         class="menu hidden absolute z-50 border border-white bg-black text-2xl right-5 -bottom-27 md:-bottom-54 md:w-[383px]">
         <div class="text-white py-3 md:py-8 md:px-4">
            @php
               $user = auth()->user();
               $isGuest = auth()->guest();
               $isAdmin = $user?->role == 1;
               $isAccepted = $user?->participant?->is_accepted == 1;
            @endphp

            @if ($isGuest || (!$isAdmin && !$isAccepted))
               <div class="relative text-center font-julius px-3 mx-3 text-xs pb-2 md:pb-3 md:text-lg">
                  <a href="{{ route('register') }}">DAFTAR</a>
                  <div class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white w-1/2"></div>
                  <div class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white w-1/2"></div>
               </div>
               <div class="relative text-center font-julius px-3 mx-3 text-xs py-2 md:py-3 md:text-lg">
                  <a href="{{ route('login') }}">MASUK</a>
                  <div class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white w-1/2"></div>
                  <div class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white w-1/2"></div>
               </div>
            @else
               <div class="relative text-center font-julius px-3 mx-3 text-xs py-2 md:py-3 md:text-lg">
                  <a href="{{ $isAdmin ? route('admin.dashboard') : route('participants.index') }}">DASHBOARD</a>
                  <div class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white w-1/2"></div>
                  <div class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white w-1/2"></div>
               </div>
               <form action="{{ route('logout') }}" method="POST" class="relative text-center font-julius px-3 mx-3 text-xs py-2 md:py-3 md:text-lg">
                  @csrf
                  <button type="submit" class="cursor-pointer">
                     <p>LOGOUT</p>
                     <div class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white w-1/2"></div>
                     <div class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white w-1/2"></div>
                  </button>
               </form>
            @endif
            <div class="text-center font-julius px-3 mx-3 text-xs pt-2 md:pt-3 md:text-lg">
               <a href="{{ config('const.link_drive_petunjuk_teknis') }}" target="_blank">PETUNJUK TEKNIS</a>
            </div>
         </div>
      </div>
   </nav>
   {{-- content --}}
   @yield('content')
   {{-- footer --}}
   <footer class="relative bg-black h-full w-full py-8 px-12  md:px-20 md:py-16">
      <div
         class="h-1 bg-gradient-to-r absolute top-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
      </div>
      <div
         class="h-1 bg-gradient-to-l absolute top-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
      </div>
      <h3 class="text-white/20 text-center text-xs md:text-lg lg:text-2xl font-light">&copy; 2025
         UDAYANAPHYSICSCHAMPIONSHIP. All rights reserved.</h3>
   </footer>
   {{-- scripts --}}
   @yield('script')
   <script>
      const tombol = document.querySelector('.tombolMenu')
      const menu = document.querySelector('.menu')
      tombol.addEventListener('click', (event) => {
         event.preventDefault()
         if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden')
         } else menu.classList.add('hidden')
      })
   </script>
   @livewireScripts
</body>

</html>
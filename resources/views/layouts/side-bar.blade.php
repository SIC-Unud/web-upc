<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>UPC | @yield('title')</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
   <div class="flex font-jakarta">
      {{-- Side Bar --}}
      <nav id="sidebar"
         class="bg-white transition-all duration-300 w-60 h-screen fixed z-50 top-0 left-0 bottom-0 shadow-[0_0_30px_rgba(0,0,0,0.25)]">
         <div class="border-b mx-2">
            <img src="/assets/competition/logo-sidebar.png" class="mb-2 mt-4 ml-3 w-20" alt="">
         </div>
         <div class="text-center mx-2 py-5 border-b">
            <div class="h-fit mx-auto w-15 mb-2 bg-[#5ACEF2] rounded-full ">
               <img src="/assets/landing/profil.png" alt="">
            </div>
            <h1 class="sidebar-text px-5 text-wrap text-base mb-[2px]">YUDHISTIRA ARIMBAWA SAPUTRA</h1>
            <h1 class="sidebar-text text-base">Kompetisi Astronomi</h1>
         </div>
         @include('partials.navbar-peserta')
      </nav>
      <main id="main" class="ml-60 w-full transition-all duration-300">
         {{-- Nav Bar --}}
         <header id="mainHeader"
            class="transition-all duration-300 fixed ml-60 px-5 w-100% py-1 left-0 top-0 right-0 z-40 flex justify-between items-center bg-white">
            <button id="sidebar-btn" class="cursor-pointer">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
                  <path fill-rule="evenodd"
                     d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                     clip-rule="evenodd" />
               </svg>
            </button>
            <a href="#">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-9">
                  <path fill-rule="evenodd"
                     d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
                     clip-rule="evenodd" />
               </svg>
            </a>
            <div class="absolute w-full h-[1px] -bottom-0.5 left-0 flex">
               <div class="w-1/2 bg-gradient-to-r from-gray-100 via-[#12B1EB]/95 to-white from-0% via-5% to-40% "></div>
               <div class="w-1/2 bg-gradient-to-l from-gray-100 via-[#FFD900] to-white from-0% via-5% to-40% "></div>
            </div>
         </header>
         {{-- Content --}}
         <div id="mainContent" class="bg-gray-100 min-h-screen w-full px-9 py-18">
            @yield('content')
         </div>
         {{-- Footer --}}
         <footer id="mainFooter" class="transition-all duration-300 ml-60 fixed z-40 bg-white bottom-0 right-0 left-0">
            <h3 class="text-[#4C4C4C] mx-10 my-4 text-xs md:text-base font-light">&copy; 2025
               UDAYANAPHYSICSCHAMPIONSHIP. All rights reserved.</h3>
         </footer>
      </main>
   </div>
   {{-- Script --}}
   @yield('script')
   <script>
      const button = document.getElementById('sidebar-btn')
      const sidebarText = document.querySelectorAll('.sidebar-text')
      const icon = document.querySelectorAll('#icon')
      const sidebar = document.getElementById('sidebar')
      const main = document.getElementById('main')
      const mainContent = document.getElementById('mainContent')
      const mainHeader = document.getElementById('mainHeader')
      const mainFooter = document.getElementById('mainFooter')

      let close = false;

      button.addEventListener('click', () => {
         close = !close;

         // Ubah lebar sidebar
         sidebar.classList.toggle('w-30');
         sidebar.classList.toggle('w-60');

         // Geser konten
         mainHeader.classList.toggle('ml-60');
         mainHeader.classList.toggle('ml-30');

         main.classList.toggle('ml-60');
         main.classList.toggle('ml-30');

         mainFooter.classList.toggle('ml-60');
         mainFooter.classList.toggle('ml-30');

         // Sembunyikan teks
         icon.forEach(e => e.classList.toggle('pl-5'));
         icon.forEach(e => e.classList.toggle('justify-center'));
         sidebarText.forEach(e => e.classList.toggle('hidden'));
      });
   </script>
</body>

</html>

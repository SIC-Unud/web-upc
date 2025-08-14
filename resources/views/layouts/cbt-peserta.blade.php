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
   {{-- Header --}}
   <header id="mainHeader"
      class="overflow-visible fixed px-5 py-1 left-0 top-0 right-0 z-40 flex justify-between items-center bg-white ">
      {{-- logo --}}
      <img src="/assets/competition/logo-sidebar.png" alt="logo" class="mb-2 mt-3 lg:mt-4 ml-3 w-10 lg:w-20">
      {{-- Log out Button --}}
      <button x-on:click="open = true" class="cursor-pointer">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 lg:size-9">
            <path fill-rule="evenodd"
               d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
               clip-rule="evenodd" />
         </svg>
      </button>
      <div class="absolute w-full h-[1px] bottom-0 left-0 flex">
         <div class="w-1/2 bg-gradient-to-r from-gray-100 via-[#12B1EB]/95 to-white from-0% via-5% to-40% "></div>
         <div class="w-1/2 bg-gradient-to-l from-gray-100 via-[#FFD900] to-white from-0% via-5% to-40% "></div>
      </div>
   </header>
   {{-- Header --}}

   {{-- Body --}}
   <div id="mainContent" class="bg-gray-100 min-h-screen w-full h-full px-5 lg:px-9 py-10 lg:py-22">
      @yield('content')
   </div>
   {{-- Body --}}

   {{-- Footer --}}
   <footer id="mainFooter" class="max-h-fit min-h-fit fixed z-40 bg-white bottom-0 right-0 left-0 ">
      <h3 class="text-[#4C4C4C] mx-10 my-1 lg:my-4 text-[8px] lg:text-base font-light">&copy; 2025
         UDAYANAPHYSICSCHAMPIONSHIP. All rights reserved.</h3>
   </footer>
   {{-- Footer --}}

   {{-- Modal --}}
   <div>
      @yield('modal')
   </div>
   {{-- Modal --}}
</body>

</html>

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
   <div class="bg-black flex justify-between relative overflow-visible px-4">
      <img src="/assets/landing/Logolayout.png" alt="" class="w-11 py-4 md:w-28 md:pl-[30px] md:py-[19px]">
      <button class="tombolMenu cursor-pointer">
         <img src="/assets/landing/garis3.png" alt="" class="w-5 py-4 md:w-18 md:py-[19px] md:pr-[30px]">
      </button>
      <div
         class="h-1 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
      </div>
      <div
         class="h-1 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
      </div>

      <div
         class="menu hidden absolute z-50 right-4 border border-white bg-black text-2xl -bottom-27 md:-bottom-70 md:w-[383px]">
         <div class="text-white py-3 md:py-12 md:px-8">
            <div class="relative text-center font-julius px-3 mx-3 text-xs pb-2 md:pb-5 md:text-2xl">
               <a href="/register">DAFTAR</a>
               <div
                  class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
               </div>
               <div
                  class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
               </div>
            </div>
            <div class="relative text-center font-julius px-3 mx-3 text-xs py-2 md:py-5 md:text-2xl">
               <a href="/login">MASUK</a>
               <div
                  class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
               </div>
               <div
                  class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
               </div>
            </div>
            <div class="text-center font-julius px-3 mx-3 text-xs pt-2 md:pt-5 md:text-2xl">
               <a href="">PETUNJUK TEKNIS</a>
            </div>
         </div>
      </div>
   </div>
   @yield('content')
   <div
      class="pt-4 pb-5 text-center text-[8px] md:text-4xl md:pt-[97px] md:mx-auto font-koulen md:pb-14 text-white/20 bg-black">
      &copy; 2025 UDAYANAPHYSICSCHAMPIONSHIP. All rights reserved.
   </div>

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
</body>

</html>

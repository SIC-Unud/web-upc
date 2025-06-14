<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     <title>Document</title>
</head>
<body>
     {{-- navbar --}}
     <div class="bg-black flex justify-between relative overflow-visible px-4">
          <img src="/assets/register/icon.png" alt="" class="w-11 py-4 md:w-28 md:pl-[30px] md:py-[19px]">
          <button class="tombolMenu cursor-pointer">
               <img src="/assets/register/humberger.png" alt="" class="w-5 py-4 md:w-18 md:py-[19px] md:pr-[30px]">
          </button>
          <div
               class="h-1 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
          </div>
          <div
               class="h-1 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
          </div>

          <div
               class="menu hidden absolute z-50 right-0 border border-white bg-black text-2xl -bottom-27 md:-bottom-70 md:w-[383px]">
               <div class="text-white py-3 md:py-12 md:px-8">
                    <div class="relative text-center font-julius px-3 mx-3 text-xs pb-2 md:pb-5 md:text-2xl">
                         <a href="">DAFTAR</a>
                         <div
                              class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
                         </div>
                         <div
                              class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
                         </div>
                    </div>
                    <div class="relative text-center font-julius px-3 mx-3 text-xs py-2 md:py-5 md:text-2xl">
                         <a href="">MASUK</a>
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
     {{-- content --}}
     @livewire('registration-form')
     {{-- footer --}}
     <footer class="relative bg-black h-full w-full py-8 px-12  md:px-20 md:py-16"> 
          <div
               class="h-1 bg-gradient-to-r absolute top-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
          </div>
          <div
               class="h-1 bg-gradient-to-l absolute top-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
          </div>
          <h3 class="text-white/20 text-center text-xs md:text-lg lg:text-2xl font-light">&copy; 2025 UDAYANAPHYSICSCHAMPIONSHIP. All rights reserved.</h3>
     </footer>
     {{-- scripts --}}
     <script>
        window.addEventListener('scroll-to-top', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>
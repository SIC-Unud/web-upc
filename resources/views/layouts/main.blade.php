<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UPC | @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            class="menu hidden absolute z-50 right-0 border border-white bg-black text-2xl -bottom-27 md:-bottom-70 md:w-[383px]">
            <div class="text-white py-3 md:py-12 md:px-8">
                <div class="relative text-center font-julius px-3 mx-3 text-xs pb-2 md:pb-5 md:text-2xl">
                        <a href="{{ route('register') }}">DAFTAR</a>
                        <div
                            class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
                        </div>
                        <div
                            class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
                        </div>
                </div>
                <div class="relative text-center font-julius px-3 mx-3 text-xs py-2 md:py-5 md:text-2xl">
                        <a href="{{ route('login') }}">MASUK</a>
                        <div
                            class="h-[0.70px] bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
                        </div>
                        <div
                            class="h-[0.70px] bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
                        </div>
                </div>
                <div class="text-center font-julius px-3 mx-3 text-xs pt-2 md:pt-5 md:text-2xl">
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
        <h3 class="text-white/20 text-center text-xs md:text-lg lg:text-2xl font-light">&copy; 2025 UDAYANAPHYSICSCHAMPIONSHIP. All rights reserved.</h3>
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

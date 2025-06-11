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
     <form class="bg-[url(../../public/assets/register/bg.png)] font-jakarta h-full">
          <div class="backdrop-blur-2xl bg-black/55">
               {{-- Heading --}}
               <div class="md:pt-12 pt-8 mx-auto text-white">
                    <h1 class="font-bold text-4xl md:text-5xl text-center">Registrasi</h1>
                    <p class="font-medium font-jakarta text-sm md:text-2xl px-6 md:px-15 lg:px-30 text-center my-8 md:my-12">Mulai proses pendaftaran dengan mengisi formulir online. Lengkapi data dirimu, lalu unggah dokumen pendukung. Prosesnya cepat, mudah, dan GRATIS!</p>
               </div>
               {{-- form --}}
               <div class="relative h-fit w-fit mx-8 md:mx-12 lg:mx-30">
                    <div class="bg-black border border-white w-full h-full">
                         <img class="absolute select-none -top-[5px] md:-top-1.5 -left-1.5 size-24 md:size-32" src="/assets/register/border2.png" alt="">
                         <div class="w-1.5 h-16 md:w-2.5 md:h-25 bg-white absolute -right-1.5 md:-right-2.5 -top-[0.2px]"></div>
                         <div class="w-0.5 h-30 md:h-55 bg-white absolute -right-0.5 -top-[0.2px]"></div>
                         <div class="py-5 px-6 md:py-9 md:px-10">
                              <h1 class="text-2xl md:text-4xl font-bold mb-1 md:mb-2 text-white text-center md:text-left">Formulir Terkirim!</h1>
                              <p class="text-base font-extralight md:text-2xl mb-5 md:mb-12 text-white md:text-left text-wrap">Formulir anda berhasil terkirim! Akun peserta anda sedang dalam peninjauan oleh panitia. Peninjauan akan memakan waktu paling lambat H+3 hari kerja.</p>
                              {{-- rincian --}}
                              <div class="flex justify-center">
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="md:size-35 size-25 text-center font-extrabold text-white">
                                        <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                                   </svg>
                              </div>
                              <h2 class="text-white text-base md:text-2xl text-center mb-6 md:mb-12">No. Registrasi anda: 198788099</h2>
                              <p class="text-white md:text-2xl text-base md:mb-12 mb-6 text-wrap">Salinan Formulir registrasi anda akan terunduh secara otomatis, jika tidak terunduh maka klik tombol unduh di bawah untuk mengunduh salinan formulir registrasi anda secara manual.</p>
                              <div class="text-center">
                                   <button class="border border-[#12B1EB] rounded-md py-2 px-15 md:text-2xl text-xs md:py-2 md:px-20 mb-8 bg-[#12B1EB] text-white text-center">Unduh</button>
                              </div>
                              <p class="text-white md:text-2xl text-base md:mb-12 mb-6 text-wrap">Mohon mengkonfirmasi pendaftaran anda dan masuk ke dalam grup peserta UPC dengan cara menghubungi CP humas UPC 2025 <a href="" class="text-[#12B1EB] underline">di sini</a>.</p>
                              <p class="text-white text-base md:text-2xl font-semibold md:font-bold text-center text-wrap">Terima kasih telah mendaftar!</p>
                              <p class="text-white text-base md:text-2xl font-semibold md:font-bold text-center text-wrap">Sampai jumpa di rangkaian kegiatan UPC selanjutnya!</p>


                              
                         </div>
                    </div>
                    <div class="py-14 flex justify-center items-center">
                         {{-- Selesai --}} 
                         <div class=" w-35 h-8 md:w-55 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-end ">
                              <div class="w-full h-full bg-black flex items-center justify-center">
                                   <h1 class="text-white md:text-lg">Selesai</h1>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </form>
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
</body>
</html>
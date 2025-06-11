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
     <form class="bg-[url(../../public/assets/bg.png)] font-jakarta h-full">
          <div class="backdrop-blur-2xl bg-black/55">
               {{-- Heading --}}
               <div class="pt-12 mx-auto w-fit h-fit text-white">
                    <h1 class="font-bold text-4xl md:text-5xl text-center">Registrasi</h1>
                    <p class="font-medium font-jakarta text-sm md:text-2xl px-6 md:px-15 lg:px-30 text-center my-8 md:my-12">Mulai proses pendaftaran dengan mengisi formulir online. Lengkapi data dirimu, lalu unggah dokumen pendukung. Prosesnya cepat, mudah, dan GRATIS!</p>
               </div>
               {{-- form --}}
               <div class="relative h-fit w-fit mx-8 md:mx-12 lg:mx-auto ">
                    <div class="bg-black border border-white w-full h-full">
                         <img class="absolute select-none -top-[5px] md:-top-1.5 -left-1.5 size-24 md:size-32" src="/assets/register/border1.png" alt="">
                         <div class="w-1.5 h-16 md:w-2.5 md:h-25 bg-white absolute -right-1.5 md:-right-2.5 -top-[0.2px]"></div>
                         <div class="w-0.5 h-30 md:h-55 bg-white absolute -right-0.5 -top-[0.2px]"></div>
                         <div class=" py-6 px-8 md:py-12 md:px-10">
                              <h1 class="text-xl md:text-4xl font-semibold md:font-bold text-white">Informasi Umum</h1>
                              <p class="text-lg font-extralight md:text-xl mb-5 md:mb-12 text-white">Lengkapi formulir di bawah ini dengan data dirimu yang valid.</p>
                              <div class="mb-4 md:mb-8">
                                   <label for="" class="md:block text-xs md:text-xl text-white">Dari mana Anda mengetahui kompetisi ini? <span class="text-red-500">*</span></label>
                                   <select class="block w-1/2 md:w-2/3 md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="" id="">
                                        <option class="" value="">Pilih...</option>
                                        <option value="">Media sosial UPC 2025</option>
                                        <option value="">Media sosial informasi lomba</option>
                                        <option value="">Guru/Dosen</option>
                                        <option value="">Teman/Keluarga</option>
                                        <option value="">Lainnya</option>
                                   </select>
                              </div>
                              <div class="mb-4 md:mb-8">
                                   <label for="" class="md:block text-xs md:text-xl text-wrap text-white">Apakah ini pertama kalinya Anda mengikuti kompetisi ini? <span class="text-red-500">*</span><label>
                                   <select class="block w-1/2 md:w-2/3 md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="" id="">
                                        <option value="">Pilih...</option>
                                        <option value="">Ya</option>
                                        <option value="">Tidak</option>
                                   </select>
                              </div>
                              <div class="mb-4 md:mb-8">
                                   <label class="md:block text-xs md:text-xl text-wrap text-white">Apa alasan utama Anda mengikuti kompetisi ini? <span class="text-red-500">*</span></label>
                                   <select class="block w-1/2 md:w-2/3 md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="" id="">
                                        <option class="" value="">Pilih...</option>
                                        <option value="">Meningkatkan kemampuan diri</option>
                                        <option value="">Networking</option>
                                        <option value="">Hadiah/sertifikat penghargaan</option>
                                        <option value="">Kebutuhan akademik</option>
                                        <option value="">Lainnya</option>
                                   </select>
                              </div>
                              <div class="mb-4 md:mb-8">
                                   <label for="" class="block text-xs md:text-xl text-wrap text-white">Apakah Anda memiliki kebutuhan khusus (disabilitas, alergi makanan, dll.)?</label>
                                   <input type="text" placeholder="Ketik di sini..." class="w-1/2 md:w-2/3 md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="" id=""></input>
                              </div>
                              <div class="mb-6 md:mb-12">
                                   <label for="" class="md:block text-xs md:text-xl text-wrap text-white">Kategori kompetisi apa yang ingin Anda ikuti?  <span class="text-red-500">*</span></label>
                                   <select class="block w-1/2 md:w-2/3 md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="" id="">
                                        <option class="" value="">Pilih...</option>
                                        <option value="">Cerdas cermat SD (kelompok)</option>
                                        <option value="">Fisika SMP</option>
                                        <option value="">Fisika SMA</option>    
                                        <option value="">Kebumian</option>
                                        <option value="">Astronomi</option>
                                        <option value="">Esai (kelompok)</option>
                                        <option value="">Poster Ilmiah (kelompok)</option>
                                   </select>
                              </div>
                         </div>
                    </div>
                    <div class="py-14 grid grid-cols-3 items-center">
                         {{-- bulet-bulet --}}
                         <div class="col-start-2 grid grid-cols-subgrid justify-items-center">
                              <div class="w-25 h-8 md:w-30 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] rounded-full p-[1px]">
                                   <div class="w-full h-full bg-black rounded-full flex items-center justify-center">
                                        <div class="flex items-center">
                                             <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full bg-white flex items-center justify-center"></div>
                                             <div class="h-[0.5px] w-2 md:w-3 bg-white"></div>
                                             <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full bg-white flex items-center justify-center">
                                                  <div class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 bg-black rounded-full"></div>
                                             </div>
                                             <div class="h-[0.5px] w-2 md:w-3 bg-white"></div>
                                             <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white">
                                                  <div class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 bg-black rounded-full"></div>
                                             </div>
                                             <div class="h-[0.5px] w-2 md:w-3 bg-white"></div>
                                             <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white">
                                                  <div class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 bg-black rounded-full"></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         {{-- selanjutnya --}} 
                         <div class=" w-20 h-8 md:w-38 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-end ">
                              <div class="w-full h-full bg-black flex items-center justify-center">
                                   <div class="flex justify-between item-center gap-2">
                                        <h1 class="text-white hidden md:contents md:text-lg">Selanjutnya</h1>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 md:size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                        </svg>
                                   </div>
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
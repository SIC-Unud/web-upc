<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @php
        $timeline = [
            ['title' => 'Pendaftaran Periode I', 'date' => '22 Juni - 25 Juli'],
            ['title' => 'Pendaftaran Periode I', 'date' => '22 Juni - 25 Juli'],
            ['title' => 'Pendaftaran Periode I', 'date' => '22 Juni - 25 Juli'],
            ['title' => 'Pendaftaran Periode I', 'date' => '22 Juni - 25 Juli'],
            ['title' => 'Pendaftaran Periode I', 'date' => '22 Juni - 25 Juli'],
            ['title' => 'Pendaftaran Periode I', 'date' => '22 Juni - 25 Juli'],
        ];
    @endphp
    <div class="bg-black flex justify-between relative">
        <img src="/assets/Logolayout.png" alt="" class="w-11 my-3 ml-3 md:w-auto md:pl-[34px] md:py-[19px]">
        <img src="/assets/garis3.png" alt="" class="w-[15px] my-3 mr-3 md:w-auto  md:py-[27px] md:pr-[69px]">
        <div
            class="h-1 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
        </div>
        <div
            class="h-1 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
        </div>
    </div>

    <div class="bg-[url(../../public/assets/image-9.png)] bg-black bg-cover pb-12 relative">
        <div class="flex items-center justify-center">
            <img class="hidden md:block" src="/assets/PurpleCat.png" alt="">
            <div class="mt-[39px]">
                <h1
                    class="text-white text-[13px] md:text-3xl md:mb-7 text-center md:flex md:justify-center font-julius">
                    UDAYANA PHYSICS CHAMPIONSHIP</h1>
                <img class="mt-3 w-[246px] md:w-auto" src="/assets/Logo.png" alt="">
            </div>
            <img class="hidden md:block" src="/assets/YellowCat.png" alt="">
        </div>
        <div class="flex justify-center items-center w-full">
            <img class="w-[80px] md:hidden" src="/assets/PurpleCat.png" alt="">
            <a
                class="md:mt-11 mx-5 relative flex w-fit justify-center items-center py-4 px-[12px] md:py-[37px] md:px-11 backdrop-blur-sm bg-white/10">
                <div class="absolute w-px h-full left-0 top-0 bg-[#12B1EB]"></div>
                <div class="absolute w-px h-full right-0 top-0 bg-[#FFD900]"></div>
                <div class="absolute top-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                <div class="absolute bottom-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                <div class="text-[13px] md:text-3xl text-white leading-6 mr-[8px] md:mr-9 font-julius">DAFTAR SEKARANG
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3 md:size-6  text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
            <img class="w-[80px] md:hidden" src="/assets/YellowCat.png" alt="">
        </div>
        <div class="h-30 w-full absolute -bottom-15 bg-gradient-to-b from-transparent via-black to-transparent"></div>
    </div>

    <div class="bg-[url(../../public/assets/latar2.png)] bg-black bg-cover">
        <div class="pt-7 px-4 md:px-18 md:pt-[57px] overflow-x-auto">
            <div class="flex gap-2 md:gap-[29px] w-fit md:w-auto snap-x">
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-none transition hover:scale-105" src="/assets/foto1.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-none transition hover:scale-105" src="/assets/foto2.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-none transition hover:scale-105" src="/assets/foto3.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-none transition hover:scale-105" src="/assets/foto4.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-none transition hover:scale-105" src="/assets/foto5.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-none transition hover:scale-105" src="/assets/foto6.png"
                        alt="">
                </div>
            </div>
        </div>

        <div class="flex items-center ml-10 mt-12 md:ml-35 md:mt-65">
            <div class="w-[962px]">
                <div class="md:pb-20 pb-3 relative flex justify-center">
                    <img class="w-17 md:w-auto" src="/assets/LogoDesc.png" alt="">
                    <div
                        class="h-0.5 md:h-1 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
                    </div>
                    <div
                        class="h-0.5 md:h-1 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
                    </div>
                </div>
                <h1 class="text-white text-justify text-[8px] md:text-2xl font-lao mt-4 md:mt-10">Udayana Physics
                    Championship (UPC) 2025
                    merupakan salah satu program kerja tahunan
                    yang diselenggarakan oleh Himpunan Mahasiswa Fisika (HIMAFI), Fakultas Matematika dan Ilmu
                    Pengetahuan
                    Alam,
                    Universitas Udayana. Kegiatan ini merupakan ajang kompetisi dan perlombaan berskala nasional yang
                    secara
                    konsisten menarik partisipasi dari pelajar hingga mahasiswa dari berbagai daerah di Indonesia. Tahun
                    ini,
                    UPC menyelenggarakan
                    beberapa cabang lomba meliputi: Cerdas Cermat SD (untuk siswa SD se-Bali), Kompetisi Fisika SMP
                    (untuk
                    siswa
                    SMP seIndonesia), Kompetisi Fisika SMA, Kebumian, dan Astronomi (untuk siswa SMA seIndonesia), serta
                    Lomba
                    Esai dan Poster Digital (untuk siswa SMA/SMK/MA dan mahasiswa se-Indonesia).</h1>
            </div>
            <div class="overflow-hidden">
                <img class="relative -right-8 md:static" src="/assets/siapa ya.png" alt="">
            </div>
        </div>

        <div class="mt-[100px]">
            <div class="relative md:w-fit mx-auto">
                <h1 class="text-[18px] md:text-[50px] pb-4 md:px-70 md:pb-10 text-white text-center">BIDANG LOMBA</h1>
                <div
                    class="h-0.5 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
                </div>
                <div
                    class="h-0.5 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
                </div>
            </div>

            <div
                class="mt-10 justify-center items-center gap-3 mx-5 md:gap-9 text-[8px] md:text-2xl flex flex-wrap font-lao">
                <div class="w-16 md:w-38">
                    <img class="" src="/assets/SD.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Cerdas Cermat SD</h1>
                </div>
                <div class="w-16 md:w-38">
                    <img class="" src="/assets/SMP.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Fisika SMP</h1>
                </div>
                <div class="w-16 md:w-38">
                    <img class="" src="/assets/SMA.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Fisika SMA</h1>
                </div>
                <div class="w-16 md:w-38">
                    <img class="" src="/assets/kebumian.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Kebumian</h1>
                </div>
                <div class="w-16 md:w-38">
                    <img class="" src="/assets/astronomi.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Astronomi</h1>
                </div>
                <div class="w-16 md:w-38">
                    <img class="" src="/assets/essai.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Essai</h1>
                </div>
                <div class="w-16 md:w-38">
                    <img class="" src="/assets/poster_ilmiah.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Poster Ilmiah</h1>
                </div>
            </div>
        </div>

        <div class="mt-20 text-white px-6 md:px-32">
            <h1 class="text-lg md:text-4xl pb-4 md:px-70 md:pb-10 text-white text-center">TIMELINE</h1>
            <div class="grid grid-cols-3">
                {{-- Elemen Pertama --}}
                <div class="col-span-3">
                    <div class="flex items-center justify-center gap-6 w-fit mx-auto -translate-x-[calc(50%-12px)]">
                        <div>
                            <h3 class="font-medium text-lg">PENDAFTARAN PERIODE I</h3>
                            <div>22 Juni - 25 Juli</div>
                        </div>
                        <img src="/assets/star.png" alt="" class="size-6">
                    </div>
                </div>
                {{-- Panah Start --}}
                <div></div>
                <div>
                    <div class="h-40 w-1/2 ml-auto">
                        <div class="w-full h-full"
                            style="background: linear-gradient(to top right,
                          rgba(255,255,255,0) 0%,
                          rgba(255,255,255,0) calc(50% - 0.8px),
                          rgba(255,255,255,1) 50%,
                          rgba(255,255,255,0) calc(50% + 0.8px),
                          rgba(255,255,255,0) 100%)">
                        </div>
                    </div>
                </div>
                <div></div>
                {{-- Panah End --}}

                {{-- Elemen Kedua --}}
                <div class="col-span-2"></div>
                <div>
                    <div class="flex items-center gap-6">
                        <img src="/assets/star.png" alt="" class="size-6">
                        <div>
                            <h3 class="font-medium text-lg">PENDAFTARAN PERIODE I</h3>
                            <div>22 Juni - 25 Juli</div>
                        </div>
                    </div>
                </div>
                {{-- Panah Start --}}
                <div></div>
                <div>
                    <div class="h-40 w-full ml-auto">
                        <div class="w-full h-full"
                            style="background: linear-gradient(to top left,
                          rgba(255,255,255,0) 0%,
                          rgba(255,255,255,0) calc(50% - 0.8px),
                          rgba(255,255,255,1) 50%,
                          rgba(255,255,255,0) calc(50% + 0.8px),
                          rgba(255,255,255,0) 100%)">
                        </div>
                    </div>
                </div>
                <div></div>
                {{-- Panah End --}}

                {{-- Elemen Ketiga --}}
                <div>
                    <div class="flex items-center justify-end gap-6">
                        <div>
                            <h3 class="font-medium text-lg">PENDAFTARAN PERIODE I</h3>
                            <div>22 Juni - 25 Juli</div>
                        </div>
                        <img src="/assets/star.png" alt="" class="size-6">
                    </div>
                </div>
                <div class="col-span-2"></div>
                {{-- Panah Start --}}
                <div></div>
                <div>
                    <div class="h-40 w-full ml-auto">
                        <div class="w-full h-full"
                            style="background: linear-gradient(to top right,
                          rgba(255,255,255,0) 0%,
                          rgba(255,255,255,0) calc(50% - 0.8px),
                          rgba(255,255,255,1) 50%,
                          rgba(255,255,255,0) calc(50% + 0.8px),
                          rgba(255,255,255,0) 100%)">
                        </div>
                    </div>
                </div>
                <div></div>
                {{-- Panah End --}}

                {{-- Elemen Keempat --}}
                <div class="col-span-2"></div>
                <div>
                    <div class="flex items-center gap-6">
                        <img src="/assets/star.png" alt="" class="size-6">
                        <div>
                            <h3 class="font-medium text-lg">PENDAFTARAN PERIODE I</h3>
                            <div>22 Juni - 25 Juli</div>
                        </div>
                    </div>
                </div>
                {{-- Panah Start --}}
                <div></div>
                <div>
                    <div class="h-40 w-1/2 ml-auto">
                        <div class="w-full h-full"
                            style="background: linear-gradient(to top left,
                          rgba(255,255,255,0) 0%,
                          rgba(255,255,255,0) calc(50% - 0.8px),
                          rgba(255,255,255,1) 50%,
                          rgba(255,255,255,0) calc(50% + 0.8px),
                          rgba(255,255,255,0) 100%)">
                        </div>
                    </div>
                </div>
                <div></div>
                {{-- Panah End --}}

                {{-- Elemen Kelima --}}
                <div class="col-span-3">
                    <div class="flex items-center justify-center gap-6 w-fit mx-auto translate-x-[calc(50%-12px)]">
                        <img src="/assets/star.png" alt="" class="size-6">
                        <div>
                            <h3 class="font-medium text-lg">PENDAFTARAN PERIODE I</h3>
                            <div>22 Juni - 25 Juli</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="size-40">
                <div class="w-full h-px border-t border-dashed border-white rotate-45 origin-top-left"></div>
            </div> --}}
        </div>

        <div class="flex items-center mr-10 mt-12 md:mr-35 md:mt-43">
            <div class="overflow-hidden w-70 md:w-auto">
                <img class="relative -left-1 md:static" src="/assets/cat-purple.png" alt="">
            </div>
            <div
                class="relative flex-grow md:w-[962px] bg-[#D9D9D9]/14 backdrop-blur-sm p-3 md:px-[55px] md:py-[51px] border border-white">
                <img class="w-8 md:w-auto absolute -top-[2px] md:-top-2.5 -left-[2px] md:-left-2.5"
                    src="/assets/bazel1.png" alt="">
                <img class="w-8 md:w-auto absolute -bottom-[2px] md:-bottom-2.5 -right-[2px] md:-right-2.5"
                    src="/assets/bazel2.png" alt="">
                <div class="flex border-b border-white mb-2 pb-2 md:pb-8 md:mb-9">
                    <div class="mr-2 md:mr-16 h-fit bg-[#5ACEF2] rounded-full shrink-0">
                        <img class="w-8 md:w-33" src="/assets/profil.png" alt="">
                    </div>
                    <div class="text-white">
                        <h1 class="text-[7px] md:text-4xl font-koulen">Ni Kadek Belinda Maheswari Prahsini </h1>
                        <h2 class="text-[6px] md:text-2xl font-koulen">SMA Negeri 1 Denpasar</h2>
                        <p class="font-lao text-[6px] md:text-3xl">Kegiatan sangat bermanfaat untuk mengetes kemampuan
                            akademik peserta dan
                            menyiapkan diri untuk
                            kompetisi-kompetisi lainnya.</p>
                    </div>
                </div>
                <div class="flex border-b border-white mb-2 pb-2 md:pb-8 md:mb-9">
                    <div class="mr-2 md:mr-16 h-fit bg-[#5ACEF2] rounded-full shrink-0">
                        <img class="w-8 md:w-33" src="/assets/profil.png" alt="">
                    </div>
                    <div class="text-white">
                        <h1 class="text-[7px] md:text-4xl font-koulen">Wilson Sidarta Putra Lohanata</h1>
                        <h2 class="text-[6px] md:text-2xl font-koulen">SMAK PENABUR Gading Serpong</h2>
                        <p class="font-lao text-[6px] md:text-3xl">Bagi saya, UPC ini merupakan sarana yang sangat baik
                            sebagai persiapan awal hingga menengah peserta didik dalam mengerjakan soal-soal olimpiade
                            yang
                            lebih lanjut, seperti tingkat nasional hingga internasional.</p>
                    </div>
                </div>
                <div class="flex">
                    <div class="mr-2 md:mr-16 h-fit bg-[#5ACEF2] rounded-full shrink-0">
                        <img class="w-8 md:w-33" src="/assets/profil.png" alt="">
                    </div>
                    <div class="text-white">
                        <h1 class="text-[7px] md:text-4xl font-koulen">Putu Devika Raisa Nayuri</h1>
                        <h2 class="text-[6px] md:text-2xl font-koulen">SD Jambe Agung Batubulan</h2>
                        <p class="font-lao text-[6px] md:text-3xl">Kegiatan ini sangat disarankan. Untuk memberikan
                            wadah
                            atau ruang ke anak2 pencinta MIPA untuk bisa mengeksplor kemampuannya.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-18 md:mt-38">
            <div class="relative w-fit mx-auto">
                <h1 class="text-[18px] md:text-[50px] pb-1 px-3 md:px-67 md:pb-13 text-white text-center">MEDIA PARTNER
                </h1>
                <div
                    class="h-0.5 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
                </div>
                <div
                    class="h-0.5 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
                </div>
            </div>

            <div class="px-8 sm:px-14 lg:px-28 mt-8">

                <div class="marquee overflow-x-hidden group py-4">
                    <div class="marquee-group flex gap-10 w-max pl-10">
                        @for ($i = 0; $i < 2; $i++)
                            <img src="/assets/fokus-event.png" alt="" class="h-36 item">
                            <img src="/assets/gudang-lomba.png" alt="" class="h-36 item">
                            <img src="/assets/info-lomba.png" alt="" class="h-36 item">
                            <img src="/assets/lomba-SMA.png" alt="" class="h-36 item">
                        @endfor
                    </div>
                </div>
            </div>
            {{-- <div class="relative pb-[6px] md:pb-9">
                <div class="mt-2.5 md:mt-6 overflow-x-auto px-3 md:px-10">
                    <div class="flex gap-1 md:gap-6 space-x-1 md:space-x-4 w-max">
                        <img class="h-27 md:h-[450px] object-contain" src="/assets/fokus-event.png" alt="">
                        <img class="h-27 md:h-[450px] object-contain" src="/assets/gudang-lomba.png" alt="">
                        <img class="h-27 md:h-[450px] object-contain" src="/assets/info-lomba.png" alt="">
                        <img class="h-27 md:h-[450px] object-contain" src="/assets/lomba-SMA.png" alt="">
                    </div>
                </div>
                <div
                    class="h-[0.75px] md:h-0.5 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
                </div>
                <div
                    class="h-[0.75px] md:h-0.5 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
                </div>
            </div> --}}

            <div
                class="mt-4 pb-5 text-center text-[8px] md:text-4xl md:mt-[97px] md:mx-auto font-koulen md:pb-14 text-white/20">
                &copy; 2025 UDAYANAPHYSICSCHAMPIONSHIP. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>

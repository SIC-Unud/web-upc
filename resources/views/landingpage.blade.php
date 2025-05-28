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
    <div class="bg-black flex justify-between relative overflow-hidden px-4">
        <img src="/assets/Logolayout.png" alt="" class="w-11 py-4 md:w-28 md:pl-[30px] md:py-[19px]">
        <img src="/assets/garis3.png" alt="" class="w-5 py-4 md:w-18 md:py-[19px] md:pr-[30px]">
        <div
            class="h-1 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
        </div>
        <div
            class="h-1 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
        </div>
    </div>

    <div class="bg-[url(../../public/assets/image-9.png)] bg-black bg-cover overflow-hidden relative">
        <div class="flex items-center justify-evenly">
            <img class="hidden md:block md:w-55 md:mt-5" src="/assets/PurpleCat.png" alt="">
            <div class="mt-7">
                <h1
                    class="text-white text-[13px] text-center font-julius md:flex md:text-2xl md:mb-5 md:justify-center">
                    UDAYANA PHYSICS CHAMPIONSHIP</h1>
                <div class="flex justify-center">
                    <img class="flex mt-3 w-[246px] md:w-[450px]" src="/assets/Logo.png" alt="">
                </div>
            </div>
            <img class="hidden md:block md:w-55 md:mt-5" src="/assets/YellowCat.png" alt="">
        </div>
        <div class="flex justify-center items-center w-full">
            <img class="w-[80px] relative z-10 md:hidden" src="/assets/PurpleCat.png" alt="">
            <a
                class="mx-5 relative z-10 flex w-fit justify-center items-center py-4 px-[12px] backdrop-blur-sm bg-white/10 md:py-[30px] md:px-[30px] md:mt-5">
                <div class="absolute w-px h-full left-0 top-0 bg-[#12B1EB]"></div>
                <div class="absolute w-px h-full right-0 top-0 bg-[#FFD900]"></div>
                <div class="absolute top-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                <div class="absolute bottom-0 h-px w-full bg-gradient-to-r from-[#12B1EB] to-[#FFD900]"></div>
                <div class="text-[13px] text-white leading-6 mr-[8px] font-julius md:mr-6 md:text-2xl">DAFTAR SEKARANG
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3 md:size-6  text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
            <img class="w-[80px] relative z-10 md:hidden" src="/assets/YellowCat.png" alt="">
        </div>
        <div
            class="w-full z-0 absolute bg-gradient-to-b from-transparent via-black to-transparent h-30 -bottom-15 from-0% via-60% to-95% md:h-30">
        </div>
    </div>

    <div class="bg-[url(../../public/assets/latar2.png)] bg-black bg-cover">
        <div class="px-4 overflow-x-auto md:px-18 md:pt-[10px]">
            <div class="flex gap-2 w-fit snap-x md:w-auto md:gap-[29px]">
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-cover transition hover:scale-105" src="/assets/foto1.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-cover transition hover:scale-105" src="/assets/foto2.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-cover transition hover:scale-105" src="/assets/foto3.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-cover transition hover:scale-105" src="/assets/foto4.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-cover transition hover:scale-105" src="/assets/foto5.png"
                        alt="">
                </div>
                <div
                    class="drop-shadow-white/25 drop-shadow-[10px_9px_9px] py-6 snap-center w-[84px] md:w-[269px] shrink-0 lg:shrink">
                    <img class="object-contain md:object-cover transition hover:scale-105" src="/assets/foto6.png"
                        alt="">
                </div>
            </div>
        </div>

        <div class="flex items-center ml-10 mt-12 md:ml-35 md:mt-22">
            <div class="w-full">
                <div class="md:pb-12 pb-3 relative flex justify-center">
                    <img class="w-17 md:w-90" src="/assets/LogoDesc.png" alt="">
                    <div
                        class="h-0.5 md:h-1 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
                    </div>
                    <div
                        class="h-0.5 md:h-1 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
                    </div>
                </div>
                <h1 class="text-white text-justify text-[8px] md:text-lg font-lao mt-4 md:mt-10">Udayana Physics
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
                <img class="relative object-cover -right-8 w-60 md:w-auto md:static" src="/assets/siapa ya.png"
                    alt="">
            </div>
        </div>

        <div class="mt-12 mx-8 md:mt-20">
            <div class="relative mx-auto lg:w-fit">
                <h1 class="text-lg md:text-3xl pb-4 md:px-70 md:pb-10 text-white text-center font-novaria">BIDANG
                    LOMBA</h1>
                <div
                    class="h-0.5 bg-gradient-to-r absolute bottom-0 left-0 from-black via-[#12B1EB]/95 to-white from-0% via-20% to-60% w-1/2">
                </div>
                <div
                    class="h-0.5 bg-gradient-to-l absolute bottom-0 right-0 from-black via-[#FFD900] to-white from-0% via-20% to-60% w-1/2">
                </div>
            </div>

            <div
                class="mt-5 justify-evenly items-center text-[8px] flex font-lao md:w-full md:flex-wrap lg:flex-nowrap md:mt-10 md:gap-9 md:text-xl">
                <div class="w-16 md:w-32">
                    <img class="" src="/assets/SD.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Cerdas Cermat SD</h1>
                </div>
                <div class="w-16 md:w-32">
                    <img class="" src="/assets/SMP.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Fisika SMP</h1>
                </div>
                <div class="w-16 md:w-32">
                    <img class="" src="/assets/SMA.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Fisika SMA</h1>
                </div>
                <div class="w-16 md:w-32">
                    <img class="" src="/assets/kebumian.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Kebumian</h1>
                </div>
                <div class="w-16 md:w-32">
                    <img class="" src="/assets/astronomi.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Astronomi</h1>
                </div>
                <div class="w-16 md:w-32">
                    <img class="" src="/assets/essai.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Essai</h1>
                </div>
                <div class="w-16 md:w-32">
                    <img class="" src="/assets/poster_ilmiah.png" alt="">
                    <h1 class="text-wrap text-center text-white mt-2.5">Kompetisi Poster Ilmiah</h1>
                </div>
            </div>
        </div>

        <div class="text-white px-10 mt-15 md:mt-30 md:px-32">
            <h1 class="text-lg md:text-3xl pb-4 md:px-70 md:pb-10 text-white text-center font-novaria">TIMELINE</h1>
            <div class="grid grid-cols-3">
                {{-- Elemen Pertama --}}
                <div class="col-span-3">
                    <div class="flex items-center justify-center gap-6 w-fit mx-auto -translate-x-[calc(50%-12px)]">
                        <div>
                            <h3 class="font-medium text-xs md:text-lg">PENDAFTARAN PERIODE I</h3>
                            <div class="text-[8px] md:text-base">22 Juni - 25 Juli</div>
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
                            <h3 class="font-medium text-xs md:text-lg">PENDAFTARAN PERIODE II</h3>
                            <div class="text-[8px] md:text-base">26 Juli - 24 Agustus</div>
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
                            <h3 class="font-medium text-xs md:text-lg">PENDAFTARAN PERIODE III</h3>
                            <div class="text-[8px] md:text-base">25 Agustus - 19 September</div>
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
                            <h3 class="font-medium text-xs md:text-lg">Technical Meeting</h3>
                            <div class="text-[8px] md:text-base">26 September</div>
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


                {{-- Elemen Kelima --}}
                <div>
                    <div class="flex items-center justify-end gap-6">
                        <div>
                            <h3 class="font-medium text-xs md:text-lg">BABAK PENYISIHAN</h3>
                            <div class="text-[8px] md:text-base">27 September</div>
                        </div>
                        <img src="/assets/star.png" alt="" class="size-6">
                    </div>
                </div>
                <div class="col-span-2"></div>
                {{-- Panah Start --}}
                <div></div>
                <div>
                    <div class="h-40 w-1/2 mr-auto">
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

                {{-- Elemen Keenam --}}
                <div class="col-span-3">
                    <div
                        class="flex items-center justify-center gap-6 w-fit max-w-1/2 mx-auto translate-x-[calc(50%-12px)]">
                        <img src="/assets/star.png" alt="" class="size-6">
                        <div class="w-full">
                            <h3 class="font-medium text-xs text-wrap break-words whitespace-normal md:text-lg">Puncak
                                Acara
                                (Semi Final & Final)</h3>
                            <div class="text-[8px] md:text-base">18 Oktober</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="size-40">
                <div class="w-full h-px border-t border-dashed border-white rotate-45 origin-top-left"></div>
            </div> --}}
        </div>

        <div class="flex items-center mr-10 mt-12 md:mr-35 md:mt-43">
            <div class="overflow-hidden w-70 md:w-100">
                <img class="relative -left-1 md:static" src="/assets/cat-purple.png" alt="">
            </div>
            <div
                class="relative flex-grow bg-[#D9D9D9]/14 backdrop-blur-sm p-3 border border-white md:px-[55px] md:py-[51px] md:w-[962px]">
                <img class="w-8 absolute -top-[2px] -left-[2px] md:-top-2.5 md:w-auto md:-left-2.5"
                    src="/assets/bazel1.png" alt="">
                <img class="w-8 absolute -bottom-[2px] -right-[2px] md:-bottom-2.5 md:w-auto md:-right-2.5"
                    src="/assets/bazel2.png" alt="">
                <div class="flex border-b border-white mb-2 pb-2 md:pb-8 md:mb-9">
                    <div class="mr-2 md:mr-16 h-fit bg-[#5ACEF2] rounded-full shrink-0">
                        <img class="w-8 md:w-27" src="/assets/profil.png" alt="">
                    </div>
                    <div class="text-white">
                        <h1 class="text-[7px] md:text-2xl font-koulen">Ni Kadek Belinda Maheswari Prahsini </h1>
                        <h2 class="text-[6px] md:text-xl font-koulen">SMA Negeri 1 Denpasar</h2>
                        <p class="font-lao text-[6px] md:text-lg">Kegiatan sangat bermanfaat untuk mengetes kemampuan
                            akademik peserta dan
                            menyiapkan diri untuk
                            kompetisi-kompetisi lainnya.</p>
                    </div>
                </div>
                <div class="flex border-b border-white mb-2 pb-2 md:pb-8 md:mb-9">
                    <div class="mr-2 md:mr-16 h-fit bg-[#5ACEF2] rounded-full shrink-0">
                        <img class="w-8 md:w-27" src="/assets/profil.png" alt="">
                    </div>
                    <div class="text-white">
                        <h1 class="text-[7px] md:text-2xl font-koulen">Wilson Sidarta Putra Lohanata</h1>
                        <h2 class="text-[6px] md:text-xl font-koulen">SMAK PENABUR Gading Serpong</h2>
                        <p class="font-lao text-[6px] md:text-lg">Bagi saya, UPC ini merupakan sarana yang sangat baik
                            sebagai persiapan awal hingga menengah peserta didik dalam mengerjakan soal-soal olimpiade
                            yang
                            lebih lanjut, seperti tingkat nasional hingga internasional.</p>
                    </div>
                </div>
                <div class="flex">
                    <div class="mr-2 md:mr-16 h-fit bg-[#5ACEF2] rounded-full shrink-0">
                        <img class="w-8 md:w-27" src="/assets/profil.png" alt="">
                    </div>
                    <div class="text-white">
                        <h1 class="text-[10px] md:text-2xl font-koulen">Putu Devika Raisa Nayuri</h1>
                        <h2 class="text-[8px] md:text-xl font-koulen">SD Jambe Agung Batubulan</h2>
                        <p class="font-lao text-[8px] md:text-lg">Kegiatan ini sangat disarankan. Untuk memberikan
                            wadah
                            atau ruang ke anak2 pencinta MIPA untuk bisa mengeksplor kemampuannya.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-18 md:mt-38">
            <div class="relative w-fit mx-auto">
                <h1 class="text-lg md:text-3xl pb-1 px-3 md:px-67 md:pb-13 text-white text-center font-novaria">
                    MEDIA PARTNER
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
                            <img src="/assets/fokus-event.png" alt="" class="h-20 md:h-36 item">
                            <img src="/assets/gudang-lomba.png" alt="" class="h-20 md:h-36 item">
                            <img src="/assets/info-lomba.png" alt="" class="h-20 md:h-36 item">
                            <img src="/assets/lomba-SMA.png" alt="" class="h-20 md:h-36 item">
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

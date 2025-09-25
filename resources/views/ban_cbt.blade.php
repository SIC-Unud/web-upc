<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UPC | Pinalti Kompetisi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    {{-- Header --}}
    <header id="mainHeader"
        class="overflow-visible fixed px-5 py-1 left-0 top-0 right-0 z-40 flex justify-between items-center bg-white ">
        {{-- logo --}}
        <img src="/assets/competition/logo-sidebar.png" alt="logo" class="mb-2 mt-3 lg:mt-4 ml-3 w-10 lg:w-20">
        {{-- Log out Button --}}
        {{-- <button type="button" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 lg:size-9">
                <path fill-rule="evenodd"
                    d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </button type="button"> --}}
        <div class="absolute w-full h-[1px] bottom-0 left-0 flex">
            <div class="w-1/2 bg-gradient-to-r from-gray-100 via-[#12B1EB]/95 to-white from-0% via-5% to-40% "></div>
            <div class="w-1/2 bg-gradient-to-l from-gray-100 via-[#FFD900] to-white from-0% via-5% to-40% "></div>
        </div>
    </header>
    {{-- Header --}}


    {{-- Content --}}
    <div x-data="{ isOpen: false }" id="mainContent" class=" min-h-screen w-full h-full py-11 bg-gray-100 ">


        {{-- Menu Soal SideBar Mobile dan Tablet --}}
        <div x-bind:class="isOpen ? 'block' : 'hidden'" x-cloak
            class="fixed z-30 shadow-[0_0_30px_rgba(0,0,0,0.25)] bg-white p-5 h-screen lg:hidden">
            <h2 class="font-bold mb-3 md:text-lg">Soal</h2>
            <div class="grid grid-cols-4 gap-2">
                @for ($i = 1; $i <= 20; $i++)
                    <button type="button"
                        class="drop-shadow-lg size-7 items-center text-[10px] md:text-sm rounded-sm cursor-pointer hover:bg-[#007BFF] hover:text-white bg-white"
                    >{{ $i }}</button>
                @endfor
            </div>
        </div>
        {{-- Menu Soal SideBar Mobile dan Tablet --}}


        <div class=" bg-gray-100 min-h-screen w-full h-full px-5 lg:px-9 py-5 lg:py-11">
            <div x-data="countdown">
                <div class="flex flex-col font-jakarta gap-5 lg:gap-9 md:flex-row">

                    <div x-bind:class="isOpen ? 'left-44' : 'left-0'"
                        class="py-1 px-3 flex gap-2 items-center fixed top-11 z-20 bg-white shadow-lg rounded-br-xl lg:hidden"
                        x-on:click="isOpen = !isOpen">
                        <button class="cursor-pointer" type="button">☰</button>
                        <h2 class="font-bold">Soal</h2>
                    </div>

                    <div class="fixed top-11 right-0 z-20 bg-white shadow-lg rounded-bl-xl py-1 px-5 text-center font-bold lg:hidden text-black">
                        10:00
                    </div>

                    <div class="md:w-3/5 lg:w-2/5 mt-5">
                        <div class="flex gap-2 items-center justify-end lg:hidden mb-4">
                            <button
                                class="px-3 py-2 rounded-lg bg-[#00C482] flex gap-2 items-center text-white cursor-pointer text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                                Selesai
                            </button>
                        </div>

                        <div class="drop-shadow-xl bg-white rounded-2xl p-6">
                            <div class="flex gap-3 items-center mb-3">
                                <h2 class="font-bold text-2xl">Soal No. 1</h2>
                            </div>

                            <p class="text-sm text-justify">
                                Ini adalah contoh pertanyaan dummy untuk tes tampilan. Silakan pilih jawaban yang paling tepat.
                            </p>
                        </div>
                    </div>

                    {{-- Pilihan Jawaban --}}
                    <div class="md:w-2/5 mt-5 md:mt-0">
                        <h2 class="font-bold text-2xl mb-3">Pilihan</h2>
                        <div class="flex flex-col gap-3">
                            <div class="bg-white hover:bg-blue-400 text-black hover:text-white rounded-lg py-3 px-5 cursor-pointer">A. Pilihan Pertama</div>
                            <div class="bg-white hover:bg-blue-400 text-black hover:text-white rounded-lg py-3 px-5 cursor-pointer">B. Pilihan Kedua</div>
                            <div class="bg-white hover:bg-blue-400 text-black hover:text-white rounded-lg py-3 px-5 cursor-pointer">C. Pilihan Ketiga</div>
                            <div class="bg-white hover:bg-blue-400 text-black hover:text-white rounded-lg py-3 px-5 cursor-pointer">D. Pilihan Keempat</div>
                        </div>
                    </div>

                    {{-- Sidebar Desktop --}}
                    <div class="lg:w-1/5 lg:block hidden">
                        <div class="hidden gap-2 items-center justify-end lg:flex mb-6">
                            <button
                                class="px-4.5 py-3 rounded-lg bg-[#00C482] flex gap-2 items-center text-white cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                                Selesai
                            </button>
                        </div>
                        <div class="drop-shadow-xl bg-white rounded-2xl p-6 mb-6">
                            <h2 class="font-bold text-2xl mb-4">Soal</h2>
                            <div class="grid grid-cols-6 gap-2">
                                @for ($i = 1; $i <= 10; $i++)
                                    <button class="inline-flex justify-center drop-shadow-lg size-7 items-center text-[12px] md:text-sm rounded-sm cursor-pointer hover:bg-[#007BFF] hover:text-white bg-white">
                                        {{ $i }}
                                    </button>
                                @endfor
                            </div>
                        </div>

                        {{-- Countdown Desktop --}}
                        <div class="drop-shadow-xl bg-white rounded-2xl py-8 px-4 text-center font-bold text-xl text-black">
                            10:00
                        </div>
                    </div>

                    {{-- Tombol Navigasi --}}
                    <div class="flex gap-2 justify-between items-center lg:hidden mt-4">
                        <button class="px-4 py-2 rounded-md bg-gray-300 text-sm cursor-not-allowed">Sebelumnya</button>
                        <button class="px-4 py-2 rounded-md bg-[#00C482] text-white text-sm cursor-pointer">Selanjutnya</button>
                    </div>
                </div>
                <div
                    class="fixed inset-0 flex bg-black/50 items-center justify-center w-screen h-screen backdrop-blur-sm z-50 font-jakarta">
                    <div class="bg-white p-6 rounded-lg shadow-xl w-160 max-w-full font-jakarta">
                        <div class="mb-10">
                            <h1 class="mb-3 font-bold text-xl lg:text-2xl text-red-500 text-center md:text-start">Perhatian!</h1>
                            <div class="flex gap-3 flex-col md:flex-row">
                                <div class="flex flex-col items-center gap-4">
                                    <div class="shadow-lg rounded-xl bg-gray-50 py-4 px-8 flex items-center justify-center w-28 max-w-full">
                                        <div class="font-semibold text-xl"
                                            :class="(minutes == 0 && seconds == 0 ) ? 'text-black' : 'text-red-500'"
                                            x-text="`${minutes}:${seconds}`"
                                        >
                                            00:30
                                        </div>
                                    </div>
                                    <p class="text-xs font-medium" :class="(minutes == 0 && seconds == 0 ) ? 'text-black' : 'text-red-500'">waktu pinalti</p>
                                </div>
                                <p class="text-justify text-sm md:text-base">Mohon maaf, anda tidak diperkenankan untuk keluar dari tab pada saat sesi ini berlangsung. Jika anda merasa ini kesalahan, anda dapat menghubungi pihak panitia!</p>
                            </div>
                        </div>
                        <div class="flex justify-center md:justify-end">
                            <template x-if="minutes >= 0 && seconds > 0">
                                <button class="bg-gray-600 text-gray-100 py-2 px-5 rounded-md cursor-not-allowed">Mengerti</button>
                            </template>
                            <template x-if="minutes == 0 && seconds == 0">
                                <button class="bg-[#12B1EB] text-gray-100 py-2 px-5 rounded-md cursor-pointer" x-on:click="window.location.reload()">Mengerti</button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Content --}}

    {{-- Footer --}}
    <footer id="mainFooter" class="max-h-fit min-h-fit fixed z-40 bg-white bottom-0 right-0 left-0 ">
        <h3 class="text-[#4C4C4C] mx-10 my-1 lg:my-4 text-[8px] lg:text-base font-light">&copy; 2025
            UDAYANAPHYSICSCHAMPIONSHIP. All rights reserved.</h3>
    </footer>


    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('countdown', () => ({
                time: dayjs("{{ $expired_at }}"),
                minutes: 0,
                seconds: 0,
                confirmFinish: false,
                init() {
                    this.updateCountdown()
                    setInterval(() => {
                        this.updateCountdown()
                    }, 1000);
                },
                updateCountdown() {
                    const now = dayjs();
                    const diff = this.time.diff(now)

                    if (diff <= 0) {
                        this.minutes = 0
                        this.seconds = 0
                        window.location.reload();
                        return
                    }

                    this.minutes = this.time.diff(now, 'minute')
                    this.seconds = this.time.diff(now, 'second') % 60
                }
            }))
        })

    </script>
    @livewireScripts
</body>
</html>
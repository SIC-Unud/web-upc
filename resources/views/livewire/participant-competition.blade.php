<div x-data="countdown">
    <div class="flex flex-col font-jakarta gap-5 lg:gap-9 md:flex-row">

        {{-- Tombol SideBar di Mobile & Tablet --}}
        <div x-bind:class="isOpen ? 'left-44' : 'left-0'"
            class="py-1 px-3 flex gap-2 items-center fixed top-11 z-20 bg-white shadow-[0_0_30px_rgba(0,0,0,0.25)] rounded-br-xl lg:hidden"
            x-on:click="isOpen = !isOpen">
            <button class="cursor-pointer" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <h2 class="font-bold">Soal</h2>
        </div>
        {{-- Tombol SideBar di Mobile & Tablet --}}

        {{-- Countdown di Mobile & Tablet --}}
        <div class="fixed top-11 right-0 z-20 bg-white shadow-[0_0_30px_rgba(0,0,0,0.25)] rounded-bl-xl py-1 px-5 text-center font-bold lg:hidden"
            x-text="`${minutes}:${seconds}`">
            00:00
        </div>
        {{-- Countdown di tablet --}}

        {{-- Soal --}}
        <div class="md:w-3/5 lg:w-2/5 mt-5">
            <button
                class="px-3 py-2 rounded-lg bg-[#00C482] flex gap-2 items-center text-white mb-4 ml-auto cursor-pointer text-sm lg:hidden"
                x-on:click="confirmFinish = true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                Selesai
            </button>
            <div class="drop-shadow-xl bg-white rounded-2xl p-3 lg:p-6">
                <h2 class="font-bold mb-3 lg:mb-6 md:text-xl lg:text-2xl">Soal No. {{ $question_number }}</h2>
                <div class="flex justify-center">
                    @if ($question->question_image)
                        <img src="{{ asset($question->question_image) }}" alt=""
                            class="mb-3 items-center w-85 md:w-90 lg:w-auto lg:mb-6">
                    @endif
                </div>
                <p class="text-[12px] md:text-sm text-justify">
                    {{ $question->question }}
                </p>
            </div>
        </div>
        {{-- Soal --}}

        {{-- Pilihan --}}
        <div class="md:w-2/5">
            <h2 class="font-bold md:text-xl lg:text-2xl mb-3 lg:mb-6">Pilihan</h2>
            <div class="flex flex-col gap-2 md:gap-3">
                @foreach ($pilihan as $i => $pil)
                    <div class="drop-shadow-sm text-wrap rounded-lg  cursor-pointer hover:bg-[#007BFF] hover:text-white text-[12px] py-2 px-3 md:text-sm lg:py-4 lg:px-5 {{ $pil->id == $selectedOption || $pil->id == $answers[$question_number - 1] ? 'bg-[#007BFF] text-white' : 'bg-white' }}"
                        wire:click="selectOption({{ $pil->id }})">
                        {{ chr(65 + $i) }}. {{ $pil->answer_value }}</div>
                @endforeach
            </div>
        </div>
        {{-- Pilihan --}}

        <div class="lg:w-1/5 lg:block hidden">
            <button
                class="px-4.5 py-3 rounded-lg bg-[#00C482] hidden lg:flex gap-2 items-center text-white mb-6 ml-auto cursor-pointer"
                x-on:click="confirmFinish = true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                Selesai
            </button>
            {{-- Menu Soal --}}
            <div class="drop-shadow-xl bg-white rounded-2xl p-6 lg:mb-6">
                <h2 class="font-bold text-2xl mb-4">Soal</h2>
                <div class="grid grid-cols-6 gap-2">
                    @for ($i = 1; $i <= $count; $i++)
                        <button wire:click="moveQuestion({{ $i }})"
                            class="inline-flex justify-center drop-shadow-lg size-7 items-center text-[12px] md:text-sm rounded-sm cursor-pointer hover:bg-[#007BFF] hover:text-white {{ $answers[$i - 1] != null || $i == $question_number ? 'bg-[#007BFF] text-white' : 'bg-white' }}">{{ $i }}</button>
                    @endfor
                </div>
            </div>
            {{-- Menu Soal --}}

            {{-- Countdown di Desktop --}}
            <div class="drop-shadow-xl bg-white rounded-2xl py-8 px-4 text-center font-bold text-xl"
                x-text="`${minutes}:${seconds}`">
                00:00
            </div>
            {{-- Countdown di Desktop --}}
        </div>
    </div>

    <template x-if="confirmFinish">
        <div
            class="fixed inset-0 flex bg-black/50 items-center justify-center w-screen h-screen backdrop-blur-sm z-50 font-jakarta">
            <div class="bg-white p-6 rounded-lg shadow-xl w-90 font-jakarta">
                <div class="mb-10">
                    <h1 class="mb-3 font-bold text-xl">Selesaikan sesi?</h1>
                    <p class="text-justify">Apakah anda yakin menyimpan seluruh progres dan mengakhiri sesi ini?</p>
                </div>
                <div class="flex justify-end">
                    <div class="flex gap-5 text-sm">
                        <button class="bg-[#4C4C4C] text-white py-1 px-5 cursor-pointer"
                            x-on:click="confirmFinish = false">Batal</button>
                        <button class="bg-[#029161] text-white py-1 px-5 cursor-pointer">Simpan & Keluar</button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

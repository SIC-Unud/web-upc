<div x-data="countdown"
    x-init="
        let isReloading = false;
        window.addEventListener('beforeunload', () => { isReloading = true });

        window.addEventListener('pagehide', () => {
            if (!isReloading) {
                $wire.recordViolation();
            }
        });

        document.addEventListener('visibilitychange', () => {
            if (!isReloading && document.visibilityState === 'hidden') {
                $wire.recordViolation();
            }
        });

        window.addEventListener('blur', () => {
            if (!isReloading){
                $wire.recordViolation();
            }
        });

        let autosaveTimer;
        window.addEventListener('start-autosave', (event) => {
            clearTimeout(autosaveTimer);
            autosaveTimer = setTimeout(() => {
                $wire.saveAnswer();
            }, 2000);
        });
    "
>
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
            :class="(minutes <= 20) ? 'text-red-500' : 'text-black'"
            x-text="`${minutes}:${seconds}`">
            00:00
        </div>
        {{-- Countdown di tablet --}}

        {{-- Soal --}}
        <div class="md:w-3/5 lg:w-2/5 mt-5">
            <div class="flex gap-2 items-center justify-end lg:hidden mb-4">
                @if (session('showNotification'))
                    <p x-data="{ show: true }" 
                        x-show="show"
                        x-init="setTimeout(() => show = false, 1000)"
                        x-transition.opacity
                        class="font-semibold text-sm lg:text-base text-[#00C482]">
                        Progress berhasil disimpan!
                    </p>
                @endif
                <button
                    class="px-3 py-2 rounded-lg bg-[#00C482] flex gap-2 items-center text-white cursor-pointer text-sm"
                    x-on:click="confirmFinish = true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    Selesai
                </button>
            </div>
            <div class="drop-shadow-xl bg-white rounded-2xl p-3 lg:p-6">
                <div class="flex gap-3 items-center mb-3 lg:mb-6">
                    <h2 class="font-bold md:text-xl lg:text-2xl">Soal No. {{ $question_number }}</h2>
                    @if ($question->is_hot)
                        <div class="flex gap-1 items-center">
                            <svg class="size-5 md:size-6" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M35.3211 22.4C34.8611 21.8 34.3011 21.28 33.7811 20.76C32.4411 19.56 30.9211 18.7 29.6411 17.44C26.6611 14.52 26.0011 9.7 27.9011 6C26.0011 6.46 24.3411 7.5 22.9211 8.64C17.7411 12.8 15.7011 20.14 18.1411 26.44C18.2211 26.64 18.3011 26.84 18.3011 27.1C18.3011 27.54 18.0011 27.94 17.6011 28.1C17.1411 28.3 16.6611 28.18 16.2811 27.86C16.1676 27.7649 16.0726 27.6496 16.0011 27.52C13.7411 24.66 13.3811 20.56 14.9011 17.28C11.5611 20 9.74108 24.6 10.0011 28.94C10.1211 29.94 10.2411 30.94 10.5811 31.94C10.8611 33.14 11.4011 34.34 12.0011 35.4C14.1611 38.86 17.9011 41.34 21.9211 41.84C26.2011 42.38 30.7811 41.6 34.0611 38.64C37.7211 35.32 39.0011 30 37.1211 25.44L36.8611 24.92C36.4411 24 35.3211 22.4 35.3211 22.4ZM29.0011 35C28.4411 35.48 27.5211 36 26.8011 36.2C24.5611 37 22.3211 35.88 21.0011 34.56C23.3811 34 24.8011 32.24 25.2211 30.46C25.5611 28.86 24.9211 27.54 24.6611 26C24.4211 24.52 24.4611 23.26 25.0011 21.88C25.3811 22.64 25.7811 23.4 26.2611 24C27.8011 26 30.2211 26.88 30.7411 29.6C30.8211 29.88 30.8611 30.16 30.8611 30.46C30.9211 32.1 30.2011 33.9 29.0011 35Z" fill="#FF0000"/>
                            </svg>
                            <span class="text-xs md:text-sm text-red-500">HOTS</span>
                        </div>
                    @endif
                </div>
                <div class="flex justify-center">
                    @if ($question->question_image)
                        <img src="{{ asset('/storage/' . $question->question_image) }}" alt=""
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
                    @php
                        $activeOption = $selectedOption ?? $answers[$question_number] ?? null;
                    @endphp

                    <div class="math-content drop-shadow-sm text-wrap rounded-lg cursor-pointer hover:text-white text-[12px] py-2 px-3 md:text-sm lg:py-4 lg:px-5 
                                {{ $pil->id == $activeOption ? 'bg-[#007BFF] text-white' : 'bg-white hover:bg-[#68b1ff]' }}"
                        wire:click="selectOption({{ $pil->id }})">
                        {{ chr(65 + $i) }}. {!! $pil->answer_value !!}
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Pilihan --}}

        <div class="lg:w-1/5 lg:block hidden">
            <div class="hidden gap-2 items-center justify-end lg:flex mb-6">
                @if (session('showNotification'))
                    <p x-data="{ show: true }" 
                        x-show="show"
                        x-init="setTimeout(() => show = false, 1000)"
                        x-transition.opacity
                        class="font-semibold text-sm lg:text-base text-[#00C482]">
                        Progress berhasil disimpan!
                    </p>
                @endif
                <button
                    class="px-4.5 py-3 rounded-lg bg-[#00C482] flex gap-2 items-center text-white cursor-pointer"
                    x-on:click="confirmFinish = true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    Selesai
                </button>
            </div>
            {{-- Menu Soal --}}
            <div class="drop-shadow-xl bg-white rounded-2xl p-6 lg:mb-6">
                <h2 class="font-bold text-2xl mb-4">Soal</h2>
                <div class="grid grid-cols-6 gap-2">
                    @for ($i = 1; $i <= $count; $i++)
                        <button wire:click="moveQuestion({{ $i }})"
                            class="inline-flex justify-center drop-shadow-lg size-7 items-center text-[12px] md:text-sm rounded-sm cursor-pointer hover:bg-[#007BFF] hover:text-white {{ $answers[$i] != null || $i == $question_number ? 'bg-[#007BFF] text-white' : 'bg-white' }}">{{ $i }}</button>
                    @endfor
                </div>
            </div>
            {{-- Menu Soal --}}

            {{-- Countdown di Desktop --}}
            <div class="drop-shadow-xl bg-white rounded-2xl py-8 px-4 text-center font-bold text-xl"
                :class="(minutes <= 20) ? 'text-red-500' : 'text-black'"
                x-text="`${minutes}:${seconds}`">
                00:00
            </div>
            {{-- Countdown di Desktop --}}
        </div>

        <div class="flex gap-2 justify-between items-center md:hidden">
           <button
                class="px-4 py-2 rounded-md text-sm {{ $question_number == 1 ? 'bg-gray-300 cursor-not-allowed' : 'bg-[#00C482] text-white cursor-pointer' }}"
                wire:click="{{ $question_number == 1 ? '' : "moveQuestion($question_number - 1)" }}"
                @disabled($question_number == 1)>
                Sebelumnya
            </button>

            <button
                class="px-4 py-2 rounded-md text-sm {{ $question_number == $count ? 'bg-gray-300 cursor-not-allowed' : 'bg-[#00C482] text-white cursor-pointer' }}"
                wire:click="{{ $question_number == $count ? '' : "moveQuestion($question_number + 1)" }}"
                @disabled($question_number == $count)>
                Selanjutnya
            </button>

        </div>
    </div>

    <template x-if="confirmFinish">
        <div
            class="fixed inset-0 flex bg-black/50 items-center justify-center w-screen h-screen backdrop-blur-sm z-50 font-jakarta">
            <div class="bg-white p-6 rounded-lg shadow-xl w-110 max-w-full font-jakarta">
                <div class="mb-10">
                    <h1 class="mb-3 font-bold text-xl">Selesaikan sesi?</h1>
                    <p class="text-justify">Apakah anda yakin menyimpan seluruh progres dan mengakhiri sesi ini?</p>
                </div>
                <div class="flex justify-end">
                    <div class="flex gap-2">
                        <button class="bg-[#4C4C4C] text-white py-2 rounded-md px-5 cursor-pointer"
                            x-on:click="confirmFinish = false">Batal</button>
                        <button 
                            wire:click="finishAttempt"
                            class="bg-[#029161] hover:bg-green-700 text-white py-2 rounded-md px-5 cursor-pointer">
                            Simpan & Keluar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>

    @push('scripts-mathjax')
        <script>
            document.addEventListener('livewire:init', () => {
                let debounceTimer;

                const renderAllPreviews = () => {
                    const allPreviewElements = document.querySelectorAll('.math-content');

                    if (allPreviewElements.length > 0 && window.MathJax && window.MathJax.typesetPromise) {
                        MathJax.typesetPromise(allPreviewElements).catch((err) => console.log('MathJax typesetting error:', err));
                    }
                };

                const processWithDebounce = () => {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(renderAllPreviews, 50);
                };

                renderAllPreviews();

                Livewire.hook('commit', ({ component, respond }) => {
                    respond(() => {
                        processWithDebounce();
                    });
                });
            });
        </script>
    @endpush
</div>

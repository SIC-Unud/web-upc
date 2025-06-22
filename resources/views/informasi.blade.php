@extends('layouts.side-bar')

@section('title', 'Informasi')
@section('content')

<div x-data="{modalOpen: false, modalContent: '', modalTitle: '', isMobile: window.innerWidth < 768}"  x-init="$watch('isMobile', value => {}); window.addEventListener('resize', () => isMobile = window.innerWidth < 768)" class="px-4 relative font-jakarta">

    <h1 class="text-3xl md:text-5xl font-bold text-[#4C4C4C] py-8">Informasi</h1>

    <div class="space-y-4">
        @foreach ($informasi as $info)
            <div class="bg-white shadow-xl rounded-xl p-4 relative max-h-[140px] text-justify">
                <h2 class="md:text-lg text-base font-bold text-gray-800 mb-1">{{ $info['title'] }}</h2>

                <div class="text-xs md:text-base text-black relative overflow-hidden">
                    @php
                        $limitDesktop = 210;
                        $limitMobile = 80;
                        $previewDesktop = Str::limit($info['content'], $limitDesktop);
                        $previewMobile = Str::limit($info['content'], $limitMobile);
                    @endphp

                    <p class="text-xs md:text-base text-black">
                        <span x-show="!isMobile">{!! nl2br(e($previewDesktop)) !!}</span>
                        <span x-show="isMobile">{!! nl2br(e($previewMobile)) !!}</span>
                        <span
                            class="text-green-500 cursor-pointer hover:underline"
                            @click="modalOpen = true; modalContent = `{{ addslashes($info['content']) }}`; modalTitle = `{{ $info['title'] }}`"
                        >
                            lihat selengkapnya
                        </span>
                    </p>
                </div>
            </div>
        @endforeach


        <!-- Modal -->
        <div class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-black/10 z-50" x-show="modalOpen" x-transition>
            <div class="bg-white w-[70%] md:w-[60%] h-[55%] p-6 rounded-xl shadow-xl overflow-hidden">
                <div class="flex justify-between items-start mb-0">
                    <h2 class="font-bold text-lg md:text-2xl text-black mb-0" x-text="modalTitle"></h2>
                        <button class="text-gray-700 text-xl font-bold hover:text-red-600" @click="modalOpen = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 md:size-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                </div>
                <div class="text-sm md:text-lg text-black text-justify overflow-y-auto max-h-full pr-5">
                    <p class="mt-0" x-text="modalContent"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

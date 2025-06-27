@extends('layouts.side-bar')

@section('title', 'Informasi Admin')
@section('content')

<div x-data="{modalOpen: false, formOpen: false, modalContent: '', modalTitle: '', isMobile: window.innerWidth < 768, editMode: false}" x-init="$watch('isMobile', value => {}); window.addEventListener('resize', () => isMobile = window.innerWidth < 768)" class="px-4 relative font-jakarta">

    <div class="flex justify-between items-center py-8">
        <h1 class="text-3xl md:text-5xl font-bold text-[#4C4C4C]">Informasi</h1>
        <button @click="formOpen = true; modalTitle=''; modalContent=''; editMode=false" class="bg-[#007BFF] hover:shadow-xl text-white font-bold py-2 px-4 text-[10px] md:text-base">
            + Tambah
        </button>
    </div>

    <div class="space-y-4">
        @foreach ($informasi as $info)
            <div class="bg-white shadow-xl rounded-xl p-4 relative max-h-[140px] text-justify">
                <h2 class="md:text-lg text-sm font-bold text-gray-800 mb-1">{{ $info['title'] }}</h2>

                <div class="text-[10px] md:text-base text-black relative overflow-hidden">
                    @php
                        $limitDesktop = 210;
                        $limitMobile = 80;
                        $previewDesktop = Str::limit($info['content'], $limitDesktop);
                        $previewMobile = Str::limit($info['content'], $limitMobile);
                    @endphp

                    <p class="text-[10px] md:text-base text-black">
                        <span x-show="!isMobile">{!! nl2br(e($previewDesktop)) !!}</span>
                        <span x-show="isMobile">{!! nl2br(e($previewMobile)) !!}</span>
                        <span class="text-green-500 cursor-pointer hover:underline" @click="formOpen = true; modalTitle = `{{ addslashes($info['title']) }}`; modalContent = `{{ addslashes($info['content']) }}`; editMode = true">
                            lihat selengkapnya
                        </span>
                    </p>
                </div>
            </div>
        @endforeach

        <!-- Form Modal (Tambah / Edit) -->
        <div class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-black/10 z-50" x-show="formOpen" x-transition x-cloak>
            <div class="bg-white w-[90%] md:w-[60%] h-[75%] p-6 rounded-xl shadow-xl overflow-y-auto">
                <div class="flex justify-between items-start mb-3">
                    <h2 class="font-bold text-lg md:text-2xl text-black" x-text="editMode ? 'Edit Informasi' : 'Tambah Informasi'"></h2>
                    <button class="text-gray-700 text-xl font-bold hover:text-red-600" @click="formOpen = false; editMode = false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-8 md:size-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form @submit.prevent class="space-y-4">
                    <div>
                        <input type="text" name="title"
                            class="mt-1 block w-full rounded-md border-black shadow-xs p-3 font-bold text-base md:text-2xl text-black"
                            placeholder="Masukkan judul..."
                            x-model="modalTitle">
                    </div>
                    <div>
                        <textarea name="content" rows="4"
                            class="mt-1 block w-full rounded-md  border-black shadow-sm text-xs md:text-lg text-black text-justify overflow-y-auto min-h-[210px] p-3 pr-5"
                            placeholder="Tulis isi informasi..."
                            x-model="modalContent"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="button" class="bg-[#029161] hover:shadow-xl text-white font-bold text-xs md:text-base py-2 px-6"
                            @click="formOpen = false; editMode = false">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

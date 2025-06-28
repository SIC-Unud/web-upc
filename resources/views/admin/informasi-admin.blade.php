@extends('layouts.side-bar')

@section('title', 'Informasi Admin')
@section('content')

    <div x-data="{
            modalOpen: false,
            formOpen: false,
            modalContent: '',
            modalTitle: '',
            isMobile: window.innerWidth < 768,
            editMode: false,
            currentId: null,
            updateFormAction() {
                const form = document.getElementById('form');
                if (this.editMode && this.currentId) {
                    form.action = '/admin/informasi/update/' + this.currentId;
                    // Add method spoofing for PUT/PATCH if needed
                    let methodInput = form.querySelector('input[name=_method]');
                    if (!methodInput) {
                        methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        form.appendChild(methodInput);
                    }
                    methodInput.value = 'PUT';
                } else {
                    form.action = '{{ route('broadcast.store') }}';
                    // Remove method input for create
                    const methodInput = form.querySelector('input[name=_method]');
                    if (methodInput) {
                        methodInput.remove();
                    }
                }
            }
        }"
        x-init="$watch('isMobile', value => {}); window.addEventListener('resize', () => isMobile = window.innerWidth < 768)"
        class="px-4 relative font-jakarta">

        <div class="flex justify-between items-center py-8">
            <h1 class="text-3xl md:text-5xl font-bold text-[#4C4C4C]">Informasi</h1>
            <button
                @click="formOpen = true; modalTitle=''; modalContent=''; editMode=false; currentId=null; updateFormAction()"
                class="bg-[#007BFF] cursor-pointer hover:shadow-xl text-white font-bold py-2 px-4 text-[10px] md:text-base rounded-md">
                + Tambah
            </button>
        </div>

        <div class="space-y-4">
            @if (count($broadcasts) > 0)
                @foreach ($broadcasts as $info)
                    <div class="bg-white shadow-xl rounded-xl p-4 relative max-h-[140px] text-justify">
                        <div class="flex gap-2 justify-between items-center">
                            <h2 class="md:text-lg text-sm font-bold text-gray-800 mb-1">{{ $info['title'] }}</h2>
                            <form action="{{ route('broadcast.delete', $info['id']) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="rounded-md p-2 bg-red-500 text-white transition-all duration-300 hover:bg-red-600 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <div class="text-[10px] md:text-base text-black relative overflow-hidden">
                            @php
                                $limitDesktop = 210;
                                $limitMobile = 80;
                                $previewDesktop = Str::limit($info['broadcast'], $limitDesktop);
                                $previewMobile = Str::limit($info['broadcast'], $limitMobile);
                            @endphp

                            <p class="text-[10px] md:text-base text-black">
                                <span x-show="!isMobile">{!! nl2br(e($previewDesktop)) !!}</span>
                                <span x-show="isMobile">{!! nl2br(e($previewMobile)) !!}</span>
                                <span class="text-green-500 cursor-pointer hover:underline"
                                    @click="formOpen = true;
                                    modalTitle = `{{ addslashes($info['title']) }}`;
                                    modalContent = `{{ addslashes($info['broadcast']) }}`;
                                    editMode = true;
                                    currentId = {{ $info['id'] }};
                                    updateFormAction();"
                                >
                                    lihat selengkapnya
                                </span>
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="font-bold text-lg text-center">Belum Ada Data Broadcast</p>
            @endif

            <!-- Form Modal (Tambah / Edit) -->
            <div class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-black/10 z-50" x-show="formOpen"
                x-transition x-cloak>
                <div class="bg-white w-[90%] md:w-[60%] h-[75%] p-6 rounded-xl shadow-xl overflow-y-auto">
                    <div class="flex justify-between items-start mb-3">
                        <h2 class="font-bold text-lg md:text-2xl text-black"
                            x-text="editMode ? 'Edit Informasi' : 'Tambah Informasi'"></h2>
                        <button class="cursor-pointer text-gray-700 text-xl font-bold hover:text-red-600"
                            @click="formOpen = false; editMode = false; currentId = null;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-8 md:size-10" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form class="space-y-4" id="form" method="POST" action="{{ route('broadcast.store') }}">
                        @csrf
                        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                        <div>
                            <input type="text" name="title"
                                class="mt-1 block w-full rounded-md border-black shadow-xs p-3 font-bold text-base md:text-2xl text-black"
                                placeholder="Masukkan judul..." x-model="modalTitle">
                        </div>
                        <div>
                            <textarea name="broadcast" rows="4"
                                class="mt-1 block w-full rounded-md  border-black shadow-sm text-xs md:text-lg text-black text-justify overflow-y-auto min-h-[210px] p-3 pr-5"
                                placeholder="Tulis isi informasi..." x-model="modalContent"></textarea>
                        </div>
                        <div class="text-right">
                            <button class="bg-[#029161] hover:shadow-xl cursor-pointer text-white font-bold text-xs md:text-base py-2 px-6"
                                type="submit">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
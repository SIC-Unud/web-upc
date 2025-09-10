<div class="font-jakarta" 
    x-data="{
        isDirty: @entangle('isDirty'),
        banyakOpsi: @entangle('optionCount'),
        showNotif: @entangle('showNotification'),
        isSaving: @entangle('isSaving'),
        showConfirm: @entangle('showConfirmDialog'),
        pendingUrl: @entangle('pendingUrl'),
        isImageDeleted: @entangle('isImageDeleted'),
        init() {
            window.addEventListener('beforeunload', (e) => {
                if (this.isDirty) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            document.addEventListener('livewire:navigate', (e) => {
                if (this.isDirty) {
                    e.preventDefault();
                    this.pendingUrl = e.detail.url;
                    this.showConfirm = true;
                }
            });
        }
    }"
    x-init="$watch('showNotif', value => { if (value) setTimeout(() => showNotif = false, 1500) })"
    >
    @if ($totalQuestions == 0)
        <div class="w-full mt-3 flex items-center justify-center flex-col gap-2">
            <h1 class="text-center text-lg md:text-xl lg:text-2xl font-bold">{{ $competition->name }} belum mempunyai soal!</h1>
            <button 
                wire:click="addQuestion({{ $totalQuestions + 1 }})"
                class="rounded-md bg-[#00C482] hover:bg-[#00b074] lg:px-6 px-2 lg:py-3 py-2 cursor-pointer flex items-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 stroke-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <p class="hidden md:block md:text-base lg:text-lg text-white font-semibold">
                Tambah Soal
                </p>
            </button>
        </div>
    @else
        <div x-show="showConfirm" x-transition.opacity
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
                <h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
                <p class="text-gray-600 mb-6">Anda memiliki perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman ini?</p>
                <div class="flex gap-3 justify-end">
                    <button wire:click="handleCancelNavigation" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button wire:click="handleConfirmNavigation" 
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Ya, Tinggalkan
                    </button>
                </div>
            </div>
        </div>

        <header class="flex justify-between lg:mb-4 mb-2 relative">
            <h1 class="text-[#4C4C4C] font-bold lg:text-4xl text-2xl">Kompetisi</h1>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-3 relative">
                    <p x-show="showNotif" x-transition.opacity class="text-sm lg:text-base text-[#00C482] font-semibold">
                        Progres Berhasil Tersimpan!
                    </p>
                    <button 
                        wire:click="save" 
                        :disabled="isSaving"
                        :class="isSaving ? 'bg-gray-400 cursor-not-allowed' : 'bg-[#00C482] hover:bg-[#00b074]'" 
                        class="rounded-md lg:px-6 px-2 lg:py-3 py-2 cursor-pointer flex items-center gap-2 transition-colors">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="white" viewBox="0 0 16 16">
                            <path d="M11 2H9v3h2z"/>
                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                        </svg>
                        <p class="hidden md:block md:text-base lg:text-lg text-white font-semibold">
                            <span x-show="!isSaving">Simpan</span>
                            <span x-show="isSaving">Menyimpan...</span>
                        </p>
                    </button>
                </div>
                <button 
                    @click="if (confirm('Apakah Anda yakin ingin menghapus soal ini?')) { $wire.deleteQuestion() }" 
                    :disabled="isSaving"
                    :class="isSaving ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-600 hover:bg-red-700'" 
                    class="rounded-md lg:px-6 px-2 lg:py-3 py-2 cursor-pointer flex items-center gap-2 transition-colors"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    <p class="hidden md:block md:text-base lg:text-lg text-white font-semibold">
                        <span x-show="!isSaving">Hapus</span>
                        <span x-show="isSaving">Menghapus...</span>
                    </p>
                </button>
            </div>
        </header>

        <main class="block md:flex justify-between lg:gap-5 md:gap-3">
            <div class="bg-white rounded-md lg:px-12 px-6 lg:py-8 py-4 w-full grow shadow-lg mb-2 md:mb-0">
                <h2 class="md:text-xl text-base font-semibold lg:mb-4 mb-2">
                    {{ $competition->name }} - Soal {{ $questionNumber }}
                </h2>
                
                {{-- Image Upload --}}
                <label class="border min-h-20 lg:min-h-30 w-full flex-col gap-3 flex relative justify-center items-center h-max rounded-md cursor-pointer hover:bg-gray-50" for="image_upload">
                    @if ($questionImage)
                        <img src="{{ $questionImage->temporaryUrl() }}" alt="Preview Image" class="max-w-full h-30 object-contain">
                        <div class="absolute flex items-center top-2 gap-2 right-2">
                            <div wire:loading.remove wire:target="questionImage" class="justify-center items-center gap-2 bg-yellow-400 hover:bg-yellow-500 transition-all flex py-2 px-2 sm:px-5 duration-300 rounded-md"> 
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 640 640"><path d="M535.6 85.7C513.7 63.8 478.3 63.8 456.4 85.7L432 110.1L529.9 208L554.3 183.6C576.2 161.7 576.2 126.3 554.3 104.4L535.6 85.7zM236.4 305.7C230.3 311.8 225.6 319.3 222.9 327.6L193.3 416.4C190.4 425 192.7 434.5 199.1 441C205.5 447.5 215 449.7 223.7 446.8L312.5 417.2C320.7 414.5 328.2 409.8 334.4 403.7L496 241.9L398.1 144L236.4 305.7zM160 128C107 128 64 171 64 224L64 480C64 533 107 576 160 576L416 576C469 576 512 533 512 480L512 384C512 366.3 497.7 352 480 352C462.3 352 448 366.3 448 384L448 480C448 497.7 433.7 512 416 512L160 512C142.3 512 128 497.7 128 480L128 224C128 206.3 142.3 192 160 192L256 192C273.7 192 288 177.7 288 160C288 142.3 273.7 128 256 128L160 128z"/></svg> 
                                <p class="lg:text-sm md:text-xs hidden sm:block">Edit</p> 
                            </div>
                            <button wire:click="deleteImage" class="justify-center items-center gap-2 bg-red-600 hover:bg-red-700 transition-all flex p-2 duration-300 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 stroke-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    @elseif($question && $question->question_image && !$isImageDeleted)
                        <img src="{{ Storage::url($question->question_image) }}" alt="Question Image" class="max-w-full h-30 object-contain">
                        <div class="absolute flex items-center top-2 gap-2 right-2">
                            <div wire:loading.remove wire:target="questionImage" class="justify-center items-center gap-2 bg-yellow-400 hover:bg-yellow-500 transition-all flex py-2 px-2 sm:px-5 duration-300 rounded-md"> 
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 640 640"><path d="M535.6 85.7C513.7 63.8 478.3 63.8 456.4 85.7L432 110.1L529.9 208L554.3 183.6C576.2 161.7 576.2 126.3 554.3 104.4L535.6 85.7zM236.4 305.7C230.3 311.8 225.6 319.3 222.9 327.6L193.3 416.4C190.4 425 192.7 434.5 199.1 441C205.5 447.5 215 449.7 223.7 446.8L312.5 417.2C320.7 414.5 328.2 409.8 334.4 403.7L496 241.9L398.1 144L236.4 305.7zM160 128C107 128 64 171 64 224L64 480C64 533 107 576 160 576L416 576C469 576 512 533 512 480L512 384C512 366.3 497.7 352 480 352C462.3 352 448 366.3 448 384L448 480C448 497.7 433.7 512 416 512L160 512C142.3 512 128 497.7 128 480L128 224C128 206.3 142.3 192 160 192L256 192C273.7 192 288 177.7 288 160C288 142.3 273.7 128 256 128L160 128z"/></svg> 
                                <p class="lg:text-sm md:text-xs hidden sm:block">Edit</p> 
                            </div>
                            <button wire:click="deleteImage" class="justify-center items-center gap-2 bg-red-600 hover:bg-red-700 transition-all flex p-2 duration-300 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 stroke-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    @else
                        <div wire:loading.remove wire:target="questionImage" id="first_add_image" class="justify-center items-center gap-4 flex lg:py-10 py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="lg:w-8 w-6 lg:h-7 h-5" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1z"/>
                            </svg>
                            <p class="lg:text-2xl md:text-lg hidden md:block">Tambahkan Gambar</p>
                        </div>
                    @endif
                    <div wire:loading wire:target="questionImage" class="bg-black/30 absolute z-1 flex justify-center items-center w-full top-0 left-0 h-full">
                        <div class="flex justify-end items-start gap-3 w-full h-full p-3">
                            <svg class="animate-spin size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                            <p class="text-base font-medium hidden sm:block">Mengupload...</p>
                        </div>
                    </div>
                </label>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 stroke-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <span class="text-xs md:text-sm text-gray-500">Max. 1MB (.jpg / .png)</span>
                </div>
                <input wire:model.live="questionImage" class="hidden" type="file" accept="image/*" id="image_upload">
                @error('questionImage') <span class="text-red-500 text-sm mb-3">{{ $message }}</span> @enderror

                {{-- Question Text --}}
                <textarea 
                    wire:model.live="questionText"
                    class="border rounded-md lg:p-3 mt-4 p-1.5 w-full lg:mb-4 h-auto min-h-15 lg:min-h-0 resize-y lg:text-base text-xs" 
                    rows="4" 
                    placeholder="Ketik soal..."></textarea>
                @error('questionText') <span class="text-red-500 text-sm mb-3">{{ $message }}</span> @enderror

                <div class="grid grid-cols-1 sm:grid-cols-[repeat(6,1fr)_auto] gap-x-2 gap-y-4 justify-center mt-2">
                    {{-- Option Count --}}
                    <div class="flex col-span-1 sm:col-span-2 gap-2 items-center">
                        <label class="text-xs lg:text-base">Banyak Opsi</label>
                        <select wire:model.live="optionCount" class="bg-[#D9D9D9] text-center cursor-pointer">
                            @for($i = 3; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    {{-- Question Score --}}
                    <div class="col-span-1 sm:col-span-2 flex gap-2 items-center">
                        <label class="text-xs lg:text-base">Poin Soal</label>
                        <select wire:model.live="questionScore" class="bg-[#D9D9D9] text-center cursor-pointer">
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    {{-- HOT Question --}}
                    <div class="col-span-1 sm:col-span-2 flex gap-2 items-center">
                        <label class="text-xs lg:text-base">Soal HOTS</label>
                        <input wire:model.live="isHot" class="lg:size-4 size-3" type="checkbox">
                    </div>
                    
                    <p class="flex place-self-end text-xs lg:text-base">Kunci</p>
                    
                    {{-- Answer Options --}}
                    <div class="cols-span-1 sm:col-span-7 flex flex-col gap-2">
                        @for($i = 0; $i < $optionCount; $i++)
                            <div class="grid grid-cols-[1fr_auto] gap-2 items-center" wire:key="option-{{ $i }}">
                                <input 
                                    wire:model.live="options.{{ $i }}"
                                    type="text"
                                    class="p-2 lg:text-base text-xs border rounded-md resize-y" 
                                    placeholder="Ketik Opsi {{ $i + 1 }}">
                                <input 
                                    wire:model.live="correctAnswerIndex" 
                                    name="answer_key" 
                                    value="{{ $i }}" 
                                    class="lg:size-6 size-4" 
                                    type="radio">
                            </div>
                            @error("options.$i") <span class="text-red-500 text-sm mb-3">{{ $message }}</span> @enderror
                        @endfor
                        @error('options') <span class="text-red-500 text-sm mb-3">{{ $message }}</span> @enderror
                        @error('correctAnswerIndex') <span class="text-red-500 text-sm mb-3">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-auto md:gap-auto w-full md:max-w-104 md:w-104">
                {{-- Question Navigation --}}
                <div class="bg-white lg:px-4 lg:py-3 px-4 py-3 rounded-lg w-full shadow-lg order-2 md:order-1">
                    <h2 class="lg:text-lg sm:text-base font-bold md:pl-2 lg:mb-2 mb-1">Soal</h2>
                    <div class="h-max max-h-max p-0 md:p-2 w-full">
                        <div class="flex flex-wrap w-full gap-2">
                            @foreach($competition->questions as $i => $question)
                                <button 
                                    wire:click="goToQuestion({{ $i+1 }})"
                                    class="min-w-9 min-h-9 max-w-full max-h-max p-1.5 flex justify-center items-center rounded-lg shadow-[0_0_10px_rgba(0,0,0,0.2)] cursor-pointer text-[10px] lg:text-[14px] transition-colors
                                    {{ ($i+1) == $questionNumber 
                                        ? 'bg-[#007BFF] text-white' 
                                        : (!$question->not_null_question ? 'bg-gray-300 hover:bg-gray-400' : 'bg-white hover:bg-gray-100') }}">
                                    {{ $i+1 }}
                                </button>
                            @endforeach
                            <button 
                                wire:click="addQuestion({{ $totalQuestions + 1 }})"
                                class="bg-white min-w-9 min-h-9 max-w-max max-h-max p-1.5 flex justify-center items-center rounded-lg shadow-[0_0_10px_rgba(0,0,0,0.2)] cursor-pointer text-[10px] lg:text-[14px] hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                {{-- Duration --}}
                <div class="bg-white px-4 md:px-6 py-3 my-3 rounded-lg w-full shadow-lg order-1 md:order-2">
                    <h2 class="lg:text-lg sm:text-base font-bold lg:mb-2 sm:mb-1">Waktu</h2>
                    <div class="flex justify-start items-center gap-2">
                        <select wire:model.live="duration" class="bg-[#D9D9D9] text-center w-max cursor-pointer">
                            <option value="30">30</option>
                            <option value="45">45</option>
                            <option value="60">60</option>
                            <option value="90">90</option>
                            <option value="120">120</option>
                            <option value="180">180</option>
                        </select>                                   
                        <label class="lg:text-base sm:text-xs">Menit</label>
                    </div>
                    @error('duration') <span class="text-red-500 text-sm mb-3">{{ $message }}</span> @enderror
                </div>
            </div>
        </main>

        @if (session()->has('error'))
            <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                {{ session('error') }}
            </div>
        @endif
    @endif
</div>
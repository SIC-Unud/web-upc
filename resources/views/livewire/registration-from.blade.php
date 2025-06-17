<div class="bg-[url(../../public/assets/register/bg.png)] font-jakarta h-full pt-18">
    <div
        wire:loading
        wire:target="firstStepSubmit, secondStepSubmit, submitForm"
        class="fixed min-h-screen inset-0 bg-black/70 flex items-center justify-center z-50"
    >
        <div class="flex flex-col items-center justify-center text-white min-h-screen">
            <svg class="animate-spin h-10 w-10 mb-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <span class="text-sm md:text-lg font-light">Menyimpan data...</span>
        </div>
    </div>
    <div class="backdrop-blur-2xl bg-black/55">
        {{-- Heading --}}
        <div class="md:pt-12 pt-8 mx-auto text-white">
            <h1 class="font-bold text-4xl md:text-5xl text-center">Registrasi</h1>
            <p class="font-medium font-jakarta text-sm md:text-2xl px-6 md:px-15 lg:px-30 text-center my-8 md:my-12">
                Mulai proses pendaftaran dengan mengisi formulir online. Lengkapi data dirimu, lalu unggah dokumen pendukung. Prosesnya cepat, mudah, dan GRATIS!
            </p>
        </div>

        @if(!$success)
                    {{-- Step 1 Content --}}
                    @if($currentStep == 1)
                    <form wire:submit.prevent="firstStepSubmit" class="relative h-fit w-fit mx-8 md:mx-12 lg:mx-auto">
                        <div class="bg-black border border-white w-full h-full">
                            <img class="absolute select-none -top-[5px] md:-top-1.5 -left-1.5 size-24 md:size-32" 
                                src="/assets/register/{{ $currentStep == 1 ? 'border1' : 'border2' }}.png" alt="">
                            <div class="w-1.5 h-16 md:w-2.5 md:h-25 bg-white absolute -right-1.5 md:-right-2.5 -top-[0.2px]"></div>
                            <div class="w-0.5 h-30 md:h-55 bg-white absolute -right-0.5 -top-[0.2px]"></div>
                            <div class="py-6 px-8 md:py-12 md:px-10">
                                <h1 class="text-xl md:text-4xl font-semibold md:font-bold text-white">Informasi Umum</h1>
                                <p class="text-lg font-extralight md:text-xl mb-5 md:mb-12 text-white">Lengkapi formulir di bawah ini dengan data dirimu yang valid.</p>
                                <div class="mb-4 md:mb-8">
                                    <label for="source_of_information" class="md:block text-xs md:text-xl text-white">Dari mana Anda mengetahui kompetisi ini? <span class="text-red-500">*</span></label>
                                    <select wire:model="source_of_information" class="block w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="source_of_information" id="source_of_information" required>
                                        <option class="" value="">Pilih...</option>
                                        @foreach (config('const.source_of_informations') as $source)
                                            <option value="{{ $source }}">{{ $source }}</option>
                                        @endforeach
                                    </select>
                                    @error('source_of_information') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4 md:mb-8">
                                    <label for="is_first_competition" class="md:block text-xs md:text-xl text-wrap text-white">Apakah ini pertama kalinya Anda mengikuti kompetisi ini? <span class="text-red-500">*</span><label>
                                    <select wire:model="is_first_competition" class="block w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="is_first_competition" id="is_first_competition" required>
                                        <option value="">Pilih...</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                    @error('is_first_competition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4 md:mb-8">
                                    <label for="reason" class="md:block text-xs md:text-xl text-wrap text-white">Apa alasan utama Anda mengikuti kompetisi ini? <span class="text-red-500">*</span></label>
                                    <select wire:model="reason" class="block w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="reason" id="reason" required>
                                        <option class="" value="">Pilih...</option>
                                        @foreach (config('const.reasons') as $reason)
                                            <option value="{{ $reason }}">{{ $reason }}</option>
                                        @endforeach
                                    </select>
                                    @error('reason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-4 md:mb-8">
                                    <label for="special_needs" class="block text-xs md:text-xl text-wrap text-white">Apakah Anda memiliki kebutuhan khusus (disabilitas, alergi makanan, dll.)?</label>
                                    <input wire:model="special_needs" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="special_needs" id="special_needs">
                                </div>
                                <div class="mb-6 md:mb-12">
                                    <label for="competition" class="md:block text-xs md:text-xl text-wrap text-white">Kategori kompetisi apa yang ingin Anda ikuti?  <span class="text-red-500">*</span></label>
                                    <select wire:model="competition" class="block w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="competition" id="competition" required>
                                        <option class="" value="">Pilih...</option>
                                        @foreach ($competitions as $key => $competition)
                                            <option value="{{ $competition->id }}">{{ $competition->name }} {{ ($competition->is_team_competition ? '(kelompok)' : '') }}</option>
                                        @endforeach
                                    </select>
                                    @error('competition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Navigation Buttons --}}
                        <div class="py-14 grid grid-cols-3 items-center">
                            {{-- Previous Button --}}
                            <div></div>
                            
                            {{-- Progress Dots --}}
                            <div class="col-start-2 grid grid-cols-subgrid justify-items-center">
                                <div class="w-25 h-8 md:w-30 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] rounded-full p-[1px]">
                                    <div class="w-full h-full bg-black rounded-full flex items-center justify-center">
                                        <div class="flex items-center">
                                            <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white"></div>
                                            <div class="h-[0.5px] w-2 md:w-3 bg-white"></div>
                                            <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white">
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
                            
                            {{-- Next Button --}}
                            <button type="submit" class="w-20 h-8 md:w-38 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-end cursor-pointer">
                                <div class="w-full h-full bg-black flex items-center justify-center">
                                    <div class="flex justify-between item-center gap-2">
                                        <h1 class="text-white hidden md:contents md:text-lg">Selanjutnya</h1>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 md:size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                        </svg>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </form>
                    @endif

                    {{-- Step 2 Content --}}
                    @if($currentStep == 2)
                        @if (!$is_team_competition)
                            <form wire:submit.prevent="secondStepSubmit" class="relative h-fit w-fit mx-8 md:mx-12 lg:mx-auto">
                                <div class="bg-black border border-white w-full h-full">
                                    <img class="absolute select-none -top-[5px] md:-top-1.5 -left-1.5 size-24 md:size-32" 
                                        src="/assets/register/{{ $currentStep == 1 ? 'border1' : 'border2' }}.png" alt="">
                                    <div class="w-1.5 h-16 md:w-2.5 md:h-25 bg-white absolute -right-1.5 md:-right-2.5 -top-[0.2px]"></div>
                                    <div class="w-0.5 h-30 md:h-55 bg-white absolute -right-0.5 -top-[0.2px]"></div>
                                    <div class="py-6 px-8 md:py-12 md:px-10">
                                        <h1 class="text-3xl md:text-4xl font-bold text-white">Data Diri Peserta</h1>
                                        <p class="text-base font-extralight md:text-xl mb-5 md:mb-12 text-white">Lengkapi formulir di bawah ini dengan data dirimu yang valid.</p>
                                        <div class="grid grid-cols-1 mb-12 w-full gap-4 md:grid-cols-2 md:gap-x-8 md:gap-y-4">                               
                                            <div class="md:grid md:col-span-2">
                                                <label for="leader_name" class="block text-xs md:text-xl text-wrap text-white">Nama Lengkap (contoh: Yudhistira Arimbawa Saputra) <span class="text-red-500">*</span></label>
                                                <input wire:model="leader_name" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_name" id="leader_name" required>
                                                @error('leader_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="leader_student_id" class=" text-xs md:text-xl text-wrap text-white">NISN (Siswa) / NIM (Mahasiswa) <span class="text-red-500">*</span></label>
                                                <input wire:model="leader_student_id" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_student_id" id="leader_student_id" required>
                                                @error('leader_student_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="leader_date_of_birth" class=" text-xs md:text-xl text-wrap text-white">Tanggal lahir <span class="text-red-500">*</span></label>
                                                <input wire:model="leader_date_of_birth" type="date" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_date_of_birth" id="leader_date_of_birth" required>
                                                @error('leader_date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="leader_gender" class="md:block text-xs md:text-xl text-wrap text-white">Jenis Kelamin <span class="text-red-500">*</span></label>
                                                <select wire:model="leader_gender" class="block w-full md:py-3 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_gender" id="leader_gender" required>
                                                    <option value="">Pilih...</option>
                                                    <option value="l">Laki-laki</option>
                                                    <option value="p">Perempuan</option>
                                                </select>
                                                @error('leader_gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>    
                                            <div class="flex flex-col justify-between">
                                                <label for="leader_no_wa" class="block text-xs md:text-xl text-wrap text-white">No. Handphone (Aktif WhatsApp)<span class="text-red-500">*</span> </label>
                                                <input wire:model="leader_no_wa" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_no_wa" id="leader_no_wa" required>
                                                @error('leader_no_wa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="md:grid md:col-span-2">
                                                <label for="email" class="block text-xs md:text-xl text-wrap text-white">Email Aktif <span class="text-red-500">*</span></label>
                                                <input wire:model="email" type="email" placeholder="Ketik di sini..." class="w-full md:w-full md:py-2 md:px-1 p-2 text-xs md:text-lg border mt-2 bg-gray-300 text-black" name="email" id="email" required>
                                                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 mb-12 w-full gap-4 md:grid-cols-2 md:gap-x-8 md:gap-y-4">                               
                                            <div class="md:grid md:col-span-2">
                                                <label for="institution" class="block text-xs md:text-xl text-wrap text-white">Nama Lengkap Institusi <span class="text-red-500">*</span></label>
                                                <input wire:model="institution" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="institution" id="institution" required>
                                                @error('institution') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="institution_address" class="block text-xs md:text-xl text-wrap text-white">Alamat Institusi<span class="text-red-500">*</span></label>
                                                <input wire:model="institution_address" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="institution_address" id="institution_address" required>
                                                @error('institution_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="institution_province" class="block text-xs md:text-xl text-wrap text-white">Provinsi <span class="text-red-500">*</span></label>
                                                <input wire:model="institution_province" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="institution_province" id="institution_province" required>
                                                @error('institution_province') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="institution_city" class="block text-xs md:text-xl text-wrap text-white">Kabupaten/Kota <span class="text-red-500">*</span></label>
                                                <input wire:model="institution_city" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="institution_city" id="institution_city" required>
                                                @error('institution_city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="parent_no_wa" class="block text-xs md:text-xl text-wrap text-white">No. Handphone (Orang Tua/Pendamping) <span class="text-red-500">*</span></label>
                                                <input wire:model="parent_no_wa" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="parent_no_wa" id="parent_no_wa" required>
                                                @error('parent_no_wa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center gap-3 mb-4  md:mb-8">
                                            <div class="">
                                                <label class="block text-white font-extralight md:text-xl text-xs w-2/3" for="pass_photo">Pas Foto (Latar belakang merah, ukuran 3x4) (Format .jpg / .png) <span class="text-red-500">*</span></label>
                                                @error('pass_photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="">
                                                <input wire:model="pass_photo" id="file-input-img" name="pass_photo" accept=".jpg, .png" class="hidden" type="file"> 
                                                <div class="flex flex-col gap-2 items-end">
                                                    <label for="file-input-img" class="border border-[#12B1EB] rounded-md py-2 px-3 md:text-lg text-xs md:py-3 md:px-5 bg-[#12B1EB] text-white text-center w-max">UPLOAD</label>
                                                    <div wire:loading wire:target="pass_photo" class="text-white text-xs">Uploading...</div>
                                                    @if($pass_photo)
                                                        <span class="text-white text-xs">
                                                            {{ \Illuminate\Support\Str::limit($pass_photo->getClientOriginalName(), 25) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center gap-3 mb-8">
                                            <div class="">
                                                <label class="block text-white font-extralight md:text-xl text-xs w-2/3" for="student_proof">Scan KTM/NISN/Kartu Pelajar (Format PDF) <span class="text-red-500">*</span></label>
                                                @error('student_proof') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="">
                                                <input wire:model="student_proof" id="file-input-pdf" accept=".pdf" name="student_proof" class="hidden" type="file"> 
                                                <div class="flex flex-col gap-2 items-end">
                                                    <label for="file-input-pdf" class="border border-[#12B1EB] rounded-md py-2 px-3 md:text-lg text-xs md:py-3 md:px-5 bg-[#12B1EB] text-white text-center w-max">UPLOAD</label>
                                                    <div wire:loading wire:target="student_proof" class="text-white text-xs">Uploading...</div>
                                                    @if($student_proof)
                                                        <span class="text-white text-xs">
                                                            {{ \Illuminate\Support\Str::limit($student_proof->getClientOriginalName(), 25) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-6 md:mb-12">
                                            <label class="block text-xs md:text-xl text-wrap text-white" for="twibbon_links">Bukti upload twibbon UPC 2025 (Link unggahan) <span class="text-red-500">*</span></label>
                                            <input wire:model="twibbon_links" class="md:w-2/3 w-full md:py-2 md:px-1 p-2 border mt-2 bg-gray-300 text-black text-xs md:text-lg" placeholder="Ketik disini..." type="text" name="twibbon_links" id="twibbon_links" required>
                                            @error('twibbon_links') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- check-box --}}
                                        <div class="flex items-center gap-2 md:gap-4">
                                            <input wire:model="terms_accepted" class="size-6" type="checkbox" name="terms_accepted" id="terms_accepted" required>
                                            <label class="text-white font-extralight text-xs md:text-lg" for="terms_accepted">Saya telah membaca, menyetujui, dan akan mematuhi seluruh syarat dan ketentuan/Juknis UPC 2025. <span class="text-red-500">*</span></label>
                                        </div>
                                        @error('terms_accepted') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Navigation Buttons --}}
                                <div class="py-14 grid grid-cols-3 items-center">
                                    {{-- Previous Button --}}
                                    <div class="w-20 h-8 md:w-38 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-start cursor-pointer" wire:click="back(1)">
                                        <div class="w-full h-full bg-black flex items-center justify-center">
                                            <div class="flex justify-between item-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-4 md:size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                                </svg>
                                                <h1 class="text-white hidden md:contents md:text-lg">Sebelumnya</h1>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Progress Dots --}}
                                    <div class="col-start-2 grid grid-cols-subgrid justify-items-center">
                                        <div class="w-25 h-8 md:w-30 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] rounded-full p-[1px]">
                                            <div class="w-full h-full bg-black rounded-full flex items-center justify-center">
                                                <div class="flex items-center">
                                                    <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white">
                                                        <div class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 bg-black rounded-full"></div>
                                                    </div>
                                                    <div class="h-[0.5px] w-2 md:w-3 bg-white"></div>
                                                    <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white"></div>
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
                                    
                                    {{-- Next Button --}}
                                    <button type="submit" class="w-20 h-8 md:w-38 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-end cursor-pointer">
                                        <div class="w-full h-full bg-black flex items-center justify-center">
                                            <div class="flex justify-between item-center gap-2">
                                                <h1 class="text-white hidden md:contents md:text-lg">Selanjutnya</h1>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 md:size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </button>
                                    
                                </div>
                            </form>
                        @else
                            <form wire:submit.prevent="secondStepSubmit" class="relative h-fit w-fit mx-8 md:mx-12 lg:mx-auto">
                                <div class="bg-black border border-white w-full h-full">
                                    <img class="absolute select-none -top-[5px] md:-top-1.5 -left-1.5 size-24 md:size-32" 
                                        src="/assets/register/{{ $currentStep == 1 ? 'border1' : 'border2' }}.png" alt="">
                                    <div class="w-1.5 h-16 md:w-2.5 md:h-25 bg-white absolute -right-1.5 md:-right-2.5 -top-[0.2px]"></div>
                                    <div class="w-0.5 h-30 md:h-55 bg-white absolute -right-0.5 -top-[0.2px]"></div>
                                    <div class="py-6 px-8 md:py-12 md:px-10">
                                        <h1 class="text-2xl md:text-4xl font-bold text-white">Data Diri Peserta</h1>
                                        <p class="text-base font-extralight md:text-xl mb-5 md:mb-12 text-white">Lengkapi formulir di bawah ini dengan data dirimu yang valid.</p>
                                        <h2 class="text-white md:text-3xl text-xl md:font-bold font-semibold md:mb-8 mb-4">Data Ketua Tim</h2>
                                        <div class="grid grid-cols-1 mb-12 w-full gap-4 md:grid-cols-2 md:gap-x-8 md:gap-y-4">                               
                                            <div class="md:grid md:col-span-2">
                                                <label for="leader_name" class="block text-xs md:text-xl text-wrap text-white">Nama Lengkap (contoh: Yudhistira Arimbawa Saputra) <span class="text-red-500">*</span></label>
                                                <input wire:model="leader_name" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_name" id="leader_name" required>
                                                @error('leader_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="leader_student_id" class=" text-xs md:text-xl text-wrap text-white">NISN (Siswa) / NIM (Mahasiswa) <span class="text-red-500">*</span></label>
                                                <input wire:model="leader_student_id" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_student_id" id="leader_student_id" required>
                                                @error('leader_student_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="leader_date_of_birth" class=" text-xs md:text-xl text-wrap text-white">Tanggal lahir <span class="text-red-500">*</span></label>
                                                <input wire:model="leader_date_of_birth" type="date" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_date_of_birth" id="leader_date_of_birth" required>
                                                @error('leader_date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="leader_gender" class="md:block text-xs md:text-xl text-wrap text-white">Jenis Kelamin <span class="text-red-500">*</span></label>
                                                <select wire:model="leader_gender" class="block w-full md:py-3 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_gender" id="leader_gender" required>
                                                    <option value="">Pilih...</option>
                                                    <option value="l">Laki-laki</option>
                                                    <option value="p">Perempuan</option>
                                                </select>
                                                @error('leader_gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>    
                                            <div class="flex flex-col justify-between">
                                                <label for="leader_no_wa" class="block text-xs md:text-xl text-wrap text-white">No. Handphone (Aktif WhatsApp)<span class="text-red-500">*</span> </label>
                                                <input wire:model="leader_no_wa" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="leader_no_wa" id="leader_no_wa" required>
                                                @error('leader_no_wa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="md:grid md:col-span-2">
                                                <label for="email" class="block text-xs md:text-xl text-wrap text-white">Email Aktif <span class="text-red-500">*</span></label>
                                                <input wire:model="email" type="email" placeholder="Ketik di sini..." class="w-full md:w-full md:py-2 md:px-1 p-2 text-xs md:text-lg border mt-2 bg-gray-300 text-black" name="email" id="email" required>
                                                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 mb-12 w-full gap-4 md:grid-cols-2 md:gap-x-8 md:gap-y-4">                               
                                            <div class="md:grid md:col-span-2">
                                                <label for="institution" class="block text-xs md:text-xl text-wrap text-white">Nama Lengkap Institusi <span class="text-red-500">*</span></label>
                                                <input wire:model="institution" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="institution" id="institution" required>
                                                @error('institution') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="institution_address" class="block text-xs md:text-xl text-wrap text-white">Alamat Institusi<span class="text-red-500">*</span></label>
                                                <input wire:model="institution_address" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="institution_address" id="institution_address" required>
                                                @error('institution_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="institution_province" class="block text-xs md:text-xl text-wrap text-white">Provinsi <span class="text-red-500">*</span></label>
                                                <input wire:model="institution_province" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="institution_province" id="institution_province" required>
                                                @error('institution_province') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="institution_city" class="block text-xs md:text-xl text-wrap text-white">Kabupaten/Kota <span class="text-red-500">*</span></label>
                                                <input wire:model="institution_city" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="institution_city" id="institution_city" required>
                                                @error('institution_city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <label for="parent_no_wa" class="block text-xs md:text-xl text-wrap text-white">No. Handphone (Orang Tua/Pendamping) <span class="text-red-500">*</span></label>
                                                <input wire:model="parent_no_wa" type="text" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="parent_no_wa" id="parent_no_wa" required>
                                                @error('parent_no_wa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        
                                        <h2 class="text-white md:text-3xl text-xl md:font-bold font-semibold md:mb-8 mb-4">Data Anggota</h2>
                                        <div class="grid grid-cols-1 mb-12 w-full gap-6 md:grid-cols-2 md:gap-x-8 md:gap-y-4">
                                            <div class="w-full grid gap-4">
                                                <h3 class="text-white md:text-3xl text-left md:text-center text-xl md:font-bold font-semibold md:mb-4 mb-2">Anggota 1</h3>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member1_name" class="block text-xs md:text-xl text-wrap text-white">Nama Lengkap (contoh: Yudhistira Arimbawa Saputra) <span class="text-red-500">*</span></label>
                                                    <input type="text" wire:model="member1_name" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member1_name" id="member1_name" required>
                                                    @error('member1_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member1_student_id" class=" text-xs md:text-xl text-wrap text-white">NISN (Siswa) / NIM (Mahasiswa) <span class="text-red-500">*</span></label>
                                                    <input type="text" wire:model="member1_student_id" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member1_student_id" id="member1_student_id" required>
                                                    @error('member1_student_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member1_gender" class="md:block text-xs md:text-xl text-wrap text-white">Jenis Kelamin <span class="text-red-500">*</span></label>
                                                    <select wire:model="member1_gender" class="block w-full md:py-3 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member1_gender" id="member1_gender" required>
                                                        <option value="">Pilih...</option>
                                                        <option value="l">Laki-laki</option>
                                                        <option value="p">Perempuan</option>
                                                    </select>
                                                    @error('member1_gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member1_date_of_birth" class=" text-xs md:text-xl text-wrap text-white">Tanggal lahir <span class="text-red-500">*</span></label>
                                                    <input type="date" wire:model="member1_date_of_birth" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member1_date_of_birth" id="member1_date_of_birth" required>
                                                    @error('member1_date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member1_no_wa" class="block text-xs md:text-xl text-wrap text-white">No. Handphone (Aktif WhatsApp)<span class="text-red-500">*</span> </label>
                                                    <input type="text" wire:model="member1_no_wa" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member1_no_wa" id="member1_no_wa" required>
                                                    @error('member1_no_wa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member1_email" class="block text-xs md:text-xl text-wrap text-white">Email Aktif <span class="text-red-500">*</span></label>
                                                    <input type="text" wire:model="member1_email" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member1_email" id="member1_email" required>
                                                    @error('member1_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>                                                             
                                            <div class="w-full grid gap-4">
                                                <h3 class="text-white md:text-3xl text-left md:text-center text-xl md:font-bold font-semibold md:mb-4 mb-2">Anggota 2</h3>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member2_name" class="block text-xs md:text-xl text-wrap text-white">Nama Lengkap (contoh: Yudhistira Arimbawa Saputra) <span class="text-red-500">*</span></label>
                                                    <input type="text" wire:model="member2_name" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member2_name" id="member2_name" required>
                                                    @error('member2_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member2_student_id" class=" text-xs md:text-xl text-wrap text-white">NISN (Siswa) / NIM (Mahasiswa) <span class="text-red-500">*</span></label>
                                                    <input type="text" wire:model="member2_student_id" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member2_student_id" id="member2_student_id" required>
                                                    @error('member2_student_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member2_gender" class="md:block text-xs md:text-xl text-wrap text-white">Jenis Kelamin <span class="text-red-500">*</span></label>
                                                    <select wire:model="member2_gender" class="block w-full md:py-3 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member2_gender" id="member2_gender" required>
                                                        <option value="">Pilih...</option>
                                                        <option value="l">Laki-laki</option>
                                                        <option value="p">Perempuan</option>
                                                    </select>
                                                    @error('member2_gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member2_date_of_birth" class=" text-xs md:text-xl text-wrap text-white">Tanggal lahir <span class="text-red-500">*</span></label>
                                                    <input type="date" wire:model="member2_date_of_birth" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member2_date_of_birth" id="member2_date_of_birth" required>
                                                    @error('member2_date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member2_no_wa" class="block text-xs md:text-xl text-wrap text-white">No. Handphone (Aktif WhatsApp)<span class="text-red-500">*</span> </label>
                                                    <input type="text" wire:model="member2_no_wa" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member2_no_wa" id="member2_no_wa" required>
                                                    @error('member2_no_wa') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex flex-col justify-between">
                                                    <label for="member2_email" class="block text-xs md:text-xl text-wrap text-white">Email Aktif <span class="text-red-500">*</span></label>
                                                    <input type="text" wire:model="member2_email" placeholder="Ketik di sini..." class="w-full md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" name="member2_email" id="member2_email" required>
                                                    @error('member2_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                            </div>                                                             
                                        </div>

                                        <h2 class="text-white md:text-3xl text-xl md:font-bold font-semibold md:mb-8 mb-4">Dokumen</h2>
                                        <div class="flex justify-between items-center gap-3 mb-4  md:mb-8">
                                            <div class="">
                                                <label class="block text-white font-extralight md:text-xl text-xs w-2/3" for="pass_photo">Lampiran Pas foto Kelompok (Latar belakang merah, ukuran 3x4)<span class="text-red-500">*</span></label>
                                                @error('pass_photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="">
                                                <input wire:model="pass_photo" id="file-input-img" name="pass_photo" accept=".jpg, .png" class="hidden" type="file"> 
                                                <div class="flex flex-col gap-2 items-end">
                                                    <label for="file-input-img" class="border border-[#12B1EB] rounded-md py-2 px-3 md:text-lg text-xs md:py-3 md:px-5 bg-[#12B1EB] text-white text-center w-max">UPLOAD</label>
                                                    <div wire:loading wire:target="pass_photo" class="text-white text-xs">Uploading...</div>
                                                    @if($pass_photo)
                                                        <span class="text-white text-xs">
                                                            {{ \Illuminate\Support\Str::limit($pass_photo->getClientOriginalName(), 25) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center gap-3 mb-8">
                                            <div class="">
                                                <label class="block text-white font-extralight md:text-xl text-xs w-2/3" for="student_proof">Lampiran scan KTM/NISN/Kartu Pelajar kelompok (Format PDF)<span class="text-red-500">*</span></label>
                                                @error('student_proof') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="">
                                                <input wire:model="student_proof" id="file-input-pdf" accept=".pdf" name="student_proof" class="hidden" type="file"> 
                                                <div class="flex flex-col gap-2 items-end">
                                                    <label for="file-input-pdf" class="border border-[#12B1EB] rounded-md py-2 px-3 md:text-lg text-xs md:py-3 md:px-5 bg-[#12B1EB] text-white text-center w-max">UPLOAD</label>
                                                    <div wire:loading wire:target="student_proof" class="text-white text-xs">Uploading...</div>
                                                    @if($student_proof)
                                                        <span class="text-white text-xs">
                                                            {{ \Illuminate\Support\Str::limit($student_proof->getClientOriginalName(), 25) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-6 md:mb-12">
                                            <label class="block text-xs md:text-xl text-wrap text-white" for="twibbon_links">Twibbon UPC 2025 (Link unggahan, dipisah dengan ",")<span class="text-red-500">*</span></label>
                                            <input wire:model="twibbon_links" class="md:w-2/3 w-full md:py-2 md:px-1 p-2 border mt-2 bg-gray-300 text-black text-xs md:text-lg" placeholder="Ketik disini..." type="text" name="twibbon_links" id="twibbon_links" required>
                                            @error('twibbon_links') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- check-box --}}
                                        <div class="flex items-center gap-2 md:gap-4">
                                            <input wire:model="terms_accepted" class="size-6" type="checkbox" name="terms_accepted" id="terms_accepted" required>
                                            <label class="text-white font-extralight text-xs md:text-lg" for="terms_accepted">Saya telah membaca, menyetujui, dan akan mematuhi seluruh syarat dan ketentuan/Juknis UPC 2025. <span class="text-red-500">*</span></label>
                                        </div>
                                        @error('terms_accepted') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                {{-- Navigation Buttons --}}
                                <div class="py-14 grid grid-cols-3 items-center">
                                    {{-- Previous Button --}}
                                    <div class="w-20 h-8 md:w-38 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-start cursor-pointer" wire:click="back(1)">
                                        <div class="w-full h-full bg-black flex items-center justify-center">
                                            <div class="flex justify-between item-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-4 md:size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                                </svg>
                                                <h1 class="text-white hidden md:contents md:text-lg">Sebelumnya</h1>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Progress Dots --}}
                                    <div class="col-start-2 grid grid-cols-subgrid justify-items-center">
                                        <div class="w-25 h-8 md:w-30 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] rounded-full p-[1px]">
                                            <div class="w-full h-full bg-black rounded-full flex items-center justify-center">
                                                <div class="flex items-center">
                                                    <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white">
                                                        <div class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 bg-black rounded-full"></div>
                                                    </div>
                                                    <div class="h-[0.5px] w-2 md:w-3 bg-white"></div>
                                                    <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white"></div>
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
                                    
                                    {{-- Next Button --}}
                                    <button type="submit" class="w-20 h-8 md:w-38 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-end cursor-pointer">
                                        <div class="w-full h-full bg-black flex items-center justify-center">
                                            <div class="flex justify-between item-center gap-2">
                                                <h1 class="text-white hidden md:contents md:text-lg">Selanjutnya</h1>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 md:size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endif

                    {{-- Step 3 Content --}}
                    @if($currentStep == 3)
                        <form wire:submit.prevent="submitForm" class="relative h-fit w-fit mx-8 md:mx-12 lg:mx-auto">
                            <div class="bg-black border border-white w-full h-full">
                                <img class="absolute select-none -top-[5px] md:-top-1.5 -left-1.5 size-24 md:size-32" 
                                    src="/assets/register/{{ $currentStep == 1 ? 'border1' : 'border2' }}.png" alt="">
                                <div class="w-1.5 h-16 md:w-2.5 md:h-25 bg-white absolute -right-1.5 md:-right-2.5 -top-[0.2px]"></div>
                                <div class="w-0.5 h-30 md:h-55 bg-white absolute -right-0.5 -top-[0.2px]"></div>
                                <div class="py-5 px-6 md:py-9 md:px-10">
                                    <h1 class="text-2xl md:text-4xl font-bold text-white">Rincian Pembayaran</h1>
                                    <p class="text-base font-extralight md:text-xl mb-5 md:mb-12 text-white">Lengkapi formulir di bawah ini dengan data dirimu yang valid.</p>
                                    {{-- rincian --}}
                                    <div class="border border-white w-full h-fit md:px-5 px-2 py-5 md:py-7 mb-4 md:mb-8">
                                        <div class="flex justify-between mb-1 md:mb-2">
                                            <h4 class="text-white text-xs md:text-base font-extralight">Biaya pendaftaran kompetisi Fisika SMP</h4>
                                            <p class="text-white text-xs md:text-base">{{ rupiah($subtotal) }}</p>
                                        </div>
                                        <div class="flex justify-between mb-1 md:mb-2">
                                            <h4 class="text-white text-xs md:text-base font-extralight">Biaya aplikasi</h4>
                                            <p class="text-white text-xs md:text-base">Rp. 1.000</p>
                                        </div>
                                        @if ($discount > 0)
                                            <div class="flex justify-between mb-3 md:mb-5">
                                                <h4 class="text-white text-xs md:text-base font-extralight">Potongan kupon</h4>
                                                <p class="text-white text-xs md:text-base">-{{ rupiah($discount) }}</p>
                                            </div>
                                        @endif
                                        <div class="flex justify-between">
                                            <h4 class="text-white text-xs md:text-base font-semibold md:font-bold">Total</h4>
                                            <p class="text-white text-xs md:text-base font-semibold md:font-bold">{{ rupiah($total) }}</p>
                                        </div>
                                    </div>

                                    <div class="mb-4 md:mb-8">
                                        <h3 class="text-white md:text-base text-xs mb-1 md:mb-2">Punya kode kupon?</h3>
                                        <div class="flex gap-x-1 md:gap-x-4 items-end">
                                            <input wire:model="coupon_code" placeholder="Ketik di sini..." class="grow md:py-2 md:px-1 p-2 border mt-2 text-xs md:text-lg bg-gray-300 text-black" type="text">
                                            <button wire:click.prevent="applyCoupon" type="button" class="border border-[#12B1EB] rounded-md py-2 px-3 md:text-lg text-xs md:py-2 md:px-5 bg-[#12B1EB] text-white text-center cursor-pointer">Masukkan</button>
                                        </div>
                                        @error('coupon_code') <p class="text-red-500 mt-2">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="mb-4 md:mb-8">
                                        <h3 class="text-white md:text-base text-xs">Upload Bukti Transfer <span class="text-red-500">*</span></h3>
                                        <input wire:model="transaction_proof" class="w-full md:py-2 md:px-1 p-1 border md:mt-2 mt-1 text-xs md:text-lg bg-gray-300" type="file" name="transaction_proof" id="transaction_proof" required>
                                        @error('transaction_proof') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Navigation Buttons --}}
                            <div class="py-14 grid grid-cols-3 items-center">
                                {{-- Previous Button --}}
                                <div class="w-20 h-8 md:w-38 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-start cursor-pointer" wire:click="back(2)">
                                    <div class="w-full h-full bg-black flex items-center justify-center">
                                        <div class="flex justify-between item-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-4 md:size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                            </svg>
                                            <h1 class="text-white hidden md:contents md:text-lg">Sebelumnya</h1>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Progress Dots --}}
                                <div class="col-start-2 grid grid-cols-subgrid justify-items-center">
                                    <div class="w-25 h-8 md:w-30 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] rounded-full p-[1px]">
                                        <div class="w-full h-full bg-black rounded-full flex items-center justify-center">
                                            <div class="flex items-center">
                                                <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white">
                                                    <div class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 bg-black rounded-full"></div>
                                                </div>
                                                <div class="h-[0.5px] w-2 md:w-3 bg-white"></div>
                                                <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white">
                                                    <div class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 bg-black rounded-full"></div>
                                                </div>
                                                <div class="h-[0.5px] w-2 md:w-3 bg-white"></div>
                                                <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white"></div>
                                                <div class="h-[0.5px] w-2 md:w-3 bg-white"></div>
                                                <div class="relative w-2 h-2 md:w-3 md:h-3 rounded-full flex items-center justify-center bg-white">
                                                    <div class="w-1.5 h-1.5 md:w-2.5 md:h-2.5 bg-black rounded-full"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Submit Button --}}
                                <button type="submit" class="w-20 h-8 md:w-38 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-end cursor-pointer">
                                    <div class="w-full h-full bg-black flex items-center justify-center">
                                        <div class="flex justify-between item-center gap-2">
                                            <h1 class="text-white hidden md:contents md:text-lg">Kirim</h1>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4 md:size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                                            </svg>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        @else
            <div class="relative h-fit w-fit mx-8 md:mx-12 lg:mx-30">
                <div class="bg-black border border-white w-full h-full">
                    <img class="absolute select-none -top-[5px] md:-top-1.5 -left-1.5 size-24 md:size-32" src="/assets/register/border2.png" alt="">
                    <div class="w-1.5 h-16 md:w-2.5 md:h-25 bg-white absolute -right-1.5 md:-right-2.5 -top-[0.2px]"></div>
                    <div class="w-0.5 h-30 md:h-55 bg-white absolute -right-0.5 -top-[0.2px]"></div>
                    <div class="py-5 px-6 md:py-9 md:px-10">
                        <h1 class="text-2xl md:text-4xl font-bold mb-1 md:mb-2 text-white text-center md:text-left">Formulir Terkirim!</h1>
                        <p class="text-base font-extralight md:text-2xl mb-5 md:mb-12 text-white md:text-left text-wrap">Formulir anda berhasil terkirim! Akun peserta anda sedang dalam peninjauan oleh panitia. Peninjauan akan memakan waktu paling lambat H+3 hari kerja.</p>
                        {{-- rincian --}}
                        <div class="flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="md:size-35 size-25 text-center font-extrabold text-white">
                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h2 class="text-white text-base md:text-2xl text-center mb-6 md:mb-12">No. Registrasi anda: {{ $no_registration }}</h2>
                        <p class="text-white md:text-2xl text-base md:mb-12 mb-6 text-wrap">Salinan Formulir registrasi anda akan terunduh secara otomatis, jika tidak terunduh maka klik tombol unduh di bawah untuk mengunduh salinan formulir registrasi anda secara manual.</p>
                        <div class="text-center">
                            <button wire:click.prevent="downloadInvoice" type="button" class="cursor-pointer border border-[#12B1EB] rounded-md py-2 px-15 md:text-2xl text-xs md:py-2 md:px-20 mb-8 bg-[#12B1EB] text-white text-center">Unduh</button>
                        </div>
                        <p class="text-white md:text-2xl text-base md:mb-12 mb-6 text-wrap">Mohon mengkonfirmasi pendaftaran anda dan masuk ke dalam grup peserta UPC dengan cara menghubungi CP humas UPC 2025 <a href="https://wa.me/" class="text-[#12B1EB] underline">di sini</a>.</p>
                        <p class="text-white text-base md:text-2xl font-semibold md:font-bold text-center text-wrap">Terima kasih telah mendaftar!</p>
                        <p class="text-white text-base md:text-2xl font-semibold md:font-bold text-center text-wrap">Sampai jumpa di rangkaian kegiatan UPC selanjutnya!</p>
                    </div>
                </div>
                <div class="py-14 flex justify-center items-center">
                    {{-- bawa ke login --}}
                    <a href="{{ route('login') }}" class=" w-35 h-8 md:w-55 md:h-12 bg-gradient-to-r from-[#12B1EB] via-white to-[#FFD900] p-[1px] grid justify-self-end ">
                        <div class="w-full h-full bg-black flex items-center justify-center">
                            <h1 class="text-white md:text-lg">Selesai</h1>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
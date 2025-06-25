<tr id="user-row-{{ $user['id'] }}" class="bg-[#FFD9001A]">
   <td class="text-center lg:px-4 px-2 py-3 lg:text-base text-xs lg:py-5">{{ $user['no_reg'] }}</td>
   <td class="lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['nama'] }}</td>
   <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['nisn'] }}</td>
   <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['telepon'] }}</td>
   <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['waktu_registrasi'] }}</td>
   <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['kompetisi'] }}</td>
   <td id="user-status-{{ $user['id'] }}" class="text-center px-4 py-5 lg:text-base text-xs">{{ $user['status'] }}</td>

   <td class="lg:px-3 lg:py-4 px-2 py-3">
      <div x-data="{ showConfirm: false, showReject: false, note: '', showButton: true, showDetail: false }" class="flex items-center justify-evenly relative">
         <button x-on:click="showConfirm = true" class="cursor-pointer" :class="showButton ? '' : 'invisible'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#029161" class="size-6 lg:size-8">
               <path fill-rule="evenodd"
                  d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                  clip-rule="evenodd" />
            </svg>
         </button>
         <button x-on:click="showReject = true" class="cursor-pointer"
            :class="showButton ? 'cursor-pointer' : 'invisible cursor-pointer'">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="red" class="size-6 lg:size-8">
               <path fill-rule="evenodd"
                  d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm2.78-4.22a.75.75 0 0 1-1.06 0L8 9.06l-1.72 1.72a.75.75 0 1 1-1.06-1.06L6.94 8 5.22 6.28a.75.75 0 0 1 1.06-1.06L8 6.94l1.72-1.72a.75.75 0 1 1 1.06 1.06L9.06 8l1.72 1.72a.75.75 0 0 1 0 1.06Z"
                  clip-rule="evenodd" />
            </svg>
         </button>
         <button x-on:click="showDetail = true" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#007BFF" class="size-8 lg:size-10">
               <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
               <path fill-rule="evenodd"
                  d="M1.38 8.28a.87.87 0 0 1 0-.566 7.003 7.003 0 0 1 13.238.006.87.87 0 0 1 0 .566A7.003 7.003 0 0 1 1.379 8.28ZM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                  clip-rule="evenodd" />
            </svg>
         </button>

         {{-- pop-up detail --}}
         <div x-show="showDetail" x-transition.opacity x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm ">
            <div class="bg-[#FAF9F6] p-8 rounded-lg shadow-xl h-fit max-h-138 w-fit lg:w-180 overflow-y-auto"
               x-on:click.outside="showDetail = false">
               <div class="grid grid-cols-1 gap-3">
                  <button class="flex justify-end" x-on:click="showDetail = false">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="black" class="border p-1 inline size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                     </svg>
                  </button>
                  <div class="w-full grid gap-2">
                     <h1 class="border-b-2 text-2xl font-extrabold">Ketua</h1>
                     <div class=" text-center flex justify-center items-center">
                        <img src="/assets/profile-peserta.png" class="w-30 h-40" alt="profil-peserta">
                     </div>
                     <div
                        class="text-left lg:text-base text-xs grid break-all grid-cols-[max-content_1fr] gap-x-2 gap-y-4 w-full">
                        <span class="font-bold">No. Peserta</span>
                        <span>: FAST-001</span>
                        <span class="font-bold">No. Registrasi</span>
                        <span>: 198788099 </span>
                        <span class="font-bold">Waktu Registrasi</span>
                        <span>: 29-05-2025 17:30:00 </span>
                        <span class="font-bold">Nama Lengkap</span>
                        <span>: YUDHISTIRA ARIMBAWA SAPUTRA</span>
                        <span class="font-bold">NISN/NIM</span>
                        <span>: 003525676 </span>
                        <span class="font-bold">Tanggal Lahir</span>
                        <span>: 03-02-2005 </span>
                        <span class="font-bold">Jenis Kelamin</span>
                        <span>: Laki-laki</span>
                        <span class="font-bold">No Handphone</span>
                        <span>: 081xxx</span>
                        <span class="font-bold">Email</span>
                        <span>: yukeno@gmail.com </span>
                        <span class="font-bold">Asal Sekolah</span>
                        <span>: SMA Negeri 2 Kuta</span>
                        <span class="font-bold">Provinsi</span>
                        <span>: Kuta </span>
                        <span class="font-bold">Kabupaten/Kota</span>
                        <span>: Badung </span>
                        <span class="font-bold">Jenis Kompetisi</span>
                        <span>: Astronomi </span>
                     </div>

                  </div>
                  <div class="w-full grid gap-2">
                     <h1 class="border-b-2 text-2xl font-extrabold">Anggota 1</h1>
                     <div class=" text-center flex justify-center items-center">
                        <img src="/assets/profile-peserta.png" class="w-30 h-40" alt="profil-peserta">
                     </div>
                     <div
                        class="text-left lg:text-base text-xs grid break-all grid-cols-[max-content_1fr] gap-x-2 gap-y-4 w-full">
                        <span class="font-bold">Nama Lengkap</span>
                        <span>: YUDHISTIRA ARIMBAWA SAPUTRA</span>
                        <span class="font-bold">NISN/NIM</span>
                        <span>: 003525676 </span>
                        <span class="font-bold">Tanggal Lahir</span>
                        <span>: 03-02-2005 </span>
                        <span class="font-bold">Jenis Kelamin</span>
                        <span>: Laki-laki</span>
                        <span class="font-bold">No Handphone</span>
                        <span>: 081xxx</span>
                        <span class="font-bold">Email</span>
                        <span>: yukeno@gmail.com </span>
                     </div>
                  </div>
                  <div class="w-full grid gap-2">
                     <h1 class="border-b-2 text-2xl font-extrabold">Anggota 2</h1>
                     <div class=" text-center flex justify-center items-center">
                        <img src="/assets/profile-peserta.png" class="w-30 h-40" alt="profil-peserta">
                     </div>
                     <div
                        class="text-left lg:text-base text-xs grid break-all grid-cols-[max-content_1fr] gap-x-2 gap-y-4 w-full">
                        <span class="font-bold">Nama Lengkap</span>
                        <span>: YUDHISTIRA ARIMBAWA SAPUTRA</span>
                        <span class="font-bold">NISN/NIM</span>
                        <span>: 003525676 </span>
                        <span class="font-bold">Tanggal Lahir</span>
                        <span>: 03-02-2005 </span>
                        <span class="font-bold">Jenis Kelamin</span>
                        <span>: Laki-laki</span>
                        <span class="font-bold">No Handphone</span>
                        <span>: 081xxx</span>
                        <span class="font-bold">Email</span>
                        <span>: yukeno@gmail.com </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         {{-- pop-up confirm --}}
         <div x-show="showConfirm" x-transition.opacity x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm">
            <div class="bg-white p-6 rounded-lg shadow-xl w-80" x-on:click.outside="showConfirm = false">
               <h2 class="text-lg font-semibold mb-4">Konfirmasi Verifikasi</h2>
               <p class="mb-12">Yakin ingin memverifikasi user ini?</p>
               <div class="flex justify-end gap-3">
                  <button x-on:click="showConfirm = false"
                     class="bg-gray-600 text-white px-4 py-1 rounded hover:bg-gray-800">
                     Batal
                  </button>
                  <button
                     x-on:click="
                         document.getElementById('user-status-{{ $user['id'] }}').textContent = 'Diterima';
                         document.getElementById('user-row-{{ $user['id'] }}').classList.remove('bg-[#FFD9001A]');
                         document.getElementById('user-row-{{ $user['id'] }}').classList.add('bg-white');
                         showConfirm = false
                         showButton = false"
                     class="bg-[#029161] hover:bg-green-700 text-white px-4 py-1 rounded">
                     Ya
                  </button>
               </div>
            </div>
         </div>

         {{-- pop-up reject --}}
         <div x-show="showReject" x-transition.opacity x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm">
            <div class="bg-white p-6 rounded-lg shadow-xl w-80"
               x-on:click.outside="showReject = false">
               <h2 class="text-lg font-semibold mb-4">Konfirmasi Penolakan</h2>
               <p class="mb-2">Yakin ingin menolak user ini?</p>
               <textarea x-model="note" class="w-full text-sm border rounded p-2 mb-4 resize-none" rows="3"
                  placeholder="Ketik catatan untuk user... *"></textarea>
               <div class="flex justify-end gap-3">
                  <button x-on:click="showReject = false"
                     class="bg-gray-600 text-white px-4 py-1 rounded hover:bg-gray-800">
                     Batal
                  </button>
                  <button
                     x-on:click="
                         document.getElementById('user-status-{{ $user['id'] }}').textContent = 'Ditolak';
                         document.getElementById('user-row-{{ $user['id'] }}').classList.remove('bg-[#FFD9001A]');
                         document.getElementById('user-row-{{ $user['id'] }}').classList.add('bg-[#FF00001A]');
                         note = '';
                         showReject = false
                         showButton = false"
                     class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded">
                     Tolak
                  </button>
               </div>
            </div>

         </div>
   </td>
</tr>

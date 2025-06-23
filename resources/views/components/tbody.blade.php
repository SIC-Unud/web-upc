<tr id="user-row-{{ $user['id'] }}" class="bg-[#FFD9001A]">
     <td class="text-center lg:px-4 px-2 py-3 lg:text-base text-xs lg:py-5">{{ $user['no_reg'] }}</td>
     <td class="lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['nama'] }}</td>
     <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['nisn'] }}</td>
     <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['telepon'] }}</td>
     <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['waktu_registrasi'] }}</td>
     <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-base text-xs">{{ $user['kompetisi'] }}</td>
     <td id="user-status-{{ $user['id'] }}" class="text-center px-4 py-5 lg:text-base text-xs">{{ $user['status'] }}</td>

     <td class="lg:px-3 lg:py-4 px-2 py-3">
          <div x-data="{ showConfirm: false, showReject: false, note: '', showButton: true }" class="flex items-center justify-evenly relative">
               <button 
                    @@click="showConfirm = true" 
                    class="cursor-pointer" 
                    :class="showButton ? '' : 'invisible'"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#029161" class="size-5 lg:size-8">
                         <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
                    </svg>
               </button>
               <button 
                    @@click="showReject = true" 
                    class="cursor-pointer" 
                    :class="showButton ? 'cursor-pointer' : 'invisible cursor-pointer'"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="red" class="size-5 lg:size-8">
                         <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm2.78-4.22a.75.75 0 0 1-1.06 0L8 9.06l-1.72 1.72a.75.75 0 1 1-1.06-1.06L6.94 8 5.22 6.28a.75.75 0 0 1 1.06-1.06L8 6.94l1.72-1.72a.75.75 0 1 1 1.06 1.06L9.06 8l1.72 1.72a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
               </button>
               <button 
                    class="cursor-pointer"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#007BFF" class="size-6 lg:size-10">
                         <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                         <path fill-rule="evenodd" d="M1.38 8.28a.87.87 0 0 1 0-.566 7.003 7.003 0 0 1 13.238.006.87.87 0 0 1 0 .566A7.003 7.003 0 0 1 1.379 8.28ZM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" clip-rule="evenodd" />
                    </svg>
               </button>

               {{-- pop-up confirm --}}
               <div 
                    x-show="showConfirm"
                    x-transition.opacity
                    x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm"
                    >
                    <div 
                         class="bg-white p-6 rounded-lg shadow-xl w-80"
                         @@click.outside="showConfirm = false"
                         >
                         <h2 class="text-lg font-semibold mb-4">Konfirmasi Verifikasi</h2>
                         <p class="mb-12">Yakin ingin memverifikasi user ini?</p>
                         <div class="flex justify-end gap-3">
                              <button 
                                   @@click="showConfirm = false"
                                   class="bg-gray-600 text-white px-4 py-1 rounded hover:bg-gray-800">
                                   Batal
                              </button>
                              <button 
                                   @@click="
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
               <div 
                    x-show="showReject"
                    x-transition.opacity
                    x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm"
                    >
                    <div 
                         class="bg-white p-6 rounded-lg shadow-xl w-80"
                         @@click.outside="showReject = false"
                    >
                         <h2 class="text-lg font-semibold mb-4">Konfirmasi Penolakan</h2>
                         <p class="mb-2">Yakin ingin menolak user ini?</p>
                         <textarea 
                              x-model="note" 
                              class="w-full text-sm border rounded p-2 mb-4 resize-none" 
                              rows="3" 
                              placeholder="Ketik catatan untuk user... *"
                         ></textarea>
                         <div class="flex justify-end gap-3">
                              <button 
                                   @@click="showReject = false"
                                   class="bg-gray-600 text-white px-4 py-1 rounded hover:bg-gray-800">
                                   Batal
                              </button>
                              <button 
                                   @@click="
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
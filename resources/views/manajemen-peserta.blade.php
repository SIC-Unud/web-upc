@extends('layouts.side-bar')
@section('content')
    <div class="bg-gray-100 w-full h-screen font-jakarta">
          <div class="flex justify-between items-center mb-8">
               <h2 class="text-4xl font-bold text-[#4C4C4C]">Manajemen User</h2>
               <button class="flex items-center justify-between gap-2 bg-[#00C482] hover:bg-[#16ad7a] rounded-lg px-5 py-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <p class="text-white">Export</p>
               </button>
          </div>
          <div class="flex bg-white rounded-md gap-4 items-center px-8 py-6 mb-8 shadow-xl">
          <div class="grow relative">
               <input name="search" value="{{ request('search') }}" class="border rounded-md px-8 py-2 w-full"  type="text"  placeholder="Telusuri User...">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                    viewBox="0 0 24 24" stroke-width="1.5" 
                    stroke="currentColor" 
                    class="absolute top-2 left-1 size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 
                          5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
               </svg>
          </div>
          <button type="submit" class="flex items-center justify-between gap-2 bg-[#007BFF] hover:bg-[#0062ff] rounded-lg px-5 py-3 cursor-pointer">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                    viewBox="0 0 24 24" stroke-width="1.5" 
                    stroke="white" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
               </svg>
               <p class="text-white">Filter</p>
          </button>
     </div>

          <div class="overflow-x-auto mb-8 rounded-md shadow-xl">
               <table class="min-w-full table-auto bg-[#D9D9D999]">
                    <thead class="border border-collapse border-b-3 border-gray-400">
                         <tr>
                              @foreach ($headers as $header)
                                   <th class="py-3 px-4 font-extralight">{{ $header }}</th>
                              @endforeach
                         </tr>
                    </thead>
                    <tbody class="bg-white">
                         @foreach ($users as $user)
                              <tr id="user-row-{{ $user['id'] }}" class="bg-[#FFD9001A]">
                                   <td class="text-center px-4 py-5">{{ $user['no_reg'] }}</td>
                                   <td class="px-4 py-5">{{ $user['nama'] }}</td>
                                   <td class="text-center px-4 py-5">{{ $user['nisn'] }}</td>
                                   <td class="text-center px-4 py-5">{{ $user['telepon'] }}</td>
                                   <td class="text-center px-4 py-5">{{ $user['waktu_registrasi'] }}</td>
                                   <td class="text-center px-4 py-5">{{ $user['kompetisi'] }}</td>
                                   <td id="user-status-{{ $user['id'] }}" class="text-center px-4 py-5">{{ $user['status'] }}</td>
                                   <td class="px-4 py-5 flex items-center justify-evenly">
                                        <button 
                                             class="btn-accept cursor-pointer " 
                                             data-user-id="{{ $user['id'] }}">
                                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#029161" class="size-8">
                                                  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                        <button 
                                             class="btn-reject cursor-pointer " 
                                             data-user-id="{{ $user['id'] }}">
                                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="red" class="size-8">
                                                  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm2.78-4.22a.75.75 0 0 1-1.06 0L8 9.06l-1.72 1.72a.75.75 0 1 1-1.06-1.06L6.94 8 5.22 6.28a.75.75 0 0 1 1.06-1.06L8 6.94l1.72-1.72a.75.75 0 1 1 1.06 1.06L9.06 8l1.72 1.72a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                                             </svg>
                                        </button>
                                        <button class="cursor-pointer">
                                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#007BFF" class="size-10">
                                                  <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                                                  <path fill-rule="evenodd" d="M1.38 8.28a.87.87 0 0 1 0-.566 7.003 7.003 0 0 1 13.238.006.87.87 0 0 1 0 .566A7.003 7.003 0 0 1 1.379 8.28ZM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" clip-rule="evenodd" />
                                             </svg>    
                                        </button>
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>

     <x-modal-popup 
          id="popup-confirm"
          title="Konfirmasi Accept"
          message="Anda yakin ingin memverifikasi data user ini?"
          confirmFunction="confirmAccept()"
          cancelFunction="closePopup()" 
     />
     <x-modal-popup 
          id="popup-reject"
          title="Konfirmasi Reject"
          message="Anda yakin ingin menolak data user ini?"
          type="reject"
          confirmFunction="confirmReject()"
          cancelFunction="closeRejectPopup()" 
     />
</div>

<script>
     let selectedUserId = null;
     let actionType = null;

     function showPopup(userId, type = 'accept') {
          selectedUserId = userId;
          actionType = type;
          document.getElementById('popup-confirm').classList.remove('hidden');
     }
     function closePopup() {
          selectedUserId = null;
          document.getElementById('popup-confirm').classList.add('hidden');
     }

     function confirmAccept() {
          if (!selectedUserId) return;
          const row = document.getElementById(`user-row-${selectedUserId}`);
          const statusCell = document.getElementById(`user-status-${selectedUserId}`);
          if (row && statusCell) {
               row.classList.remove('bg-[#FFD9001A]', 'bg-[#FF00001A]', 'bg-white');
               if (actionType === 'accept') {
                    row.classList.add('bg-white');
                    statusCell.textContent = 'Diterima';
               } else if (actionType === 'decline') {
                    row.classList.add('bg-[#FF00001A]');
                    statusCell.textContent = 'Ditolak';
               }
          }
          toggleActionButtons(selectedUserId, true);
          closePopup();
     }

     function showRejectPopup(userId) {
          selectedUserId = userId;
          document.getElementById('popup-reject').classList.remove('hidden');
     }
     function closeRejectPopup() {
          selectedUserId = null;
          document.getElementById('popup-reject').classList.add('hidden');
          document.getElementById('reject-note').value = "";
     }
     function confirmReject() {
          const note = document.getElementById('reject-note').value.trim();
          if (!note) {
               alert("Catatan tidak boleh kosong.");
               return;
          }
          if (!selectedUserId) return;

          const row = document.getElementById(`user-row-${selectedUserId}`);
          const statusCell = document.getElementById(`user-status-${selectedUserId}`);
          if (row && statusCell) {
               row.classList.remove('bg-[#FFD9001A]', 'bg-white');
               row.classList.add('bg-[#FF00001A]');
               statusCell.textContent = 'Ditolak';
          }
          toggleActionButtons(selectedUserId, true);
          console.log(`User ID ${selectedUserId} ditolak dengan catatan: "${note}"`);
          closeRejectPopup();
     }
     
     function toggleActionButtons(userId, hide = false) {
          const acceptBtn = document.querySelector(`.btn-accept[data-user-id="${userId}"]`);
          const rejectBtn = document.querySelector(`.btn-reject[data-user-id="${userId}"]`);
          const declineBtn = document.querySelector(`.btn-decline[data-user-id="${userId}"]`);
          if (acceptBtn) acceptBtn.classList.toggle('invisible', hide);
          if (rejectBtn) rejectBtn.classList.toggle('invisible', hide);
          if (declineBtn) declineBtn.classList.toggle('invisible', hide);
     }

     document.addEventListener('DOMContentLoaded', () => {
          document.querySelectorAll('.btn-accept').forEach(btn => {
               btn.addEventListener('click', () => {
                    const userId = btn.getAttribute('data-user-id');
                    showPopup(userId, 'accept');
               });
          });
          document.querySelectorAll('.btn-decline').forEach(btn => {
               btn.addEventListener('click', () => {
                    const userId = btn.getAttribute('data-user-id');
                    showPopup(userId, 'decline');
               });
          });
          document.querySelectorAll('.btn-reject').forEach(btn => {
               btn.addEventListener('click', () => {
                    const userId = btn.getAttribute('data-user-id');
                    showRejectPopup(userId);
               });
          });
     });
</script>




@endsection
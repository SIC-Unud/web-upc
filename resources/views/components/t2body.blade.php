<tr id="user-row-{{ $user->id }}" class="{{ $user->is_accepted ? 'bg-white' : ($user->is_rejected ? 'bg-[#FF00001A]' : 'bg-[#FFD9001A]') }}">
    <td class="text-center lg:px-4 px-2 py-3 lg:text-[12px] text-xs lg:py-5">{{ $user->no_registration }}</td>
    <td class="lg:px-4 lg:py-5 px-2 py-3 lg:text-[12px] text-xs">{{ $user->leader_name }}</td>
    <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-[12px] text-xs">{{ $user->leader_student_id }}</td>
    <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-[12px] text-xs">{{ $user->leader_no_wa }}</td>
    <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-[12px] text-xs">{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i:s') }}</td>
    <td class="text-center lg:px-4 lg:py-5 px-2 py-3 lg:text-[12px] text-xs">{{ $user->competition->name }}</td>
    <td id="user-status-{{ $user->id }}" class="text-center px-4 py-5 lg:text-[12px] text-xs">
        @if ($user->is_accepted)
            <span class="text-green-600 font-semibold">Diterima</span>
        @elseif ($user->is_rejected)
            <span class="text-red-600 font-semibold">Ditolak</span>
        @else
            <span class="text-yellow-600 font-semibold">Menunggu</span>
        @endif
    </td>

    <td class="lg:px-3 lg:py-4 px-2 py-3">
        {{-- Ini adalah div utama dengan x-data yang mengelola state semua pop-up --}}
        <div x-data="{ showConfirm: false, showReject: false, note: '', showButton: true, showDetail: false,}" class="flex items-center justify-evenly relative">

            {{-- Tombol Accept dan Reject --}}
            @if (!$user->is_accepted && !$user->is_rejected)
                {{-- Tombol ACCEPT --}}
                <button
                    x-on:click="showConfirm = true" {{-- Pastikan ini showConfirm = true --}}
                    class="cursor-pointer"
                    :class="showButton ? 'cursor-pointer' : 'invisible cursor-pointer'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#029161" class="size-5 lg:size-8">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd" />
                    </svg>
                </button>

                {{-- Tombol REJECT --}}
                <button
                    x-on:click="showReject = true" {{-- Pastikan ini showReject = true --}}
                    class="cursor-pointer"
                    :class="showButton ? 'cursor-pointer' : 'invisible cursor-pointer'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="red" class="size-5 lg:size-8">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm2.78-4.22a.75.75 0 0 1-1.06 0L8 9.06l-1.72 1.72a.75.75 0 1 1-1.06-1.06L6.94 8 5.22 6.28a.75.75 0 0 1 1.06-1.06L8 6.94l1.72-1.72a.75.75 0 1 1 1.06 1.06L9.06 8l1.72 1.72a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endif

            {{-- Tombol Detail --}}
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
                                <img src="{{ asset('/storage/Images/' . $user->pass_photo) }}" class="w-30 h-40" alt="profil-peserta">
                            </div>
                            <div
                                class="text-left lg:text-base text-xs grid break-all grid-cols-[max-content_1fr] gap-x-2 gap-y-4 w-full">
                                <span class="font-bold">No. Peserta</span>
                                <span>: {{ $user->no_participant }}</span>

                                <span class="font-bold">No. Registrasi</span>
                                <span>: {{ $user->no_registration }}</span>

                                <span class="font-bold">Token</span>
                                <span>: {{ $user->token }}</span>

                                <span class="font-bold">Sumber Informasi</span>
                                <span>: {{ $user->source_of_information }}</span>

                                <span class="font-bold">Alasan Mengikuti</span>
                                <span>: {{ $user->reason }}</span>

                                <span class="font-bold">Kompetisi Pertama</span>
                                <span>: {{ $user->is_first_competition ? 'Yes' : 'No' }}</span>

                                <span class="font-bold">Kebutuhan Spesial</span>
                                <span>: {{ $user->special_needs }}</span>

                                <span class="font-bold">Waktu Registrasi</span>
                                <span>: {{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i:s') }}</span>

                                <span class="font-bold">Nama Lengkap</span>
                                <span>: {{ $user->leader_name }}</span>

                                <span class="font-bold">NISN/NIM</span>
                                <span>: {{ $user->leader_student_id }}</span>

                                <span class="font-bold">Tanggal Lahir</span>
                                <span>: {{ $user->leader_date_of_birth }}</span>

                                <span class="font-bold">Jenis Kelamin</span>
                                <span>: {{ $user->leader_gender === 'l' ? 'Laki-laki' : 'Perempuan' }}</span>

                                <span class="font-bold">No Handphone</span>
                                <span>: {{ $user->leader_no_wa }}</span>

                                <span class="font-bold">Email</span>
                                <span>: {{ $user->user->email }}</span>

                                <span class="font-bold">Asal Sekolah</span>
                                <span>: {{ $user->institution }}</span>

                                <span class="font-bold">Provinsi</span>
                                <span>: {{ $user->institution_province }}</span>

                                <span class="font-bold">Kabupaten/Kota</span>
                                <span>: {{ $user->institution_city }}</span>

                                <span class="font-bold">Jenis Kompetisi</span>
                                <span>: {{ $user->competition->is_team_competition ? 'Berkelompok' : 'Individual' }}</span>

                                <span class="font-bold">Pas Foto</span>
                                <span>: <a
                                    href="{{ asset('/storage/Images/' . $user->pass_photo) }}"
                                    target="_blank" class="text-blue-500 underline"> {{ $user->pass_photo }} </a></span>
                                    
                                <span class="font-bold">Kartu Pelajar</span>
                                <span>: <a
                                    href="{{ asset('/storage/StudentProofs/' . $user->student_proof) }}"
                                    target="_blank" class="text-blue-500 underline">{{ $user->student_proof }} </a></span>

                                {{-- <span class="font-bold">Link Twibbon</span>
                                <span>: <a
                                    href="https://www.figma.com/design/Tvi5lcd05JzhzZDlWL4C7Z/UPC-25?node-id=544-1374&t=0ZuWJ1e4dOswEGt8-0"
                                    target="_blank" class="text-blue-500 underline">Lorem ipsum dolor sit amet. </a></span> --}}
                                <span class="font-bold">Subtotal</span>
                                <span>: {{ $user->subtotal }} </span>

                                <span class="font-bold">Total</span>
                                <span>: {{ $user->total }} </span>

                                <span class="font-bold">Bukti Pembayaran</span>
                                <span>: <a
                                    href="{{ asset('/storage/TransactionProofs/' . $user->transaction_proof) }}"
                                    target="_blank" class="text-blue-500 underline">{{ $user->transaction_proof }}</a></span>

                                <span class="font-bold">Diterima</span>
                                <span>: {{ $user->is_accepted ? 'Yes' : 'No' }} </span>

                                <span class="font-bold">Ditolak</span>
                                <span>: {{ $user->is_rejected ? 'Yes' : 'No' }} </span>

                                <span class="font-bold">Pesan Ditolak</span>
                                <span>: {{ $user->reject_message }} </span>

                                <span class="font-bold">Waktu Diperbarui</span>
                                <span>: {{ \Carbon\Carbon::parse($user->updated_at)->format('Y-m-d H:i:s') }} </span>
                            </div>

                            @foreach ($user->members as $member)
                                <div class="w-full grid gap-2">
                                    <h1 class="border-b-2 text-2xl font-extrabold">Anggota {{ $loop->iteration }}</h1>
                                    <div
                                        class="text-left lg:text-base text-xs grid break-all grid-cols-[max-content_1fr] gap-x-2 gap-y-4 w-full">
                                        <span class="font-bold">Nama Lengkap</span>
                                        <span>: {{ $member->name }}</span>

                                        <span class="font-bold">NISN/NIM</span>
                                        <span>: {{ $member->student_id }} </span>

                                        <span class="font-bold">Tanggal Lahir</span>
                                        <span>: {{ $member->date_of_birth }} </span>

                                        <span class="font-bold">Jenis Kelamin</span>
                                        <span>: {{ $member->gender == 'l' ? 'Laki-laki' : 'Perempuan' }} </span>

                                        <span class="font-bold">No Handphone</span>
                                        <span>: {{ $member->no_wa }}</span>

                                        <span class="font-bold">Email</span>
                                        <span>: {{ $member->email }} </span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            {{-- pop-up confirm --}}
            <div
                x-show="showConfirm"
                x-transition.opacity
                x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm"
                >
                <div
                    class="bg-white p-6 rounded-lg shadow-xl w-80"
                    x-on:click.outside="showConfirm = false" {{-- Perbaiki @@ menjadi x-on: --}}
                    >
                    <h2 class="text-lg font-semibold mb-4">Konfirmasi Verifikasi</h2>
                    <p class="mb-12">Yakin ingin memverifikasi user ini?</p>
                    <div class="flex justify-end gap-3">
                            <button
                                x-on:click="showConfirm = false" {{-- Perbaiki @@ menjadi x-on: --}}
                                class="bg-gray-600 text-white px-4 py-1 rounded hover:bg-gray-800">
                                Batal
                            </button>

                            <form
                                method="POST"
                                action="{{ route('admin.manajemen-user.accpet', ['partisipant_id' => $user->id]) }}"
                                onsubmit="showConfirm = false; showButton = false"
                            >
                                    @csrf
                                    <button type="submit"
                                        class="bg-[#029161] hover:bg-green-700 text-white px-4 py-1 rounded">
                                        Ya
                                    </button>
                            </form>
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
                    x-on:click.outside="showReject = false" {{-- Perbaiki @@ menjadi x-on: --}}
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
                                x-on:click="showReject = false" {{-- Perbaiki @@ menjadi x-on: --}}
                                class="bg-gray-600 text-white px-4 py-1 rounded hover:bg-gray-800">
                                Batal
                            </button>

                            <form
                                method="POST"
                                action="{{ route('admin.manajemen-user.reject', ['partisipant_id' => $user->id]) }}"
                                onsubmit="showReject = false; showButton = false"
                                >
                                    @csrf
                                    <input type="hidden" name="reject_message" :value="note">

                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded">
                                        Tolak
                                    </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
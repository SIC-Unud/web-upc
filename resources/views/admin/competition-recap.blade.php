@extends('layouts.side-bar')

@section('title', $title ?? 'Rekap Kompetisi')

@section('content')
    <header class="flex justify-between lg:mb-4 mb-2 relative">
        <h1 class="text-[#4C4C4C] font-bold lg:text-4xl text-2xl">Kompetisi</h1>
    </header>
    <main class="block md:flex justify-between items-center lg:gap-5 md:gap-3">
        <div class="bg-white rounded-md lg:px-12 px-6 lg:py-8 py-4 w-full grow shadow-lg mb-2 md:mb-0">
            <div class="flex gap-2 md:gap-5 flex-col items-center md:flex-row">
                <img src="/assets/competition/kompetisi.png" class="max-w-full w-50" alt="Image Kompetisi">
                <div class="flex flex-col items-center md:items-start gap-2">
                    <h1 class="text-xl font-bold lg:text-2xl">{{ $competition->name }}</h1>
                    <div class="flex gap-2 items-center text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        <h5 class="text-base font-semibold lg:text-lg">{{ $competition->is_simulation ? $countAllParticipantAccept : $competition->participant_count }} <span class="text-[10px] ml-1 text-gray-400 font-normal">(total peserta aktif)</span></h5>
                    </div>
                    <div class="flex gap-2 items-center text-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        <h5 class="text-base font-semibold lg:text-lg">{{ $competition->is_simulation ? $started_simulation_participants_count : $competition->started_real_participants_count }} <span class="text-[10px] ml-1 text-gray-400 font-normal">(total peserta yang sudah start quiz)</span></h5>
                    </div>
                    <div class="flex gap-2 items-center text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        <h5 class="text-base font-semibold lg:text-lg">{{ $competition->is_simulation ? $finished_simulation_participants_count : $competition->finished_real_participants_count }} <span class="text-[10px] ml-1 text-gray-400 font-normal">(total peserta yang sudah menyelesaikan quiz)</span></h5>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <div class="flex justify-between gap-2 flex-col md:flex-row">
                    <h1 class="text-xl font-bold lg:text-2xl">REKAP PENILAIAN</h1>
                    <a href="{{ route('admin.competition.score-recap', $competition->slug) }}" class="flex items-center justify-between gap-2 bg-[#00C482] hover:bg-[#16ad7a] w-max rounded-lg px-3 py-1 lg:px-5 lg:py-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="white" 
                            class="size-3 lg:size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <p class="lg:text-base text-sm text-white">Export</p>
                    </a>
                </div>
                <div class="overflow-x-auto my-5">
                    <table class="table-auto w-full border-collapse border border-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="border border-gray-200 px-4 py-2 text-left">Peringkat</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Nama Lengkap</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">No Peserta</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Benar</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Salah</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Hots</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Waktu Submit</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attempts as $key => $attempt)
                                <tr class="{{ ($attempts->firstItem() + $key) <= 10 ? 'bg-emerald-200' : 'bg-white' }}">
                                    <td class="border border-gray-200 px-4 py-2">
                                        {{ $attempts->firstItem() + $key }}
                                    </td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->participant->leader_name }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->participant->no_participant }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->correct_answer }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->wrong_answer }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->correct_hots_question }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->finish_at }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->score }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $attempts->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
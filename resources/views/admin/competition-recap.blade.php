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
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('admin.competition.score-recap', $competition->slug) }}" class="flex items-center justify-between gap-2 bg-[#00C482] hover:bg-[#16ad7a] w-max rounded-lg px-3 py-1 lg:px-5 lg:py-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="size-3 lg:size-6" fill="white"><path d="M128 64C92.7 64 64 92.7 64 128L64 512C64 547.3 92.7 576 128 576L208 576L208 464C208 428.7 236.7 400 272 400L448 400L448 234.5C448 217.5 441.3 201.2 429.3 189.2L322.7 82.7C310.7 70.7 294.5 64 277.5 64L128 64zM389.5 240L296 240C282.7 240 272 229.3 272 216L272 122.5L389.5 240zM272 444C261 444 252 453 252 464L252 592C252 603 261 612 272 612C283 612 292 603 292 592L292 564L304 564C337.1 564 364 537.1 364 504C364 470.9 337.1 444 304 444L272 444zM304 524L292 524L292 484L304 484C315 484 324 493 324 504C324 515 315 524 304 524zM400 444C389 444 380 453 380 464L380 592C380 603 389 612 400 612L432 612C460.7 612 484 588.7 484 560L484 496C484 467.3 460.7 444 432 444L400 444zM420 572L420 484L432 484C438.6 484 444 489.4 444 496L444 560C444 566.6 438.6 572 432 572L420 572zM508 464L508 592C508 603 517 612 528 612C539 612 548 603 548 592L548 548L576 548C587 548 596 539 596 528C596 517 587 508 576 508L548 508L548 484L576 484C587 484 596 475 596 464C596 453 587 444 576 444L528 444C517 444 508 453 508 464z"/></svg>
                            <p class="lg:text-base text-sm text-white">Export PDF</p>
                        </a>
                        
                        <a href="{{ route('attempts.export', $competition->slug) }}" class="flex items-center justify-between gap-2 bg-[#00C482] hover:bg-[#16ad7a] w-max rounded-lg px-3 py-1 lg:px-5 lg:py-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3 lg:size-6" fill="white" viewBox="0 0 640 640"><path d="M128 64C92.7 64 64 92.7 64 128L64 512C64 547.3 92.7 576 128 576L208 576L208 464C208 428.7 236.7 400 272 400L448 400L448 234.5C448 217.5 441.3 201.2 429.3 189.2L322.7 82.7C310.7 70.7 294.5 64 277.5 64L128 64zM389.5 240L296 240C282.7 240 272 229.3 272 216L272 122.5L389.5 240zM296 444C271.7 444 252 463.7 252 488L252 568C252 592.3 271.7 612 296 612L312 612C336.3 612 356 592.3 356 568L356 560C356 549 347 540 336 540C325 540 316 549 316 560L316 568C316 570.2 314.2 572 312 572L296 572C293.8 572 292 570.2 292 568L292 488C292 485.8 293.8 484 296 484L312 484C314.2 484 316 485.8 316 488L316 496C316 507 325 516 336 516C347 516 356 507 356 496L356 488C356 463.7 336.3 444 312 444L296 444zM432 444C403.3 444 380 467.3 380 496C380 524.7 403.3 548 432 548C438.6 548 444 553.4 444 560C444 566.6 438.6 572 432 572L400 572C389 572 380 581 380 592C380 603 389 612 400 612L432 612C460.7 612 484 588.7 484 560C484 531.3 460.7 508 432 508C425.4 508 420 502.6 420 496C420 489.4 425.4 484 432 484L456 484C467 484 476 475 476 464C476 453 467 444 456 444L432 444zM528 444C517 444 508 453 508 464L508 495.6C508 531.1 518.5 565.9 538.2 595.4L543.3 603.1C547 608.7 553.3 612 559.9 612C566.5 612 572.8 608.7 576.5 603.1L581.6 595.4C601.3 565.8 611.8 531.1 611.8 495.6L611.8 464C611.8 453 602.8 444 591.8 444C580.8 444 571.8 453 571.8 464L571.8 495.6C571.8 515.2 567.7 534.5 559.8 552.3C551.9 534.5 547.8 515.2 547.8 495.6L547.8 464C547.8 453 538.8 444 527.8 444z"/></svg>
                            <p class="lg:text-base text-sm text-white">Export CSV</p>
                        </a>
                    </div>
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
                                <tr class="{{ ($attempts->firstItem() + $key) <= 25 ? 'bg-emerald-200' : 'bg-white' }}">
                                    <td class="border border-gray-200 px-4 py-2">
                                        {{ $attempts->firstItem() + $key }}
                                    </td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->participant->leader_name }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->participant->no_participant }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->correct_answer ?? '-' }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->wrong_answer ?? '-'  }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->correct_hots_question ?? '-' }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->finish_at ?? "Belum Submit"  }}</td>
                                    <td class="border border-gray-200 px-4 py-2">{{ $attempt->score ?? 0  }}</td>
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
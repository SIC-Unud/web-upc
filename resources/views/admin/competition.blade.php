@extends('layouts.side-bar')

@section('title', 'Competitions')

@section('content')
    <div 
        x-data="{ 
            showConfirm: false, 
            selectedCompetition: '', 
            pendingUrl: '' 
        }"
    >
        <x-header class="mb-5 lg:mb-9">Kompetisi</x-header>
        
        <div class="grid w-fit gap-3 grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 lg:gap-5"> 
            @foreach ($competitions as $competition)
                <div class="w-full flex flex-col pl-2 h-full">
                    <img src="/assets/competition/kompetisi.png" class="max-w-full" alt="">
                    <div class="bg-white grow rounded-b-3xl flex flex-col shadow-xl">
                        <div class="flex flex-col grow p-2 md:p-5 pt-2">
                            <h1 class="text-[8px] md:text-xs lg:text-base font-semibold">
                            {{ $competition['title'] }}
                            </h1>
                            <p class="text-[5px] md:text-[8px] lg:text-[10px]">{{ $competition['date'] }}</p>
                        </div>
                        <div class="flex gap-2 items-center px-4 md:px-7 {{ $competition['hasStarted'] ? 'justify-between' : 'justify-end'}}">
                            <div
                                @click="
                                    selectedCompetition = '{{ $competition['title'] }}'; 
                                    pendingUrl = '{{ route('admin.competition.question.edit', ['competition' => $competition['slug'], 'questionNumber' => 1]) }}'; 
                                    showConfirm = true
                                "
                                class="{{ $competition['countNotNullQuestion'] < $competition['countQuestion'] ? 'text-[#FF0606]' : 'text-[#029161]' }} cursor-pointer w-max text-[6px] md:text-[10px] lg:text-xs font-semibold pb-5">
                                {{ $competition['countNotNullQuestion'] }}/{{ $competition['countQuestion'] }} soal
                            </div>
                            @if ($competition['hasStarted'])
                                <a href="{{ route('admin.competition.recap', $competition['slug']) }}" class="cursor-pointer w-max text-[6px] md:text-[10px] lg:text-xs font-semibold pb-5 text-[#029161]">lihat rekap</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <x-pop-up-kompetisi 
            title="Edit Kompetisi" 
            color="green" 
            confirmText="Ya" 
            x-bind:pending-url="pendingUrl"
        >
            Apakah anda ingin mengedit <span x-text="selectedCompetition"></span>?
        </x-pop-up-kompetisi>
    </div>
@endsection
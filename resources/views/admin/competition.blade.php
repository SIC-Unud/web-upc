@extends('layouts.side-bar')

@section('title', 'Competitions')

@section('content')
<div x-data="{ showConfirm: false, selectedCompetition: '' }">
    <x-header class="mb-5 lg:mb-9">Kompetisi</x-header>
    <div class="grid w-fit gap-3 grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 lg:gap-5"> 
        @foreach ($competitions as $competition)
            <div 
                class="cursor-pointer" 
                @click="selectedCompetition = '{{ $competition['title'] }}'; showConfirm = true"
            >
                <x-competition-admin 
                    :count="$competition['countQestion']" 
                    :title="$competition['title']" 
                    :date="$competition['date']" 
                />
            </div>
        @endforeach
    </div>

    {{-- Popup --}}
    <x-pop-up-kompetisi title="Edit Kompetisi" color="green" confirmText="Ya">
        Apakah anda ingin mengedit <span x-text="selectedCompetition"></span>?
    </x-pop-up-kompetisi>
</div>
@endsection

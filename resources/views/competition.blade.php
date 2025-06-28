@extends('layouts.side-bar')

@section('title', 'Competitions')

@section('content')
   <div>
      <x-header class="mb-5 lg:mb-9">Kompetisi</x-header>
      <div class="grid w-fit gap-3 grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 lg:gap-5"> 
         @foreach ($competitions as $competition)
            <x-jadwal :isMissed="$competition['isMissed']">
               <x-slot:title>{{ $competition['title'] }}</x-slot:title>
               <x-slot:date>{{ $competition['date'] }}</x-slot:date>
               <x-slot:status>{{ $competition['status'] }}</x-slot:status>
            </x-jadwal>
         @endforeach
      </div>
   </div>
@endsection

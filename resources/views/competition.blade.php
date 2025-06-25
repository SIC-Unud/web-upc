@extends('layouts.side-bar')

@section('title', 'Competitions')

@section('content')
   <div>
      <x-header class="mb-5 lg:mb-9">Kompetisi</x-header>
      <div class="grid w-fit gap-3 grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 lg:gap-5"> 
         @foreach ($lomba as $lom)
            <x-jadwal :isMissed="$lom['isMissed']">
               <x-slot:title>{{ $lom['title'] }}</x-slot:title>
               <x-slot:date>{{ $lom['date'] }}</x-slot:date>
               <x-slot:status>{{ $lom['status'] }}</x-slot:status>
            </x-jadwal>
         @endforeach
      </div>
   </div>
@endsection

@extends('layouts.side-bar')

@section('title', 'Competition Questions')

@section('content')
    {{-- content --}}
    @livewire('competition-questions', ['competition' => $competition, 'questionNumber' => $questionNumber])
@endsection
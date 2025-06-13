<?php

use Illuminate\Support\Facades\Route;

Route::get('/livewire', function () {
    return view('livewire.register');
});
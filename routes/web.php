<?php

use App\Livewire\Computer\DetailComputer;
use App\Livewire\Computer\IndexComputer as computer;
use App\Livewire\Setting\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kom', Computer::class);
Route::get('/details/{id_computer}', DetailComputer::class)->name('details.computer');
Route::get('/setting', Setting::class)->name('setting');
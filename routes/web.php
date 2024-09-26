<?php

use App\Livewire\Computer\DetailComputer;
use App\Livewire\Computer\IndexComputer as computer;
use App\Livewire\Events\IndexEvent;
use App\Livewire\Setting\Setting;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Computer::class)->name('index.computer');
Route::get('/details/{id_computer}', DetailComputer::class)->name('details.computer');
Route::get('/events/{id_computer}', IndexEvent::class)->name('events.computer');
Route::get('/setting', Setting::class)->name('setting');
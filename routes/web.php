<?php

use App\Livewire\Computer\DetailComputer;
use App\Livewire\Computer\IndexComputer as computer;
use App\Livewire\Events\IndexEvent;
use App\Livewire\Policies\IndexPolicies;
use App\Livewire\Policies\ListPolicies;
use App\Livewire\Setting\Setting;
use App\Livewire\Status\IndexStatus;
use Illuminate\Support\Facades\Route;

Route::get('/', Computer::class)->name('index.computer');

Route::get('/details/{id_computer}', DetailComputer::class)->name('details.computer');
Route::get('/events/{id_computer}', IndexEvent::class)->name('events.computer');
Route::get('/status/{id_computer}', IndexStatus::class)->name('status.computer');

Route::get('/policies/list', ListPolicies::class)->name('policies.list');
Route::get('/policies/{id_computer}', IndexPolicies::class)->name('policies.computer');

Route::get('/setting', Setting::class)->name('setting');
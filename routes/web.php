<?php

use App\Livewire\Computer\DetailComputer;
use App\Livewire\Computer\Group\CreateGroup;
use App\Livewire\Computer\Group\EditGroup;
use App\Livewire\Computer\Group\IndexGroup;
use App\Livewire\Computer\Group\PolicyGroup;
use App\Livewire\Computer\Group\ShowGroup;
use App\Livewire\Computer\IndexComputer as computer;
use App\Livewire\Events\IndexEvent;
use App\Livewire\Policies\CreatePolicies;
use App\Livewire\Policies\EditPolicies;
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
Route::get('/policies/create', CreatePolicies::class)->name('policies.create');
Route::get('/policies/{id_policies}', EditPolicies::class)->name('policies.edit');
Route::get('/policies-computer/{id_computer}', IndexPolicies::class)->name('policies.computer');

Route::get('/computer/group',IndexGroup::class)->name('computer.group');
Route::get('/computer/create/group', CreateGroup::class)->name('create.group');
Route::get('/computer/group/show/{id}', ShowGroup::class)->name('show.group');
Route::get('/computer/group/policy/{id}', PolicyGroup::class)->name('policy.group');
Route::get('/computer/group/edit/{id}', EditGroup::class)->name('group.edit');


Route::get('/setting', Setting::class)->name('setting');


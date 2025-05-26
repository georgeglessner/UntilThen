<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RSVPController;
use App\Models\RSVP;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// main page - list of events 
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('events/create', [EventController::class, 'create'])
    ->middleware('auth')
    ->name('events.create');

// event route, need to add event hash into url param
Route::resource('events', EventController::class)->except(['create', 'index']);

// rsvp route
Route::resource('rsvp', RSVPController::class);

Route::get('events/{hash}', [EventController::class, 'show']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('events', [EventController::class, 'index'])->name('events.index');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

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

Route::get('events/past', [EventController::class, 'past'])->name('events.past');

Route::get('events/{hash}', [EventController::class, 'show']);

// rsvp route
Route::resource('rsvp', RSVPController::class);

// event route, need to add event hash into url param
Route::resource('events', EventController::class)->except(['create', 'index']);

Route::redirect('dashboard', 'events')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('events', [EventController::class, 'index'])->name('events.index');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

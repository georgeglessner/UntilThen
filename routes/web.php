<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// main page - list of events 
Route::get('/', function () {
    return view('welcome');
})->name('home');

// event route, need to add event hash into url param
Route::get('/event', function () {
    return 'This is an event';
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

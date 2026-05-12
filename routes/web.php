<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', fn () => view('home'))->name('home');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/events/{event}/subscribers', [RegistrationController::class, 'subscribers'])->name('events.subscribers');
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('events.register');
    Route::delete('/events/{event}/register', [RegistrationController::class, 'destroy'])->name('events.unregister');

    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
});

require __DIR__.'/auth.php';

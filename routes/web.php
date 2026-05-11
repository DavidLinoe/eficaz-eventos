<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/events', [EventController::class, 'index'])->name('events.index');

Route::get('/registrations', function () {
    return view('registrations');
});


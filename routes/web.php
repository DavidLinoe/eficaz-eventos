<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/registrations', function () {
    return view('registrations');
});


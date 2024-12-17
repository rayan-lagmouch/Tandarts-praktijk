<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('index');
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/services', function () {
    return view('services');
});


Route::get('/appointment', function () {
    return view('appointment');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointments.store');
});

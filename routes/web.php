<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PDFController;
use App\Http\Middleware\VerifyIsEmployee;

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

Route::get('/invoices/{id}/pdf', [PDFController::class, 'generateInvoicePDF'])->name('invoices.pdf');

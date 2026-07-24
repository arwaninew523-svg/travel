<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Welcome')->name('home');
Route::inertia('/about', 'public/About')->name('about');
Route::inertia('/service', 'public/Service')->name('service');
Route::inertia('/contact', 'public/Contact')->name('contact');

Route::get('/contact/login', function () {
    return Inertia::render('auth/Login', [
        'status' => session('status'),
        'canResetPassword' => true,
        'teamInvitation' => null,
    ]);
})->name('contact.login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

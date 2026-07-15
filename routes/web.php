<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Controllers\Travel\PaketController;
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

Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::get('paket-travel', [PaketController::class, 'index'])->name('paket-travel.index');
    });

Route::middleware(['auth'])->group(function () {
    Route::get('invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
    Route::delete('invitations/{invitation}', [TeamInvitationController::class, 'decline'])->name('invitations.decline');
});

require __DIR__.'/settings.php';

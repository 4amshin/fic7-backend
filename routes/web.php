<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*----------------------------------------NON AUTH--------------------------------------*/
Route::get('/', function () {
    return view('auth.login');
});


/*----------------------------------------AUTH ROUTE--------------------------------------*/
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('home', function() {
        return view('admin.home')->with('showNavbar', true);
    })->name('home');

    /*----------------------------------------USER--------------------------------------*/
    // Route::post('profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
});


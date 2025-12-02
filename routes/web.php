<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/store', function () {
    return view('store');
})->name('home');

Route::get('/store', [StoreController::class, 'index']);

Route::get('/cc', function () {
    return view('cc');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('home');

Route::get('/temp-pp', function () {
    return view('product-page');
})->name('home');

Route::get('/temp-pp', [ProductController::class, 'index']);

Route::get('/basket', function () {
    return view('basket');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

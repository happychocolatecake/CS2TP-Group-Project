<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\BasketController; 
// use App\Http\Controllers\CheckoutController; going to implement later


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/store', [StoreController::class, 'index'])->name('store.index');

Route::get('/search', function () {
    return view('store'); 
})->name('search');

Route::get('/help', function () {
    return view('contact'); 
})->name('help');


Route::get('/cc', function () {
    return view('cc');
})->name('cc.index'); 

Route::get('/about', function () {
    return view('about');
})->name('about.index'); 

Route::get('/contact', function () {
    return view('contact');
})->name('contact.index'); 

Route::get('/temp-pp', function () {
    return view('product-page');
})->name('home');

Route::get('/temp-pp', [ProductController::class, 'index']);

Route::get('/basket', function () {
    return view('basket');
})->name('home');


Route::middleware(['auth'])->group(function () {

    Route::redirect('settings', 'settings/profile');

    Route::get('/basket', [StoreController::class, 'viewBasket'])->name('basket.view');
    Route::post('/basket/add', [StoreController::class, 'addToBasket'])->name('basket.add');
    Route::post('/basket/remove', [StoreController::class, 'removeItem'])->name('basket.remove');
    Route::post('/basket/update', [StoreController::class, 'updateQuantity'])->name('basket.update');
    Route::post('/basket/update', [StoreController::class, 'updateQuantity'])->name('basket.update');

    Volt::route('settings/profile', 'initial views.livewire.settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'initial views.livewire.settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'initial views.livewire.settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'initial views.livewire.settings.two-factor')
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
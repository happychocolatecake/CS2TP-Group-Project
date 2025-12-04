<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

// --- Public Routes ---

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
})->name('cc');

Route::get('/about', function () {
    return view('about');
})->name('about');

/*Route::get('/cc', function () {
    return view('cc');
})->name('cc.index');

Route::get('/about', function () {
    return view('about');
})->name('about.index');  old */

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
    return back()->with('status', 'Message sent successfully!');
});

Route::get('/product/{id}', [StoreController::class, 'show'])->name('product.show');

Route::get('/basket', function () {
    if (request()->user()) {
        return redirect()->route('basket.view');
    }

    return view('basket', ['basket' => null]);
})->name('basket.guest');

//  Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'processOrder'])->name('checkout.process');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// --- Authenticated Routes ---

Route::middleware(['auth'])->group(function () {

    Route::redirect('settings', 'settings/profile');

    // Basket routes for logged in users
    Route::get('/basket', action: [StoreController::class, 'viewBasket'])->name('basket.view');
    Route::post('/basket/add', [StoreController::class, 'addToBasket'])->name('basket.add');
    Route::post('/basket/remove', [StoreController::class, 'removeItem'])->name('basket.remove');
    Route::post('/basket/update', [StoreController::class, 'updateQuantity'])->name('basket.update');
    Route::post('/basket/update', [StoreController::class, 'updateQuantity'])->name('basket.update');

    // Profile Tabs & Actions
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');

    // Password Change Page
    Route::get('/password/change', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/profile/verify-email-change', [ProfileController::class, 'verifyEmailPage'])->name('profile.verify-email');
    Route::post('/profile/verify-email-change', [ProfileController::class, 'verifyEmailAction'])->name('profile.verify-email.store');

    // settings
    Volt::route('settings/profile', 'initial views.livewire.settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'initial views.livewire.settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'initial views.livewire.settings.appearance')->name('appearance.edit');


    Volt::route('settings/two-factor', 'initial views.livewire.settings.two-factor')
        ->middleware(['password.confirm'])
        ->name('two-factor.show');


});

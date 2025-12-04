<?php


use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController; 
use Illuminate\Http\Request;

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

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (Request $request) {
    $request->validate([
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
    return back()->with('status', 'Message sent successfully!');
});

Route::get('/temp-pp', [ProductController::class, 'index'])->name('product.temp');

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

    Volt::route('settings/profile', 'initial views.livewire.settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'initial views.livewire.settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'initial views.livewire.settings.appearance')->name('appearance.edit');


    Volt::route('settings/two-factor', 'initial views.livewire.settings.two-factor')
        ->middleware(['password.confirm']) 
        ->name('two-factor.show');
});
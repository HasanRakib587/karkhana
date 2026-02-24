<?php

use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CheckoutPage;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\LoginPage;
use App\Livewire\Pages\PageController;
use App\Livewire\Pages\ProductDetailPage;
use App\Livewire\Pages\ProductsPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/products', ProductsPage::class)->name('products.all');
Route::get('/products/{slug}', ProductDetailPage::class)->name('product.detail');
Route::get('/cart', CartPage::class)->name('cart.page');
Route::get('/login', LoginPage::class)->name('login');

// Route::get('/auth/redirection/{provider}', [SocialiteController::class, 'authProviderRedirect'])
//         ->name('auth.redirection');
// Route::get('auth/{provider}/callback', [SocialiteController::class, 'socialAuthentication'])
//         ->name('auth.callback');

Route::get('/contact', [PageController::class, 'contactUs'])->name('contact.page');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy.page');
Route::get('/terms-conditions', [PageController::class, 'termsConditions'])->name('terms.page');

Route::middleware('auth:customer')->group(function () {

    Route::get('/logout', function () {
        Auth::guard('customer')->logout();
        // Regenerate CSRF token only
        request()->session()->regenerateToken();

        return redirect('/');
    })->name('customer.logout');

    Route::get('/checkout', CheckoutPage::class)->name('checkout');
});

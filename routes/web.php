<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SocialiteController;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CheckoutPage;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\LoginPage;
use App\Livewire\Pages\MyOrderDetailsPage;
use App\Livewire\Pages\MyOrdersPage;
use App\Livewire\Pages\ProductDetailPage;
use App\Livewire\Pages\ProductsPage;
use App\Livewire\Pages\SuccessPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/products', ProductsPage::class)->name('products.all');
Route::get('/products/{slug}', ProductDetailPage::class)->name('product.detail');
Route::get('/cart', CartPage::class)->name('cart.page');
Route::get('/login', LoginPage::class)->name('login');

Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/redirection/{provider}', 'authProviderRedirect')->name('auth.redirection');
    Route::get('auth/{provider}/callback', 'socialAuthentication')->name('auth.callback');
});

Route::get('/contact', [PageController::class, 'contactUs'])->name('contact.page');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

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
    Route::get('/my-orders', MyOrdersPage::class)->name('my.orders');
    Route::get('/my-orders/{order_id}', MyOrderDetailsPage::class)->name('order.details');

    Route::get('/success', SuccessPage::class)->name('success');
});

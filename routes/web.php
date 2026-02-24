<?php

use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\ProductsPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/products', ProductsPage::class)->name('products.all');

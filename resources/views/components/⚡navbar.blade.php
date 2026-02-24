<?php

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public $total_count = 0;

    public function mount()
    {
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        $this->total_count = $total_count;
    }
};
?>

<header>
    @php
        $isHome = request()->routeIs('home');
    @endphp
    <nav class="navbar navbar-expand navbar-dark {{ $isHome ? '' : 'bg-primary' }} fixed-top">
        <div class="nav__bg"></div>
        <div class="container">
            <!-- Trigger button -->
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
                    <path fill="white" d="M10 12h30v4H10zm0 10h30v4H10zm0 10h30v4H10z" />
                </svg>
            </button>

            @if ($isHome)
                <div class="logo d-flex justify-content-center align-items-center">
                    <img class="img-fluid" src="{{ asset('/images/logo.svg') }}" alt="" />
                    {{-- <div class="navbar-brand">
                    </div> --}}
                </div>
            @else
                <div class="navbar-brand logo">
                    <a href="">
                        <img class="img-fluid" src="{{ asset('/images/logo.svg') }}" alt="" />
                    </a>
                </div>
            @endif


            <div class="navbar-nav ms-auto">
                <ul class="navbar-nav">
                    @auth('customer')
                        <li class="nav-item dropdown">
                            <a class="nav-link text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ auth('customer')->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a wire:navigate class="dropdown-item" href="">My Orders</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="">Logout</a></li>
                            </ul>
                        </li>
                    @endauth
                    @guest('customer')
                        <li>
                            <a wire:navigate href="" class="nav-link text-light position-relative">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                                </svg>
                            </a>
                        </li>
                    @endguest
                    <li>
                        <a wire:navigate href="" class="nav-link text-light position-relative">
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $total_count }}
                                <span class="visually-hidden">cart items</span>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19 6h-2c0-2.8-2.2-5-5-5S7 3.2 7 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2m-7-3c1.7 0 3 1.3 3 3H9c0-1.7 1.3-3 3-3m7 17H5V8h14zm-7-8c-1.7 0-3-1.3-3-3H7c0 2.8 2.2 5 5 5s5-2.2 5-5h-2c0 1.7-1.3 3-3 3" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Panel -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Karkhana</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                        href="">Home</a>
                </li>
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{ request()->is('products') ? 'active' : '' }}"
                        href="">Products</a>
                </li>
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{ request()->is('cart') ? 'active' : '' }}" href="">Cart</a>
                </li>
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{ request()->is('my-orders') ? 'active' : '' }}"
                        href="">Profile</a>
                </li>
            </ul>
        </div>
    </div>
</header>
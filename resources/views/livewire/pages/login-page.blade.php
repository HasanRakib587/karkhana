<div class="container py-5 px-4 mt-5">
    <div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <main class="w-100" style="max-width: 480px;">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4 p-sm-5">
                    <div class="text-center mb-4">
                        <h1 class="font-primary h3 fw-bold text-dark mb-2">Sign in</h1>
                    </div>
                    <hr class="my-4">
                    <!-- Form -->
                    <form wire:submit.prevent="save">

                        @if (session('error'))
                            <div class="alert alert-danger mb-4" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="d-grid gap-2 mb-3">
                            <a href="#" class="btn btn-social btn-google">
                                <i class="bi bi-google me-2"></i> Sign in with Google
                            </a>
                            <a href="#" class="btn btn-social btn-facebook disabled ">
                                <i class="bi bi-facebook me-2"></i> Sign in with Facebook
                            </a>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </main>
    </div>
</div>
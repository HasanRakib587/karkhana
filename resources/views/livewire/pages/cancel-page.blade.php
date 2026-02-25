<div class="container py-5 px-4">
    <section class="d-flex align-items-center justify-content-center font-poppins bg-light py-5 rounded-3">
        <div class="bg-white border rounded-3 shadow-sm p-4 p-md-5 text-center" style="max-width: 700px; width: 100%;">
            <h1 class="text-danger fw-semibold fs-2 mb-0">
                @error('error')
                    {{ $message }}
                @enderror
            </h1>
        </div>
    </section>
</div>
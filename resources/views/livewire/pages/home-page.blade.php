<div>
    <!-- Hero Section -->
    <section class="hero-video hero hero-image">
        <video class="video-slide" src="{{ asset('videos/hero_vid.mp4') }}" autoplay muted loop></video>
    </section>
    <livewire:shop />
    <livewire:trending-slider />
    <livewire:homeslider />
    <!-- About Section-->
    <section id="about" class="bg-primary text-light py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-xxl-8">
                    <div class="text-center my-5">
                        <h2 class="font-primary fw-bolder display-6 text-light">About Karkhana</h2>
                        <p class="font-secondary fw-light lead fw-light mb-4">
                            Karkhana is an unique collection of handmade jewellery made eltirely with indigenous
                            materials.
                        </p>
                        {{-- <p class="font-seondary text-light">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit
                            dolorum itaque qui unde quisquam consequatur autem. Eveniet
                            quasi nobis aliquid cumque officiis sed rem iure ipsa!
                            Praesentium ratione atque dolorem?
                        </p> --}}
                        <div class="d-flex justify-content-center fs-2 gap-4">
                            <a class="text-gradient" href="#!"><i class="bi bi-twitter"></i></a>
                            <a class="text-gradient" href="#!"><i class="bi bi-linkedin"></i></a>
                            <a class="text-gradient" href="#!"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <livewire:footer />
    @push('scripts')
        <script src="https://unpkg.com/gsap@3.12.5/dist/gsap.min.js"></script>
        <script src="https://unpkg.com/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
        <script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>
        <script src="{{ asset('js/coverflow.js') }}"></script>
        <script src="{{ asset('js/heroLogo.js') }}"></script>
    @endpush
</div>
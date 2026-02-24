document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper', {          
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,    
        slidesPerView: "auto",
        spaceBetween: -350,
        loop: true,
        coverflowEffect: {
            rotate: 0,
            stretch: 250,
            depth: 350,
            modifier: 1,
            slideShadows: true,
        },
        navigation: {
            nextEl: ".swiper-next",
            prevEl: ".swiper-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 0,
                centeredSlides: true,
                effect: "slide",  
            },
            768: {
                slidesPerView: "auto",
                spaceBetween: 100,
                effect: "coverflow", 
            },
        },
    });
});




import Swiper from "swiper/bundle";

'use strict';

const Sliders = {
    init: function () {
        let swiper = null;
        function initSwiper() {
            if (!swiper) {
                swiper = new Swiper('.hero-swiper', {
                    direction: 'horizontal',
                    slidesPerView: 1,
                    effect: "fade", // Fade efekat za drugi slajder
                    fadeEffect: {
                        crossFade: true,
                    },
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            }
        }

        window.addEventListener('load', initSwiper);

        let reviewsSwiper = null;
        function initReviewsSwiper() {
            if (!reviewsSwiper) {
                reviewsSwiper = new Swiper('.reviews-swiper', {
                    direction: 'horizontal', // Koristi horizontalno pomeranje
                    slidesPerView: 3, // Prikazuje 3 slajda
                    breakpoints: {
                        992: { // Ekrani širi od 992px
                            slidesPerView: 3,
                        },
                        768: { // Ekrani od 768px do 991px
                            slidesPerView: 2,
                        },
                        0: { // Ekrani manji od 768px
                            slidesPerView: 1,
                        },
                    },
                    loop: true,
                    pagination: false, // Nema dots
                    navigation: false, // Nema strelica
                });
            }
        }

        window.addEventListener('load', initReviewsSwiper);
    }
};

export default Sliders;

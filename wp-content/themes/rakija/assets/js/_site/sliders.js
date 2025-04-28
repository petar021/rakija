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

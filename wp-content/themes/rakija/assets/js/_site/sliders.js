import Swiper from "swiper/bundle";

'use strict';

const Sliders = {
    init: function () {
        let swiper = null;

        function initSwiper() {
            if (!swiper) {
                swiper = new Swiper('.swiper', {
                    direction: 'horizontal',
                    slidesPerView: 1,
					effect: "fade",
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
    }
};

export default Sliders;

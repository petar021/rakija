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

		let reviewsSwiper = null;
		function initReviewsSwiper() {
			if (!reviewsSwiper) {
				reviewsSwiper = new Swiper('.reviews-swiper', {
					direction: 'horizontal',
					slidesPerView: 3,
					breakpoints: {
						992: { slidesPerView: 3 },
						768: { slidesPerView: 2 },
						0:   { slidesPerView: 1 },
					},
					loop: true,
					pagination: false,
					navigation: false,
				});
			}
		}

		let productMainSwiper = null;
		let productThumbsSwiper = null;
		function initProductGallerySwiper() {
			const mainSlider = document.querySelector('.js-product-main');
			const thumbsSlider = document.querySelector('.js-product-thumbs');

			if (mainSlider && thumbsSlider && !productMainSwiper) {
				productThumbsSwiper = new Swiper(thumbsSlider, {
					slidesPerView: 3,
					spaceBetween: 10,
					watchSlidesProgress: true,
					slideToClickedSlide: true,
				});

				productMainSwiper = new Swiper(mainSlider, {
					slidesPerView: 1,
					spaceBetween: 10,
					loop: true,
					thumbs: {
						swiper: productThumbsSwiper,
					},
				});
			}
		}

		function initProductGalleryModal() {
			const modal = document.getElementById("imageModal");
			const modalImg = document.getElementById("modalImg");
			const closeBtn = document.querySelector(".close");
			const prevBtn = document.querySelector(".modal-prev");
			const nextBtn = document.querySelector(".modal-next");

			let currentIndex = 0;
			let images = [];

			const galleryImgs = document.querySelectorAll(".js-product-main .swiper-slide img");

			if (modal && modalImg && closeBtn && prevBtn && nextBtn && galleryImgs.length) {
				galleryImgs.forEach((img, index) => {
					images.push(img.src);
					img.addEventListener("click", () => {
						modal.style.display = "flex";
						modalImg.src = img.src;
						currentIndex = index;
					});
				});

				function showImage(index) {
					if (index >= 0 && index < images.length) {
						modalImg.src = images[index];
						currentIndex = index;
					}
				}

				prevBtn.addEventListener("click", (e) => {
					e.stopPropagation();
					showImage(currentIndex - 1);
				});

				nextBtn.addEventListener("click", (e) => {
					e.stopPropagation();
					showImage(currentIndex + 1);
				});

				closeBtn.addEventListener("click", () => modal.style.display = "none");

				modal.addEventListener("click", (event) => {
					if (event.target === modal) {
						modal.style.display = "none";
					}
				});

				document.addEventListener("keydown", function (event) {
					if (modal.style.display === "flex") {
						if (event.key === "ArrowLeft") showImage(currentIndex - 1);
						else if (event.key === "ArrowRight") showImage(currentIndex + 1);
						else if (event.key === "Escape") modal.style.display = "none";
					}
				});
			}
		}

		window.addEventListener('load', () => {
			initSwiper();
			initReviewsSwiper();
			initProductGallerySwiper();
			initProductGalleryModal();
		});
	}
};

export default Sliders;

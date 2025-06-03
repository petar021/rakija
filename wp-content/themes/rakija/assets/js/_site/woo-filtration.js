'use strict';
const WooFiltration = {
    init: function () {
        // Prvo postavljanje: prikaži 8 i sakrij ostale
        document.querySelectorAll(".search-filter-field--type-choice.search-filter-field--input-type-radio").forEach(function (section) {
            const radios = Array.from(section.querySelectorAll(".search-filter-input-radio"));

            if (radios.length > 8) {
                // Prvih 8 ostaje gde jeste
                const visible = radios.slice(0, 8);
                visible.forEach(item => {
                    const label = item.querySelector(".search-filter-input-radio__container");
                    if (label) label.classList.remove("hidden-filter");
                });

                // Ostale prebacujemo u wrapper koji je zatvoren
                const hidden = radios.slice(8);
                const wrapper = document.createElement("div");
                wrapper.className = "animated-filter-wrapper";
                wrapper.style.height = "0px";
                wrapper.style.overflow = "hidden";
                wrapper.style.transition = "height 0.5s ease";

                hidden.forEach(item => {
                    wrapper.appendChild(item);
                });

                // Umetni wrapper odmah iza 8. elementa
                const lastVisible = visible[visible.length - 1];
                lastVisible.parentNode.insertBefore(wrapper, lastVisible.nextSibling);

                // Dodaj dugme "Prikaži sve"
                const showMoreBtn = document.createElement("span");
                showMoreBtn.className = "show-more-btn";
                showMoreBtn.setAttribute("data-target", section.dataset.filter || '');
                showMoreBtn.textContent = "Prikaži sve";
                section.appendChild(showMoreBtn);
            }
        });

        // Toggle dugme za otvaranje/zatvaranje wrappera
        document.querySelectorAll(".show-more-btn").forEach(function (btn) {
            btn.addEventListener("click", function () {
                const section = btn.closest(".search-filter-field");
                const wrapper = section.querySelector(".animated-filter-wrapper");

                if (!wrapper) return;

                const isOpen = wrapper.classList.contains("open");

                if (isOpen) {
                    // Zatvori wrapper
                    const currentHeight = wrapper.scrollHeight + "px";
                    wrapper.style.height = currentHeight;
                    requestAnimationFrame(() => {
                        wrapper.style.height = "0px";
                        wrapper.style.overflow = "hidden";
                        wrapper.classList.remove("open");
                        btn.textContent = "Prikaži sve";
                    });
                } else {
                    // Otvori wrapper
                    const fullHeight = wrapper.scrollHeight + "px";
                    wrapper.style.height = "0px"; // resetuje
                    requestAnimationFrame(() => {
                        wrapper.style.height = fullHeight;
                        wrapper.classList.add("open");
                        btn.textContent = "Prikaži manje";
                    });

                    // Nakon animacije postavi auto visinu
                    wrapper.addEventListener("transitionend", function handler() {
                        wrapper.style.height = "auto";
                        wrapper.style.overflow = "visible";
                        wrapper.removeEventListener("transitionend", handler);
                    });
                }

                btn.classList.toggle("active");
            });
        });

        // Otvori filtraciju (popup)
        const filterButton = document.querySelector('.products__filtration-cta');
        const customFilter = document.querySelector('.custom-filter');
        const customFilterCloseBtn = document.querySelector('.custom-filter__close');
        const body = document.body;

        if (filterButton && customFilter && customFilterCloseBtn) {
            filterButton.addEventListener('click', function () {
                customFilter.classList.add('active');
                customFilterCloseBtn.classList.add('active');
                body.classList.add('scroll-disable', 'overlay');
            });
        }

        // Zatvori filtraciju (popup)
        const filterButtonOpened = document.querySelector('.custom-filter');
        const customFilterClose = document.querySelector('.custom-filter__close');

        if (filterButtonOpened && customFilterClose) {
            customFilterClose.addEventListener('click', function () {
                filterButtonOpened.classList.remove('active');
                customFilterClose.classList.remove('active');
                body.classList.remove('scroll-disable', 'overlay');
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const isMobile = window.innerWidth < 1199;

            if (!isMobile) return;

            // 1. Nađi sve radio dugmiće unutar filtera
            const radios = document.querySelectorAll('.woocommerce-products-page .products-sidebar .yith-wcan-filters .yith-wcan-filter .filter-items .filter-item input[type="checkbox"]');
                        

            radios.forEach(radio => {
                // 2. Kloniraj element bez događaja (uklanja originalni 'change' handler YITH-a)
                const newRadio = radio.cloneNode(true);
                radio.parentNode.replaceChild(newRadio, radio);
            });

            // 3. Na klik dugmeta, ručno pokreni filtraciju
            const filterBtn = document.querySelector('.products__filtration-cta.bottom');
            if (filterBtn) {
                filterBtn.addEventListener('click', function () {
                    // Možda nemaš .yith-wcan-container, pa tražimo formu u okviru filter sekcije
                    const filterWrapper = document.querySelector('.products-grid'); // <- izmeni po tvojoj strukturi
                    const form = filterWrapper ? filterWrapper.closest('form') || filterWrapper.querySelector('form') : null;

                    if (form && typeof yith_wcan_frontend !== 'undefined' && typeof yith_wcan_frontend.ajax_call === 'function') {
                        yith_wcan_frontend.ajax_call(form);
                    }
                });
            }
        });
    }
};

export default WooFiltration;

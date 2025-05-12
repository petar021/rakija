'use strict';
const WooFiltration = {
    init: function() {
        document.querySelectorAll(".show-more-btn").forEach(function (btn) {
            btn.addEventListener("click", function () {
                const target = btn.getAttribute("data-target");
                const section = document.querySelector(`.filter-section[data-filter="${target}"]`);
                let wrapper = section.querySelector(".animated-filter-wrapper");

                if (!wrapper) {
                    // Prvi klik – otvori
                    const hiddenItems = section.querySelectorAll(".hidden-filter");

                    wrapper = document.createElement("div");
                    wrapper.classList.add("animated-filter-wrapper");

                    hiddenItems.forEach(el => {
                        el.classList.remove("hidden-filter");
                        wrapper.appendChild(el);
                    });

                    // Ubaci ispod poslednjeg vidljivog elementa
                    const lastVisible = section.querySelector("label:not(.hidden-filter):last-of-type");
                    if (lastVisible && lastVisible.parentNode) {
                        lastVisible.parentNode.insertBefore(wrapper, lastVisible.nextSibling);
                    } else {
                        section.appendChild(wrapper);
                    }

                    // Animacija otvaranja
                    wrapper.style.height = "0px";
                    wrapper.style.overflow = "hidden";
                    requestAnimationFrame(() => {
                        const fullHeight = wrapper.scrollHeight + "px";
                        wrapper.style.transition = "height 0.5s ease";
                        wrapper.style.height = fullHeight;

                        wrapper.addEventListener("transitionend", () => {
                            wrapper.style.height = "auto";
                            wrapper.style.overflow = "visible";
                            wrapper.style.transition = "none";
                        }, { once: true });
                    });

                    btn.textContent = "Prikaži manje";
                } else {
                    // Sledeći klik – zatvori
                    const currentHeight = wrapper.scrollHeight + "px";
                    wrapper.style.height = currentHeight;
                    requestAnimationFrame(() => {
                        wrapper.style.transition = "height 0.5s ease";
                        wrapper.style.height = "0px";
                        wrapper.style.overflow = "hidden";

                        wrapper.addEventListener("transitionend", () => {
                            // Vrati elemente u sekciju i sakrij ih
                            const items = Array.from(wrapper.children);
                            items.forEach(el => {
                                el.classList.add("hidden-filter");
                                section.insertBefore(el, wrapper);
                            });
                            wrapper.remove();
                        }, { once: true });
                    });

                    btn.textContent = "Prikaži sve";
                }
            });
        });

        // Open filtration popup
        const filterButton = document.querySelector('.products__filtration-cta');
        const customFilter = document.querySelector('.custom-filter');
        const body = document.body;

        if (filterButton && customFilter) {
            filterButton.addEventListener('click', function () {
                customFilter.classList.add('active');
                body.classList.add('scroll-disable');
            });
        }

        // Close filtration popup
        const filterButtonOpened = document.querySelector('.custom-filter');
        const customFilterClose = document.querySelector('.custom-filter__close');

        if (filterButtonOpened && customFilterClose) {
            customFilterClose.addEventListener('click', function () {
                filterButtonOpened.classList.remove('active');
                body.classList.remove('scroll-disable');
            });
        }
    }
};

export default WooFiltration;

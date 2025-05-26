'use strict';
const WooFiltration = {
    init: function () {
        // Sakrij višak .custom-radio ako ih ima više od 8
        document.querySelectorAll(".filter-section").forEach(function (section) {
            const labels = Array.from(section.querySelectorAll("label.custom-radio.custom-checkbox"));
            
            if (labels.length > 8) {
                const visible = labels.slice(0, 8);
                const hidden = labels.slice(8);

                hidden.forEach(label => label.classList.add("hidden-filter"));

                // Dodaj dugme "Prikaži sve"
                const showMoreBtn = document.createElement("span");
                showMoreBtn.className = "show-more-btn";
                showMoreBtn.setAttribute("data-target", section.dataset.filter);
                showMoreBtn.textContent = "Prikaži sve";
                section.appendChild(showMoreBtn);
            }
        });

        // Dugme za prikaz više
        document.querySelectorAll(".show-more-btn").forEach(function (btn) {
            btn.addEventListener("click", function () {
                const target = btn.getAttribute("data-target");
                const section = document.querySelector(`.filter-section[data-filter="${target}"]`);
                let wrapper = section.querySelector(".animated-filter-wrapper");

                if (!wrapper) {
                    const hiddenItems = section.querySelectorAll(".hidden-filter");

                    wrapper = document.createElement("div");
                    wrapper.classList.add("animated-filter-wrapper");

                    hiddenItems.forEach(el => {
                        el.classList.remove("hidden-filter");
                        wrapper.appendChild(el);
                    });

                    const lastVisible = section.querySelector("label:not(.hidden-filter):last-of-type");
                    if (lastVisible && lastVisible.parentNode) {
                        lastVisible.parentNode.insertBefore(wrapper, lastVisible.nextSibling);
                    } else {
                        section.appendChild(wrapper);
                    }

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
                    const currentHeight = wrapper.scrollHeight + "px";
                    wrapper.style.height = currentHeight;
                    requestAnimationFrame(() => {
                        wrapper.style.transition = "height 0.5s ease";
                        wrapper.style.height = "0px";
                        wrapper.style.overflow = "hidden";

                        wrapper.addEventListener("transitionend", () => {
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

        // Otvori filtraciju (popup)
        const filterButton = document.querySelector('.products__filtration-cta');
        const customFilter = document.querySelector('.custom-filter');
        const body = document.body;

        if (filterButton && customFilter) {
            filterButton.addEventListener('click', function () {
                customFilter.classList.add('active');
                body.classList.add('scroll-disable', 'overlay');
            });
        }

        // Zatvori filtraciju (popup)
        const filterButtonOpened = document.querySelector('.custom-filter');
        const customFilterClose = document.querySelector('.custom-filter__close');

        if (filterButtonOpened && customFilterClose) {
            customFilterClose.addEventListener('click', function () {
                filterButtonOpened.classList.remove('active');
                body.classList.remove('scroll-disable', 'overlay');
            });
        }
    }
};

export default WooFiltration;

'use strict';
const WooFiltration = {
    init: function() {
        document.querySelectorAll(".show-more-btn").forEach(function (btn) {
            btn.addEventListener("click", function () {
                const target = btn.getAttribute("data-target");
                const section = document.querySelector(`.filter-section[data-filter="${target}"]`);
                const hiddenItems = section.querySelectorAll(".hidden-filter");

                // Kreiraj wrapper
                const wrapper = document.createElement("div");
                wrapper.classList.add("animated-filter-wrapper");

                hiddenItems.forEach(el => {
                    el.classList.remove("hidden-filter");
                    wrapper.appendChild(el);
                });

                // Ubaci wrapper ispod zadnjeg vidljivog elementa
                const lastVisible = section.querySelector("label:not(.hidden-filter):last-of-type");
                if (lastVisible && lastVisible.parentNode) {
                    lastVisible.parentNode.insertBefore(wrapper, lastVisible.nextSibling);
                } else {
                    section.appendChild(wrapper);
                }

                // Animacija visine
                wrapper.style.height = "0px";
                wrapper.style.overflow = "hidden";

                requestAnimationFrame(() => {
                    const fullHeight = wrapper.scrollHeight + "px";
                    wrapper.style.transition = "height 0.5s ease";
                    wrapper.style.height = fullHeight;

                    // Nakon tranzicije, očisti stilove
                    wrapper.addEventListener("transitionend", () => {
                        wrapper.style.height = "auto";
                        wrapper.style.overflow = "visible";
                        wrapper.style.transition = "none";
                    }, { once: true });
                });

                btn.remove(); // Ukloni dugme
            });
        });
    }
};

export default WooFiltration;

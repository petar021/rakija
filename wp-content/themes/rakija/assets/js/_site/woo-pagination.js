'use strict';
const Pagination = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		document.addEventListener("DOMContentLoaded", function () {
        const filterForm = document.getElementById("product-filter-form");
        const filteredProductsWrapper = document.getElementById("filtered-products");

        function getFormData(form) {
            const formData = new FormData(form);
            const params = new URLSearchParams();

            for (let [key, value] of formData.entries()) {
                if (value !== "all") {
                    params.append(key, value);
                }
            }

            return params;
        }

        // AJAX pagination click
        document.addEventListener("click", function (e) {
            const target = e.target.closest(".woocommerce-pagination a");

            if (target) {
                e.preventDefault();

                const url = new URL(target.href);
                const paged = url.searchParams.get("paged") || 1;

                const params = getFormData(filterForm);
                params.set("paged", paged);
                params.set("ajax_filter", "1");

                const categoryWrapper = document.querySelector(".products-sec");
                const categoryId = categoryWrapper?.dataset.categoryId;

                if (categoryId) {
                    params.set("main_category", categoryId);
                }

                fetch(window.location.pathname + "?" + params.toString(), {
                    method: "GET",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(res => res.text())
                .then(html => {
                    filteredProductsWrapper.innerHTML = html;
                    window.scrollTo({ top: filteredProductsWrapper.offsetTop - 100, behavior: "smooth" });
                });
            }
        });
    });

	}
};

export default Pagination;

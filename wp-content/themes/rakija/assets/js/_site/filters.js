'use strict';

let debounceTimeout;
const debounceDelay = 600;

const getSafePriceValue = (value, fallback) => {
	return value && !isNaN(value) ? value : fallback;
};

const submitForm = () => {
	const filterForm = document.querySelector("#product-filter-form");
	const productsContainer = document.querySelector("#filtered-products");
	if (!filterForm || !productsContainer) return;

	const minInput = filterForm.querySelector("#min-price-input");
	const maxInput = filterForm.querySelector("#max-price-input");

	const minPrice = getSafePriceValue(minInput.value, 0);
	const maxPrice = getSafePriceValue(maxInput.value, 10000);

	minInput.value = minPrice;
	maxInput.value = maxPrice;

	const url = new URL(window.location.href);
	const params = new URLSearchParams(new FormData(filterForm));

	// Očisti sve prethodne vrednosti paginacije (nije više relevantna)
	params.delete("paged");

	// Promeni URL bez reloada
	history.replaceState(null, '', `${url.pathname}?${params}`);

	productsContainer.classList.add("loading");

	fetch(`${url.pathname}?${params}&ajax_filter=1`)
		.then(res => res.text())
		.then(html => {
			const parser = new DOMParser();
			const doc = parser.parseFromString(html, "text/html");
			const newContent = doc.querySelector("#filtered-products");

			if (newContent) {
				productsContainer.innerHTML = newContent.innerHTML;
				bindFilterEvents(); // Ponovo binduj evente
			} else {
				console.warn("⚠️ AJAX nije vratio #filtered-products div!");
			}

			productsContainer.classList.remove("loading");
		});
};

const bindFilterEvents = () => {
	const inputs = document.querySelectorAll("#product-filter-form input[type=radio]");
	const numberInputs = document.querySelectorAll("#product-filter-form input[type=number]");

	inputs.forEach((input) => {
		input.removeEventListener("change", submitForm);
		input.addEventListener("change", submitForm);
	});

	numberInputs.forEach((input) => {
		input.removeEventListener("input", input.__debouncedHandler);
		const handler = () => {
			clearTimeout(debounceTimeout);
			debounceTimeout = setTimeout(submitForm, debounceDelay);
		};
		input.__debouncedHandler = handler;
		input.addEventListener("input", handler);
	});
};

const Filters = {
	init: function () {
		const filterForm = document.querySelector("#product-filter-form");
		const applyBtn = document.querySelector(".products__filtration-cta");
		const isMobile = window.innerWidth <= 1024;

		if (!filterForm) return;

		if (applyBtn && isMobile) {
			applyBtn.addEventListener("click", submitForm);
		} else {
			bindFilterEvents();
		}
	}
};

export default Filters;

'use strict';

let debounceTimeout;
const debounceDelay = 600;

const updateProductCount = () => {
	const wrapper = document.querySelector("#filtered-products .products-wrapper");
	const countEl = document.querySelector(".products-number");
	const productState = document.querySelector('.products-sec__top');
	if (!wrapper || !countEl) return;

	// Provera da li postoji poruka "nema proizvoda"
	const noProductsMsg = wrapper.querySelector("p");

	// Ako nema proizvoda (ni jedan .product-box ili postoji p element sa porukom)
	const products = wrapper.querySelectorAll(".product-box");
	const totalCount = products.length;

	if (totalCount === 0 || noProductsMsg) {
		countEl.textContent = "";
		productState.classList.add('active');
		console.log("< 0");
	} else if (totalCount === 1) {
		countEl.textContent = "1 proizvod";
		productState.classList.remove('active');
		console.log("= 1");
	} else {
		countEl.textContent = `${totalCount} proizvoda`;
		productState.classList.remove('active');
		console.log("> 1");
	}
};

// ✅ Bezbedno parsiranje cene
const getSafePriceValue = (value, fallback) => {
	return value && !isNaN(value) ? value : fallback;
};

// ✅ Dodavanje <span class="checkmark"> u prvi label svake filter sekcije
const addCheckmarkToFirstLabel = () => {
	document.querySelectorAll(".filter-section").forEach(section => {
		const firstLabel = section.querySelector("label");
		if (firstLabel && !firstLabel.querySelector(".checkmark")) {
			const span = document.createElement("span");
			span.className = "checkmark";
			firstLabel.appendChild(span);
		}
	});
};

// ✅ Funkcija za submit filtera — koristi se na desktopu
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
	params.delete("paged"); // očisti paginaciju

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
				updateProductCount();

				if (window.innerWidth >= 767) {
					bindFilterEvents(); // samo na desktopu ponovo binduj
				}
			} else {
				console.warn("⚠️ AJAX nije vratio #filtered-products div!");
			}

			productsContainer.classList.remove("loading");
		});
};

// ✅ Filtracija samo klikom na dugme na mobilnim uređajima
const submitMobileForm = () => {
	submitForm();

	// ✅ Zatvori mobilni filter panel
	document.querySelectorAll(".custom-filter").forEach(el => el.classList.remove("active"));
	document.body.classList.remove("scroll-disable", "overlay");
};

// ✅ Desktop filtracija — binduje evente
const bindFilterEvents = () => {
	const isMobile = window.innerWidth < 767;
	if (isMobile) return; // ⛔️ Ne binduj evente na mobilnim uređajima

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

// ✅ Učitaj filtere iz URL-a (za reload i popstate/back)
const updateFiltersFromURL = () => {
	const url = new URL(window.location.href);
	const params = new URLSearchParams(url.search);
	const filterForm = document.querySelector("#product-filter-form");
	if (!filterForm) return;

	for (const [key, value] of params.entries()) {
		const input = filterForm.querySelector(`[name="${key}"][value="${value}"]`);
		if (input) input.checked = true;

		const numberInput = filterForm.querySelector(`[name="${key}"]`);
		if (numberInput && numberInput.type === "number") numberInput.value = value;
	}
};

// ✅ Glavni objekat
const Filters = {
	init: function () {
		const filterForm = document.querySelector("#product-filter-form");
		const applyBtnMobile = document.querySelector(".products__filtration-cta.bottom");
		const isMobile = window.innerWidth < 767;

		updateFiltersFromURL();
		addCheckmarkToFirstLabel();

		if (isMobile) {
			if (applyBtnMobile) {
				applyBtnMobile.addEventListener("click", submitMobileForm);
			}
		} else {
			if (filterForm) {
				bindFilterEvents();
			}
		}

		window.addEventListener("popstate", () => {
			updateFiltersFromURL();
			if (window.innerWidth < 767) {
				submitMobileForm();
			} else {
				submitForm();
			}
		});

		updateProductCount();

	}
};

export default Filters;

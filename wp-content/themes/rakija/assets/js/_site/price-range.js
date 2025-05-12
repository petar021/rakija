'use strict';
const PriceRange = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		const minRange = document.getElementById("min-price");
		const maxRange = document.getElementById("max-price");
		const minInput = document.getElementById("min-price-input");
		const maxInput = document.getElementById("max-price-input");
		const rangeFill = document.querySelector(".price-slider-range");

		// Ako bilo koji od elemenata ne postoji, ne izvršavaj dalje
		if (!minRange || !maxRange || !minInput || !maxInput || !rangeFill) {
			return;
		}

		function updateRangeFill() {
			const min = parseInt(minRange.value);
			const max = parseInt(maxRange.value);
			const rangeWidth = maxRange.max - minRange.min;
			const left = ((min - minRange.min) / rangeWidth) * 100;
			const right = ((max - minRange.min) / rangeWidth) * 100;
			rangeFill.style.left = left + "%";
			rangeFill.style.width = (right - left) + "%";
		}

		function syncInputs() {
			minInput.value = minRange.value;
			maxInput.value = maxRange.value;
			updateRangeFill();
		}

		minRange.addEventListener("input", () => {
			if (parseInt(minRange.value) > parseInt(maxRange.value)) {
				minRange.value = maxRange.value;
			}
			syncInputs();
		});

		maxRange.addEventListener("input", () => {
			if (parseInt(maxRange.value) < parseInt(minRange.value)) {
				maxRange.value = minRange.value;
			}
			syncInputs();
		});

		minInput.addEventListener("input", () => {
			minRange.value = minInput.value;
			minRange.dispatchEvent(new Event("input"));
		});

		maxInput.addEventListener("input", () => {
			maxRange.value = maxInput.value;
			maxRange.dispatchEvent(new Event("input"));
		});

		syncInputs();
	}
};

export default PriceRange;

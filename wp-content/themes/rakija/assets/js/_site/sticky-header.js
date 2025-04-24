'use strict';
const StickyHeader = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		// Get the header element
		const header = document.querySelector('.site-header');
		let lastScrollTop = 0;

		if (header) {
			// Add a scroll event listener to the window
			window.addEventListener('scroll', () => {
				const scrollPos = window.scrollY;
				const windowWidth = window.innerWidth;

				if (windowWidth >= 1200) {
					// Animate header stickiness on larger screens
					if (scrollPos > 0) {
						header.classList.add('is-sticky', 'sticky-animate');
					} else {
						header.classList.remove('is-sticky', 'sticky-animate');
					}
				} else {
					// Hide header on scroll down, show on scroll up for smaller screens
					if (scrollPos > lastScrollTop) {
						header.classList.add('hidden');
					} else {
						header.classList.remove('hidden');
					}
					lastScrollTop = scrollPos;
				}
			});
		}
	}
};

export default StickyHeader;

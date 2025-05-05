'use strict';
const Navigation = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		const menuBtn = document.querySelector('.js-menu-btn');
		const navigation = document.querySelector('.js-navigation');
		const cart = document.querySelector('.site-header__cart');
		const body = document.body;

		if (navigation) {
			menuBtn.addEventListener('click', function() {
				this.classList.toggle('is-active');
				navigation.classList.toggle('is-active');
				body.classList.toggle('scroll-disable');
				cart.classList.toggle('is-active');
			});
		}
	}
};

export default Navigation;

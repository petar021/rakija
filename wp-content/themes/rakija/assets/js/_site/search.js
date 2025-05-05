'use strict';
const Search = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
		const search = document.querySelector('.site-header__cart-left');

		if (search) {
			search.addEventListener('click', function() {
				this.classList.toggle('active');
				// search.classList.toggle('is-active');
			});
		}

		const toggleButton = document.getElementById('search-toggle');
		const searchForm = document.getElementById('search-form');
		const searchInput = document.getElementById('search-input');
	
		toggleButton.addEventListener('click', function(e) {
			e.preventDefault();
		
			const isVisible = searchForm.style.display === 'block';
			const inputValue = searchInput.value.trim();
		
			if (!isVisible) {
				searchForm.style.display = 'block';
				searchInput.focus();
			} else {
				if (inputValue !== '') {
					searchForm.submit(); // Pokreni pretragu
				} else {
					searchForm.style.display = 'none'; // Zatvori ako je prazno
				}
			}
		});		
	
		searchInput.addEventListener('keydown', function(e) {
			if (e.key === 'Enter') {
				e.target.form.submit(); // Pokreće pretragu
			}
		});

		document.addEventListener('click', function(event) {
			const searchForm = document.getElementById('search-form');
			const toggleButton = document.getElementById('search-toggle');
		
			if (!searchForm || !toggleButton) return;
		
			const isClickInside = searchForm.contains(event.target) || toggleButton.contains(event.target);
		
			if (!isClickInside) {
				searchForm.style.display = 'none';
				search.classList.remove('active');
			}
		});		
	}
};

export default Search;

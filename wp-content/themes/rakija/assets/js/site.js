
import LazyLoader from './_site/lazy-load';
import Navigation from './_site/navigation';
import StickyHeader from './_site/sticky-header';
import Sliders from './_site/sliders';
// import Search from './_site/search';
import Qty from './_site/qty-counter';
import MiniCart from './_site/mini-cart';
import WooFiltration from './_site/woo-filtration';
import PriceRange from './_site/price-range';
import Filters from './_site/filters';
import Pagination from './_site/woo-pagination';
import Geolocation from './_site/geolocation';
// import Wishlist from './_site/wishlist';

document.addEventListener('DOMContentLoaded', () => {
	LazyLoader.init();
	Navigation.init();
	StickyHeader.init();
	Sliders.init();
	// Search.init();
	Qty.init();
	MiniCart.init();
	WooFiltration.init();
	PriceRange.init();
	Filters.init();
	Pagination.init();
	Geolocation.init();
	// Wishlist.init();
});

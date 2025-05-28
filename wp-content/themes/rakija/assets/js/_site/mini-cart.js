'use strict';
const MiniCart = {
    init: function() {
        document.body.addEventListener('click', function(e) {
            // Proverite da li je element koji je izazvao event (e.target) ili neki od njegovih roditelja ima klasu 'js-mini-cart-hide'
            var closeButton = e.target.closest('.js-mini-cart-close');
            if (closeButton) {
                var miniCart = document.getElementById('mini-cart');
                miniCart.style.display = 'none';
            }
            var miniCart = document.getElementById('mini-cart');
            // Ako klik nije unutar js-mini-cart-wrap, zatvorite mini-cart
            if (!e.target.closest('.js-mini-cart-wrap')) {
                miniCart.style.display = 'none';
            }
        });

        document.addEventListener('keydown', function(event) {
            // Proveri da li je pritisnut ESC (kod 27 ili event.key === 'Escape')
            if (event.key === 'Escape' || event.keyCode === 27) {
                const miniCart = document.getElementById('mini-cart');
                if (miniCart) {
                    miniCart.style.display = 'none';
                }
            }
        });
    }
};
export default MiniCart;
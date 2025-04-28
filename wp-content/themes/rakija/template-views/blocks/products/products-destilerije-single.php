<section class="products">
    <div class="container">
        <form class="woocommerce-ordering" method="get">
            <label for="orderby">6 proizvoda</label>
            <select name="orderby" id="orderby" class="orderby" onchange="this.form.submit()">
                <option value="popularity" selected>Najpopularnije</option>
                <option value="date">Najnovije</option>
                <option value="price">Cena: rastuće</option>
                <option value="price-desc">Cena: opadajuće</option>
            </select>

            <!-- Zadrži postojeće GET parametre (osim 'orderby') -->
            <input type="hidden" name="paged" value="1" />
        </form>
        <div class="products-wrapper">
            <div class="product-box">
                <div class="product-box__top">
                    <a href="javascript:;">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-01.jpg" alt="">
                    </a>
                </div>
                <div class="product-box__bottom">
                    <div class="price-box">
                        <span class="price">3.350</span>
                        <span class="value">rsd</span>
                    </div>
                    <span class="product-cat">Zlatni Tok</span>
                    <a href="javascript:;" class="product-title-link">
                        <h3 class="product-title">Alba šljiva prepečenica</h3>
                    </a>
                    <span class="product-tax">700ml</span>
                    <a href="javascript:;" class="add-to-cart-btn"><span class="font-cart"></span></a>
                </div>
            </div>
            <div class="product-box">
                <div class="product-box__top">
                    <a href="javascript:;">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-01.jpg" alt="">
                    </a>
                </div>
                <div class="product-box__bottom">
                    <div class="price-box">
                        <span class="price">3.350</span>
                        <span class="value">rsd</span>
                    </div>
                    <span class="product-cat">Zlatni Tok</span>
                    <a href="javascript:;" class="product-title-link">
                        <h3 class="product-title">Alba šljiva prepečenica</h3>
                    </a>
                    <span class="product-tax">700ml</span>
                    <a href="javascript:;" class="add-to-cart-btn"><span class="font-cart"></span></a>
                </div>
            </div>
            <div class="product-box">
                <div class="product-box__top">
                    <a href="javascript:;">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-01.jpg" alt="">
                    </a>
                </div>
                <div class="product-box__bottom">
                    <div class="price-box">
                        <span class="price">3.350</span>
                        <span class="value">rsd</span>
                    </div>
                    <span class="product-cat">Zlatni Tok</span>
                    <a href="javascript:;" class="product-title-link">
                        <h3 class="product-title">Alba šljiva prepečenica</h3>
                    </a>
                    <span class="product-tax">700ml</span>
                    <a href="javascript:;" class="add-to-cart-btn"><span class="font-cart"></span></a>
                </div>
            </div>
            <div class="product-box">
                <div class="product-box__top">
                    <a href="javascript:;">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-01.jpg" alt="">
                    </a>
                </div>
                <div class="product-box__bottom">
                    <div class="price-box">
                        <span class="price">3.350</span>
                        <span class="value">rsd</span>
                    </div>
                    <span class="product-cat">Zlatni Tok</span>
                    <a href="javascript:;" class="product-title-link">
                        <h3 class="product-title">Alba šljiva prepečenica</h3>
                    </a>
                    <span class="product-tax">700ml</span>
                    <a href="javascript:;" class="add-to-cart-btn"><span class="font-cart"></span></a>
                </div>
            </div>
            <div class="product-box">
                <div class="product-box__top">
                    <a href="javascript:;">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-01.jpg" alt="">
                    </a>
                </div>
                <div class="product-box__bottom">
                    <div class="price-box">
                        <span class="price">3.350</span>
                        <span class="value">rsd</span>
                    </div>
                    <span class="product-cat">Zlatni Tok</span>
                    <a href="javascript:;" class="product-title-link">
                        <h3 class="product-title">Alba šljiva prepečenica</h3>
                    </a>
                    <span class="product-tax">700ml</span>
                    <a href="javascript:;" class="add-to-cart-btn"><span class="font-cart"></span></a>
                </div>
            </div>
            <div class="product-box">
                <div class="product-box__top">
                    <a href="javascript:;">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/project/image-01.jpg" alt="">
                    </a>
                </div>
                <div class="product-box__bottom">
                    <div class="price-box">
                        <span class="price">3.350</span>
                        <span class="value">rsd</span>
                    </div>
                    <span class="product-cat">Zlatni Tok</span>
                    <a href="javascript:;" class="product-title-link">
                        <h3 class="product-title">Alba šljiva prepečenica</h3>
                    </a>
                    <span class="product-tax">700ml</span>
                    <a href="javascript:;" class="add-to-cart-btn"><span class="font-cart"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="reviews">
    <div class="container">
        <h2 class="section-title">Recenzije</h2>
        <?php
            // Tvoj API ključ
            $api_key = 'AIzaSyDmsCxyfQd20r5Yc7KPP5RtvgSxoNsPATY';

            // Tvoj Place ID
            $place_id = 'ChIJ3c673W0RW0cR7kN1uB78st0';

            // Pravimo URL za API poziv
            $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id={$place_id}&fields=name,rating,reviews&key={$api_key}";

            // Pozivamo API
            $response = wp_remote_get($url);

            if (is_wp_error($response)) {
                echo 'Greška pri komunikaciji sa Google API.';
                return;
            }

            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            if (!empty($data['result']['reviews'])) {
                $reviews = $data['result']['reviews'];
            
                // Samo recenzije sa ocenom 5
                $five_star_reviews = array_filter($reviews, function($review) {
                    return $review['rating'] == 5;
                });
            
                // Uzimamo samo 5 recenzija
                $five_star_reviews = array_slice($five_star_reviews, 0, 5);
                ?>
            
                <!-- Swiper Wrapper -->
                <div class="swiper reviews-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($five_star_reviews as $review): ?>
                            <div class="swiper-slide">
                                <div class="single-review">
                                    <span class="font-star"></span>
                                    <span class="font-star"></span>
                                    <span class="font-star"></span>
                                    <span class="font-star"></span>
                                    <span class="font-star"></span>
                                    <p><?php echo esc_html($review['text']); ?></p>
                                    <h3><?php echo esc_html($review['author_name']); ?></h3>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Nema pagination, nema arrows -->
                     <div class="swiper-pagination"></div>
                </div>
            
            <?php
            
            } else {
                echo 'Nema dostupnih recenzija.';
            }
        ?>
    </div>
</section>
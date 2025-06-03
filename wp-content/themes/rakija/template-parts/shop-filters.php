<div class="filter-section">
    <h2 class="filter-section__title">Destilerije</h2>

    <label class="custom-checkbox">
        <input type="checkbox" name="filter_destilerije_all" value="all" checked>
        <span class="checkmark"></span>
        Svi dostupni
    </label>

    <?php
    $taxonomy = 'product_cat';
    $rakije_term = get_term_by('slug', 'rakije', $taxonomy);

    if ($rakije_term) {
        // Dobavi direktne podkategorije od "rakije" - to su destilerije
        $destilerije = get_terms([
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
            'parent' => $rakije_term->term_id,
        ]);

        foreach ($destilerije as $destilerija) {
            // Dobavi podkategorije (poddestilerije) za svaku destileriju
            $podkategorije = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
                'parent' => $destilerija->term_id,
            ]);

            if (!empty($podkategorije)) {
                foreach ($podkategorije as $podkat) {
                    ?>
                    <label class="custom-checkbox">
                        <input type="checkbox" name="filter_destilerije[]" value="<?php echo esc_attr($podkat->term_id); ?>">
                        <span class="checkmark"></span>
                        <?php echo esc_html($podkat->name); ?>
                    </label>
                    <?php
                }
            } else {
                // Ako nema podkategorija, možda ispiši i samu destileriju kao checkbox
                ?>
                <label class="custom-checkbox">
                    <input type="checkbox" name="filter_destilerije[]" value="<?php echo esc_attr($destilerija->term_id); ?>">
                    <span class="checkmark"></span>
                    <?php echo esc_html($destilerija->name); ?>
                </label>
                <?php
            }
        }
    }
    ?>
</div>

<div class="filter-section">
    <h2 class="filter-section__title">Voće</h2>

    <label class="custom-checkbox">
        <input type="checkbox" name="filter_voce_all" value="all" checked>
        <span class="checkmark"></span>
        Svi dostupni
    </label>

    <?php
    $voce_term = get_term_by('slug', 'voce', $taxonomy);

    if ($voce_term) {
        $voce_podkategorije = get_terms([
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
            'parent' => $voce_term->term_id,
        ]);

        foreach ($voce_podkategorije as $podkat) {
            ?>
            <label class="custom-checkbox">
                <input type="checkbox" name="filter_voce[]" value="<?php echo esc_attr($podkat->term_id); ?>">
                <span class="checkmark"></span>
                <?php echo esc_html($podkat->name); ?>
            </label>
            <?php
        }
    }
    ?>
</div>

<div class="filter-section price-range-filter">
    <h2 class="filter-section__title">Cena</h2>

    <div class="price-slider-wrapper">
        <div class="price-slider-track"></div>
        <div class="price-slider-range" style="left: 0%; width: 100%;"></div>
        <input type="range" min="0" max="10000" value="0" id="min-price" class="price-slider">
        <input type="range" min="0" max="10000" value="10000" id="max-price" class="price-slider">
    </div>

    <div class="price-inputs">
        <label>
            <input type="number" id="min-price-input" value="1000" min="0" max="10000">
            <span class="checkmark"></span>
        </label>
        <label>
            <input type="number" id="max-price-input" value="7000" min="0" max="10000">
        </label>
    </div>
</div>


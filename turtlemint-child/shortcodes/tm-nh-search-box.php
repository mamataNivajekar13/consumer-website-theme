<?php
function tmNhSearchBox($atts){
    
	$atts = shortcode_atts( array(
        'city' => '',
        'insurercode' => ''
    ), $atts, 'tm_nh_search_box' );
    
  ob_start();?>

    <?php 
        $term = get_queried_object();

        if(!$term){
            $health_term_slug = get_query_var( 'health-ic' );
            if($health_term_slug){
              $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
            }
          }

        $taxonomy_slug = $term->taxonomy;
        $tax_slug = $term->slug;
        $insurer_code = ucwords(get_field('insurer_code', $term));

        if(get_field('insurer_name', $term)){
            $insurer_display_name = ucwords(get_field('insurer_name', $term));
        }else{
            $insurer_display_name = ucwords($term->name);
        }

        global $wpdb;
        $hospitals = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}cashless_hospitals_insurers WHERE insurer = '{$insurer_code}' AND count > 0;" );
        $hospital_count = $wpdb->get_var( "SELECT SUM(count) FROM {$wpdb->prefix}cashless_hospitals_insurers WHERE insurer='{$insurer_code}'" );

        /* Theme Settings - start */
        $theme_settings_verticals = get_field('verticals', 'option');
        foreach ($theme_settings_verticals as $theme_settings_vertical) {
            $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

            if($vertical_taxonomy_slug == $taxonomy_slug){
            $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
            $popular_cities_section = $theme_settings_vertical['popular_cities_section'];
            }
        }

        $map_key = (current($theme_settings_verticals)['maps_key']);
        /* Theme Settings - end */

        $vertical_name_category = tm_event_category();

    if($hospitals) { ?>
        <section class="highlight-section tm-container blurred-bg bordered tm-container" id="nh-search-box">
            <div class="wp-block-group has-global-padding is-layout-constrained">
                <div class="wp-block-column" style="flex-basis: 75%;">
                    <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo $insurer_display_name;?><?php echo ucwords(" Cashless Network Hospitals "); ?></h2>
                    <div class="tm-container__content">
                        <p><?php echo $insurer_display_name;?> has a network of <?php echo $hospital_count;?> cashless hospitals across India. To find the nearest <?php echo $insurer_display_name;?> health insurance network hospital, enter your location.</p>
                    </div>
                    <form class="form-style-1 nh-banner-searchform d-block">
                        <div class="field-group field-group-search">
                            <p>
                                <label for="city-name">Location Name</label>
                                <span class="" style="position: relative" data-name="city-name">
                                    <input id="locationInput" size="40" class="" aria-required="true" aria-invalid="false" value="" type="text" name="city-name" placeholder="Search Location" data-vertical="<?php echo $vertical_name_category; ?>" data-icname="<?php echo $insurer_display_name;?>" onkeydown="return (event.keyCode!=13);">
                                    <i class="tm-sprite-1 bg-search"></i>
                                </span>
                            </p>
                        </div>
                    </form>
                    <div class="" style="margin-top: 35px;">
                        <div class="wp-block-columns popular-cities-list mb-0">
                            <?php
                                foreach ($popular_cities_section as $popular_city):
                                    $popular_city_title = $popular_city['city_name'];
                                    $popular_city_logo = $popular_city['city_logo'];
                                    $city_name = strtolower($popular_city_title);
                                    global $wpdb;
                                    $city_hospotal_count = $wpdb->get_var( "SELECT count FROM `wp_mdcsm8_cashless_hospitals_insurers` as i INNER JOIN `wp_mdcsm8_cashless_hospitals_state_city` as c ON i.cityid = c.id WHERE c.city = '{$city_name}' AND i.insurer = '{$insurer_code}'" );
                                ?>
                                <?php 
                                if($city_hospotal_count > 0 ) { 
                                    if ($popular_city_title && $popular_city_logo):?>
                                    <a href="<?php echo get_site_url().'/health-insurance/'.$tax_slug.'/network-hospitals/'.strtolower(str_replace(' ', '-', $popular_city_title)).'/'?>" class="popular-city">
                                        <div class="popular-city-icon has-turtlemint-child-tm-light-purple-background-color">
                                            <img loading="lazy" title="<?php echo ucwords($insurer_display_name . " Network Hospitals In ".$popular_city_title); ?>" alt="<?php echo ucwords($insurer_display_name . " Network Hospitals In ".$popular_city_title); ?>" src=<?php echo $popular_city_logo;?> />
                                        </div>
                                        <p class="popular-city-title has-turtlemint-child-tm-medium-font-size"><?php echo $popular_city_title; ?></p>
                                    </a>
                                    <?php endif;
                                }
                                ?>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="cta-links mt-4">
                        <p class="tm-link mb-0 d-inline-flex">
                            <a href="<?php echo get_term_link( $term->term_id )?>network-hospitals" class="icon-link" title="Check all <?php echo $insurer_display_name;?> network hospitals">
                                <span>Check All <?php echo $insurer_display_name;?> Network Hospitals</span><i class="tm-sprite-1 bg-chevron-right-green"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_key;?>&libraries=places"></script>
            <script>
                const input = document.getElementById('locationInput');
                const autocomplete = new google.maps.places.Autocomplete(input, {
                    componentRestrictions: { country: 'IN' }
                });
                autocomplete.addListener('place_changed', function () {
                    const place = autocomplete.getPlace();
                    var latitude = place.geometry.location.lat();
                    var longitude = place.geometry.location.lng();
                    var city_slug = place.name.toLowerCase().replace(/ /g, "-").replace(/[^\w-]+/g, "");
                    var url = window.location.href + '/network-hospitals/' + city_slug + '/?lat=' + latitude + '&lng=' + longitude;
                    window.location.href = url;
                });
            </script>
        </section>
    <?php } ?>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_nh_search_box', 'tmNhSearchBox');
?>
<?php
function tmCgPopularCity($atts){

	$atts = shortcode_atts( array(
    'type' => '',
    'page' => '',
    'uitype' => '',
  ), $atts, 'tm_cg_popular_city' );

  ob_start();?>

  <?php

    global $template;
    $templateName = basename($template);

    if($atts['type'] == "car") {
      $tax_slug = (get_query_var( 'car-ic' ));
      $term = get_term_by('slug', $tax_slug, 'car-insurer');
      $taxonomy_slug = $term->taxonomy;
    } else {
      $term = get_queried_object();
      $taxonomy_slug = $term->taxonomy;
      $tax_slug = $term->slug;
    }

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }

    $insurer_code = ucwords(get_field('insurer_code', $term));

    $taxonomy_slug = $term->taxonomy;

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
          $popular_cities_section = $theme_settings_vertical['popular_cities_section'];
        }
    }
    /* Theme Settings - end */

    $cityflag = false;
    foreach ($popular_cities_section as $popular_city) {
      $popular_city_title = $popular_city['city_name'];
      $popular_city_logo = $popular_city['city_logo'];
      $city_name = strtolower($popular_city_title);
      global $wpdb;
      $city_garages_count = $wpdb->get_var( "SELECT count FROM `wp_mdcsm8_cashless_garages_insurers` as i INNER JOIN `wp_mdcsm8_cashless_garages_state_city` as c ON i.cityid = c.id WHERE c.city = '{$city_name}' AND i.insurer = '{$insurer_code}'" );
      if($city_garages_count > 0 ) { 
        $cityflag = true;
      }
    }

    $current_page_city = (get_query_var( 'car-cg-city' ));
    
  ?>
    <?php if($cityflag) { ?>
      <?php if($popular_cities_section):?>
        <?php if($atts['uitype'] != "list") {?>
          <section id="popular-cities" class="highlight-section tm-container blurred-bg bordered">
              <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size">
                  <?php echo ucwords($insurer_display_name . " Car Insurance Cashless Garages"); ?>
              </h2>
              <div class="wp-block-columns popular-cities-list mb-0">
                  <?php
                      foreach ($popular_cities_section as $popular_city):
                          $popular_city_title = $popular_city['city_name'];
                          $popular_city_logo = $popular_city['city_logo'];
                          $city_name = strtolower($popular_city_title);
                          if($city_name == $current_page_city) {
                            continue;
                          }
                          global $wpdb;
                          $city_garages_count = $wpdb->get_var( "SELECT count FROM `wp_mdcsm8_cashless_garages_insurers` as i INNER JOIN `wp_mdcsm8_cashless_garages_state_city` as c ON i.cityid = c.id WHERE c.city = '{$city_name}' AND i.insurer = '{$insurer_code}'" );
                      ?>
                      <?php 
                        if($city_garages_count > 0 ) { 
                          if ($popular_city_title && $popular_city_logo):?>
                            <a onclick="tmClickEvent('Popular city clicked', '<?php echo $atts['page'];?>', '<?php echo $insurer_display_name; ?>', '<?php echo $popular_city_title;?>')" href="<?php echo get_site_url().'/car-insurance/'.$tax_slug.'/cashless-garages/'.strtolower(str_replace(' ', '-', $popular_city_title)).'/'?>" class="popular-city">
                                <div class="popular-city-icon has-turtlemint-child-tm-light-purple-background-color">
                                  <img loading="lazy" title="<?php echo ucwords($insurer_display_name . " Cashless Garages In ".$popular_city_title); ?>" alt="<?php echo ucwords($insurer_display_name . " Cashless Garages In ".$popular_city_title); ?>" src=<?php echo $popular_city_logo;?> />
                                </div>
                                <p class="popular-city-title has-turtlemint-child-tm-medium-font-size"><?php echo $popular_city_title; ?></p>
                            </a>
                          <?php endif;
                        }
                      ?>
                  <?php endforeach;?>
              </div>
              <?php if($templateName !='tm-cg-network.php' ) { ?>
                <div class="cta-links mt-4">
                    <p class="tm-link mb-0 d-inline-flex">
                        <a href="<?php echo get_term_link( $term->term_id )?>cashless-garages" class="icon-link" title="Check <?php echo $insurer_display_name;?> Cashless Garages List">
                            <span>Check <?php echo $insurer_display_name;?> Cashless Garages List</span><i class="tm-sprite-1 bg-chevron-right-green"></i>
                        </a>
                    </p>
                </div>
              <?php } ?>
              <div class="view-more-popular-cities cta-links mt-3" style="display: none;">
                  <p class="tm-link  mb-0 d-inline-flex">
                      <a class="icon-link">
                          <span>View More</span>
                          <i class="tm-sprite-1 bg-chevron-down-green"></i>
                      </a>
                  </p>
              </div>
              <div class="view-less-popular-cities cta-links mt-3" style="display: none;">
                  <p class="tm-link  mb-0 d-inline-flex">
                      <a class="icon-link">
                          <span>View Less</span>
                          <i class="tm-sprite-1 bg-chevron-up-green"></i>
                      </a>
                  </p>
              </div>
          </section>
        <?php } else { ?>
          <div class="city-list" id="city-list-wrapper">
            <p class="city-list-title has-turtlemint-child-tm-large-1-font-size mb-0">Popular Cities</p>
            <?php
                foreach ($popular_cities_section as $popular_city):
                    $popular_city_title = $popular_city['city_name'];
                    $popular_city_logo = $popular_city['city_logo'];
                    $city_name = strtolower($popular_city_title);
                    global $wpdb;
                    $city_garages_count = $wpdb->get_var( "SELECT count FROM `wp_mdcsm8_cashless_garages_insurers` as i INNER JOIN `wp_mdcsm8_cashless_garages_state_city` as c ON i.cityid = c.id WHERE c.city = '{$city_name}' AND i.insurer = '{$insurer_code}'" );
                ?>
                <?php 
                  if($city_garages_count > 0 ) { 
                    if ($popular_city_title && $popular_city_logo):?>
                      <a onclick="tmClickEvent('Popular city clicked', '<?php echo $atts['page'];?>', '<?php echo $insurer_display_name; ?>', '<?php echo $popular_city_title;?>')" href="<?php echo get_site_url().'/car-insurance/'.$tax_slug.'/cashless-garages/'.strtolower(str_replace(' ', '-', $popular_city_title)).'/'?>" class="popular-city">
                          <p class="popular-city-title has-turtlemint-child-tm-medium-font-size"><?php echo $popular_city_title; ?></p>
                      </a>
                    <?php endif;
                  }
                ?>
            <?php endforeach;?>
          </div>
        <?php } ?>
      <?php endif; ?>
    <?php } ?>
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_cg_popular_city', 'tmCgPopularCity');
?>
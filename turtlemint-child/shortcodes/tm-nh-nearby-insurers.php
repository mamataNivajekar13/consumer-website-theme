<?php
function tmNhNearbyInsurers($atts){

	$atts = shortcode_atts( array(
    'city' => '',
    'insurercode' => '',
    'limit' => 5
  ), $atts, 'tm_nh_nearby_insurers' );

  ob_start();?>

  <?php

    $tax_slug = (get_query_var( 'health-ic' ));
    $term = get_term_by('slug', $tax_slug, 'health-insurer');
    $taxonomy_slug = $term->taxonomy;
    $term_id = $term->term_id;

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    $vertical_name = null;
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
        }
    }
    /* Theme Settings - end */
    $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));

    $terms = get_terms( array(
      'taxonomy' => $convertedVerticalName.'-insurer', /* Vertical Slug Change */
      'hide_empty' => false,
      'exclude' => [$term_id]
   ) );
    $elementLimit = $atts['limit'];

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }

    $cityname = $atts['city'];
    $insurer_code = $atts['insurercode'];

    global $wpdb;
    $nearby_insurers = $wpdb->get_col( "SELECT insurer FROM {$wpdb->prefix}cashless_hospitals_insurers as i RIGHT JOIN {$wpdb->prefix}cashless_hospitals_state_city as c on i.cityid = c.id WHERE insurer != '{$insurer_code}' AND i.count > 0 AND c.city = '{$cityname}' ORDER BY i.count;" );

  ?>

  <?php if($nearby_insurers):?>
    <section class="wp-block-group alignfull is-layout-flow tm-insurance-companies tm-insurance-companies--vertical">
      <div class="wp-block-group has-global-padding is-layout-constrained">
        <div class="alignwide">
          <div class="tm-container has-turtlemint-child-tm-light-purple-background-color">
            <div class="wp-block-columns is-not-stacked-on-mobile mb-0">
              <div class="wp-block-column" style="flex-basis: 75%;">
                <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Other Network Hospitals In "); ?><?php echo ucwords($atts['city'])?></h2>
                <div class="tm-container__content">
                  <p>One of the key aspects considered while buying a health insurance plan is the list of network hospitals offered by the insurer within their vicinity, as it ensures ease of treatment. Find the list of hospitals of different insurers in <?php echo ucwords($atts['city'])?> below</p>
                </div>
              </div>
              <div class="wp-block-column has-text-align-right" style="flex-basis: 25%;">
                <i class="tm-sprite-2 bg-network-hospitals"></i>
              </div>
            </div>
            <div class="viewMoreContainer has-turtlemint-child-white-background-color" style="margin-bottom:16px">
              <?php foreach($nearby_insurers as $nearby_insurer): ?>
                  <?php 
                    global $wpdb;
                    $term_id = $wpdb->get_var( "SELECT term_id FROM {$wpdb->prefix}termmeta WHERE meta_key='insurer_code' and meta_value='{$nearby_insurer}'" );
                    if ($term_id) {
                      $term = get_term( $term_id );
                      if(get_field('insurer_name', $term)){
                        $ic_display_name = ucwords(get_field('insurer_name', $term));
                      }else{
                        $ic_display_name = ucwords($term->name);
                      }
                  ?>
                <div class="tm-insurance-company">
                    <a class="tm-insurance-company__title" href="<?php echo get_site_url().'/health-insurance/'.$term->slug.'/network-hospitals/'.str_replace(' ', '-', strtolower($atts['city'])).'/'?>" title="<?php echo $ic_display_name. " Health Insurance Hospital List In " . ucwords($atts['city'])?>" onclick="tmClickEvent('Other network hospital', 'NH-City', '<?php echo $insurer_display_name; ?>', '<?php echo ucwords($ic_display_name)?>', '<?php echo ucwords($atts['city']);?>')">
                      <?php echo $ic_display_name. " Hospital List In " . ucwords($atts['city'])?>
                      <i style="margin-right:auto" class="tm-sprite-3 bg-chevron-right"></i>
                    </a>
                </div>
              <?php } 
              endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif;?>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_nh_nearby_insurers', 'tmNhNearbyInsurers');
?>
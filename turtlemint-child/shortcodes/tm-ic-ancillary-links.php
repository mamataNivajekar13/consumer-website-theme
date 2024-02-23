<?php
function tmIcAncillaryLinks($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_ic_ancillary_links' );

  ob_start();?>

  <?php

    $ancillary_links = ancillary_links();
  
    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
      }
    }

    $taxonomy_slug = $term->taxonomy;

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

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }
  ?>

  <?php if(count($ancillary_links) > 0): ?>
    <section class="wp-block-group alignfull is-layout-flow tm-ic-ancillary-links">
      <div class="tm-container has-turtlemint-child-tm-pink-background-color">
        <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Know more about ".$insurer_display_name." ".$vertical_name." Insurance"); ?></h2>
        <div class="tm-container mb-0 has-turtlemint-child-white-background-color p-0">
          <ul class="tm-cta-list">
            <?php
              foreach ($ancillary_links as $link) {
                echo '<li class="tm-cta-item"><a href="' . $link['link'] . '" title="' . $link['title'] . '">' . $link['title'] . '<i class="tm-sprite-3 bg-chevron-right"></i></a></li>';
              }
            ?>
          </ul>
        </div>
      </div>
    </section>
  <?php endif; ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_ancillary_links', 'tmIcAncillaryLinks');
?>
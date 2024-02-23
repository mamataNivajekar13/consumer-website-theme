<?php
function tmIcDocuments($atts){

	$atts = shortcode_atts( array(
    'vertical' => ''
  ), $atts, 'tm_ic_documents' );

  ob_start();?>

  <?php

    $vertical = $atts['vertical'];

    $term = get_queried_object();

    if(!$term){
      $car_term_slug = get_query_var( 'car-ic' );
      if($car_term_slug) {
        $term = get_term_by( 'slug', $car_term_slug, 'car-insurer' );
      }
    }

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }

    $taxonomy_slug = $term->taxonomy;
    
    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
        }
    }
    /* Theme Settings - end */

    $insurer_documents_required = get_field('insurer_documents_required', $term);
  ?>

  <?php if($insurer_documents_required):?>
  <section class="wp-block-group alignfull is-layout-flow tm-ic-buying-process">
    <div class="wp-block-group has-global-padding is-layout-constrained">
        <div class="alignwide">
          <div class="tm-container has-turtlemint-child-tm-light-yellow-background-color">
            <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Documents required for Claims"); ?></h2>
            <div class="tm-container__content mb-0">

                <div class="tm-container__content has-toggle-expand-cta tm-gradient-light-yellow has-turtlemint-child-tm-gray-color" style="max-height:153px;" data-max-height="153" data-max-height-mob="140">
                  <?php echo $insurer_documents_required; ?>
                </div>
                <div class="cta-links">
                  <p class="tm-link toggleExpand mb-0 d-inline-flex" data-eventaction="Documents view more" data-eventcategory="<?php echo $vertical_name; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" onclick="toggleContent(this);tmClickEvent('Documents view more', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')"><a class="icon-link" title="<?php echo ucwords("Check the list of documents required to raise a ".$insurer_display_name." ".$vertical_name." insurance claim"); ?>"><span>Read More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a></p>
                </div>

            </div>
          </div>
        </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_documents', 'tmIcDocuments');
?>
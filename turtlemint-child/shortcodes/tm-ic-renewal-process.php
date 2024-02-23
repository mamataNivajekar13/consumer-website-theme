<?php
function tmIcRenewalProcess($atts){

	$atts = shortcode_atts( array(
    'vertical' => ''
  ), $atts, 'tm_ic_renewal_process' );

  ob_start();?>

  <?php

    $vertical = $atts['vertical'];
    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
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
    
    $insurer_renewal_process = get_field('insurer_renewal_process', $term);
  ?>

  <?php if ($insurer_renewal_process):?>
    <section id="renewal" class="highlight-section wp-block-group alignfull is-layout-flow tm-ic-renewal-process">
      <div class="wp-block-group has-global-padding is-layout-constrained">
          <div class="alignwide">
            <div class="tm-container bordered">
              <?php if($vertical_name == "Bike"): ?>
                <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords($insurer_display_name." Two Wheeler Bike Insurance Renewal Process"); ?></h2>
              <?php else:?>
                <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Renewal Process"); ?></h2>
              <?php endif;?>
              <div class="tm-container__content has-toggle-expand-cta has-turtlemint-child-tm-gray-color" style="max-height:220px;" data-max-height="220" data-max-height-mob="220">
                <?php echo $insurer_renewal_process;?>
              </div>
              <?php if($vertical_name == "Bike"): $vertical_name = "two wheeler"; endif; ?>
              <?php
                if($vertical == 'bike'){
                  $readMoreTitle = ucwords("Read more about renewal process of ".$insurer_display_name." ".$vertical_name." insurance");
                }else{
                  $readMoreTitle = ucwords("read more renewal ".$insurer_display_name." ".$vertical_name." insurance");
                }
              ?>
              <div class="cta-links">
                <p class="tm-link toggleExpand mb-0 d-inline-flex" onclick="toggleContent(this)"><a class="icon-link" title="<?php echo $readMoreTitle; ?>"><span>Read More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a></p>
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

add_shortcode('tm_ic_renewal_process', 'tmIcRenewalProcess');
?>
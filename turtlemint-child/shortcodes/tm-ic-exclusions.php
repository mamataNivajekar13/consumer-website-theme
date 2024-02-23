<?php
function tmIcExclusions($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_ic_exclusions' );

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

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
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
    
    $insurer_exclusions = get_field("insurer_exclusions", $term);
  ?>

  <?php if($insurer_exclusions):?>
    <section id="exclusions" class="highlight-section tm-container bordered wp-block-group alignfull is-layout-flow tm-sprite-2-before tm-ic-exclusions">
      <div class="wp-block-group has-global-padding is-layout-constrained">
        <div class="alignwide">
          <?php if($vertical_name == 'Bike'){?>
            <h2 class="section-heading medium-width has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Exclusions under ".$insurer_display_name." two wheeler insurance Plans"); ?></h2>
          <?php } elseif($vertical_name == 'Car'){?>
            <h2 class="section-heading medium-width has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Exclusions under ".$insurer_display_name." car insurance Plans"); ?></h2>
          <?php } else{ ?>
            <h2 class="section-heading medium-width has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Exclusions across ".$insurer_display_name." ".$vertical_name." Plans"); ?></h2>
          <?php } ?>
          <div class="tm-container__content has-toggle-expand-cta" style="max-height:220px;" data-max-height="220" data-max-height-mob="220">
            <?php echo $insurer_exclusions; ?>
          </div>
          <?php
            if($vertical_name == "Bike"){
              $vertical_name = "two wheeler";
              $vertical_name_category = "Bike";
            }else{
              $vertical_name_category = tm_event_category();
            }
          ?>
          <div class="cta-links">
            <p class="tm-link toggleExpand mb-0 d-inline-flex" data-eventaction="Exclusions view more" data-eventcategory="<?php echo $vertical_name;?>" data-eventlabel="<?php echo $insurer_display_name;?>" onclick="toggleContent(this);tmClickEvent('Exclusions view more', '<?php echo $vertical_name_category;?>', '<?php echo $insurer_display_name;?>')"><a class="icon-link" title="<?php echo ucwords("Read more ".$insurer_display_name." ".$vertical_name." Insurance exclusions"); ?>"><span>Read More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a></p>
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

add_shortcode('tm_ic_exclusions', 'tmIcExclusions');
?>
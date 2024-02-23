<?php
function tmIcAbout($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_ic_about' );

  ob_start();?>

  <?php
    $term = get_queried_object();

    $taxonomy_slug = $term->taxonomy;
    $insurer_content = get_field('insurer_description', $term);

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

  ?>

  <?php if($insurer_content):?>
    <section class="wp-block-group alignfull is-layout-flow tm-ic-about">
        <div class="wp-block-group has-global-padding is-layout-constrained">
            <div class="alignwide">
              <div class="tm-container blurred-bg bordered">
                <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("About ". $insurer_display_name . " " . $vertical_name . " Insurance"); ?></h2>
                <div class="tm-container__content has-toggle-expand-cta has-turtlemint-child-tm-gray-color" style="max-height:75px;" data-max-height="75" data-max-height-mob="145">
                  <?php echo $insurer_content; ?>
                </div>
                <div class="cta-links">
                  <p class="tm-link toggleExpand mb-0 d-inline-flex" onclick="toggleContent(this)"><a class="icon-link" title="<?php echo ucwords("read more about ".$insurer_display_name." ".$vertical_name." insurance"); ?>"><span>Read More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a></p>
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

add_shortcode('tm_ic_about', 'tmIcAbout');
?>
<?php
function tmIcDownloadApp($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_ic_download_app' );

  ob_start();?>

  <?php
    $term = get_queried_object();

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
  ?>

  <section class="wp-block-group alignfull is-layout-flow tm-ic-download-app">
    <div class="wp-block-group has-global-padding is-layout-constrained">
      <div class="alignwide">
        <div class="tm-container blurred-bg bordered">
          <p class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Manage all your policies in one place"); ?></p>
          <ul class="tm-list green-checklist mt-0" style="margin-bottom: 32px;">
            <li>All policies, one app</li>
            <li>Free claim service</li>
            <li>All policies explained</li>
            <li>Consult an expert</li>
          </ul>
          <button class="wp-block-button tm-button" style="margin-left: auto;margin-right: auto"><a class="wp-block-button__link wp-element-button" href="https://turtlemint.onelink.me/b9Hg/0hkazw9s" target="_blank" onclick="tmClickEvent('Consumer app download', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Download Now</a></button>
        </div>
      </div>
    </div>
  </section>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_download_app', 'tmIcDownloadApp');
?>
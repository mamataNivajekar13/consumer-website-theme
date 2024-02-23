<?php
function tmBannerCta($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_banner_cta' );

  ob_start();?>

  <?php
    global $post;
    if (get_post_meta($post->ID, 'Banner CTA Link', true)) { 
      $customLink = get_post_meta($post->ID, 'Banner CTA Link', true);
      ?>
      <button class="wp-block-button tm-button"><a target="__blank" class="get-quote-cta wp-block-button__link wp-element-button" href="<?php echo $customLink; ?>">Find Plans</a></button>
    <?php }
    else{ }
  ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_banner_cta', 'tmBannerCta');
?>
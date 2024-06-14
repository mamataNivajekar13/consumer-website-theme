<?php
function tmBreadcrumb($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_breadcrumb' );

  ob_start();?>

  <?php
    if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb( '<div class="tm-breadcrumb" id="breadcrumbs">','</div>' );
    }
  ?>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_breadcrumb', 'tmBreadcrumb');
?>
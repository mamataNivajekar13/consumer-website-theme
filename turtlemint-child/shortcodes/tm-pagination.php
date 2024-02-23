<?php
function tmPagination($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_pagination' );

  ob_start();?>

	
<?php the_posts_pagination( array(
    'mid_size'  => 1,
    'prev_text' => __( '«', 'turtlemint-child' ),
    'next_text' => __( '»', 'turtlemint-child' ),
) ); ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_pagination', 'tmPagination');
?>
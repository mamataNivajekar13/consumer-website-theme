<?php
function tmMegamenu($atts){

	$atts = shortcode_atts( array(
		'megamenu' => ''
	), $atts, 'tm_megamenu' );

    ob_start();

    $megamenu = $atts['megamenu'];

    if($megamenu != ''):?>
    
      <div class="tm-megamenu">
        <?php
          dynamic_sidebar( 'megamenu_'. $megamenu );
        ?>
      </div>

      <?php
      $html = ob_get_contents();

      ob_end_clean();

      return $html;

    endif;
}

add_shortcode('tm_megamenu', 'tmMegamenu');
?>
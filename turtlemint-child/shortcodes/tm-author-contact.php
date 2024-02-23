<?php
function tmAuthorContact($atts){

	$atts = shortcode_atts( array(
    'linkedin' => false
  ), $atts, 'tm_author_contact' );

  ob_start();?>

  <?php

    $linkedin = $atts['linkedin'];
    $user_id = get_the_author_meta('ID');

    if($linkedin == true && $user_id){
      $linkedin_url = get_user_meta($user_id, 'linkedin', true);
      if($linkedin_url){
        echo '<p class="tm-link underlined"><a style="display: inline-flex;align-items: center;gap: 10px;" href="'.esc_url($linkedin_url).'" target="__blank"><i style="margin-top: -5px;height: 18px;width: 18px;background-position-y: -70.5px;" class="tm-sprite-3 bg-linkedin-in" alt="Linkedin" title="Linkedin"></i>Check LinkedIn Profile</a></p>';
      }
    }

  ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_author_contact', 'tmAuthorContact');
?>
<?php
function tmGetAQuoteCtas($atts){

	$atts = shortcode_atts( array(
    'validate'=> 'false',
    'vertical' => ''
	), $atts, 'tm_get_a_quote_ctas' );

  ob_start();?>
  
  <?php
    $validate = $atts['validate'];
    if($atts['vertical'] != ''){
      $vertical = ", '".$atts['vertical']."'";
    }
  ?>

  <div class="get-a-quote-ctas">
    <button class="wp-block-button tm-button secondary"><a class="get-quote-cta wp-block-button__link wp-element-button" <?php if($validate == 'true'): echo "onclick=\"verticalRedirect('redirect', this)\""; elseif($atts['vertical']): echo "onclick=\"verticalRedirect('redirect', this".$vertical.")\""; else: endif; ?>>Get a Quote</a></button>
    <div class="get-a-quote-content tm-weight-medium">
      <strong>45+ Insurer</strong><br>companies online
    </div>
    <span class="has-turtlemint-child-large-font-size tm-weight-semi-bold">or</span>
    <button class="wp-block-button tm-button"><a class="find-advisor-cta wp-block-button__link wp-element-button" <?php if($validate == 'true'): echo "onclick=\"verticalRedirect('findAdvisor', this)\""; elseif($atts['vertical']): echo "onclick=\"verticalRedirect('findAdvisor', this".$vertical.")\""; else: endif; ?> >Find Advisor</a></button>
    <div class="find-advisor-content tm-weight-medium">
      <strong>2.5 Lakh+</strong><br>Turtlemint advisors
    </div>
  </div>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_get_a_quote_ctas', 'tmGetAQuoteCtas');
?>
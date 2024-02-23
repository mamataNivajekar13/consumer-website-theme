<?php
function tmFindAdvisor($atts){
	$atts = shortcode_atts( array(
    'vertical' => 'FW'
  ), $atts, 'tm_find_advisor' );

  $vertical = $atts['vertical'];

  ob_start();?>

  <div class="tm-section-find-advisor">
    <div class="tm-section-find-advisor__wraper">
      <p class="has-turtlemint-child-large-1-font-size mt-0 mb-3 tm-weight-bold">Find a Turtlemint Advisor Near You</p>
      <form class="tm-form" id="find-advisor-form" method="get" action="<?php echo site_url() ?>/insurance-advisor-near-me/" novalidate>
        <div class="tm-field-group">
          <div class="tm-field">
            <div class="tm-field__cta">
              <input type="text" class="tm-field__input" id="find-advisor-pincode" name="pincode" placeholder="Enter Pin Code" maxlength="6" required onkeypress="return isNumber(event)">
              <input type="hidden" id="vertical" name="vertical" value="<?php echo $vertical ?>">
              <button class="wp-block-button tm-button"><a class="get-quote-cta wp-block-button__link wp-element-button">Find Advisor</a></button>
            </div>
            <p class="tm-message"></p>
          </div>
        </div>
      </form>
      <p  class="mt-0 mb-0 tm-weight-medium"><b>2.8 Lakh+</b> Turtlemint advisors</p>
    </div>
  </div>
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_find_advisor', 'tmFindAdvisor');
?>
<?php
function tmSelectInsurance($atts){

	$atts = shortcode_atts( array(

	), $atts, 'tm_select_insurance' );

  ob_start(); ?>

  <div class="tm-section-select-insurance">
    <div class="tm-section-select-insurance__wraper">
      <div class="steps">
          <div class="step step-1 current">
            <div class="step__head">
              <span class="step-number">1</span>
              <p class="step-title">Select type of insurance</p>
            </div>
            <div class="step__content">
              <form action="<?php echo site_url() ?>/insurance-advisor-near-me" class="tm-form" id="tm-select-insurance">
                <div class="tm-field-group">
                  <ul class="tm-radio-verticals">
                    <li class="tm-radio-vertical">
                      <label title="Health Insurance" class="has-turtlemint-child-medium-font-size tm-weight-medium tm-sprite-3-before bg-health" for="tm-health-insurance">Health</label>
                      <input type="radio" name="vertical" id="tm-health-insurance" value="Health">
                      <label class="radio-button" for="tm-health-insurance"></label>
                    </li>
                    <li class="tm-radio-vertical">
                      <label title="Life Insurance" class="has-turtlemint-child-medium-font-size tm-weight-medium tm-sprite-3-before bg-life" for="tm-life-insurance">Life</label>
                      <input type="radio" name="vertical" id="tm-life-insurance" value="Life">
                      <label class="radio-button" for="tm-life-insurance"></label>
                    </li>
                    <li class="tm-radio-vertical">
                      <label title="Bike Insurance" class="has-turtlemint-child-medium-font-size tm-weight-medium tm-sprite-3-before bg-bike" for="tm-tw-insurance">Bike</label>
                      <input type="radio" name="vertical" id="tm-tw-insurance" value="TW">
                      <label class="radio-button" for="tm-tw-insurance"></label>
                    </li>
                    <li class="tm-radio-vertical">
                      <label title="Car Insurance" class="has-turtlemint-child-medium-font-size tm-weight-medium tm-sprite-3-before bg-car" for="tm-fw-insurance">Car</label>
                      <input type="radio" name="vertical" id="tm-fw-insurance" value="FW">
                      <label class="radio-button" for="tm-fw-insurance"></label>
                    </li>
                  </ul>
                  <p class="tm-message"></p>
                </div>
              </form>
            </div>
          </div>
          <div class="step step-2">
            <div class="step__head">
              <span class="step-number">2</span>
              <p class="step-title">How can we help you?</p>
            </div>
            <div class="step__content">
              <?php echo do_shortcode('[tm_get_a_quote_ctas validate=true]') ?>
            </div>
          </div>
      </div>
    </div>
  </div>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_select_insurance', 'tmSelectInsurance');
?>
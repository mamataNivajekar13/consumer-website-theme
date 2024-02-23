<?php
function tmIcClaimProcess($atts){

	$atts = shortcode_atts( array(
    'type' => '',
    'vertical' => '',
  ), $atts, 'tm_ic_claim_process' );

  ob_start();?>

  <?php

    $type = $atts['type'];
    $vertical = $atts['vertical'];
    
    if(get_query_var( 'health-ic-city' )){
      $city = str_replace('-', ' ', get_query_var( 'health-ic-city' ));
    }elseif(get_query_var( 'car-cg-city' )){
      $city = str_replace('-', ' ', get_query_var( 'car-cg-city' ));
    }

    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      $car_term_slug = get_query_var( 'car-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
      }
      if($car_term_slug) {
        $term = get_term_by( 'slug', $car_term_slug, 'car-insurer' );
      }
    }

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

    global $template;
    $templateName = basename($template);

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }
    $insurer_cashless_claims = get_field('insurer_cashless_claims', $term);
    $insurer_reimbursement = get_field('insurer_reimbursement', $term);

    $vertical_name_category = tm_event_category();
  ?>

  <?php if($vertical == 'bike' || $vertical == 'car' && $insurer_cashless_claims):?>
    <section id="claims" class="highlight-section wp-block-group alignfull is-layout-flow tm-ic-claim-process">
      <div class="wp-block-group has-global-padding is-layout-constrained">
        <div class="alignwide">
          <div class="tm-container has-turtlemint-child-tm-light-green-background-color">
            <?php if($vertical == 'bike'){
              echo '<h2 class="section-heading has-turtlemint-child-tm-x-large-font-size">'.ucwords("How to raise a claim under ".$insurer_display_name." two wheeler bike insurance").'</h2>';
            }else{
              echo '<h2 class="section-heading has-turtlemint-child-tm-x-large-font-size">'.ucwords("How to raise a claim under ".$insurer_display_name." car insurance").'</h2>';
            }?>
            <div class="tm-container__content has-toggle-expand-cta tm-gradient-light-green has-turtlemint-child-tm-gray-color" style="max-height:190px;" data-max-height="190" data-max-height-mob="174">
              <?php echo $insurer_cashless_claims; ?>
            </div>
            <?php
              if($vertical_name == "Bike"){
                $vertical_name = "two wheeler";
                $vertical_name_category = "Bike";
              }else{
                $vertical_name_category = tm_event_category();
              }
            ?>
            <div class="cta-links">
              <p class="tm-link toggleExpand mb-0 d-inline-flex" data-eventaction="Claim Process" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" data-ctavalue="<?php echo $city; ?>" onclick="toggleContent(this);tmClickEvent('Claim Process', '<?php echo $vertical_name_category; ?>', '<?php echo $insurer_display_name; ?>'<?php if($city): echo ', \'\', \''.$city.'\'' ; endif; ?>)"><a class="icon-link" title="<?php echo ucwords("read more about claim process of ".$insurer_display_name." ".$vertical_name." insurance"); ?>"><span>Read More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php elseif($insurer_cashless_claims || $insurer_reimbursement):?>
    <section id="claims" class="highlight-section wp-block-group alignfull is-layout-flow tm-ic-claim-process">
      <div class="wp-block-group has-global-padding is-layout-constrained">
          <div class="alignwide">
            <div class="tm-container has-turtlemint-child-tm-light-green-background-color">
              <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords($insurer_display_name." Claim Process"); ?></h2>

              <div class="tm-container__content">
                <p><?php echo $insurer_display_name; ?> supports both cashless claims and reimbursement claims. This section covers the information on how to check <?php echo $insurer_display_name." ".strtolower($vertical_name); ?> insurance claim status, fill <?php echo $insurer_display_name." ".strtolower($vertical_name); ?> insurance claim form, and the claim settlement process.</p>
              </div>

              <?php if($insurer_cashless_claims || $insurer_reimbursement):?>

              <div class="tm-accordion-style2" id="tmAccordion-claim-process">
                <?php if($insurer_cashless_claims):?>
                  <div class="tm-accordion-item">
                      <p class="tm-accordion-header mb-0" id="heading-cashless-claims">
                          <button class="tm-sprite-3-after bg-chevron-up tm-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-cashless-claims" aria-expanded="false" aria-controls="collapse-cashless-claims" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" data-ctavalue="<?php echo $city; ?>">
                              <h3 class="mb-0 has-turtlemint-child-medium-font-size"><?php echo "Cashless Claims"; ?></h3>
                          </button>
                      </p>
                      <div id="collapse-cashless-claims" class="tm-accordion-collapse collapse show" aria-labelledby="heading-cashless-claims" data-bs-parent="#tmAccordion-cashless-claims">
                          <div class="tm-accordion-body">
                              <div class="tm-accordion-body__wraper">
                                  <?php echo $insurer_cashless_claims;?>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php endif;?>
                <?php if($insurer_reimbursement):?>
                  <div class="tm-accordion-item">
                      <p class="tm-accordion-header mb-0" id="heading-reimbursement">
                          <button class="tm-sprite-3-after bg-chevron-down tm-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-reimbursement" aria-expanded="false" aria-controls="collapse-reimbursement" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" data-ctavalue="<?php echo $city; ?>">
                              <h3 class="mb-0 has-turtlemint-child-medium-font-size"><?php echo "Reimbursement Claims"; ?></h3>
                          </button>
                      </p>
                      <div id="collapse-reimbursement" class="tm-accordion-collapse collapse" aria-labelledby="heading-reimbursement" data-bs-parent="#tmAccordion-reimbursement">
                          <div class="tm-accordion-body">
                              <div class="tm-accordion-body__wraper">
                                <?php echo $insurer_reimbursement;?>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php endif;?>
              </div>
              <script type="text/javascript">
                // FAQ
                if(document.getElementById('tmAccordion-claim-process')){
                    document.getElementById('tmAccordion-claim-process').addEventListener('hide.bs.collapse', event => {
                        $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-up').addClass('bg-chevron-down')
                    })
                    document.getElementById('tmAccordion-claim-process').addEventListener('show.bs.collapse', event => {
                        $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-down').addClass('bg-chevron-up');
                        let button = $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button');
                        let buttonText = button.text().replace(/\s+/g, ' ').trim();
                        let eventCategory = button.data('eventcategory');
                        let eventLabel = button.data('eventlabel');
                        let city = button.data('ctavalue');
                        if(city) {
                          tmClickEvent(buttonText, eventCategory, eventLabel, ' ', city);
                        } else {
                          tmClickEvent(buttonText, eventCategory, eventLabel);
                        }
                    })
                }
              </script>
              <?php endif;?>

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

add_shortcode('tm_ic_claim_process', 'tmIcClaimProcess');
?>
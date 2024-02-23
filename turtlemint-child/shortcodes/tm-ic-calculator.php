<?php
function tmIcCalculator($atts){

	$atts = shortcode_atts( 
    array(
      'type' => '',
      'vertical' => 'health',
    ), $atts, 'tm_ic_calculator' );

  ob_start();?>

  <?php

        $type = $atts['type'];
        $vertical = $atts['vertical'];
        $city = str_replace('-', ' ', get_query_var( 'health-ic-city' ));

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
              $calculators = $theme_settings_vertical['calculator_quick_links'];
            }
        }
        /* Theme Settings - end */

        global $template;
        $templateName = basename($template);
        if($templateName == 'ic-network-hospitals.php'){
          $event_vertical_name = 'NH-India';
        }elseif($templateName == 'tm-nh-hospitals-list.php'){
          $event_vertical_name = 'NH-City';
        }elseif($templateName == 'tm-cg-network.php'){
          $event_vertical_name = 'CG-India';
        }elseif($templateName == 'tm-cg-city-list.php'){
          $event_vertical_name = 'CG-City';
        }else{
          $event_vertical_name = tm_event_category();
        }

        if(get_field('insurer_name', $term)){
          $insurer_display_name = ucwords(get_field('insurer_name', $term));
        }else{
          $insurer_display_name = ucwords($term->name);
        }
        
  ?>

  <?php if($vertical == 'health' && $calculators){?>
    <section id="premium-calculator" class="highlight-section tm-container has-turtlemint-child-tm-light-yellow-background-color wp-block-group alignfull is-layout-flow tm-ic-calculator">
          <div class="wp-block-group has-global-padding is-layout-constrained">
              <div class="alignwide">
                <div class="wp-block-columns is-not-stacked-on-mobile mb-0">
                  <div class="wp-block-column" style="flex-basis: 75%;">
                    <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo $insurer_display_name.ucwords(" Premium Calculator"); ?></h2>
                    <div class="tm-container__content">
                      <p>Use the <?php echo ucwords($insurer_display_name)." ". strtolower($vertical_name); ?> insurance premium calculator to estimate your <?php echo strtolower($vertical_name); ?> insurance premiums.</p>
                    </div>
                  </div>
                  <div class="wp-block-column has-text-align-right" style="flex-basis: 25%;">
                    <i class="tm-sprite-2 bg-calculator-3d"></i>
                  </div>
                </div>
                <?php
                  foreach ($calculators as $calculator):
                    $quick_link_title = $calculator['quick_link_title'];
                    $quick_link_description = $calculator['quick_link_description'];
                    $quick_link = $calculator['quick_link'];
                ?>
                  <?php if ($quick_link && $quick_link_description && $quick_link_title):?>
                    <div class="calculator-card" title="<?php echo ucwords("Check ".$insurer_display_name." ".$vertical_name." Plan Premium") ; ?>" onclick="tmClickEvent('Premium calculator', '<?php echo $event_vertical_name; ?>', '<?php echo $insurer_display_name; ?>', '', '<?php echo ucwords($city)?>');window.open('<?php echo $quick_link; ?>', '_blank')" style="cursor: pointer;">
                      <div class="calculator-card__wrapper">
                        <i class="card-icon tm-sprite-2 bg-premium-3d"></i>
                        <div class="card-content">
                          <?php if($quick_link_title):?>
                            <p class="card-heading has-turtlemint-child-tm-large-font-size" style="font-weight: 600;"><?php echo $quick_link_title; ?></p>
                          <?php endif;?>
                          <?php if($quick_link_description):?>
                            <p class="card-description has-turtlemint-child-tm-gray-color"><?php echo $quick_link_description; ?></p>
                          <?php endif;?>
                        </div>
                        <i style="margin-right:auto" class="tm-sprite-3 bg-chevron-right"></i>
                      </div>
                    </div>
                  <?php endif;?>
                <?php endforeach;?>
              </div>
          </div>
    </section>
  <?php } else { ?>
    <section id="premium-calculator" class="highlight-section tm-container has-turtlemint-child-tm-light-yellow-background-color wp-block-group alignfull is-layout-flow tm-ic-calculator">
          <div class="wp-block-group has-global-padding is-layout-constrained">
              <div class="alignwide">
                <div class="wp-block-columns is-not-stacked-on-mobile mb-0">
                  <div class="wp-block-column" style="flex-basis: 75%;">
                    <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo $insurer_display_name.ucwords(" Premium Calculator"); ?></h2>
                    <div class="tm-container__content">
                      <?php
                        if($vertical == 'bike'){
                          echo "<p>Use our ".$insurer_display_name." bike insurance premium calculator to estimate ".$insurer_display_name." bike insurance premium for your bike within 30 seconds</p>";
                        }else if($vertical == 'car'){
                          echo "<p>Use our ".$insurer_display_name." car insurance premium calculator to estimate ".$insurer_display_name." car insurance premium for your car within 30 seconds</p>";
                        }
                      ?>
                    </div>
                  </div>
                  <div class="wp-block-column has-text-align-right" style="flex-basis: 25%;">
                    <i class="tm-sprite-2 bg-calculator-3d"></i>
                  </div>
                </div>
                <div class="tm-container has-turtlemint-child-white-background-color">
                  <?php 
                  if($vertical == 'bike'){
                    echo "<div>".do_shortcode('[tm_get_a_quote cta_text="Check premium" vertical="bike" placeholder_text="Bike Number (MH01MK8282)" quote_link_text="Get quotes without bike number" quote_link="https://app.turtlemint.com/two-wheeler-insurance/two-wheeler-profile/tw-registration-info" style="outside-cta-primary" cta_title_attr="Check '.$insurer_display_name.' bike insurance Premium" section="premium-calculator"]')."</div>";
                  }else if($vertical == 'car'){
                    echo "<div>".do_shortcode('[tm_get_a_quote cta_text="Check Premium" vertical="car" placeholder_text="Car Number (MH01MK8282)" quote_link_text="Get quotes without car number" quote_link="https://app.turtlemint.com/car-insurance/car-profile/car-registration-info" style="outside-cta-primary" cta_title_attr="'.$insurer_display_name.' '.$vertical_name.' Insurance quotes" section="premium-calculator"]')."</div>";
                  }
                  ?>
                </div>
              </div>
          </div>
    </section>
  <?php } ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_calculator', 'tmIcCalculator');
?>
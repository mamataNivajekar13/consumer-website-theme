<?php
function tmIcBuyingProcess($atts){

	$atts = shortcode_atts( array(
    'vertical' => 'health'
  ), $atts, 'tm_ic_buying_process' );

  ob_start();?>

  <?php

    $vertical = $atts['vertical'];

    $term = get_queried_object();

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
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
    $insurer_how_to_buy = get_field('insurer_how_to_buy', $term); 
  ?>

  <?php if($insurer_how_to_buy){ ?>
    <section class="wp-block-group alignfull is-layout-flow tm-ic-buying-process">
      <div class="wp-block-group has-global-padding is-layout-constrained">
          <div class="alignwide">
            <div class="tm-container has-turtlemint-child-tm-light-purple-background-color">
              <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("How to Buy ".$insurer_display_name." ".$vertical_name." Insurance"); ?></h2>
              <div class="tm-container__content mb-0">
                <?php if($vertical == 'health'){?>
                  <p class="list-text" style="margin-bottom:16px">There are 2 ways to purchase <?php echo $insurer_display_name." ".strtolower($vertical_name); ?> insurance either directly through the insurer on their website or through Turtlemint website and advisors. Here are the steps for online purchase through <?php echo $insurer_display_name; ?>:</p>
                <ol class="mb-0 mt-0 steps-list">
                  <li>Visit the official website of <?php echo $insurer_display_name." ".strtolower($vertical_name); ?> insurance  </li>
                  <li>Enter your personal details and other information to find the plan that best suits your requirements.</li>
                  <li>Review & compare the policy coverage, premium amount, and any additional features.</li>
                  <li>Select the plan and continue to the payment page to complete the transaction</li>
                  <li>Once the payment is successful, you will receive the policy document electronically.</li>
                </ol>
                <?php } elseif($vertical == 'bike' || $vertical == 'car') { 
                ?>
                  <div class="tm-container__content has-toggle-expand-cta tm-gradient-light-purple has-turtlemint-child-tm-gray-color" style="max-height:153px;" data-max-height="153" data-max-height-mob="140">
                    <?php echo $insurer_how_to_buy; ?>
                  </div>
                  <?php if($vertical_name == "Bike"): $vertical_name = "two wheeler"; endif; ?>
                  <div class="cta-links">
                    <p class="tm-link toggleExpand mb-0 d-inline-flex" onclick="toggleContent(this);"><a class="icon-link" title="Read More"><span>Read More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a></p>
                  </div>
                <?php
                }
                ?>
              </div>
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

add_shortcode('tm_ic_buying_process', 'tmIcBuyingProcess');
?>
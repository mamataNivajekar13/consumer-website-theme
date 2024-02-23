<?php
function tmIcCustomerCare($atts){

	$atts = shortcode_atts( array(
    'type' => '',
  ), $atts, 'tm_ic_customer_care' );

  ob_start();?>

  <?php
    
    $type = $atts['type'];

    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
      }
      $car_term_slug = get_query_var( 'car-ic' );
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
    
    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }

    $insurer_phone_no = get_field('insurer_phone_no', $term);
    $insurer_email = get_field('insurer_email', $term);
  ?>

  <?php if($insurer_phone_no || $insurer_email):?>
    <section id="customer-care" class="highlight-section tm-container bordered wp-block-group alignfull is-layout-flow tm-ic-customer-care">
        <div class="tm-container__content">
          <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords($insurer_display_name ." Customer Care"); ?></h2>
          <div class="wp-block-columns mb-0 tm-contact-card-list">
            <?php if($insurer_phone_no):?>
              <div class="contact-card wp-block-column tm-container bordered">
                  <i class="tm-sprite-1 bg-phone-grey card-icon"></i>
                  <p class="mb-0 has-turtlemint-child-black-color" style="font-weight:600 !important;"><?php echo ucwords("Customer care number"); ?></p>
                  <p class="tm-link secondary mb-0"><a class="has-turtlemint-child-medium-font-size" href="<?php echo "tel:".str_replace(' ', '', $insurer_phone_no);?>"><?php echo formatPhoneNumber($insurer_phone_no);?></a></p>
              </div>
            <?php endif;?>
            <?php if($insurer_email):?>
              <div class="contact-card wp-block-column tm-container bordered">
                <i class="tm-sprite-1 bg-envelope-grey card-icon"></i>
                  <p class="mb-0 has-turtlemint-child-black-color" style="font-weight:600 !important;"><?php echo ucwords("Email ID"); ?></p>
                  <p class="tm-link secondary mb-0"><a class="has-turtlemint-child-medium-font-size" href="<?php echo "mailto:".str_replace(' ', '', $insurer_email);?>"><?php echo $insurer_email;?></a></p>
              </div>
            <?php endif;?>
          </div>
        </div>
    </section>
  <?php endif;?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_customer_care', 'tmIcCustomerCare');
?>
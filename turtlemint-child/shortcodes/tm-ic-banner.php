<?php
function tmIcBanner($atts){

	$atts = shortcode_atts( array(
    'vertical' => 'health'
  ), $atts, 'tm_ic_banner' );

  ob_start();?>

  <?php

    $currentVertical = $atts['vertical'];
    $term = get_queried_object();

    $taxonomy_slug = $term->taxonomy;

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
          $quick_links = $theme_settings_vertical['quick_links'];
          $cta_link = $theme_settings_vertical['cta_link'];
        }
    }
    /* Theme Settings - end */

    $insurer_logo = get_field('insurer_logo', $term);
    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }
    $policies_issued = get_field('policies_issued', $term);
    $year_of_inception = get_field('year_of_inception', $term);
    $number_of_branches = get_field('number_of_branches', $term);
    $network_hospitals = get_field('network_hospitals', $term);
    $cashless_garages = get_field('cashless_garages', $term);
  ?>

    <section id="top" class="highlight-section wp-block-group alignfull mt-0 mb-0 is-layout-flow tm-ic-banner">
        <div class="wp-block-group has-global-padding is-layout-constrained">
            <div class="wp-block-columns alignwide">
                <div class="wp-block-column">
                    <?php echo do_shortcode('[tm_breadcrumb type="custom"]'); ?>
                </div>
            </div>
            <div class="wp-block-columns alignwide is-layout-flex justify-content-between mt-0 banner-section">
                <div class="wp-block-column" style="flex-basis: 60%;">
                    <?php if($insurer_logo):?>
                      <img src="<?php echo $insurer_logo; ?>" class="insurer-logo" alt="<?php echo $insurer_display_name." ".$vertical_name." Insurance Logo" ?>" title="<?php echo $insurer_display_name." ".$vertical_name." Insurance Logo" ?>" height="64" width="140">
                    <?php endif; ?>
                    <h1 class="insurer-title has-turtlemint-child-tm-xx-large-font-size"><?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance"); ?></h1>
                    <?php if($quick_links):?>
                      <div class="insurer-quick-links">
                        <?php
                          $links = [];
                          foreach($quick_links as $quick_link): 
                          if($quick_link['link']):
                            $links[] = '<p class="tm-link underlined d-inline"><a href="'.$quick_link['link'].'" onclick="tmClickEvent(\'Banner link\', \''.$vertical_name.'\', \''.$insurer_display_name.'\', \''.trim($quick_link['link_title']).'\')">'.$quick_link['link_title'].'</a></p>';
                          endif; 
                        endforeach;
                        echo implode('<span class="comma">,</span>', $links);
                        ?>
                      </div>
                    <?php endif;?>

                    <?php
                      if($currentVertical == 'bike'){
                        echo "<div style='max-width: 490px;'>".do_shortcode('[tm_get_a_quote cta_text="Get Quotes" vertical="bike" placeholder_text="Bike Number (MH01MK8282)" quote_link_text="Get quotes without bike number" quote_link="https://app.turtlemint.com/two-wheeler-insurance/two-wheeler-profile/tw-registration-info" style="outside-cta-primary" cta_title_attr="'.$insurer_display_name.' '.$vertical_name.' Insurance quotes" section="banner"]')."</div>";
                      }
                      if($currentVertical == 'car'){
                        echo "<div style='max-width: 490px;'>".do_shortcode('[tm_get_a_quote cta_text="Get Quotes" vertical="car" placeholder_text="Car Number (MH01MK8282)" quote_link_text="Get quotes without car number" quote_link="https://app.turtlemint.com/car-insurance/car-profile/car-registration-info" style="outside-cta-primary" cta_title_attr="'.$insurer_display_name.' '.$vertical_name.' Insurance quotes" section="banner"]')."</div>";
                      }
                    ?>

                    <?php if($cta_link):?>
                      <button class="wp-block-button tm-button"><a class="wp-block-button__link wp-element-button" href="<?php echo $cta_link; ?>" target="_blank" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance quotes"); ?>" onclick="tmClickEvent('Check price', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Check Price</a></button>
                    <?php endif; ?>
                </div>
                <div class="wp-block-column" style="flex-basis: 40%;">
                  <div class="insurer-highlights-section <?php if($currentVertical == 'bike' || $currentVertical == 'car'): echo 'insurer-highlights-section--bike'; endif; ?>">

                    <?php if($currentVertical == 'health'):?>
                      <div class="insurer-highlight tm-box shadow blurred-bg">
                        <i class="tm-sprite-1 bg-policies-issued"></i>
                        <p class="highlight-title has-turtlemint-child-tm-small-font-size has-turtlemint-child-tm-gray-color">Policies Issued</p>
                        <p class="highlight-value"><?php if($policies_issued): echo number_format($policies_issued)."+"; else: echo "NA"; endif; ?></p>
                      </div>
                    <?php endif;?>

                    <div class="insurer-highlight tm-box shadow blurred-bg">
                      <i class="tm-sprite-1 bg-calender"></i>
                      <p class="highlight-title has-turtlemint-child-tm-small-font-size has-turtlemint-child-tm-gray-color">Year of Inception</p>
                      <p class="highlight-value"><?php if($year_of_inception): echo $year_of_inception; else: echo "NA"; endif; ?></p>
                    </div>

                    <div class="insurer-highlight tm-box shadow blurred-bg">
                      <i class="tm-sprite-1 bg-branches"></i>
                      <p class="highlight-title has-turtlemint-child-tm-small-font-size has-turtlemint-child-tm-gray-color">No. of Branches</p>
                      <p class="highlight-value"><?php if($number_of_branches): echo number_format($number_of_branches)."+"; else: echo "NA"; endif; ?></p>
                    </div>

                    <?php if($currentVertical == 'health'):?>
                      <div class="insurer-highlight tm-box shadow blurred-bg">
                        <i class="tm-sprite-1 bg-hospitals"></i>
                        <p class="highlight-title has-turtlemint-child-tm-small-font-size has-turtlemint-child-tm-gray-color">Network Hospitals</p>
                        <p class="highlight-value"><?php if($network_hospitals): echo number_format($network_hospitals)."+"; else: echo "NA"; endif; ?></p>
                      </div>
                    <?php endif;?>

                    <?php if($currentVertical == 'bike' || $currentVertical == 'car'):?>
                      <div class="insurer-highlight tm-box shadow blurred-bg">
                        <i class="tm-sprite-1 bg-garages"></i>
                        <p class="highlight-title has-turtlemint-child-tm-small-font-size has-turtlemint-child-tm-gray-color">Cashless Garages</p>
                        <p class="highlight-value"><?php if($cashless_garages): echo number_format($cashless_garages)."+"; else: echo "NA"; endif; ?></p>
                      </div>
                    <?php endif;?>

                  </div>
                </div>
            </div>
        </div>
    </section>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_banner', 'tmIcBanner');
?>
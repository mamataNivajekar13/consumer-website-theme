<?php
function tmGetAQuote($atts){

	$atts = shortcode_atts( array(
    'vertical'=> 'car',
    'placeholder_text'=> 'Enter Car Number',
    'quote_link_text' => 'Get Quotes Without Car Number >',
    'quote_link' => '#',
    'style' => '',
    'cta_text' => 'Get a quote',
    'cta_title_attr' => '',
    'section' => ''
	), $atts, 'tm_get_a_quote' );

  ob_start();?>
  
  <?php
    $vertical = $atts['vertical'];
    $placeholderText = $atts['placeholder_text'];
    $quoteLink = $atts['quote_link'];
    $quoteLinkText = ucwords($atts['quote_link_text']);
    $style = $atts['style'];
    $cta_text = ucwords($atts['cta_text']);
    $cta_title_attr = ucwords($atts["cta_title_attr"]);
    $section = $atts['section'];

    $term = get_queried_object();

    if(get_query_var( 'car-cg-city' )){
      $city = str_replace('-', ' ', get_query_var( 'car-cg-city' ));
    }

    if(!$term){
      $car_term_slug = get_query_var( 'car-ic' );
      if($car_term_slug){
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
        }else{
          $vertical_name =  ucwords($vertical);
        }
    }
    /* Theme Settings - end */

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }

    if($vertical):

    $vertical_name_category = tm_event_category();
  ?>

  <div class="tm-section-get-a-quote <?php if($style == "outside-cta-primary"): echo "tm-section-get-a-quote--outside-cta"; endif; ?>">
    <div class="tm-section-get-a-quote__wraper">
      <form class="tm-form get-a-quote-form" id="<?php if($section == 'premium-calculator'): echo 'get-a-quote-form-3'; elseif($section == 'banner'): echo 'get-a-quote-form-2'; else: echo 'get-a-quote-form'; endif; ?>" novalidate>
      <div class="tm-field-group">
        <div class="tm-field">
          <div class="tm-field__cta">
            <input type="text" class="tm-field__input" id="regNumber" placeholder="<?php echo $placeholderText ?>" maxlength="11" oninput="this.value = this.value.toUpperCase();" name="regNumber" required>
            <?php if($style == "outside-cta-primary"): ?>
                <button class="wp-block-button tm-button" type="submit">
                    <a title="<?php echo $cta_title_attr; ?>" class="get-quote-cta wp-block-button__link wp-element-button" <?php if($section == 'premium-calculator'): echo 'data-eventaction="Premium calculator" data-eventcategory="'.$vertical_name_category.'" data-eventlabel="'.$insurer_display_name.'"'; elseif($section == 'banner'): echo 'data-eventaction="'.$cta_text.'" data-eventcategory="'.$vertical_name_category.'" data-eventlabel="'.$insurer_display_name.'" data-ctadetails="'.$cta_text.'"';  endif; ?> <?php if(isset($city)): echo 'data-ctavalue="'.$city.'"'; endif; ?>>
                        <?php echo $cta_text; ?>
                        <div class='d-md-none'><i class='tm-sprite-3 bg-arrow-right'></i></div>
                    </a>
                </button>
            <?php else: ?>
              <button class="wp-block-button tm-button secondary" type="submit"><a class="get-quote-cta wp-block-button__link wp-element-button"><?php echo $cta_text; ?></a></button>
            <?php endif; ?>
          </div>
          <p class="tm-message"></p>
        </div>
      </div>
      </form>
      <div class="tm-link d-inline-flex">
        <a <?php if($style == "outside-cta-primary"): echo "title='".ucwords($insurer_display_name." ".$vertical_name." Insurance quotes")."'"; endif; ?> class="icon-link" href="<?php echo $quoteLink ?>" target="__blank" <?php if($vertical == 'bike'): echo 'onclick="tmClickEvent(\'Quotes without bike number\', \''.$vertical_name_category.'\', \''.$insurer_display_name.'\' )"'; elseif($vertical == 'car'): echo 'onclick="tmClickEvent(\'Quotes without car number\', \''.$vertical_name_category.'\', \''.$insurer_display_name.'\' )"'; endif; ?>><?php echo $quoteLinkText; ?><?php if($style == "outside-cta-primary"): echo "<i class='tm-sprite-1 bg-chevron-right-green'></i>"; endif; ?></a>
      </div>
    </div>
  </div>

  <?php

  endif;
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_get_a_quote', 'tmGetAQuote');
?>
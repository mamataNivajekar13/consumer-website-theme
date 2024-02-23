<?php
function tmIcClaimSettlementRatio($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_ic_claim_settlement_ratio' );

  ob_start();?>

  <?php
    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
      }
    }

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }
    $insurer_claim_settlement_ratio = get_field('insurer_claim_settlement_ratio', $term);

    $taxonomy_slug = $term->taxonomy;

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
          $vertical_claim_settlement_ratio = $theme_settings_vertical['vertical_claim_settlement_ratio'];
        }
    }
    /* Theme Settings - end */
    $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));
    $insurer_url = get_term_link($term->slug, $convertedVerticalName.'-insurer');
    $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $ancillaryCtaLink = $insurer_url.'claim-settlement/';

    $largestValue = max($insurer_claim_settlement_ratio, $vertical_claim_settlement_ratio);
    $insurerClass = ($insurer_claim_settlement_ratio === $largestValue) ? 'has-turtlemint-child-tm-light-yellow-background-color highlighted' : 'has-turtlemint-child-tm-gray-2-background-color';
    $verticalClass = ($vertical_claim_settlement_ratio === $largestValue) ? 'has-turtlemint-child-tm-light-yellow-background-color highlighted' : 'has-turtlemint-child-tm-gray-2-background-color';
  ?>

  <?php if ($insurer_claim_settlement_ratio && $vertical_claim_settlement_ratio):?>
    <section id="claim-settlement-ratio" class="highlight-section tm-container blurred-bg bordered">
      <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords($insurer_display_name . " Claim Settlement Ratio"); ?></h2>
      <div class="wp-block-columns is-not-stacked-on-mobile is-layout-flex settlement-ratios">
        <div class="wp-block-column is-layout-flow settlement-ratio <?php echo $insurerClass; ?>">
          <p class="settlement-ratio-value has-turtlemint-child-tm-x-large-font-size"><?php echo $insurer_claim_settlement_ratio."%"; ?></p>
          <p class="settlement-ratio-title has-turtlemint-child-tm-x-large-font-size"><?php echo $insurer_display_name; ?></p>
        </div>
        <div class="wp-block-column is-layout-flow settlement-ratio <?php echo $verticalClass; ?>">
          <p class="settlement-ratio-value has-turtlemint-child-tm-x-large-font-size"><?php echo $vertical_claim_settlement_ratio."%"; ?></p>
          <p class="settlement-ratio-title has-turtlemint-child-tm-x-large-font-size">Industry Average</p>
        </div>
      </div>
      <div class="tm-container__content <?php if(!($insurer_url && $vertical_name == 'Health' && $currentUrl != $ancillaryCtaLink)): echo 'mb-0'; endif; ?>">
        <p><?php echo $vertical_name; ?> claim settlement ratio is the percentage of claims settled against the total claims received by the insurance company in a given fiscal year. <?php echo $insurer_display_name; ?> has a claim settlement ratio of <?php echo $insurer_claim_settlement_ratio."%"; ?>, as compared to the industry average of <?php echo $vertical_claim_settlement_ratio."%"; ?>.</p>
      </div>
      <?php if($insurer_url && $vertical_name == 'Health' && $currentUrl != $ancillaryCtaLink):?>
        <div class="cta-links">
          <p class="tm-link mb-0 d-inline-flex"><a href="<?php echo $ancillaryCtaLink; ?>" class="icon-link" title="Claim settlement ratio"><span><?php echo ucwords('Know more about '.$insurer_display_name.' claim settlement '); ?></span><i class="tm-sprite-1 bg-chevron-right-green"></i></a></p>
        </div>
      <?php endif; ?>
  </section>
  <?php endif;?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_claim_settlement_ratio', 'tmIcClaimSettlementRatio');
?>
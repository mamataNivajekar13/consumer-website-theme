<?php
function tmNhInsuranceCompanies($atts){

  $atts = shortcode_atts(array(
    'limit' => 5,
    'classes' => ''
  ), $atts, 'tm_hc_insurance_companies');

  ob_start(); ?>

  <?php

  $tax_slug = (get_query_var('health-ic'));
  $term = get_term_by('slug', $tax_slug, 'health-insurer');

  if (isset($term) && $term != false) {
    $taxonomy_slug = $term->taxonomy;
    $term_id = $term->term_id;

    if (get_field('insurer_name', $term)) {
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    } else {
      $insurer_display_name = ucwords($term->name);
    }
  } else {
    $taxonomy_slug = 'health-insurer';
  }

  /* Theme Settings - start */
  $theme_settings_verticals = get_field('verticals', 'option');
  $vertical_name = null;
  foreach ($theme_settings_verticals as $theme_settings_vertical) {
    $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

    if ($vertical_taxonomy_slug == $taxonomy_slug) {
      $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
    }
  }
  /* Theme Settings - end */
  $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));

  $term_args = array(
    'taxonomy' => $convertedVerticalName . '-insurer', /* Vertical Slug Change */
    'hide_empty' => false,
    'orderby' => 'name',
    'order' => 'ASC',
  );

  if (isset($term_id) && $term_id != false) {
    $term_args['exclude'] = array($term_id);
  }

  $terms = get_terms($term_args);

  if(!empty($terms)){
    foreach ($terms as $index => $term) {
      global $wpdb;
      $insurer_code = get_field('insurer_code', $term->taxonomy . '_' . $term->term_id);
      $hospital_count = $wpdb->get_var("SELECT SUM(count) FROM {$wpdb->prefix}cashless_hospitals_insurers WHERE insurer='{$insurer_code}'");
      if (!$hospital_count) {
        unset($terms[$index]);
      }
    }
  }

  $elementLimit = $atts['limit'];
  $classes = $atts['classes'];

  if(isset($insurer_display_name)){
    $event_label = $insurer_display_name;
  }else{
    $event_label = base_vertical();
  }

  ?>

  <?php if ($terms) : ?>

    <section class="tm-container has-turtlemint-child-tm-light-purple-background-color tm-insurance-companies tm-insurance-companies--vertical<?php if(isset($classes) && $classes != ''): echo ' '.$classes; endif; ?>">
      <div class="wp-block-columns is-not-stacked-on-mobile mb-0">
        <div class="wp-block-column" style="flex-basis: 75%;">
          <?php if(isset($tax_slug) && $tax_slug != ''):?>
            <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords(" Other Network Hospitals In India "); ?></h2>
          <?php else:?>
            <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Check the Network Hospitals across insurers"); ?></h2>
          <?php endif;?>
          <div class="tm-container__content">
            <p>Check the list of cashless network hospitals across health insurance companies below:</p>
          </div>
        </div>
        <div class="wp-block-column has-text-align-right" style="flex-basis: 25%;">
          <i class="tm-sprite-2 bg-network-hospitals"></i>
        </div>
      </div>
      <?php
      $totalElements = count($terms);
      if ($totalElements > $elementLimit) {
        $insurer_features_set1 = array_slice($terms, 0, $elementLimit);
        $insurer_features_set2 = array_slice($terms, $elementLimit);
      ?>
        <div class="viewMoreContainer has-turtlemint-child-white-background-color" style="margin-bottom:16px">
          <?php foreach ($insurer_features_set1 as $child_term_id) : ?>
            <?php
            if (get_field('insurer_name', get_term($child_term_id))) {
              $ic_display_name = ucwords(get_field('insurer_name', get_term($child_term_id)));
            } else {
              $ic_display_name = ucwords(get_term($child_term_id)->name);
            }
            ?>
            <div class="tm-insurance-company">
              <a class="tm-insurance-company__title" href="<?php echo get_term_link($child_term_id); ?>network-hospitals/" title="<?php echo ucwords($ic_display_name . " Network Hospitals in India"); ?>" onclick="tmClickEvent('Other network hospital', 'NH-India', '<?php if(isset($event_label)): echo $event_label; endif; ?>', '<?php echo $ic_display_name; ?>')">
                <?php echo ucwords($ic_display_name . " Network Hospitals in India"); ?>
                <i style="margin-right:auto" class="tm-sprite-3 bg-chevron-right"></i>
              </a>
            </div>
          <?php endforeach; ?>
          <?php foreach ($insurer_features_set2 as $child_term_id) : ?>
            <?php
            $insurer_logo = get_field('insurer_logo', get_term($child_term_id));
            if (get_field('insurer_name', get_term($child_term_id))) {
              $ic_display_name = ucwords(get_field('insurer_name', get_term($child_term_id)));
            } else {
              $ic_display_name = ucwords(get_term($child_term_id)->name);
            }
            ?>
            <div class="view-more-hidden tm-insurance-company">
              <a class="tm-insurance-company__title" href="<?php echo get_term_link($child_term_id); ?>network-hospitals/" title="<?php echo ucwords($ic_display_name . " Network Hospitals in India"); ?>" onclick="tmClickEvent('Other network hospital', 'NH-India', '<?php if(isset($event_label)): echo $event_label; endif; ?>', '<?php echo $ic_display_name; ?>')">
                <?php echo ucwords($ic_display_name . " Network Hospitals in India"); ?>
                <i style="margin-right:auto" class="tm-sprite-3 bg-chevron-right"></i>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="cta-links">
          <p class="tm-link d-inline-flex mb-0 viewMoreLink">
            <a class="icon-link"><span>More Insurers</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a>
          </p>
        </div>
      <?php } else { ?>
        <div class="viewMoreContainer has-turtlemint-child-white-background-color">
          <?php foreach ($terms as $child_term_id) : ?>
            <?php
            $insurer_logo = get_field('insurer_logo', get_term($child_term_id));
            if (get_field('insurer_name', get_term($child_term_id))) {
              $ic_display_name = ucwords(get_field('insurer_name', get_term($child_term_id)));
            } else {
              $ic_display_name = ucwords(get_term($child_term_id)->name);
            }
            ?>
            <div class="tm-insurance-company">
              <a class="tm-insurance-company__title" href="<?php echo get_term_link($child_term_id); ?>network-hospitals/" title="<?php echo ucwords($ic_display_name . " Network Hospitals in India"); ?>" onclick="tmClickEvent('Other network hospital', 'NH-India', '<?php if(isset($event_label)): echo $event_label; endif; ?>', '<?php echo $ic_display_name; ?>')">
                <?php echo ucwords($ic_display_name . " Network Hospitals in India"); ?>
                <i style="margin-right:auto" class="tm-sprite-3 bg-chevron-right"></i>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      <?php } ?>
    </section>

  <?php endif; ?>

<?php

  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_nh_insurance_companies', 'tmNhInsuranceCompanies');
?>
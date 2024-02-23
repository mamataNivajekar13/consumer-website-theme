<?php
function tmSecondaryNavbar($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_secondary_navbar' );

  ob_start();?>

  <?php
    global $template;
    $templateName = basename($template);

    $term = get_queried_object();

    $taxonomy_slug = $term->taxonomy;

    $term_slug = $term->slug;

    $insurer_code = ucwords(get_field('insurer_code', $term));
    global $wpdb;
    $hospitals = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}cashless_hospitals_insurers WHERE insurer = '{$insurer_code}' AND count > 0;" );
    $garages = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}cashless_garages_insurers WHERE insurer = '{$insurer_code}' AND count > 0;" );

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);

          if($templateName == 'taxonomy-health-insurer.php' || $templateName == 'taxonomy-bike-insurer.php' || $templateName == 'taxonomy-car-insurer.php'){
            $vertical_articles_category = $theme_settings_vertical['vertical_articles_category'];
            $calculators = $theme_settings_vertical['calculator_quick_links'];
          }else{
            $calculators = null;
          }
        }
    }
    /* Theme Settings - end */
      
    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }

    $posts_found = 0;
    $totalPlans = 0;
    $totalTopupPlans = 0;

    if($templateName == 'taxonomy-health-insurer.php' || $templateName == 'taxonomy-bike-insurer.php' || $templateName == 'taxonomy-car-insurer.php'){

      /* Article - start */
      $latest_articles_args = [
        'post_type'      => 'post',
        'orderby'        => 'date',
        'order'          => 'DESC',
        's'              => $insurer_display_name." ".$vertical_name,
        'post_status'    => 'publish'
      ];
      if($vertical_articles_category){
        $latest_articles_args['s'] = $insurer_display_name;
        $latest_articles_args['tax_query'] = [
          'relation' => 'AND',
          [
              'taxonomy' => 'category',
              'field'    => 'slug',
              'terms'    => [$vertical_articles_category]
          ]
        ];
      }
      $totalArticles = new WP_Query($latest_articles_args);
      $posts_found = $totalArticles->post_count;
      /* Articles - End */

      /* Plans - start */
      $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));
      $post_type = $convertedVerticalName."-plan";
      $taxonomy_insurer = $convertedVerticalName."-insurer"; /* Vertical Slug Change */

      $plans_args = array(
        'post_type' =>  $post_type,
        'post_status' => 'publish',
        'posts_per_page'  => -1,
        'orderby' => array(
          'meta_value_num' => 'DESC', // Sort by the meta value in descending order
          'title' => 'ASC', // Sort titles in ascending order
        ),
        'meta_key' => 'plan_top', // Top plans
        'tax_query' => array(
          'relation'  => 'AND',
            array(
                'taxonomy' => $taxonomy_insurer,
                'field' => 'slug',
                'terms' =>$term_slug,
            ),
            array(
              'taxonomy' => 'plan-type',
              'field' => 'slug',
              'terms' => 'top-up',
              'operator' => 'NOT IN',
            )
        ),
      );

      $insurance_plans = new WP_Query($plans_args);

      $totalPlans = $insurance_plans->found_posts;

      $topup_plans_args = $plans_args;

      $topup_plans_args['tax_query'][] = 
      array(
        'taxonomy' => 'plan-type',
        'field' => 'slug',
        'terms' => 'top-up',
      );

      $insurance_topup_plans = new WP_Query($plans_args);

      $totalTopupPlans = $insurance_topup_plans->found_posts;
      /* Plans - end */

      /* Fetures & exclusion - start */
      $insurer_features = get_field("insurer_features", $term);
      $insurer_exclusions = get_field("insurer_exclusions", $term);
      /* Fetures & exclusion - end */

      // Renewal section
      $insurer_renewal_process = get_field('insurer_renewal_process', $term);

      // Cashless & reimbursement claims
      $insurer_cashless_claims = get_field('insurer_cashless_claims', $term);
      $insurer_reimbursement = get_field('insurer_reimbursement', $term);

      // Phone & email
      $insurer_phone_no = get_field('insurer_phone_no', $term);
      $insurer_email = get_field('insurer_email', $term);

      // Claim settlement ratio
      $insurer_claim_settlement_ratio = get_field('insurer_claim_settlement_ratio', $term);

      /* FAQs - start */
      $insurer_faqs = get_field('insurer_faqs', $term);
      if ($insurer_faqs) {
        foreach ($insurer_faqs as $index => $faq) {
            if (empty($faq['insurer_faq_title']) || empty($faq['insurer_faq_description'])) {
                unset($insurer_faqs[$index]);
            }
        }
      }
      /* FAQs - End */
    }
  ?>

  <section class="tm-secondary-nav mt-0">
      <div class="alignfull is-layout-flow">
          <div class="has-global-padding is-layout-constrained">
              <div class="alignwide">
              <nav class="nav-horizontal-scroll">
                <ul class="nav-horizontal-scroll-list">

                  <li class="menu-item nav-active"><a class="text-truncate" style="max-width: 100px;" href="#top" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance"); ?>" onclick="tmClickEvent('Navbar CTA <?php echo $insurer_display_name; ?>', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')"><?php echo $insurer_display_name; ?></a></li>

                  <?php if($totalPlans != 0):?>
                    <li class="menu-item"><a href="#plans" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Plans"); ?>" onclick="tmClickEvent('Navbar CTA Plans', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Plans</a></li>
                  <?php endif;?>

                  <?php if($templateName =='taxonomy-bike-insurer.php' || $calculators || $templateName == 'taxonomy-car-insurer.php'): ?>
                    <li class="menu-item"><a href="#premium-calculator" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance premium calculator"); ?>" onclick="tmClickEvent('Navbar CTA Premium Calculator', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Premium Calculator</a></li>
                  <?php endif;?>

                  <?php if($insurer_features): ?>
                    <li class="menu-item"><a href="#features" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance features"); ?>" onclick="tmClickEvent('Navbar CTA Features', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Features</a></li>
                  <?php endif;?>

                  <?php if($insurer_exclusions): ?>
                    <li class="menu-item"><a href="#exclusions" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Exclusions"); ?>" onclick="tmClickEvent('Navbar CTA Exclusions', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Exclusions</a></li>
                  <?php endif;?>

                  <?php if($insurer_renewal_process): ?>
                    <li class="menu-item"><a href="#renewal" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance renewal process"); ?>" onclick="tmClickEvent('Navbar CTA Renewal', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Renewal</a></li>
                  <?php endif;?>

                  <?php if($insurer_cashless_claims || $insurer_reimbursement): ?>
                    <li class="menu-item"><a href="#claims" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance claims process"); ?>" onclick="tmClickEvent('Navbar CTA Claims', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Claims</a></li>
                  <?php endif;?>

                  <?php if($insurer_phone_no || $insurer_email): ?>
                    <li class="menu-item"><a href="#customer-care" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance customer care contact"); ?>" onclick="tmClickEvent('Navbar CTA Customer Care', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Customer Care</a></li>
                  <?php endif;?>

                  <?php if( $templateName =='taxonomy-health-insurer.php' ) { ?>
                    <?php if($hospitals) { ?>
                      <li class="menu-item"><a href="#nh-search-box" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Network Hospitals"); ?>" onclick="tmClickEvent('Navbar CTA Network Hospitals', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Network Hospitals</a></li>
                    <?php } ?>
                  <?php } ?>

                  <?php if($templateName =='taxonomy-car-insurer.php' ) { ?>
                    <?php if($garages) { ?>
                    <li class="menu-item"><a href="#nh-search-box" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Cashless Garages"); ?>" onclick="tmClickEvent('Navbar CTA Cashless Garages', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Cashless Garages</a></li>
                    <?php } ?>
                  <?php } ?>

                  <?php if($insurer_claim_settlement_ratio || $templateName =='taxonomy-health-insurer.php' || $insurer_faqs || $templateName =='taxonomy-bike-insurer.php' || $templateName == 'taxonomy-car-insurer.php' || $posts_found != 0): ?>
                  <li class="menu-item has-dropdown">
                    <a class="dropdown">More<i class="icon tm-sprite-3-before bg-chevron-down"></i></a>
                    <div class="dropdown-expand">
                      <ul>

                      <?php if($insurer_claim_settlement_ratio):?>
                        <li class="menu-item"><a href="#claim-settlement-ratio" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance claim settlement ratio"); ?>" onclick="tmClickEvent('Navbar CTA Claim Settlement Ratio', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Claim Settlement Ratio</a></li>
                      <?php endif;?>
                      
                      <?php if($templateName =='taxonomy-health-insurer.php' && $totalTopupPlans != 0):?>
                        <li class="menu-item"><a href="#top-ups" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance top-up plans"); ?>" onclick="tmClickEvent('Navbar CTA Top-up Plans', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Top-up Plans</a></li>
                      <?php endif;?>

                      <?php if($insurer_faqs):?>
                        <li class="menu-item"><a href="#faqs" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance FAQs"); ?>" onclick="tmClickEvent('Navbar CTA FAQs', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">FAQs</a></li>
                      <?php endif; ?>

                      <?php if($templateName =='taxonomy-bike-insurer.php' || $templateName == 'taxonomy-car-insurer.php'):?>
                        <li class="menu-item"><a href="#add-ons" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Add-ons"); ?>" onclick="tmClickEvent('Navbar CTA Add-ons', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Add-ons</a></li>
                      <?php endif;?>

                      <?php if($posts_found != 0):?>
                      <li class="menu-item"><a href="#articles" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Articles"); ?>" onclick="tmClickEvent('Navbar CTA Articles', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>')">Articles</a></li>
                      <?php endif;?>

                      </ul>
                    </div>
                  </li>
                  <?php endif;?>

                </ul>
              </nav>
              </div>
          </div>
          <div class="tm-secondary-nav-seperator"></div>
      </div>
  </section>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_secondary_navbar', 'tmSecondaryNavbar');
?>
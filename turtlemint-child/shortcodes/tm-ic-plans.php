<?php
function tmPlans($atts){

	$atts = shortcode_atts( array(
    "subtype" => '',
    'limit' => -1,
    'vertical' => 'health',
    'tag' => ''
  ), $atts, 'tm_ic_plans' );

  ob_start();?>

  <?php
    $plan_subtype = $atts['subtype'];
    
    $elementLimit = $atts['limit'];

    $vertical = $atts['vertical'];

    $plan_tag = $atts['tag'];

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

    $taxonomy_slug = $term->taxonomy;
    $term_slug = $term->slug;
    
    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
        }
    }
    /* Theme Settings - end */

    $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));
    $insurer_url = get_term_link($term->slug, $convertedVerticalName.'-insurer');
    $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $ancillaryCtaLink = $insurer_url.'plans/';

    global $template;
    $templateName = basename($template);
  ?>

    <?php
    $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));
    $post_type = $convertedVerticalName."-plan";
    $taxonomy_insurer = $convertedVerticalName."-insurer"; /* Vertical Slug Change */

    $plans_args = array(
      'post_type' =>  $post_type,
      'post_status' => 'publish',
      'posts_per_page'  => $elementLimit,
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
      ),
    );

    // Top-up Plans
    if($plan_subtype == 'top-up'){
      $plans_args['tax_query'][] = 
        array(
          'taxonomy' => 'plan-type',
          'field' => 'slug',
          'terms' => 'top-up',
        );
    }else{
      $plans_args['tax_query'][] =
      array(
        'taxonomy' => 'plan-type',
        'field' => 'slug',
        'terms' => 'top-up',
        'operator' => 'NOT IN',
      );
    }

    // Critical Illness Plans
    if($plan_tag != '' && $plan_tag != null && $convertedVerticalName){
      $plans_args['tax_query'][] = 
      array(
        'taxonomy' => $convertedVerticalName.'-tag',
        'field' => 'slug',
        'terms' => $plan_tag,
      );
    }

    $insurance_plans = new WP_Query($plans_args);

    $totalPlans = $insurance_plans->found_posts;
  ?>

  <?php if($totalPlans > 0): ?>
    <section id="<?php if($plan_subtype == 'top-up'): echo "top-ups"; else: echo "plans"; endif; ?>" class="highlight-section has-empty-p <?php if($plan_subtype == 'top-up'): echo "top-ups-section"; else: echo "plans-section"; endif; ?> tm-container description tm-plans <?php if($plan_subtype == 'top-up'): echo "has-turtlemint-child-tm-light-purple-background-color"; else: echo "has-turtlemint-child-tm-light-green-background-color"; endif; ?>">

      <?php
          $plans_args['posts_per_page'] = -1;
          $insurance_plans_all = new WP_Query($plans_args);
          if ( $insurance_plans_all->have_posts() ) {
            $premiums = [];
            $minimumSI = [];
            $maximumSI = [];
            while ($insurance_plans_all->have_posts()){
              $insurance_plans_all->the_post();
                $premiums[] = get_field('plan_starting_premium');
                $minimumSI[] = get_field('plan_coverage_minimum');
                $maximumSI[] = get_field('plan_coverage_maximum');
            }
            $smallestPremium = findSmallestNumber($premiums);
            $smallestMinimumSI = findSmallestNumber($minimumSI);
            $largestMaximumSI = findLargestNumber($maximumSI);
          }
          wp_reset_query();
        ?>
      <?php if($plan_subtype == 'top-up'): ?>
        <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords($insurer_display_name." Top-up Plans"); ?></h2>
        <div class="tm-container__content">
          <p><?php echo ucwords($insurer_display_name)." ". strtolower($vertical_name); ?> insurance provides <?php echo $totalPlans; ?> top-up <?php if($totalPlans == 1): echo "plan."; else: echo "plans."; endif; ?><?php if($smallestPremium): ?> The premium of these top-up plans start from <?php echo "Rs. ".number_format($smallestPremium)."/yr."; ?><?php endif;?><?php if($smallestMinimumSI && $largestMaximumSI):?> The sum insured ranges from <?php echo "Rs. ".convertNumber($smallestMinimumSI)." - ".convertNumber($largestMaximumSI)."."; ?><?php endif;?><?php echo " ".ucwords($insurer_display_name);?> top-up plans provide enhanced coverage and added protection for your well-being. Explore the details of each <?php echo ucwords($insurer_display_name);?> top-up insurance policy below:</p>
        </div>
        <?php
          $ajaxContainer = 'tm-plans-list-top-up'; 
          $linkText = 'Top-Ups';
        ?>

      <?php else: ?>
        <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Plans Overview"); ?></h2>
        <div class="tm-container__content">
          <?php
            if ($vertical == 'bike') {

              echo "<p>".$insurer_display_name." bike insurance offers ".$totalPlans." types of bike insurance plans: ";

              if($insurance_plans->have_posts()){
                while ($insurance_plans->have_posts()){
                  $insurance_plans->the_post();
                  $planTitles[] = get_the_title();
                }
              }

              echo implode(', ', array_slice($planTitles, 0, -1)) . ' and ' . end($planTitles) . '. ';

              echo "The premium of these plans start from Rs. ".$smallestPremium . "/yr. The coverage under ".$insurer_display_name." two wheeler bike insurance would depend on the type of policy you choose, check the details below:</p>";

            } else {
                echo "<p>".$insurer_display_name . " " . strtolower($vertical_name) . " insurance offers " . $totalPlans . " " . strtolower($vertical_name) . " insurance ";
                if ($totalPlans == 1) {
                    echo "plan.";
                } else {
                    echo "plans.";
                }
                if ($smallestPremium) {
                    echo " The premium of these plans starts from Rs. " . $smallestPremium . "/yr.";
                }
                if ($smallestMinimumSI && $largestMaximumSI) {
                    echo " The sum insured ranges from Rs. " . convertNumber($smallestMinimumSI) . " - " . convertNumber($largestMaximumSI) . ".";
                }
                echo " Details of the comprehensive coverage provided by the following " . $totalPlans . " " . $insurer_display_name . " " . strtolower($vertical_name) . " insurance ";
                if ($totalPlans == 1) {
                    echo "plan is";
                } else {
                    echo "plans are";
                }
                echo " listed below:</p>";
            }
          ?>
        </div>
        <?php
          $ajaxContainer = 'tm-plans-list'; 
          $linkText = 'Plans';
        ?>

      <?php endif; ?>

      <?php
        if ( $insurance_plans->have_posts() ) {?>
          <div class="tm-plans-list" id="<?php echo $ajaxContainer ?>">
            <?php while ($insurance_plans->have_posts()) {
                $insurance_plans->the_post();
                if($vertical == "bike" || $vertical == "car"){
                  get_template_part( 'parts/card', 'plan-with-cta', [
                    'plan_subtype'  => $plan_subtype,
                    'insurer' => $insurer_display_name,
                    'vertical'  => $vertical_name
                  ] );
                }else{
                  get_template_part( 'parts/card', 'plan', [
                    'plan_subtype'  => $plan_subtype,
                    'insurer' => $insurer_display_name,
                    'vertical'  => $vertical_name
                  ] );
                }
            }?>
          </div>
          <div class="tm-loader dots"></div>
          <?php
            if($plan_subtype == 'top-up'): 
              $eventAction =  'View all top-ups'; 
            else: 
              $eventAction = 'View all plans'; 
            endif;

            $vertical_name_category = tm_event_category();
          ?>
          <div class="cta-links">
            <?php if($insurer_url && $vertical_name == 'Health' && $currentUrl != $ancillaryCtaLink && $templateName == 'taxonomy-health-insurer.php'):?>
                <p class="tm-link mb-0 d-inline-flex"><a href="<?php echo $ancillaryCtaLink; ?>" class="icon-link" title="<?php echo 'Learn more about '.$insurer_display_name.' '.$vertical_name_category.' insurance plans'; ?>"><span><?php echo ucwords('Learn more'); ?></span><i class="tm-sprite-1 bg-chevron-right-green"></i></a></p>
            <?php endif; ?>
            <?php if($insurance_plans->max_num_pages > 1): ?>
              <p class="tm-link d-inline-flex mb-0 viewAllPost" data-taxonomy="<?php echo $taxonomy_slug; ?>" data-term="<?php echo $term_slug; ?>" <?php if($plan_subtype): ?>data-subtype="<?php echo $plan_subtype; ?>"<?php endif; ?> <?php if($plan_tag): echo 'data-tag="'.$plan_tag.'"'; endif; ?> data-ajaxcontainer="<?php echo $ajaxContainer; ?>" data-allvisible="false" data-posttype="<?php echo $post_type; ?>" data-planscount="<?php echo $elementLimit; ?>" data-displayname="<?php echo $insurer_display_name; ?>" data-verticalname="<?php echo $vertical_name; ?>" title="<?php echo ucwords("View all ".$insurer_display_name." ".$vertical_name." Insurance Plans"); ?>">
              <a class="icon-link" onclick="tmClickEvent('<?php echo $eventAction; ?>', '<?php echo $vertical_name_category; ?>', '<?php echo $insurer_display_name; ?>')" data-eventaction ="<?php echo $eventAction; ?>" data-eventCategory ="<?php echo $vertical_name_category; ?>" data-eventLabel="<?php echo $insurer_display_name; ?>"><span>View All <?php echo $linkText; ?></span><i class="tm-sprite-1 bg-chevron-down-green"></i></a></p>
            <?php endif; ?>
          </div>

        <?php }
        wp_reset_query();
      ?>

    </section>
  <?php endif;?>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_plans', 'tmPlans');
?>
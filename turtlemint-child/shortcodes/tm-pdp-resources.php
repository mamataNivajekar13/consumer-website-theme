<?php
function tmPdpResources($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_pdp_resources' );

  ob_start();?>

  <?php
    $vertical_name_category = tm_event_category();

    if(is_single()){
      if(get_query_var( 'health-insurer' )){
        $tax_slug = (get_query_var( 'health-insurer' ));
        $term_queried_object = get_term_by('slug', $tax_slug, 'health-insurer');
      }
      if($term_queried_object){
        if(get_field('insurer_name', $term_queried_object)){
          $insurer_title = ucwords(get_field('insurer_name', $term_queried_object));
        }else{
          $insurer_title = ucwords($term_queried_object->name);
        }
      }
      $tm_plan_data = tm_plan_data();
      $title = $tm_plan_data['plan_title'];
    }elseif(is_tax()){
      $term_queried_object = get_queried_object();
      if(get_field('insurer_name', $term_queried_object)){
        $title = ucwords(get_field('insurer_name', $term_queried_object));
      }else{
          $title = ucwords($term_queried_object->name);
      }
    }

    // Data
    $plan_resources =  $tm_plan_data['plan_resources'];
    $plan_brochure =  $tm_plan_data['plan_brochure'];
  ?>

    <?php if(isset($plan_resources) && $plan_resources != false && count($plan_resources)>0):?>
      <section class="highlight-section tm-container bordered wp-block-group alignfull is-layout-flow tm-gradient-top-right light-yellow highlight-section" id="brochure">
        <div class="tm-container__content">
          <?php echo '<h2 class="section-heading has-turtlemint-child-tm-x-large-font-size">'.$insurer_title.' '.$title.' plan resources</h2>'; ?>
          <div class="pdp-resources-list">
            <?php if($plan_brochure):?>
              <div class="pdp-resources-list__item">
                <p class="title mb-0 has-turtlemint-child-black-color">Policy Brochure</p>
                <button class="wp-block-button tm-button small download-button"><a class="wp-block-button__link wp-element-button" href="<?php echo $plan_brochure; ?>" target="_blank" onclick="tmClickEvent('Download resources', '<?php echo $vertical_name_category; ?>', '<?php echo $insurer_title; ?>', '<?php echo $title; ?>', '<?php echo 'Policy Brochure'; ?>')">Download<i class="d-md-none tm-sprite-1 bg-download"></i></a></button>
              </div>
            <?php endif; ?>
            <?php foreach($plan_resources as $resource):?>
              <?php if($resource['title'] && $resource['link']):?>
                <div class="pdp-resources-list__item">
                  <p class="title mb-0 has-turtlemint-child-black-color"><?php echo $resource['title'] ?></p>
                  <button class="wp-block-button tm-button small download-button"><a class="wp-block-button__link wp-element-button" href="<?php echo $resource['link'] ?>" target="_blank" onclick="tmClickEvent('Download resources', '<?php echo $vertical_name_category; ?>', '<?php echo $insurer_title; ?>', '<?php echo $title; ?>', '<?php echo $resource['title']; ?>')">Download<i class="d-md-none tm-sprite-1 bg-download"></i></a></button>
                </div>
              <?php endif;?>
            <?php endforeach;?>
          </div>
        </div>
      </section>
    <?php endif;?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_pdp_resources', 'tmPdpResources');
?>
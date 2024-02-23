<?php
function tmIcAddOns($atts){

	$atts = shortcode_atts( array(
    'type' => '',
    'limit' => 3,
    'vertical' => ''
  ), $atts, 'tm_ic_add_ons' );

  ob_start();?>

  <?php

    $type = $atts['type'];
    $vertical = $atts['vertical'];

    if($type == "hospital") {
      $tax_slug = (get_query_var( 'health-ic' ));
      $term = get_term_by('slug', $tax_slug, 'health-insurer');
      $taxonomy_slug = $term->taxonomy;
    } else {
      $term = get_queried_object();
      $taxonomy_slug = $term->taxonomy;
    }

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

    $insurer_add_ons = get_field('insurer_add_ons', $term);

    $vertical_name_category = tm_event_category();
  ?>

  <?php if($insurer_add_ons):?>
    <section id="add-ons" class="highlight-section wp-block-group alignfull is-layout-flow tm-ic-add-ons">
      <div class="wp-block-group has-global-padding is-layout-constrained">
          <div class="alignwide">
            <div class="tm-container has-turtlemint-child-tm-light-green-background-color">
              <?php if($vertical == "bike"){?>
                <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Add-ons available under ".$insurer_display_name." two wheeler Insurance Plans"); ?></h2>
                <?php }else{ ?>
                  <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Add-ons available under ".$insurer_display_name." ".$vertical_name." Insurance Plans"); ?></h2>
                <?php }?>

              <div class="tm-container__content">
                <?php
                  if($vertical == "bike"){
                    echo "<p>Add-ons are additional coverage benefits which can be chosen voluntarily by paying an additional premium. Add-ons help increase the scope of coverage of the bike insurance policy. ".$insurer_display_name." two wheeler insurance plans offer the following types of add-ons with the comprehensive policy:</p>";
                  }else{
                    echo "<p>Add-ons are additional coverage benefits which can be chosen voluntarily by paying an additional premium. Add-ons help increase the scope of coverage of the ".$vertical_name." insurance policy. ".$insurer_display_name." ".$vertical_name." insurance plans offer the following types of add-ons with the comprehensive policy:</p>";
                  }
                ?>
              </div>

              <?php 
                $elementLimit = $atts['limit'];
                $totalElements = count($insurer_add_ons);
                if($totalElements > $elementLimit){
                  $insurer_add_ons_set1 = array_slice($insurer_add_ons, 0, $elementLimit);
                  $insurer_add_ons_set2 = array_slice($insurer_add_ons, $elementLimit);
                ?>

                <div class="tm-accordion-style2 <?php if($totalElements > $elementLimit): echo "viewMoreContainer";endif;?>" id="tmAccordion-add-ons" style="margin-bottom:16px">
                  <?php foreach ($insurer_add_ons_set1 as $key => $insurer_add_on):?>
                    <?php
                      $insurer_add_on_title = $insurer_add_on['insurer_add_on_title'];
                      $insurer_add_on_description = $insurer_add_on['insurer_add_on_description'];
                    ?>
                    <div class="tm-accordion-item">
                        <p class="tm-accordion-header mb-0" id="heading-add-on-<?php echo $key;?>">
                            <button class="tm-sprite-3-after tm-accordion-button <?php if($key == 0): echo "bg-chevron-up collapse"; else: echo "bg-chevron-down collapsed"; endif; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-add-on-<?php echo $key;?>" aria-expanded="true" aria-controls="collapse-add-on-<?php echo $key;?>" data-eventcategory="<?php echo ucwords($vertical_name_category); ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." insurance ".$insurer_add_on_title." add-on description"); ?>">
                                <h2 class="mb-0 has-turtlemint-child-medium-font-size"><?php echo $insurer_add_on_title; ?></h2>
                            </button>
                        </p>
                        <div id="collapse-add-on-<?php echo $key;?>" class="tm-accordion-collapse collapse <?php if($key == 0): echo "show"; endif;?>" aria-labelledby="heading-add-on-<?php echo $key;?>">
                            <div class="tm-accordion-body">
                                <div class="tm-accordion-body__wraper">
                                    <?php echo $insurer_add_on_description;?>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php endforeach;?>
                  <?php foreach ($insurer_add_ons_set2 as $key => $insurer_add_on):?>
                    <?php
                      $insurer_add_on_title = $insurer_add_on['insurer_add_on_title'];
                      $insurer_add_on_description = $insurer_add_on['insurer_add_on_description'];
                    ?>
                    <div class="tm-accordion-item view-more-hidden">
                        <p class="tm-accordion-header mb-0" id="heading-add-on-hid<?php echo $key;?>">
                            <button class="tm-sprite-3-after tm-accordion-button bg-chevron-down collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-add-on-hid<?php echo $key;?>" aria-expanded="false" aria-controls="collapse-add-on-hid<?php echo $key;?>" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." insurance ".$insurer_add_on_title." add-on description"); ?>">
                                <h2 class="mb-0 has-turtlemint-child-medium-font-size"><?php echo $insurer_add_on_title; ?></h2>
                            </button>
                        </p>
                        <div id="collapse-add-on-hid<?php echo $key;?>" class="tm-accordion-collapse collapse" aria-labelledby="heading-add-on-hid<?php echo $key;?>">
                            <div class="tm-accordion-body">
                                <div class="tm-accordion-body__wraper">
                                    <?php echo $insurer_add_on_description;?>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php endforeach;?>
                </div>

                <div class="cta-links">
                  <p class="tm-link viewMoreLink mb-0 d-inline-flex" data-eventaction="All add-ons" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" onclick="tmClickEvent('All add-ons', '<?php echo $vertical_name_category; ?>', '<?php echo $insurer_display_name; ?>')">
                    <a class="icon-link" title="<?php echo ucwords("View more ".$insurer_display_name." ".$vertical_name." insurance add-ons"); ?>"><span>View More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a>
                  </p>
                </div>

              <?php }else{ ?>

                <div class="tm-accordion-style2" id="tmAccordion-add-ons">
                  <?php foreach ($insurer_add_ons as $key => $insurer_add_on):?>
                      <?php
                        $insurer_add_on_title = $insurer_add_on['insurer_add_on_title'];
                        $insurer_add_on_description = $insurer_add_on['insurer_add_on_description'];
                      ?>
                      <div class="tm-accordion-item <?php if($key == ($totalElements - 1)): echo "mb-0"; endif;?>">
                          <p class="tm-accordion-header mb-0" id="heading-add-on-<?php echo $key;?>">
                              <button class="tm-sprite-3-after tm-accordion-button <?php if($key == 0): echo "bg-chevron-up collapse"; else: echo "bg-chevron-down collapsed"; endif; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-add-on-<?php echo $key;?>" aria-expanded="true" aria-controls="collapse-add-on-<?php echo $key;?>" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." insurance ".$insurer_add_on_title." add-on description"); ?>">
                                  <h2 class="mb-0 has-turtlemint-child-medium-font-size"><?php echo $insurer_add_on_title; ?></h2>
                              </button>
                          </p>
                          <div id="collapse-add-on-<?php echo $key;?>" class="tm-accordion-collapse collapse <?php if($key == 0): echo "show"; endif;?>" aria-labelledby="heading-add-on-<?php echo $key;?>">
                              <div class="tm-accordion-body">
                                  <div class="tm-accordion-body__wraper">
                                      <?php echo $insurer_add_on_description;?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php endforeach;?>
                </div>

              <?php } ?>

              <script type="text/javascript">
                // FAQ
                if(document.getElementById('tmAccordion-add-ons')){
                    document.getElementById('tmAccordion-add-ons').addEventListener('hide.bs.collapse', event => {
                        $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-up').addClass('bg-chevron-down');
                    })
                    document.getElementById('tmAccordion-add-ons').addEventListener('show.bs.collapse', event => {
                        $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-down').addClass('bg-chevron-up');
                        let button = $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button');
                        let eventAction = 'Read add-on description';
                        let buttonText = button.text().replace(/\s+/g, ' ').trim();
                        let eventCategory = button.data('eventcategory');
                        let eventLabel = button.data('eventlabel');
                        tmClickEvent(eventAction, eventCategory, eventLabel, buttonText);
                      });
                }
              </script>

            </div>
          </div>
      </div>
    </section>
  <?php endif;?>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_add_ons', 'tmIcAddOns');
?>
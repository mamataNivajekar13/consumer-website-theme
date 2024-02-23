<?php
function tmIcFaqs($atts){

	$atts = shortcode_atts( array(
    "limit" => 3,
  ), $atts, 'tm_ic_faqs' );

  ob_start();?>

  <?php

    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
      }
    }

    $taxonomy_slug = $term->taxonomy;

    /* Theme Settings - start */
    $taxonomy_slug = $term->taxonomy;
    $theme_settings_verticals = get_field('verticals', 'option');
    $vertical_name = null;
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
    $insurer_faqs = get_field('insurer_faqs', $term);

    if ($insurer_faqs) {
      foreach ($insurer_faqs as $index => $faq) {
          if (empty($faq['insurer_faq_title']) || empty($faq['insurer_faq_description'])) {
              unset($insurer_faqs[$index]);
          }
      }
    }

    $vertical_name_category = tm_event_category();
  ?>

  <?php if($insurer_faqs):?>
    <section id="faqs" class="highlight-section wp-block-group alignfull is-layout-flow tm-ic-faqs mb-0">
      <div class="wp-block-group has-global-padding is-layout-constrained">
          <div class="alignwide">
            <div class="tm-container bordered">
              <p class="section-heading has-turtlemint-child-tm-x-large-font-size mb-0"><?php echo ucwords("FAQs"); ?></p>

              <?php if($insurer_faqs):?>
              <?php 
                $elementLimit = $atts['limit'];
                $totalElements = count($insurer_faqs);
                if($totalElements > $elementLimit){
                  $insurer_faqs_set1 = array_slice($insurer_faqs, 0, $elementLimit);
                  $insurer_faqs_set2 = array_slice($insurer_faqs, $elementLimit);
              ?>
              <div class="tm-accordion <?php if($totalElements > $elementLimit): echo "viewMoreContainer";endif;?> " id="tmAccordion-icfaqs" style="margin-bottom:16px">
                <?php foreach ($insurer_faqs_set1 as $key => $insurer_add_on):?>
                  <?php
                    $insurer_faq_title = $insurer_add_on['insurer_faq_title'];
                    $insurer_faq_description = $insurer_add_on['insurer_faq_description'];
                  ?>
                  <div class="tm-accordion-item">
                      <p class="tm-accordion-header" id="heading-icfaq-<?php echo $key;?>">
                          <button class="tm-sprite-3-after bg-chevron-down tm-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-icfaq-<?php echo $key; ?>" aria-expanded="false" aria-controls="collapse-icfaq-<?php echo $key; ?>" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>">
                              <?php echo $insurer_faq_title; ?>
                          </button>
                      </p>
                      <div id="collapse-icfaq-<?php echo $key; ?>" class="tm-accordion-collapse collapse" aria-labelledby="heading-icfaq-<?php echo $key;?>" data-bs-parent="#tmAccordion-icfaq-<?php echo $key; ?>">
                          <div class="tm-accordion-body">
                              <div class="tm-accordion-body__wraper has-turtlemint-child-tm-medium-font-size">
                                  <?php echo $insurer_faq_description; ?>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php endforeach;?>
                <?php foreach ($insurer_faqs_set2 as $key => $insurer_add_on):?>
                  <?php
                    $insurer_faq_title = $insurer_add_on['insurer_faq_title'];
                    $insurer_faq_description = $insurer_add_on['insurer_faq_description'];
                  ?>
                  <div class="tm-accordion-item view-more-hidden">
                      <p class="tm-accordion-header" id="heading-icfaq-hid-<?php echo $key;?>">
                          <button class="tm-sprite-3-after bg-chevron-down tm-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-icfaq-hid-<?php echo $key; ?>" aria-expanded="false" aria-controls="collapse-icfaq-hid-<?php echo $key; ?>" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>">
                              <?php echo $insurer_faq_title; ?>
                          </button>
                      </p>
                      <div id="collapse-icfaq-hid-<?php echo $key; ?>" class="tm-accordion-collapse collapse" aria-labelledby="heading-icfaq-hid-<?php echo $key;?>" data-bs-parent="#tmAccordion-icfaq-hid-<?php echo $key; ?>">
                          <div class="tm-accordion-body">
                              <div class="tm-accordion-body__wraper has-turtlemint-child-tm-medium-font-size">
                                  <?php echo $insurer_faq_description; ?>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php endforeach;?>
              </div>
              <div class="cta-links">
                <p class="tm-link viewMoreLink mb-0 d-inline-flex">
                  <a class="icon-link" title="<?php echo ucwords("View more ".$insurer_display_name." FAQs"); ?>"><span>View More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a>
                </p>
              </div>
              <?php }else{ ?>
                <div class="tm-accordion" id="tmAccordion-icfaqs">
                  <?php foreach ($insurer_faqs as $key => $insurer_add_on):?>
                    <?php
                      $insurer_faq_title = $insurer_add_on['insurer_faq_title'];
                      $insurer_faq_description = $insurer_add_on['insurer_faq_description'];
                    ?>
                    <div class="tm-accordion-item <?php if($key == ($totalElements - 1)): echo "mb-0"; endif;?>">
                        <p class="tm-accordion-header" id="heading-icfaq-<?php echo $key;?>">
                            <button class="tm-sprite-3-after bg-chevron-down tm-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-icfaq-<?php echo $key; ?>" aria-expanded="false" aria-controls="collapse-icfaq-<?php echo $key; ?>" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>">
                                <?php echo $insurer_faq_title; ?>
                            </button>
                        </p>
                        <div id="collapse-icfaq-<?php echo $key; ?>" class="tm-accordion-collapse collapse" aria-labelledby="heading-icfaq-<?php echo $key;?>" data-bs-parent="#tmAccordion-icfaq-<?php echo $key; ?>">
                            <div class="tm-accordion-body">
                                <div class="tm-accordion-body__wraper has-turtlemint-child-tm-medium-font-size">
                                    <?php echo $insurer_faq_description; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php endforeach;?>
                </div>
              <?php } ?>
              <script type="text/javascript">
                // FAQ
                if(document.getElementById('tmAccordion-icfaqs')){
                    document.getElementById('tmAccordion-icfaqs').addEventListener('hide.bs.collapse', event => {
                        $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-up').addClass('bg-chevron-down')
                    })
                    document.getElementById('tmAccordion-icfaqs').addEventListener('show.bs.collapse', event => {
                        $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-down').addClass('bg-chevron-up')
                        let button = $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button');
                        let buttonText = button.text().replace(/\s+/g, ' ').trim();
                        let eventCategory = button.data('eventcategory');
                        let eventLabel = button.data('eventlabel');
                        tmClickEvent('FAQ', eventCategory, eventLabel, buttonText);
                    })
                }
              </script>
              <?php endif;?>
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

add_shortcode('tm_ic_faqs', 'tmIcFaqs');
?>
<?php
function tmCgStates($atts){

	$atts = shortcode_atts( 
    array(
      'type' => ''
    ), $atts, 'tm_cg_states' );

  ob_start();?>

  <?php

        $tax_slug = (get_query_var( 'car-ic' ));
        $term = get_term_by('slug', $tax_slug, 'car-insurer');
        $taxonomy_slug = $term->taxonomy;

        /* Theme Settings - start */
        $theme_settings_verticals = get_field('verticals', 'option');
        foreach ($theme_settings_verticals as $theme_settings_vertical) {
            $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];
            if($vertical_taxonomy_slug == $taxonomy_slug){
              $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
            }else{
              $vertical_name = ucwords($term->name);
            }
        }
        /* Theme Settings - end */

        if(get_field('insurer_name', $term)){
          $insurer_display_name = ucwords(get_field('insurer_name', $term));
        }else{
          $insurer_display_name = ucwords($term->name);
        }

        $insurer_code = ucwords(get_field('insurer_code', $term));
        $stateData = getCgCitiesByState($insurer_code);

        global $wpdb;
        $garage_count = $wpdb->get_var( "SELECT SUM(count) FROM {$wpdb->prefix}cashless_garages_insurers WHERE insurer='{$insurer_code}'" );
  ?>
    <?php if($stateData) { ?>
        <section id="states-list" class="highlight-section tm-container has-turtlemint-child-tm-light-yellow-background-color wp-block-group alignfull is-layout-flow tm-ic-calculator">
          <div class="wp-block-group has-global-padding is-layout-constrained">
              <div class="alignwide">
                <div class="wp-block-columns is-stacked-on-mobile mb-0">
                  <div class="wp-block-column" style="flex-basis: 65%;">
                    <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo $insurer_display_name.ucwords(" Cashless Garages in India"); ?></h2>
                  </div>
                  <div class="wp-block-column has-text-align-md-right" style="flex-basis: 35%;">
                    <div class="count-wrapper">Total Garages: <?php echo $garage_count;?></div>
                  </div>
                </div>
                <div class="tm-container__content mb-0">
                    <p>There are over <?php echo $garage_count;?> <?php echo ucwords($insurer_display_name); ?> cashless garages in India, this extensive network offers you the freedom to select the best service centers for your vehicle. The availability of cashless garages is an important factor to consider while buying motor insurance. Find the list of <?php echo ucwords($insurer_display_name); ?> cashless garages below:</p>
                    <form class="form-style-1">
                        <div class="field-group field-group-search">
                            <input size="40" class="" aria-required="true" aria-invalid="false" value="" type="text" name="state" placeholder="Search by State " style="background-color: #ffffff; border: 0" id="search-input">
                            <i class="tm-sprite-1 bg-search"></i>
                        </div>
                    </form>
                </div>
                <div class="tm-container has-turtlemint-child-white-background-color" style="padding-top: 0;padding-bottom: 0">
                    <div class="tm-accordion viewMoreContainer " id="tmAccordion-states">
                        <?php 
                            if (!empty($stateData)) { 
                                $count = 1;
                                foreach ($stateData as $data) { ?>
                                    <div class="tm-accordion-item">
                                        <p class="tm-accordion-header" id="heading-icstate-<?php echo $count;?>">
                                            <button class="tm-sprite-3-after bg-chevron-down tm-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-icstate-<?php echo $count;?>" aria-expanded="true" aria-controls="collapse-icstate-<?php echo $count;?>" title="<?php echo $insurer_display_name; ?> Car Insurance Cashless Garages List In <?php echo ucwords($data['state']);?>" data-eventcategory="CG-India" data-eventlabel="<?php echo $insurer_display_name; ?>">
                                                <?php echo ucwords($data['state']);?>
                                            </button>
                                        </p>
                                        <div id="collapse-icstate-<?php echo $count;?>" class="tm-accordion-collapse collapse" aria-labelledby="heading-icstate-<?php echo $count;?>" data-bs-parent="#tmAccordion-states">
                                            <div class="tm-accordion-body">
                                                <div class="tm-accordion-body__wraper has-turtlemint-child-tm-medium-font-size">
                                                <?php
                                                    $cities = explode(',', $data['cities']);
                                                    foreach ($cities as $city) {?>
                                                        <a onclick="tmClickEvent('State city clicked', 'CG-India', '<?php echo $insurer_display_name; ?>', '<?php echo ucwords($city);?>')" title="<?php echo $insurer_display_name; ?>  Cashless Garages In <?php echo ucwords($city);?>" href="<?php echo get_site_url().'/car-insurance/'.$tax_slug.'/cashless-garages/'.str_replace(' ', '-', $city).'/'?>"><?php echo ucwords($city);?></a>
                                                    <?php }
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $count++;
                                }
                            }
                            echo '<div id="no-results" style="display: none;"><div class="no-results-content"><i class="tm-sprite-2 bg-search-2"></i><p class="mb-0 mt-4">No results match "<span id="search-string"></span>".</p></div></div>';
                        ?>
                    </div>
                </div>
                <?php if(count($stateData) > 10) { ?>
                    <div id="view-more" class="cta-links view-more-states mt-3 active">
                        <p class="tm-link  mb-0 d-inline-flex">
                            <a class="icon-link" title="View all states">
                                <span>View More</span>
                                <i class="tm-sprite-1 bg-chevron-down-green"></i>
                            </a>
                        </p>
                    </div>
                <?php } ?>
                <div id="view-less" class="cta-links view-less-states mt-3" style="display: none;">
                    <p class="tm-link  mb-0 d-inline-flex">
                        <a class="icon-link" title="View less states">
                            <span>View Less</span>
                            <i class="tm-sprite-1 bg-chevron-up-green"></i>
                        </a>
                    </p>
                </div>
              </div>
          </div>
          <script>
            
            document.addEventListener('DOMContentLoaded', function () {

                if (document.getElementById('tmAccordion-states')) {
                    document.getElementById('tmAccordion-states').addEventListener('hide.bs.collapse', event => {
                        $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-up').addClass('bg-chevron-down')
                    })
                    document.getElementById('tmAccordion-states').addEventListener('show.bs.collapse', event => {
                        $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-down').addClass('bg-chevron-up')
                        let button = $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button');
                        let buttonText = button.text().replace(/\s+/g, ' ').trim();
                        let eventCategory = button.data('eventcategory');
                        let eventLabel = button.data('eventlabel');
                        tmClickEvent('State chevron clicked', eventCategory, eventLabel, buttonText);
                    })
                }

                const searchInput = document.getElementById('search-input');
                const accordionItems = document.querySelectorAll('.tm-accordion-item');
                const noResults = document.getElementById('no-results');
                const viewMore = document.getElementById('view-more');
                const viewLess = document.getElementById('view-less');
                searchInput.addEventListener('input', function () {
                    const searchTerm = searchInput.value.toLowerCase();
                    let foundResults = false;
                    let blockDivCount = 0;
                    const hiddenDiv = viewMore.classList.contains('active');
                    accordionItems.forEach((item) => {
                        const state = item.querySelector('.tm-accordion-button').textContent.toLowerCase();
                        if (state.includes(searchTerm)) {
                            if(!hiddenDiv) {
                                item.style.display = 'block';
                            } else {
                                if(blockDivCount < 10) {
                                    item.style.display = 'block';
                                } else {
                                    item.style.display = 'none';
                                }
                            }
                            item.classList.remove("d-none");
                            foundResults = true;
                            blockDivCount++;
                        } else {
                            item.classList.add("d-none");
                        }
                    });
                    
                    if (!foundResults) {
                        noResults.style.display = 'block';
                        viewMore.style.display = 'none';
                        viewLess.style.display = 'none';
                        document.getElementById("search-string").textContent = searchTerm;
                    } else {
                        if(blockDivCount < 10) {
                            viewMore.style.display = 'none';
                            viewLess.style.display = 'none';
                        } else {
                            if(hiddenDiv ) {
                                viewMore.style.display = 'block';
                            } else {
                                viewLess.style.display = 'block';
                            }
                        }
                        noResults.style.display = 'none';
                    }
                });
            });
          </script>
        </section>
    <?php } ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_cg_states', 'tmCgStates');
?>
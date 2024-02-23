<?php
function tmIcNhBanner($atts){

	$atts = shortcode_atts( array(
        'type' => '',
        'city' => '',
    ), $atts, 'tm_ic_nh_banner' );

  ob_start();?>

    <?php

        $type = $atts['type'];

        $tax_slug = (get_query_var( 'health-ic' ));
        $term = get_term_by('slug', $tax_slug, 'health-insurer');
        $insurer_logo = get_field('insurer_logo', $term);
        if(get_field('insurer_name', $term)){
            $insurer_display_name = ucwords(get_field('insurer_name', $term));
        }else{
            $insurer_display_name = ucwords($term->name);
        }

        $insurer_list = get_terms( array(
            'taxonomy' => 'health-insurer',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC',
            // 'exclude' => [$term->term_id]
        ));

        if($atts['type'] == 'nh-list') {
            $place = $atts['city'];
        } else {
            $place = 'India';
        }

        $theme_settings_verticals = get_field('verticals', 'option');
        $map_key = (current($theme_settings_verticals)['maps_key']);
        $vertical_name_category = tm_event_category();
    ?>

    <section id="top" class="highlight-section wp-block-group alignfull mt-0 mb-0 is-layout-flow tm-ic-banner tm-ic-nh-banner">
        <div class="wp-block-group has-global-padding is-layout-constrained">
            <div class="wp-block-columns alignwide">
                <div class="wp-block-column">
                    <?php 
                        global $template;
                        $templateName = basename($template);
                        if($templateName == 'tm-nh-hospitals-list.php'){
                            echo do_shortcode('[tm_nh_breadcrumb type="nh-list"]');
                        } elseif($templateName == 'ic-network-hospitals.php') {
                            echo do_shortcode('[tm_nh_breadcrumb type="custom"]');
                        } elseif($templateName == 'ic-renewal.php' || $templateName == 'ic-customer-care.php' || $templateName == 'ic-premium-calculator.php' || $templateName == 'ic-claim-settlement.php' || $templateName == 'ic-benefits.php' || $templateName == 'ic-critical-illness.php' || $templateName == 'ic-plans.php'){
                            echo do_shortcode('[tm_breadcrumb type="'.$type.'"]');
                        }
                    ?>
                </div>
            </div>
            <div class="wp-block-columns alignwide is-layout-flex justify-content-between banner-section">
                <div class="wp-block-column" style="flex-basis: 60%;">
                    <?php
                        if($atts['type'] == 'nh-list'){
                            echo '<h1 class="mb-0 insurer-title has-turtlemint-child-tm-xx-large-font-size">'.$insurer_display_name.' Health Insurance Hospital List in '.ucwords($place).'</h1>';
                        }elseif($atts['type'] == 'hospital' ){
                            echo '<h1 class="insurer-title has-turtlemint-child-tm-xx-large-font-size">'.$insurer_display_name.' Health Insurance Hospital List in '.ucwords($place).'</h1>';
                        }elseif($atts['type'] == 'renewal' || $atts['type'] == 'customer-care' || $atts['type'] == 'premium-calculator' || $atts['type'] == 'claim-settlement' || $atts['type'] == 'benefits' || $atts['type'] == 'plans'){
                            $pageTitle = strtolower(str_replace('-', ' ', $type));
                            echo '<h1 class="mb-0 has-turtlemint-child-tm-xx-large-font-size">'.ucwords($insurer_display_name.' Health Insurance '.$pageTitle).'</h1>';
                        }elseif($atts['type'] == 'critical-illness'){
                            $pageTitle = strtolower(str_replace('-', ' ', $type));
                            echo '<h1 class="mb-0 has-turtlemint-child-tm-xx-large-font-size">'.ucwords($insurer_display_name.' '.$pageTitle.' Plans').'</h1>';
                        }
                    ?>
                    <?php if($atts['type'] == 'hospital') {?>
                        <div class="highlight-section tm-container blurred-bg has-turtlemint-child-white-background-color pt-12">
                            <form class="form-style-1 nh-banner-searchform">
                                <div class="field-group field-group-search mb-0">
                                    <label for="city-name">Search Insurer</label>
                                    <i class="tm-sprite-1 bg-search" style="transform: unset;"></i>
                                    <?php 
                                        if ( !empty($insurer_list) ) :
                                            $output = '<select id="insurer-select" value="'. esc_attr( $tax_slug ) .'">';
                                            foreach( $insurer_list as $category ) {
                                                global $wpdb;
                                                $insurer_code = get_field('insurer_code', $category->taxonomy.'_'.$category->term_id);

                                                if(get_field('insurer_name', $category->term_id)){
                                                    $insurer_name = get_field('insurer_name', $category->taxonomy.'_'.$category->term_id);
                                                }else{
                                                    $insurer_name = ucwords($term->name);
                                                }
                                                
                                                $hospital_count = $wpdb->get_var( "SELECT SUM(count) FROM {$wpdb->prefix}cashless_hospitals_insurers WHERE insurer='{$insurer_code}'" );
                                                if($hospital_count > 0) {
                                                    if( $category->parent == 0 ) {
                                                        $output.= '<option data-url="'.get_term_link($category->slug, 'health-insurer').'" data-insurercode="'. $insurer_code.'" data-vertical="'.$vertical_name_category.'" data-icname="'.$insurer_display_name.'" data-insurername="'.$insurer_name.'"label="'. esc_attr( $category->name ) .'" '. (esc_attr( $tax_slug ) == esc_attr( $category->slug ) ? 'selected ' : '')  .'>';
                                                        $output.=$category->name.'</option>';
                                                    }
                                                }
                                            }
                                            $output.='</select>';
                                            echo $output;
                                        endif;
                                    ?>
                                </div>
                                <div class="field-group field-group-search mb-0">
                                    <p>
                                        <label for="city-name">Search Location</label>
                                        <span class="" style="position: relative" data-name="city-name">
                                            <input id="locationInput" size="40" class="" aria-required="true" aria-invalid="false" value="" type="text" name="city-name" placeholder="Search Location" data-vertical="<?php echo $vertical_name_category; ?>" data-icname="<?php echo $insurer_display_name;?>" onkeydown="return (event.keyCode!=13);">
                                            <i class="tm-sprite-1 bg-search"></i>
                                        </span>
                                    </p>
                                    <?php echo do_shortcode('[tm_ic_nh_popular_city type="hospital" page="NH-India" uitype="list"]'); ?>
                                </div>
                                
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <div class="wp-block-column text-md-end" style="flex-basis: 40%;">
                    <?php if($insurer_logo):?>
                      <img src="<?php echo $insurer_logo; ?>" class="insurer-logo" alt="<?php echo $insurer_display_name." Health Insurance Logo" ?>" title="<?php echo $insurer_display_name." Health Insurance Logo" ?>" height="136" width="221">
                    <?php endif; ?>
                </div>
            </div>
            <?php if($atts['type'] == 'hospital') {?>
                <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_key;?>&libraries=places"></script>
            <?php } ?>
        </div>
    </section>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_nh_banner', 'tmIcNhBanner');
?>
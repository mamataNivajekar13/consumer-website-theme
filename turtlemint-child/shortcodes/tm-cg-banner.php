<?php
function tmCgBanner($atts){

	$atts = shortcode_atts( array(
        'type' => '',
        'city' => '',
    ), $atts, 'tm_cg_banner' );

  ob_start();?>

    <?php

        $type = $atts['type'];

        $tax_slug = (get_query_var( 'car-ic' ));
        $city_name = (get_query_var( 'car-cg-city' ));
        $term = get_term_by('slug', $tax_slug, 'car-insurer');
        $insurer_logo = get_field('insurer_logo', $term);
        if(get_field('insurer_name', $term)){
            $insurer_display_name = ucwords(get_field('insurer_name', $term));
        }else{
            $insurer_display_name = ucwords($term->name);
        }

        $insurer_list = get_terms( array(
            'taxonomy' => 'car-insurer',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC'
        ));

        if($atts['type'] == 'cg-list') {
            $place = ucwords(str_replace('-', ' ', $city_name));
        } else {
            $place = 'India';
        }

        $theme_settings_verticals = get_field('verticals', 'option');
        $vertical_name_category = tm_event_category();
    ?>

    <section id="top" class="highlight-section wp-block-group alignfull mt-0 mb-0 is-layout-flow tm-ic-banner tm-ic-nh-banner">
        <div class="wp-block-group has-global-padding is-layout-constrained">
            <div class="wp-block-columns alignwide">
                <div class="wp-block-column">
                    <?php 
                        global $template;
                        $templateName = basename($template);
                        if($templateName == 'tm-cg-city-list.php'){
                            echo do_shortcode('[tm_cg_breadcrumb type="cg-list"]');
                        } 
                        if($templateName == 'tm-cg-network.php') {
                            echo do_shortcode('[tm_cg_breadcrumb type="custom"]');
                        } 
                    ?>
                </div>
            </div>
            <div class="wp-block-columns alignwide is-layout-flex justify-content-between banner-section">
                <div class="wp-block-column" style="flex-basis: 60%;">
                    <?php
                        if($atts['type'] == 'cg-list'){
                            echo '<h1 class="mb-0 insurer-title has-turtlemint-child-tm-xx-large-font-size">'.$insurer_display_name.' Cashless Garages List in '.ucwords($place).'</h1>';
                        } else {
                            echo '<h1 class="insurer-title has-turtlemint-child-tm-xx-large-font-size">'.$insurer_display_name.' Cashless Garages List</h1>';
                        }
                    ?>
                    <?php if($atts['type'] == 'garage') {?>
                        <div class="highlight-section tm-container blurred-bg has-turtlemint-child-white-background-color pt-12">
                            <form class="form-style-1 nh-banner-searchform">
                                <div class="field-group field-group-search mb-0">
                                    <label for="city-name">Search Insurer</label>
                                    <i class="tm-sprite-1 bg-search" style="transform: unset;"></i>
                                    <?php 
                                        if ( !empty($insurer_list) ) :
                                            $output = '<select id="cg-insurer-select" value="'. esc_attr( $tax_slug ) .'">';
                                            foreach( $insurer_list as $category ) {
                                                global $wpdb;
                                                $insurer_code = get_field('insurer_code', $category->taxonomy.'_'.$category->term_id);

                                                if(get_field('insurer_name', $category->term_id)){
                                                    $insurer_name = get_field('insurer_name', $category->taxonomy.'_'.$category->term_id);
                                                }else{
                                                    $insurer_name = ucwords($term->name);
                                                }
                                                
                                                $garage_count = $wpdb->get_var( "SELECT SUM(count) FROM {$wpdb->prefix}cashless_garages_insurers WHERE insurer='{$insurer_code}'" );
                                                if($garage_count > 0) {
                                                    if( $category->parent == 0 ) {
                                                        $output.= '<option data-url="'.get_term_link($category->slug, 'car-insurer').'" data-insurercode="'. $insurer_code.'" data-vertical="'.$vertical_name_category.'" data-icname="'.$insurer_display_name.'" data-insurername="'.$insurer_name.'"label="'. esc_attr( $category->name ) .'" '. (esc_attr( $tax_slug ) == esc_attr( $category->slug ) ? 'selected ' : '')  .'>';
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
                                        <label for="city-name">Search City</label>
                                        <span class="" style="position: relative" data-name="city-name">
                                            <input id="cgcityinput" size="40" class="" aria-required="true" aria-invalid="false" value="" type="text" name="city-name" placeholder="Search your city" data-vertical="<?php echo $vertical_name_category; ?>" data-icname="<?php echo $insurer_display_name;?>" autocomplete="off" onkeydown="return (event.keyCode!=13);">
                                            <i class="tm-sprite-1 bg-search"></i>
                                        </span>
                                    </p>
                                    <?php echo do_shortcode('[tm_cg_popular_city type="car" page="CG-India" uitype="list"]'); ?>
                                    <div class="cg-city-list"></div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <div class="wp-block-column text-md-end" style="flex-basis: 40%;">
                    <?php if($insurer_logo):?>
                      <img src="<?php echo $insurer_logo; ?>" class="insurer-logo" alt="<?php echo $insurer_display_name." Car Insurance Logo" ?>" title="<?php echo $insurer_display_name." Car Insurance Logo" ?>" height="136" width="221">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_cg_banner', 'tmCgBanner');
?>
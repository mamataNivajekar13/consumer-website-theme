<?php
function tmCgNearbyCities($atts){
    
	$atts = shortcode_atts( array(
        'city' => '',
        'insurercode' => ''
    ), $atts, 'tm_cg_nearby_cities' );
    
  ob_start();?>

    <?php 
        $tax_slug = (get_query_var( 'car-ic' ));
        $term = get_term_by('slug', $tax_slug, 'car-insurer');

        if(get_field('insurer_name', $term)){
            $insurer_display_name = ucwords(get_field('insurer_name', $term));
        }else{
            $insurer_display_name = ucwords($term->name);
        }

        $insurer_code = $atts['insurercode'];
        $city_name = $atts['city'];

        global $wpdb;
        $nearby_cities = $wpdb->get_var( "SELECT nearby_cities FROM {$wpdb->prefix}cashless_garages_state_city WHERE city = '{$city_name}'" );

    ?>

    <?php if($nearby_cities) {
        $nearby_cities_array = json_decode($nearby_cities);
        if($nearby_cities_array){
            $nearby_cities_string = implode(',', $nearby_cities_array);
            $city_names = $wpdb->get_col( "SELECT city FROM {$wpdb->prefix}cashless_garages_state_city WHERE id IN ({$nearby_cities_string})" );
            if($city_names){

        ?>
        <section class="highlight-section tm-container blurred-bg bordered tm-container">
            <div class="wp-block-group has-global-padding is-layout-constrained">
                <div class="">
                    <div class="wp-block-column">
                        <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo $insurer_display_name;?> Cashless Garages Near <?php echo ucwords($city_name);?></h2>
                    </div>
                </div>
                <div class="nearby_section has-turtlemint-child-tm-light-yellow-background-color">
                    <?php foreach ($city_names as $city) { ?>
                        <div class="nearby_section--item">
                            <a onclick="tmClickEvent('Nearby city', 'CG-City', '<?php echo $insurer_display_name; ?>', '<?php echo ucwords($city_name);?>','<?php echo ucwords($city)?>')" href="<?php echo get_site_url().'/car-insurance/'.$tax_slug.'/cashless-garages/'.str_replace(' ', '-', $city).'/'?>" title="<?php echo $insurer_display_name?> Cashless Garages In <?php echo ucwords($city)?>">
                            Cashless Garages In <?php echo ucwords($city);?>
                                <i style="margin-right:auto" class="tm-sprite-3 bg-chevron-right"></i>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } } } ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_cg_nearby_cities', 'tmCgNearbyCities');
?>
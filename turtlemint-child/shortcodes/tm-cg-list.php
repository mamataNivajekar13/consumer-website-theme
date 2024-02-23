<?php
function tmCgList($atts){
    
	$atts = shortcode_atts( array(
        'city' => '',
        'insurercode' => ''
    ), $atts, 'tm_cg_list' );
    
  ob_start();?>

    <?php 
        $tax_slug = (get_query_var( 'car-ic' ));
        $term = get_term_by('slug', $tax_slug, 'car-insurer');
        $insurer_logo = get_field('insurer_logo', $term);
        if(get_field('insurer_name', $term)){
            $insurer_display_name = ucwords(get_field('insurer_name', $term));
        }else{
            $insurer_display_name = ucwords($term->name);
        }
        $insurer_code = $atts['insurercode'];
        $garageslist = getCashlessGaragesDataByCity($atts['city'], $insurer_code );
        $garageslistdata = $garageslist['flatListResponse'];
        $garage_count = $garageslist['count'];

        global $wpdb;
        $city_id = $wpdb->get_var( "SELECT id FROM {$wpdb->prefix}cashless_garages_state_city WHERE city = '{$atts['city']}'" );
       
        if($city_id && $garage_count > 0) {
            $wpdb->query("UPDATE {$wpdb->prefix}cashless_garages_insurers set count = {$garage_count} WHERE cityid={$city_id} AND insurer='{$insurer_code}'");
        }

    ?>

    
        <section id="garage-list" class="tm-container has-turtlemint-child-tm-light-green-background-color">
            <div class="wp-block-group has-global-padding is-layout-constrained">
                <div class="wp-block-columns is-stacked-on-mobile mb-0">
                    <div class="wp-block-column" style="flex-basis: 65%;">
                        <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size mb-0"><?php echo $insurer_display_name;?> Cashless Garages List In <?php echo ucwords($atts['city']);?></h2>
                    </div>
                    <div class="wp-block-column has-text-align-md-right" style="flex-basis: 35%;">
                        <div class="count-wrapper">Total Garages: <span class="h-count"><?php echo $garage_count;?></span></div>
                    </div>
                </div>
                <div class="tm-container__content mb-0 mt-0">
                    <?php if($garage_count > 0) { ?>
                        <p>There are more than <span class="h-count"><?php echo $garage_count;?></span> <?php echo ucwords($insurer_display_name); ?> Cashless Garages in <?php echo ucwords($atts['city']);?>, 
                        this extensive network offers you the freedom to select the best service centers for your vehicle. The availability of cashless garages is an important factor to consider while buying motor insurance. Find the <?php echo ucwords($insurer_display_name); ?> cashless garages list in <span class="c-name"><?php echo ucwords($atts['city']);?></span> below:</p>
                        <form class="form-style-1">
                            <div class="field-group field-group-search mb-0">
                                <input id="customSearch" size="40" class="" aria-required="true" aria-invalid="false" value="" type="text" name="state" placeholder="Search by Garage or Pincode" style="background-color: #ffffff;">
                                <i class="tm-sprite-1 bg-search"></i>
                            </div>
                        </form>
                    <?php } else { ?>
                        <p><?php echo ucwords($insurer_display_name); ?> does not have cashless garages at your searched location. Please explore alternative locations for these garages.</p>
                    <?php } ?>
                </div>
                <?php if($garage_count > 0) { ?>
                    <div class="hospitals-table-wrap mt-0">
                    <div class="wp-block-table">
                        <table id="garage-table" class="table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Garage Name</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($garageslistdata as $i => $garage) { ?>
                                    <tr>
                                        <td><?php echo $i+1;?></td>
                                        <td class="td-capitalize"><?php echo strtolower($garage['displayName'])?></td>
                                        <td class="td-capitalize"><?php echo strtolower($garage['address']).' '. strtolower($garage['city']).' '. $garage['pincode'];?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_cg_list', 'tmCgList');
?>
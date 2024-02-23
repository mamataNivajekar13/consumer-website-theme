<?php
function tmNhHospitals($atts){
    
	$atts = shortcode_atts( array(
        'lat' => '',
        'lng' => '',
        'city' => '',
        'insurercode' => ''
    ), $atts, 'tm_nh_hospitals' );
    
  ob_start();?>

    <?php 
        $tax_slug = (get_query_var( 'health-ic' ));
        $term = get_term_by('slug', $tax_slug, 'health-insurer');
        $insurer_logo = get_field('insurer_logo', $term);
        if(get_field('insurer_name', $term)){
            $insurer_display_name = ucwords(get_field('insurer_name', $term));
        }else{
            $insurer_display_name = ucwords($term->name);
        }
        $insurer_code = $atts['insurercode'];
        $hospitalslist = getHospitalData($atts['city'], $atts['lat'], $atts['lng'], $insurer_code );
        $hospitalslistdata = $hospitalslist['flatListResponse'];
        $hospital_count = $hospitalslist['count'];
        

        global $wpdb;
        $city_id = $wpdb->get_var( "SELECT id FROM {$wpdb->prefix}cashless_hospitals_state_city WHERE city = '{$atts['city']}'" );
       
        if($city_id && $hospital_count > 0) {
            $wpdb->query("UPDATE {$wpdb->prefix}cashless_hospitals_insurers set count = {$hospital_count} WHERE cityid={$city_id} AND insurer='{$insurer_code}'");
        }

    ?>

    
        <section id="hospital-list" class="tm-container has-turtlemint-child-tm-light-green-background-color">
            <div class="wp-block-group has-global-padding is-layout-constrained">
                <div class="wp-block-columns is-stacked-on-mobile mb-0">
                    <div class="wp-block-column" style="flex-basis: 65%;">
                        <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size mb-0"><?php echo $insurer_display_name;?> Health Insurance Network Hospitals In <?php echo ucwords($atts['city']);?></h2>
                    </div>
                    <div class="wp-block-column has-text-align-md-right" style="flex-basis: 35%;">
                        <div class="count-wrapper">Total Hospitals: <span class="h-count"><?php echo $hospital_count;?></span></div>
                    </div>
                </div>
                <div class="tm-container__content mb-0 mt-0">
                    <?php if($hospital_count > 0) { ?>
                        <p>There are more than <span class="h-count"><?php echo $hospital_count;?></span> <?php echo ucwords($insurer_display_name); ?> Health Insurance network hospitals in <?php echo ucwords($atts['city']);?>. <?php echo ucwords($insurer_display_name); ?> offers cashless treatment and hospitalization facilities at these network hospitals. Search for your nearby <?php echo ucwords($insurer_display_name); ?> cashless hospitals in <span class="c-name"><?php echo ucwords($atts['city']);?></span> below:</p>
                        <form class="form-style-1">
                            <div class="field-group field-group-search mb-0">
                                <input id="customSearch" size="40" class="" aria-required="true" aria-invalid="false" value="" type="text" name="state" placeholder="Search by Hospital or Pincode " style="background-color: #ffffff;">
                                <i class="tm-sprite-1 bg-search"></i>
                            </div>
                        </form>
                    <?php } else { ?>
                        <p><?php echo ucwords($insurer_display_name); ?> does not have cashless treatment and hospitalization facilities at your searched location. Please explore alternative locations for these facilities.</p>
                    <?php } ?>
                </div>
                <?php if($hospital_count > 0) { ?>
                    <div class="hospitals-table-wrap mt-0">
                    <div class="wp-block-table">
                        <table id="hospitals-table" class="table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Hospital Name</th>
                                    <th>Address</th>
                                    <th>Direction</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if($atts['lat'] && $atts['lng']) {
                                        $sorted_hospitlas = sortByDistance($atts['lat'], $atts['lng'], $hospitalslistdata);
                                    } else {
                                        $sorted_hospitlas = $hospitalslistdata;
                                    }
                                    foreach ($sorted_hospitlas as $i => $hospital) { ?>
                                    <tr>
                                        <td><?php echo $i+1;?></td>
                                        <td class="td-capitalize"><?php echo strtolower($hospital['hospitalName'])?></td>
                                        <td class="td-capitalize"><?php echo strtolower($hospital['address']).' '. strtolower($hospital['city']).' '. $hospital['pincode'];?></td>
                                        <td style="text-align: center;">
                                            <a title="<?php echo $hospital['hospitalName']. " Direction";?>" target="_blank" href="https://www.google.com/maps?q=<?php echo $hospital['latitude'] ?>,<?php echo  $hospital['longitude'] ?>" onclick="tmClickEvent('Hospital direction', 'NH-City', '<?php echo $insurer_display_name; ?>', '', '<?php echo ucwords($atts['city'])?>')"><i class="tm-sprite-1 bg-location-pin"></i></a>
                                        </td>
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

add_shortcode('tm_nh_hospitals', 'tmNhHospitals');
?>
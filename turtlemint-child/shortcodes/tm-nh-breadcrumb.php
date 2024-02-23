<?php
function tmNhBreadcrumb($atts){

	$atts = shortcode_atts( array(
    'type' => ''
  ), $atts, 'tm_nh_breadcrumb' );

  ob_start();?>

  <?php
    $type = $atts['type'];
    $tax_slug = (get_query_var( 'health-ic' ));
    $term = get_term_by('slug', $tax_slug, 'health-insurer');
    $city_slug = (get_query_var( 'health-ic-city' ));
    $city_name = str_replace('-', ' ', $city_slug);
    $taxonomy_slug = $term->taxonomy;
    
    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $breadcrumb_links = $theme_settings_vertical['breadcrumb_links'];
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
        }
    }
    /* Theme Settings - end */

    if($type == 'custom' && $breadcrumb_links){
      if(get_field('insurer_name', $term)){
        $insurer_display_name = ucwords(get_field('insurer_name', $term));
      }else{
        $insurer_display_name = ucwords($term->name);
      }
          ?>
          <div class="tm-breadcrumb" id="breadcrumbs">
            <span><a href="<?php echo home_url(); ?>" title="Turtlemint Homepage">Home</a></span> &gt; 
            <?php
              if($breadcrumb_links){
                  ?>
                    <span><a href="<?php echo home_url().'/'.$breadcrumb_links[0]['link']."/"; ?>" title="<?php echo ucwords($breadcrumb_links[0]['title']);?>"><?php echo ucwords($breadcrumb_links[0]['title']); ?></a></span> &gt; 
                  <?php
              }
            ?>
            <span>
                <a href="<?php echo home_url().'/'.$breadcrumb_links[0]['link']."/".$tax_slug."/"; ?>" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance"); ?>"><?php if($insurer_display_name): echo ucwords($insurer_display_name); endif; ?>
                </a>                    
            </span> &gt;
            <span title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Network Hospitals"); ?>"><?php echo ucwords("Network Hospitals"); ?></span>
          </div>
         <?php 
    } elseif($type == 'nh-list' && $breadcrumb_links ) {
      if(get_field('insurer_name', $term)){
        $insurer_display_name = ucwords(get_field('insurer_name', $term));
      }else{
        $insurer_display_name = ucwords($term->name);
      }?>
        <div class="tm-breadcrumb" id="breadcrumbs">
          <span><a href="<?php echo home_url(); ?>" title="Turtlemint Homepage">Home</a></span> &gt; 
          <?php
            if($breadcrumb_links){
                ?>
                  <span><a href="<?php echo home_url().'/'.$breadcrumb_links[0]['link']."/"; ?>" title="<?php echo ucwords($breadcrumb_links[0]['title']);?>"><?php echo ucwords($breadcrumb_links[0]['title']); ?></a></span> &gt; 
                <?php
            }
          ?>
          <span>
              <a href="<?php echo home_url().'/'.$breadcrumb_links[0]['link']."/".$tax_slug."/"; ?>" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance"); ?>"><?php if($insurer_display_name): echo ucwords($insurer_display_name); endif; ?>
              </a>                    
          </span> &gt;
          <span>
            <a href="<?php echo home_url().'/'.$breadcrumb_links[0]['link']."/".$tax_slug."/network-hospitals"; ?>" title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Network Hospitals"); ?>"><?php echo ucwords("Network Hospitals"); ?>
            </a>
          </span>&gt;
          <span title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance Network Hospitals In ".$city_name); ?>"><?php echo ucwords($city_name); ?></span>
        </div>
      <?php
    } else{
      if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="tm-breadcrumb" id="breadcrumbs">','</div>' );
      }
    }
  ?>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_nh_breadcrumb', 'tmNhBreadcrumb');
?>
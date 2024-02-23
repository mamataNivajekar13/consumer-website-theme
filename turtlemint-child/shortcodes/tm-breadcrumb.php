<?php
function tmBreadcrumb($atts){

	$atts = shortcode_atts( array(
    'type' => '',
    'vertical' => ''
  ), $atts, 'tm_breadcrumb' );

  ob_start();?>

  <?php
    $type = $atts['type'];

    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
        $vertical_url = home_url().'/health-insurance/';
        $insurer_url = get_term_link($term->slug, 'health-insurer');
      }
    }

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
    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }

    if($type == 'custom' && $breadcrumb_links){
          ?>
          <div class="tm-breadcrumb" id="breadcrumbs">
            <span><a href="<?php echo home_url(); ?>" title="Turtlemint Homepage">Home</a></span> &gt; 
            <?php
              if($breadcrumb_links){
                foreach($breadcrumb_links as $breadcrumb_link){
                  ?>
                    <span><a href="<?php echo home_url().'/'.$breadcrumb_link['link']."/"; ?>" title="<?php echo ucwords($breadcrumb_link['title']);?>"><?php echo ucwords($breadcrumb_link['title']); ?></a></span> &gt; 
                  <?php
                }
              }
            ?>
            <span title="<?php echo ucwords($insurer_display_name." ".$vertical_name." Insurance"); ?>"><?php if($insurer_display_name): echo ucwords($insurer_display_name." ".$vertical_name." Insurance"); endif; ?></span>
          </div>
         <?php 
    }elseif($type == 'renewal' || $type == 'customer-care' || $type == 'premium-calculator' || $type == 'claim-settlement' || $type == 'benefits' || $type == 'critical-illness' || $type == 'plans'){

        $pageTitle = strtolower(str_replace('-', ' ', $type));
      
        $breadcrumb = '<div class="tm-breadcrumb" id="breadcrumbs"><span><a href="'.home_url().'" title="Turtlemint Homepage">Home</a></span> &gt; <span><a href="'.$vertical_url.'" title="'.ucwords($vertical_name.' Insurance').'">'.ucwords($vertical_name.' Insurance').'</a></span> &gt; <span><a title="'.ucwords($insurer_display_name.' '.$vertical_name.' Insurance').'" href="'.$insurer_url.'">'.$insurer_display_name.'</a></span> &gt; <span title="'.ucwords($insurer_display_name.' '.$vertical_name.' Insurance '.$pageTitle).'">'.ucwords($pageTitle).'</span>';
        $breadcrumb .= '</div>';
        return $breadcrumb;
      
    }else{
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

add_shortcode('tm_breadcrumb', 'tmBreadcrumb');
?>
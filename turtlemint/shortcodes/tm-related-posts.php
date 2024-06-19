<?php
function tmRelatedPosts($atts){

	$atts = shortcode_atts( array(
    'posts_per_page'  => 7,
    'post_type'     => 'post',
    'order'      => 'DESC',
    'sticky_posts'   => 'include',
    'offset'        => 0
  ), $atts, 'tm_related_posts' );

  ob_start();?>

  <?php

    $postsPerPage = $atts['posts_per_page'];
    $postType = $atts['post_type'];
    $order = $atts['order'];
    $stickyPosts = $atts['sticky_posts'];
    $offset = $atts['offset'];

    if(function_exists('base_vertical')){
      $baseVertical = base_vertical();
      $vertical = strtolower($baseVertical);
    }

    // Get the current post's ID
    $post_id = get_the_ID();

    // Get the post type's taxonomies, including custom taxonomies
    $taxonomies = get_object_taxonomies( $postType, 'objects' ); // Post type

    // Initialize an empty array to hold the taxonomy query arguments
    $taxonomy_query = array();

    // Set up arguments for the related posts query with taxonomy query
    $args = array(
        'post_type'            => $postType, // Post type
        'post__not_in'         => array( $post_id ), // Exclude the current post
        'posts_per_page'       => $postsPerPage, // Number of related posts to display
        'orderby'              => 'date', // Order by post date
        'order'                => $order, // Order
        'offset'               => $offset, // Offset
    );

    //If the 'sticky_posts' attribute is true, include sticky posts
    if($stickyPosts == 'include'){
      $args['ignore_sticky_posts'] = 1;
    }
    else if($stickyPosts == 'only'){
      $args['ignore_sticky_posts'] = 1;
      $args['post__in'] = get_option('sticky_posts');
    }
    else{
      $args['post__not_in'] = get_option('sticky_posts');
    }

    if ( ! empty( $taxonomies ) ){
      $args['tax_query'] = array(
        'relation'   => 'OR',
      );

      // Loop through the taxonomies and add each one to the taxonomy query
      foreach ( $taxonomies as $taxonomy) {

      // Get the current post's terms for this taxonomy
      $terms = wp_get_post_terms( $post_id, $taxonomy->name );

      if (! empty($terms)){
        // Add the terms to the taxonomy query
        $args['tax_query'][] = array(
            'taxonomy' => $taxonomy->name,
            'field'    => 'term_id',
            'terms' => wp_list_pluck( $terms, 'term_id' ),
          );
        }
      }
    }

    // Get the related posts
    $related_posts = new WP_Query( $args );

    // If there are related posts
    if ( $related_posts->have_posts() ) { ?>
      <div class="tm-slider slider-related-posts">
        <div class="wp-block-post-template">
          <?php
            // Start a loop to output the related posts
            while ( $related_posts->have_posts() ) {
                $related_posts->the_post(); ?>
                  <?php
                      if(isset($vertical) && $vertical){
                        // Output the related post's title and link
                        get_template_part( 'parts/card', 'post', [
                          'insurer_display_name' => null,
                          'vertical_name' => $vertical
                        ]);
                      }else{
                        // Output the related post's title and link
                        get_template_part( 'parts/card', 'post');
                      }
                  ?>
            <?php }
          ?>
        </div>
      </div>

      <?php // Reset post data
      wp_reset_postdata();
    }

  ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_related_posts', 'tmRelatedPosts');
?>
<?php
function tmIcLatestArticles($atts){

	$atts = shortcode_atts( array(
    'limit' => 3,
    'type' => '',
    ''
  ), $atts, 'tm_ic_latest_articles' );

  ob_start();?>

  <?php

    $type = $atts['type'];

    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
      }
    }

    $taxonomy_slug = $term->taxonomy;

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }

    /* Theme Settings - start */
    $taxonomy_slug = $term->taxonomy;
    $theme_settings_verticals = get_field('verticals', 'option');
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
          $vertical_articles_category = $theme_settings_vertical['vertical_articles_category'];
        }
    }
    /* Theme Settings - end */

    $limit = $atts['limit'];

    $latest_articles_args = [
        'post_type'      => 'post',
        'orderby'        => 'date',
        'order'          => 'DESC',
        's'              => $insurer_display_name." ".$vertical_name,
        'post_status'    => 'publish'
    ];
    
    $search_page_url = home_url('/');
    $search_url = $search_page_url."?s=".$insurer_display_name." ".$vertical_name;

    if($vertical_articles_category){
      $latest_articles_args['s'] = $insurer_display_name;
      $latest_articles_args['tax_query'] = [
        'relation' => 'AND',
        [
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => [$vertical_articles_category]
        ]
      ];
      $search_url = $search_page_url."?s=".$insurer_display_name."&category_name=".$vertical_articles_category;
    }
    
    $totalArticles = new WP_Query($latest_articles_args);
    
    $posts_found = $totalArticles->post_count;

    $latest_articles_args['posts_per_page'] = $limit;
    $latest_articles = new WP_Query($latest_articles_args);

  ?>

  <?php if($posts_found > 0): ?>
    <section id="articles" class="highlight-section wp-block-group alignfull is-layout-flow tm-ic-latest-articles">
      <div class="wp-block-group has-global-padding is-layout-constrained">
          <div class="alignwide">
            <div class="tm-container has-turtlemint-child-tm-light-yellow-background-color <?php if($posts_found < 3): echo 'mb-0'; endif; ?>">
              <p class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Latest articles on ").$insurer_display_name;?></p>

              <div class="tm-container__content">

                <?php
                  if($latest_articles->have_posts()):?>
                      <div class="tm-posts">
                        <?php while($latest_articles->have_posts()):
                          $latest_articles->the_post();?>
                          <?php
                            get_template_part( 'parts/card', 'post', [
                              'insurer_display_name' => $insurer_display_name,
                              'vertical_name' => $vertical_name
                            ]);
                          ?>
                      <?php endwhile; ?>
                        </div>
                  <?php endif;?>
                <?php wp_reset_postdata(); ?>

              </div>

              <?php if($posts_found > 3):?>
              <div class="cta-links">
                <p class="tm-link mb-0 d-inline-flex">
                  <a href="<?php echo $search_url;?>" class="icon-link" title="<?php echo ucwords("View all ".$insurer_display_name." Insurance articles"); ?>"><span>View All Articles</span><i class="tm-sprite-1 bg-chevron-right-green"></i></a>
                </p>
              </div>
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

add_shortcode('tm_ic_latest_articles', 'tmIcLatestArticles');
?>
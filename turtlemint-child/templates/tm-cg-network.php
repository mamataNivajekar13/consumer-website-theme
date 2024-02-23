<?php

/**
* Template Name: CG network
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <?php
            $block_content_header = do_blocks(
                '<!-- wp:template-part {"slug":"header","theme":"turtlemint-child","tagName":"header", "className":"tm-header"} /-->'
            );
            $block_content_footer = do_blocks(
                '<!-- wp:template-part {"slug":"footer","theme":"turtlemint-child","tagName":"footer"} /-->'
            );

            $term_slug = (get_query_var( 'car-ic' ));
            $term = get_term_by('slug', $term_slug, 'car-insurer');
            $taxonomy_slug = $term->taxonomy;

            if(get_field('insurer_name', $term)){
                $insurer_display_name = ucwords(get_field('insurer_name', $term));
            }else{
                $insurer_display_name = ucwords($term->name);
            }
            $currentYear = date("Y");

            global $wpdb;

            /* Theme Settings - start */
            $theme_settings_verticals = get_field('verticals', 'option');
            foreach ($theme_settings_verticals as $theme_settings_vertical) {
                $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];
        
                if($vertical_taxonomy_slug == $taxonomy_slug){
                    $vertical_name = $theme_settings_vertical['display_vertical_name_as'];
                }
            }
            /* Theme Settings - end */
            if(get_field('insurer_name', $term)){
                $insurer_display_name = ucwords(get_field('insurer_name', $term));
            }else{
                $insurer_display_name = ucwords($term->name);
            }

            $homeUrl = home_url();

            $vertical_page_slug = strtolower(str_replace(' ', '-', $vertical_name))."-insurance";
            $term_page_link = get_term_link($term_slug, 'car-insurer');

            $tax_slug = (get_query_var( 'car-ic' ));
            $city_name = (get_query_var( 'car-cg-city' ));

            $insurer_code = ucwords(get_field('insurer_code', $term));

            $garage_count = $wpdb->get_var( "SELECT SUM(count) FROM {$wpdb->prefix}cashless_garages_insurers WHERE insurer='{$insurer_code}'" );

            $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

            $piece["itemListElement"] = [
                [
                    "@type" => "ListItem",
                    "position" => 1,
                    "name" => "Home",
                    "item" => $homeUrl
                ],
                [
                    "@type" => "ListItem",
                    "position" => 2,
                    "name" => ucwords($vertical_name." Insurance"),
                    "item" => $homeUrl."/".$vertical_page_slug."/"
                ],
                [
                    "@type" => "ListItem",
                    "position" => 3,
                    "name" => ucwords($insurer_display_name." ".$vertical_name." Insurance"),
                    "item" => $term_page_link
                ],
                [
                    "@type" => "ListItem",
                    "position" => 4,
                    "name" => ucwords($insurer_display_name." Cashless Garages"),
                    "item" => $currentURL
                ]
            ];
        ?>

        <?php

            if($insurer_display_name){
                $keywords = $insurer_display_name.' cashless garages, '.$insurer_display_name.' car insurance cashless garages, '.$insurer_display_name.' cashless garages list, '.$insurer_display_name.' car insurance cashless garages list';
            }

            if($garage_count){
                if($insurer_display_name){
                    $title = number_format($garage_count) . '+ ' .$insurer_display_name.' Cashless Garages list for Car | Turtlemint';
                }

                $description = 'Check the wide network of '.number_format($garage_count).'+ '.$insurer_display_name.' cashless garages across the country. Search for nearby authorised cashless garages for your vehicle.';
            }
            if($title){
                echo '<title>'.$title.'</title>';
            }
            if($description){
                echo '<meta name="description" content="'.$description.'">';
            }
            if($keywords){
                echo '<meta name="keywords" content="'.$keywords.'" />';
            }
            if($title){
                echo '<meta property="og:title" content="'.$title.'" />';
            }
            if($description){
                echo '<meta property="og:description" content="'.$description.'" />';
            }
            if($currentURL){
                echo '<meta property="og:url" content="'.$currentURL.'" />';
            }
            if($title){
                echo '<meta name="twitter:title" content="'.$title.'"/>';
            }
            if($description){
                echo '<meta name="twitter:description" content="'.$description.'"/>';
            }
            echo '<meta name=twitter:creator content="@helloturtlemint">';

            /* Breadcrumb Schema - Start */
            $breadcrumbSchema = '<script type="application/ld+json">
            [{
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [';

            $breadcrumbItemCount = count($piece["itemListElement"]);

            $filteredBreadcrumbItems = [];

            foreach ($piece["itemListElement"] as $key => $breadcrumbItem){
                $breadcrumbSchema .= '{
                "@type": "'.$breadcrumbItem["@type"].'",
                "position": '.$breadcrumbItem["position"].',
                "name": "'.$breadcrumbItem["name"].'",
                "item": "'.$breadcrumbItem["item"].'"
                }';

                if ($key < $breadcrumbItemCount - 1) {
                    $breadcrumbSchema .= ', ';
                }
            }

            $breadcrumbSchema .= ']}]</script>';

            echo $breadcrumbSchema;
            /* Breadcrumb Schema - End */
        ?>
        <!-- WebPage Scehma - Start -->
        <script type="application/ld+json">
            {
                "@context": "http://schema.org/",
                "@type": "WebPage",
                "name": "<?php echo $insurer_display_name; ?> Cashless Garages",
                "speakable":
                {
                    "@type": "SpeakableSpecification",
                    "xpath": [
                        "/html/head/title",
                        "/html/head/meta[@name='description']/@content"
                    ]
                },
                "url": "<?php echo $currentURL; ?>"
            }
        </script>

        <!-- WebPage Scehma - End -->

        <?php wp_head(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body <?php body_class('tm-style-1'); ?>>

        <?php wp_body_open(); ?>

        <div class="wp-site-blocks">

            <?php echo $block_content_header; ?>

            <!-- Page Content Start -->

            <?php echo do_shortcode('[tm_cg_banner type="garage"]'); ?>

            <section class="wp-block-group has-global-padding is-layout-constrained">
                <div class="wp-block-columns alignwide is-layout-flex ic-two-column">
                    <div class="wp-block-column is-layout-flow left-scrollable" style="flex-basis:65%">
                        <?php echo do_shortcode('[tm_cg_popular_city type="car" page="CG-India"]'); ?>
                        <?php echo do_shortcode('[tm_cg_states]'); ?>
                        <?php echo do_shortcode('[tm_cg_insurance_companies]'); ?>
                        <?php echo do_shortcode('[tm_ic_calculator vertical="car"]'); ?>
                        <?php echo do_shortcode('[tm_ic_claim_process vertical="car"]'); ?>
                        <?php echo do_shortcode('[tm_ic_documents]'); ?>
                        <?php echo do_shortcode('[tm_ic_customer_care]'); ?>
                    </div>
                    <div class="wp-block-column is-layout-flow sticky-column" style="flex-basis:35%">
                            <?php echo do_shortcode('[tm_lead_unit_cta]'); ?>                        <div class="sticky-marketing-unit">
                            <?php echo do_shortcode('[tm_insurance_companies]'); ?>
                        </div>
                    </div>
                </div>
            </section>
                    
            <!-- Page Content End -->

            <?php echo $block_content_footer; ?>

        </div>

        <?php wp_footer(); ?>

    </body>
</html>

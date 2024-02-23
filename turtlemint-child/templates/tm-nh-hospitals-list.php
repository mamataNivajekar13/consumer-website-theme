<?php

/**
* Template Name: Network hospitals listing
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <?php
            $block_content_topbar = do_blocks(
                '<!-- wp:template-part {"slug":"topbar","theme":"turtlemint-child","area":"header","className":"tm-topbar"} /-->'
            );
            $block_content_header = do_blocks(
                '<!-- wp:template-part {"slug":"header","theme":"turtlemint-child","tagName":"header", "className":"tm-header"} /-->'
            );
            $block_content_footer = do_blocks(
                '<!-- wp:template-part {"slug":"footer","theme":"turtlemint-child","tagName":"footer"} /-->'
            );

            $term_slug = (get_query_var( 'health-ic' ));
            $city_slug = (get_query_var( 'health-ic-city' ));
            $city_name_display = ucwords(str_replace('-', ' ', $city_slug));
            $term = get_term_by('slug', $term_slug, 'health-insurer');
            $taxonomy_slug = $term->taxonomy;

            if(get_field('insurer_name', $term)){
                $insurer_display_name = ucwords(get_field('insurer_name', $term));
            }else{
                $insurer_display_name = ucwords($term->name);
            }
            $currentYear = date("Y");

            $title = $insurer_display_name." Health Insurance Network Hospital List in ".$city_name_display.", ".$currentYear." | Turtlemint";

            $description = "Check ".$insurer_display_name." Health Insurance network hospital list in ".$city_name_display.". Find nearby ".$insurer_display_name." health insurance hospital names and addresses for any medical emergencies.";

            $keywords = $insurer_display_name." health insurance network hospital list ".$city_name_display.", ".$insurer_display_name." health insurance network hospitals ".$city_name_display.", ".$insurer_display_name." health insurance hospitals ".$city_name_display.", ".$insurer_display_name." health insurance network hospital list ".$city_name_display;

            $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

            /* Theme Settings - start */
            $theme_settings_verticals = get_field('verticals', 'option');
            foreach ($theme_settings_verticals as $theme_settings_vertical) {
                $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];
        
                if($vertical_taxonomy_slug == $taxonomy_slug){
                    $vertical_name = $theme_settings_vertical['display_vertical_name_as'];
                }
            }
            /* Theme Settings - end */

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
            $term_page_link = get_term_link($term_slug, 'health-insurer');
            $nh_page_link = $term_page_link.'network-hospitals/';

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
                    "name" => ucwords($insurer_display_name." ".$vertical_name." Insurance Hospital List"),
                    "item" => $nh_page_link
                ],
                [
                    "@type" => "ListItem",
                    "position" => 5,
                    "name" => ucwords($insurer_display_name." ".$vertical_name." Insurance Hospital List ").strtolower("in ").ucwords($city_name_display),
                    "item" => $currentURL
                ]
            ];

            if(get_field('insurer_code', $term)){
                $insurer_code = ucwords(get_field('insurer_code', $term));
            }

            $latitude = ($_GET['lat']);
            $longitude = ($_GET['lng']);
            $city_name = str_replace('-', ' ', $city_slug);

            if(!isset($_GET['lat']) || !isset($_GET['lat'])) {
                global $wpdb;
                $city_data = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}cashless_hospitals_state_city WHERE city = '{$city_name}'");
                if($city_data) {
                    $latitude = $city_data->lat;
                    $longitude = $city_data->lng;
                }
            }
            
        ?>
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>">
        <?php if($keywords):?>
            <meta name="keywords" content="<?php echo $keywords;?>" />
        <?php endif;?>
	    <meta property="og:title" content="<?php echo $title;?>" />
	    <meta property="og:description" content="<?php echo $description; ?>" />
	    <meta property="og:url" content="<?php echo $currentURL; ?>" />
        <meta name="twitter:title" content="<?php echo $title; ?>"/>
        <meta name="twitter:description" content="<?php echo $description; ?>"/>
        <meta name=twitter:creator content="@helloturtlemint">

        <?php
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
                "name": "<?php echo $insurer_display_name; ?> Network Hospitals in <?php echo $city_name_display; ?>",
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
            <?php echo $block_content_topbar; ?>
            <?php echo $block_content_header; ?>

            <!-- Page Content Start -->

            <?php echo do_shortcode('[tm_ic_nh_banner type="nh-list" city="'.$city_name.'"]'); ?>

            <section class="wp-block-group has-global-padding is-layout-constrained">
                <div class="wp-block-columns alignwide is-layout-flex ic-two-column">
                    <div class="wp-block-column is-layout-flow left-scrollable" style="flex-basis:65%">
                        <?php echo do_shortcode('[tm_nh_hospitals lat="'.$latitude.'" lng="'.$longitude.'" city="'.$city_name.'" insurercode="'.$insurer_code.'" ]'); ?>
                        <?php echo do_shortcode('[tm_ic_calculator type="hospital"]'); ?>
                        <?php echo do_shortcode('[tm_nh_nearby_insurers city="'.$city_name.'" insurercode="'.$insurer_code.'"]'); ?>
                        <?php echo do_shortcode('[tm_ic_claim_process type="hospital"]'); ?>
                        <?php echo do_shortcode('[tm_ic_customer_care type="hospital"]'); ?>
                        <?php echo do_shortcode('[tm_ic_nh_popular_city type="hospital" page="NH-City"]'); ?>
                        <?php echo do_shortcode('[tm_ic_ancillary_links]'); ?>
                    </div>
                    <div class="wp-block-column is-layout-flow sticky-column" style="flex-basis:35%">
                        <?php echo do_shortcode('[tm_nh_nearby_cities city="'.$city_name.'" insurercode="'.$insurer_code.'" ]'); ?>
                        <?php echo do_shortcode('[tm_lead_unit_cta]'); ?>
                        <div class="sticky-marketing-unit">
                            <?php echo do_shortcode('[tm_insurance_companies type="hospital"]'); ?>
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

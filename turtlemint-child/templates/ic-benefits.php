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

            $health_term_slug = get_query_var( 'health-ic' );

            if($health_term_slug){
                $term = get_term_by('slug', $health_term_slug, 'health-insurer');
            }
            
            $taxonomy_slug = $term->taxonomy;

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

            $insurerVertical = $insurer_display_name . " " . $vertical_name;

            $title = ucwords($insurerVertical)." Insurance Benefits: Plan Inclusions & Exclusions | Turtlemint";

            $description = "View the policy details of all ".ucwords($insurerVertical)." Insurance plans online, including inclusions and exclusions.";

            $keywords = strtolower($insurerVertical)." insurance benefits, ".strtolower($insurerVertical)." benefits, ".strtolower($insurerVertical)." and allied insurance benefits, ".strtolower($insurerVertical)." mediclaim policy benefits";

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
            $term_page_link = get_term_link($health_term_slug, 'health-insurer');
            $current_page_link = $term_page_link.'benefits/';

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
                    "name" => ucwords($insurer_display_name." ".$vertical_name." Insurance Benefits"),
                    "item" => $current_page_link
                ]
            ];

            if(get_field('insurer_code', $term)){
                $insurer_code = ucwords(get_field('insurer_code', $term));
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
                "name": "<?php echo $insurerVertical; ?> Insurance Benefits",
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

            <?php echo do_shortcode('[tm_ic_nh_banner type="benefits"]'); ?>

            <section class="wp-block-group has-global-padding is-layout-constrained">
                <div class="wp-block-columns alignwide is-layout-flex ic-two-column">
                    <div class="wp-block-column is-layout-flow left-scrollable" style="flex-basis:65%">
                        <?php echo do_shortcode('[tm_ic_features]'); ?>
                        <?php echo do_shortcode('[tm_ic_exclusions]'); ?>
                        <?php echo do_shortcode('[tm_ic_calculator]'); ?>
                        <?php echo do_shortcode('[tm_ic_ancillary_links]'); ?>
                        <?php echo do_shortcode('[tm_nh_search_box]'); ?>
                        <?php echo do_shortcode('[tm_ic_latest_articles]'); ?>
                        <?php echo do_shortcode('[tm_ic_faqs]'); ?>
                    </div>
                    <div class="wp-block-column is-layout-flow sticky-column" style="flex-basis:35%">
                        <?php echo do_shortcode('[tm_lead_unit_cta]'); ?>
                        <div class="sticky-marketing-unit">
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

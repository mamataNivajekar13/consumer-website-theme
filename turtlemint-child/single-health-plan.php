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

$queried_object = get_queried_object();

$currentVertical = strtolower(base_vertical());

if(is_a($queried_object, 'WP_Post')){
    $plan_name = get_the_title();
    $terms = wp_get_post_terms($queried_object->ID, $currentVertical.'-insurer');
    $queried_object = get_term_by('slug', $terms[0]->slug, $currentVertical.'-insurer');
}

$taxonomy_slug = $queried_object->taxonomy;

/* Theme Settings - start */
$theme_settings_verticals = get_field('verticals', 'option');
foreach ($theme_settings_verticals as $theme_settings_vertical) {
    $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

    if($vertical_taxonomy_slug == $taxonomy_slug){
    $vertical_name = $theme_settings_vertical['display_vertical_name_as'];
    }
}
/* Theme Settings - end */

if(get_field('insurer_name', $queried_object)){
    $insurer_display_name = ucwords(get_field('insurer_name', $queried_object));
}else{
    $insurer_display_name = ucwords($queried_object->name);
}

$keywords = $insurer_display_name.' '.$plan_name.', '.$plan_name.' policy, '.$insurer_display_name.' '.$plan_name.' policy online';
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(); ?></title>
    <?php if($keywords):?>
        <meta name="keywords" content="<?php echo $keywords;?>" />
    <?php endif;?>
    <?php wp_head(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body <?php body_class('tm-style-1'); ?>>
<?php wp_body_open(); ?>
    <div class="wp-site-blocks">
        <?php echo $block_content_topbar; ?>
        <?php echo $block_content_header; ?>

        <?php $tax_term = get_queried_object(); ?>
        <!-- Page Content Start -->

        <?php echo do_shortcode('[tm_ic_banner]'); ?>

        <?php echo do_shortcode('[tm_secondary_navbar]'); ?>

        <?php echo do_shortcode('[tm_ic_about]'); ?>

        <section class="wp-block-group has-global-padding is-layout-constrained">
            <div class="wp-block-columns alignwide is-layout-flex ic-two-column">
                <div class="wp-block-column is-layout-flow left-scrollable" style="flex-basis:67%">
                    <?php echo do_shortcode('[tm_pdp_benefits limit="6"]'); ?>
                    <?php echo do_shortcode('[tm_pdp_resources]'); ?>
                    <?php echo do_shortcode('[tm_pdp_exclusions limit="6"]'); ?>
                    <?php echo do_shortcode('[tm_ic_plans limit="3"]'); ?>
                    <?php echo do_shortcode('[tm_ic_calculator]'); ?>
                    <?php echo do_shortcode('[tm_ic_claim_settlement_ratio]'); ?>
                    <?php echo do_shortcode('[tm_ic_claim_process]'); ?>
                    <?php echo do_shortcode('[tm_nh_search_box]'); ?>
                    <?php echo do_shortcode('[tm_ic_renewal_process]'); ?>
                    <?php echo do_shortcode('[tm_ic_latest_articles]'); ?>
                    <?php echo do_shortcode('[tm_ic_customer_care]'); ?>
                </div>
                <div class="wp-block-column is-layout-flow sticky-column" style="flex-basis:33%">
                    <?php echo do_shortcode('[tm_lead_unit_cta]'); ?>
                    <?php echo do_shortcode('[tm_ic_ancillary_links]'); ?>
                    <?php echo do_shortcode('[tm_ic_plan_links limit="5"]'); ?>
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
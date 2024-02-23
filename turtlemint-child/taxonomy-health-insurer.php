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

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(); ?></title>
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
                <div class="wp-block-column is-layout-flow left-scrollable" style="flex-basis:65%">
                    <?php echo do_shortcode('[tm_ic_claim_settlement_ratio]'); ?>
                    <?php echo do_shortcode('[tm_ic_plans limit="3"]'); ?>
                    <?php echo do_shortcode('[tm_ic_plans subtype="top-up" limit="2"]'); ?>
                    <?php echo do_shortcode('[tm_ic_features]'); ?>
                    <?php echo do_shortcode('[tm_ic_exclusions]'); ?>
                    <?php echo do_shortcode('[tm_ic_calculator]'); ?>
                    <?php echo do_shortcode('[tm_nh_search_box]'); ?>
                    <?php echo do_shortcode('[tm_ic_customer_care]'); ?>
                    <?php echo do_shortcode('[tm_ic_claim_process]'); ?>
                    <?php echo do_shortcode('[tm_ic_renewal_process]'); ?>
                    <?php echo do_shortcode('[tm_ic_buying_process]'); ?>
                    <?php echo do_shortcode('[tm_ic_latest_articles]'); ?>
                    <?php echo do_shortcode('[tm_ic_faqs]'); ?>
                </div>
                <div class="wp-block-column is-layout-flow sticky-column" style="flex-basis:35%">
                    <?php echo do_shortcode('[tm_lead_unit_cta]'); ?>
                    <?php echo do_shortcode('[tm_ic_download_app]'); ?>
                    <?php echo do_shortcode('[tm_ic_ancillary_links]'); ?>
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
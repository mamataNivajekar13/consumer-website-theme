<?php
/**
 * Template Name: Insurance Company
 *
 */

$block_content_header = do_blocks(
    '<!-- wp:template-part {"slug":"header","theme":"turtlemint-child","tagName":"header"} /-->'
);
$block_content_footer = do_blocks(
    '<!-- wp:template-part {"slug":"footer","theme":"turtlemint-child","tagName":"footer"} /-->'
);

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <div class="wp-site-blocks">
        <?php echo $block_content_header; ?>
        <!-- Page Content Start -->

        <?php echo do_shortcode('[tm_ic_banner]'); ?>

        <!-- Page Content End -->
        <?php echo $block_content_footer; ?>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
<?php
/**
* Title: TM Related Posts
* Slug: turtlemint-child/related-posts
* Categories: posts
*/
?>

<!-- wp:group {"tagName":"section","align":"wide","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignwide"><!-- wp:separator {"align":"wide","backgroundColor":"turtlemint-child/gray","className":"is-style-wide"} -->
<hr class="wp-block-separator alignwide has-text-color has-turtlemint-child-gray-color has-alpha-channel-opacity has-turtlemint-child-gray-background-color has-background is-style-wide"/>
<!-- /wp:separator --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","layout":{"type":"constrained"}} -->
<section class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"bottom":"15px","top":"0px"}}},"fontSize":"turtlemint-child/x-large"} -->
<p class="has-text-align-center has-turtlemint-child-x-large-font-size" style="margin-top:0px;margin-bottom:15px;font-style:normal;font-weight:700">Related Blogs</p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:shortcode -->
[tm_related_posts post_type="post" order="DESC" sticky_posts="include" offset="0" posts_per_page="8"]
<!-- /wp:shortcode --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
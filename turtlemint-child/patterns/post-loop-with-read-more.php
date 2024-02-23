<?php
/**
* Title: TM Posts (with read more button)
* Slug: turtlemint-child/tm-posts-with-read-more
* Categories: posts
*/
?>

<!-- wp:group {"tagName":"section","layout":{"type":"constrained"}} -->
<section class="wp-block-group"><!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0px","bottom":"10px"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0px;margin-bottom:10px">Health</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0px","bottom":"30px"}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"turtlemint-child/large-1"} -->
<p class="has-turtlemint-child-large-1-font-size" style="margin-top:0px;margin-bottom:30px;font-style:normal;font-weight:500">We have decoded health insurance just for you</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":13,"query":{"perPage":"7","pages":"0","offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[30]}},"displayLayout":{"type":"flex","columns":4},"align":"full","className":"tm-slider post-slider-health","layout":{"type":"default"}} -->
<div class="wp-block-query alignfull tm-slider post-slider-health"><!-- wp:post-template -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:template-part {"slug":"card-post","theme":"turtlemint-child","area":"uncategorized"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:buttons {"align":"full","className":"tm-blog-read-more","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"0px"}}}} -->
<div class="wp-block-buttons alignfull tm-blog-read-more" style="margin-top:0px"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/category/health-insurance/">Read More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
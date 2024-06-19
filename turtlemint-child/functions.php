<?php

add_action( 'wp_enqueue_scripts', 'tm_child_styles' );

function tm_child_styles() {
	wp_enqueue_style( 'tm-child-style', get_stylesheet_uri('style.css'), [], 1.2);
}

?>
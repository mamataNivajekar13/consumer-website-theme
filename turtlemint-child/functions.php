<?php

/* Footer bottom scripts */
function tm_child_footer_scripts_bottom() {
    include get_theme_file_path('header-footer-scripts/footer-scripts-bottom.php');
}
//add_action( 'wp_footer', 'tm_child_footer_scripts_bottom', 100 );

/* Footer top scripts */
function tm_child_footer_scripts_top() {
    include get_theme_file_path('header-footer-scripts/footer-scripts-top.php');
}
//add_action( 'wp_footer', 'tm_child_footer_scripts_top', 0 );

/* Head bottom scripts */
function tm_child_head_scripts_bottom() {
    include get_theme_file_path('header-footer-scripts/head-scripts-bottom.php');
}
//add_action( 'wp_head', 'tm_child_head_scripts_bottom', 100 );

/* Head top scripts */
function tm_child_head_scripts_top() {
    include get_theme_file_path('header-footer-scripts/head-scripts-top.php');
}
//add_action( 'wp_head', 'tm_child_head_scripts_top', 0 );

?>
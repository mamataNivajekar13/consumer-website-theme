<?php

/* Shortcodes - Start */

// Breadcrumb
include get_stylesheet_directory() . '/shortcodes/tm-breadcrumb.php';

// Social Profiles
include get_stylesheet_directory() . '/shortcodes/tm-social-profiles.php';

// Copyright Year
include get_stylesheet_directory() . '/shortcodes/tm-copyright-year.php';

// Sidebar
include get_stylesheet_directory() . '/shortcodes/tm-sidebar.php';

// Pagination
include get_stylesheet_directory() . '/shortcodes/tm-pagination.php';

// Author Contact
include get_stylesheet_directory() . '/shortcodes/tm-author-contact.php';

/* Shortcodes - End */

add_filter( 'default_wp_template_part_areas', 'tm_template_part_areas' );

function tm_template_part_areas( array $areas ) {
    $areas[] = array(
            'area'        => 'sidebar',
            'area_tag'    => 'div',
            'label'       => __( 'Sidebar', 'turtlemint' ),
            'icon'        => 'sidebar' // Default icons: header, footer and sidebar.
        );
    return $areas;
}

/* Footer bottom scripts */
function tm_footer_scripts_bottom() {
    include get_stylesheet_directory() . '/header-footer-scripts/footer-scripts-bottom.php';
}
add_action( 'wp_footer', 'tm_footer_scripts_bottom', 100 );

/* Footer top scripts */
function tm_footer_scripts_top() {
    include get_stylesheet_directory() . '/header-footer-scripts/footer-scripts-top.php';
}
add_action( 'wp_footer', 'tm_footer_scripts_top', 0 );

/* Head bottom scripts */
function tm_head_scripts_bottom() {
    include get_stylesheet_directory() . '/header-footer-scripts/head-scripts-bottom.php';
}
add_action( 'wp_head', 'tm_head_scripts_bottom', 100 );

/* Head top scripts */
function tm_head_scripts_top() {
    include get_stylesheet_directory() . '/header-footer-scripts/head-scripts-top.php';
}
add_action( 'wp_head', 'tm_head_scripts_top', 0 );

/* File Version */
function fileVersion($filePath){
	return filemtime(get_stylesheet_directory() . $filePath);
}

/* Enqueue Styles */
function tm_child_styles()
{
	// Default styles
	wp_enqueue_style( 'tm-default-styles', get_stylesheet_uri(), [], 0.1);
    // Icons
    wp_enqueue_style( 'tm-icons', get_parent_theme_file_uri(). '/tm-assets/css/tm-icons.min.css' , [], fileVersion('/tm-assets/css/tm-icons.min.css'));
    // Theme Styles
    wp_enqueue_style( 'tm-styles', get_parent_theme_file_uri(). '/tm-assets/css/tm-styles.min.css' , [], fileVersion('/tm-assets/css/tm-styles.min.css'));
    // Slick Styles
    wp_enqueue_style( 'slick-styles', get_parent_theme_file_uri(). '/tm-assets/css/slick.min.css');
}
add_action('wp_enqueue_scripts', 'tm_child_styles');

/* Enqueue Scripts */
function tm_child_scripts()
{
	// jQuery
	wp_enqueue_script( 'tm-jquery', get_stylesheet_directory_uri() . '/tm-assets/js/jquery.min.js', array(), '3.6.4', true );

    // Bootstap Bundle Scripts
	wp_enqueue_script( 'bootstrap-bundle-script', get_stylesheet_directory_uri() . '/tm-assets/js/bootstrap.bundle.min.js', array('tm-jquery'), true );

    // Turtlemint Scripts
	wp_enqueue_script( 'tm-scripts', get_stylesheet_directory_uri() . '/tm-assets/js/tm-scripts.min.js', array(), fileVersion('/tm-assets/js/tm-scripts.min.js'), true );
    
}
add_action('wp_enqueue_scripts', 'tm_child_scripts');

function add_custom_body_class($classes) {

    if(is_single()){
        $classes[] = 'tm-style-1';
    }
    
    return $classes;
}
add_filter('body_class', 'add_custom_body_class');

/* Sidebar */
function tm_sidebar()
{
	register_sidebar(
		array(
			'id' => 'tm_sidebar',
			'name' => esc_html__('Sidebar', 'turtlemint'),
			'description' => esc_html__('Add sidebar content', 'turtlemint'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title-holder"><p class="widget-title">',
			'after_title' => '</p></div>'
		)
	);
}
add_action('widgets_init', 'tm_sidebar');

/* Sidebar popup */
function sidebar_popup()
{
	register_sidebar(
		array(
			'id' => 'sidebar_popup',
			'name' => esc_html__('Sidebar Popup', 'turtlemint'),
			'description' => esc_html__('Add sidebar  popup content', 'turtlemint'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title-holder"><p class="widget-title">',
			'after_title' => '</p></div>'
		)
	);
}
add_action('widgets_init', 'sidebar_popup');

// Additional Search Filters
function tmSearchfilter($query) {
 
    if ($query->is_search && !is_admin()) {
        $query->set('post_type',array('post'));
        $query->set('orderby', 'date');
        $query->set('order', 'DESC'); 
    }
 
return $query;
}
add_filter('pre_get_posts','tmSearchfilter');

/* Feature image fallback */
function tm_fallback_featured_image( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    if ( empty( $html ) ) {
        $html = '<span class="wp-block-post-featured-image__placeholder"></span>';
    }else{
        $post = get_post($post_id);
        $attr['loading'] = 'eager';
        $title = $post->post_title;
        $attr['title'] = $title;
        $attr['alt'] = $title;
        $attr['onload'] = 'if(this.previousSibling){this.previousSibling.remove()}';
        $html = '<span class="wp-block-post-featured-image__skeleton"></span>'.wp_get_attachment_image($post_thumbnail_id, $size, false, $attr);
    }
    return $html;
}
add_filter( 'post_thumbnail_html', 'tm_fallback_featured_image', 10, 5 );

// Menu Support
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
        'primary-menu' => __( 'Primary Menu' ),
        'secondary-menu' => __( 'Secondary Menu' )
        )
    );
}
<?php

/* Shortcodes - Start */

// Breadcrumb
include get_parent_theme_file_path('shortcodes/tm-breadcrumb.php');

// Social Profiles
include get_parent_theme_file_path('shortcodes/tm-social-profiles.php');

// Copyright Year
include get_parent_theme_file_path('shortcodes/tm-copyright-year.php');

// Sidebar
include get_parent_theme_file_path('shortcodes/tm-sidebar.php');

// Pagination
include get_parent_theme_file_path('shortcodes/tm-pagination.php');

// Author Contact
include get_parent_theme_file_path('shortcodes/tm-author-contact.php');

// Related Posts
include get_parent_theme_file_path('shortcodes/tm-related-posts.php');

/* Shortcodes - End */

add_filter( 'default_wp_template_part_areas', 'tm_template_part_areas' );

function tm_template_part_areas( array $areas ) {
    $areas[] = array(
            'area'        => 'sidebar',
            'area_tag'    => 'div',
            'label'       => __( 'Sidebar', 'turtlemint' ),
            'description' => __( 'Sidebar area', 'turtlemint' ),
            'icon'        => 'sidebar' // Default icons: header, footer and sidebar.
        );
    return $areas;
}

/* Footer bottom scripts */
function tm_footer_scripts_bottom() {
    include get_parent_theme_file_path('header-footer-scripts/footer-scripts-bottom.php');
}
add_action( 'wp_footer', 'tm_footer_scripts_bottom', 100 );

/* Footer top scripts */
function tm_footer_scripts_top() {
    include get_parent_theme_file_path('header-footer-scripts/footer-scripts-top.php');
}
add_action( 'wp_footer', 'tm_footer_scripts_top', 0 );

/* Head bottom scripts */
function tm_head_scripts_bottom() {
    include get_parent_theme_file_path('header-footer-scripts/head-scripts-bottom.php');
}
add_action( 'wp_head', 'tm_head_scripts_bottom', 100 );

/* Head top scripts */
function tm_head_scripts_top() {
    include get_parent_theme_file_path('header-footer-scripts/head-scripts-top.php');
}
add_action( 'wp_head', 'tm_head_scripts_top', 0 );

/* File Version */
function fileVersion($filePath){
	return filemtime($filePath);
}

/* Enqueue Styles */
function tm_styles()
{
    // Icons
    wp_enqueue_style( 'tm-icons', get_parent_theme_file_uri(). '/tm-assets/css/tm-icons.min.css' , [], fileVersion(get_parent_theme_file_path('tm-assets/css/tm-icons.min.css')));
    // Theme Styles
    wp_enqueue_style( 'tm-styles', get_parent_theme_file_uri(). '/tm-assets/css/tm-styles.min.css' , []);

    if(is_single()){
        // Slick Styles
        wp_enqueue_style( 'slick-styles', get_parent_theme_file_uri(). '/tm-assets/css/slick.min.css');
    }
}
add_action('wp_enqueue_scripts', 'tm_styles');

/* Enqueue Scripts */
function tm_scripts()
{
	// jQuery
	wp_enqueue_script( 'tm-jquery', get_parent_theme_file_uri() . '/tm-assets/js/jquery.min.js', array(), '3.6.4', true );

    // Bootstap Bundle Scripts
	wp_enqueue_script( 'bootstrap-bundle-script', get_parent_theme_file_uri() . '/tm-assets/js/bootstrap.bundle.min.js', array('tm-jquery'), true );

    // Turtlemint Scripts
	wp_enqueue_script( 'tm-scripts', get_parent_theme_file_uri() . '/tm-assets/js/tm-scripts.min.js', array(), true );

    if(is_single()){
        // Slick Scripts
        wp_enqueue_script( 'slick-script', get_parent_theme_file_uri() . '/tm-assets/js/slick.min.js', array(), "", true );

        // Sliders Scripts
        wp_enqueue_script( 'sliders-script', get_parent_theme_file_uri() . '/tm-assets/js/tm-sliders.min.js', array(), "", true );
    }
}

/************ Defer JS ***************/
function defer_parsing_of_js( $url ) {
    if ( is_user_logged_in() ) return $url; //don't break WP Admin
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    //if ( strpos( $url, 'jquery.min.js' ) ) return $url;
    if ( strpos( $url, 'tm-critical.min.js' ) ) return $url;
    return str_replace( ' src', ' defer src', $url );
}
add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );

/************* Defer CSS *************/
function preloading_of_css($html, $handle) {
    $async_loading = array(
		$handle
    );
    if( in_array($handle, $async_loading) ) {
        $async_html = str_replace("rel='stylesheet'", 'rel=\'preload\' as=\'style\' onload="this.onload=null;this.rel=\'stylesheet\'" ', $html);
        //$async_html .= str_replace( 'media=\'all\'', 'media="print" onload="this.media=\'all\'"', $html );
        return $async_html;
    }
    return $html;
}
add_filter('style_loader_tag', 'preloading_of_css', 10, 2);

add_action('wp_enqueue_scripts', 'tm_scripts');
function tm_custom_body_class($classes) {

    if(is_single()){
        $classes[] = 'tm-style-1';
    }
    
    return $classes;
}
add_filter('body_class', 'tm_custom_body_class');

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

// Replace dropdown icon in navigation menu
function tm_render_block_core_navigation_submenu(string $block_content, array $block): string
{
    if (
        isset($block['blockName']) &&
        'core/navigation' === $block['blockName'] &&
        !is_admin() &&
        !wp_is_json_request()
    ) {

        // The custom chevron icon HTML to replace with
        $chevron_icon_html = '<i class="tm-sprite-3 bg-chevron-down"></i>';
        
        // Regular expression to match the SVG icon
        $pattern = '/<svg[^>]*><path[^>]*><\/path><\/svg>/';
        
        // Replace the SVG with the chevron icon
        $block_content = preg_replace($pattern, $chevron_icon_html, $block_content);
    }

    return $block_content;
}

add_filter('render_block', 'tm_render_block_core_navigation_submenu', null, 2);

// GA Tracking - Custom Field Registration
function tm_customize_register($wp_customize){

    $wp_customize->add_section('tm_event_tracking_settings', array(
        'title'    => __('Event Tracking Settings', 'turtlemint'),
        'priority' => 120,
    ));

    /* Add custom field for the GA4 tracking ID */

    $wp_customize->add_setting('tm_ga4_tracking_id', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('tm_ga4_tracking_id', array(
        'label'      => __('GA4 Tracking ID', 'turtlemint'),
        'description' => sprintf(
            '<p>Your "G-" ID appears in the GA4 setup assistant.</p>'
        ),
        'section'    => 'tm_event_tracking_settings',
        'settings'   => 'tm_ga4_tracking_id',
    ));

    /* Add custom field for the GA tracking ID */

    $wp_customize->add_setting('tm_ga_tracking_id', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('tm_ga_tracking_id', array(
        'label'      => __('GA Tracking ID', 'turtlemint'),
        'description' => sprintf(
            '<p>Your "UA-" ID appears at the top of the Property Settings page.</p>'
        ),
        'section'    => 'tm_event_tracking_settings',
        'settings'   => 'tm_ga_tracking_id',
    ));

    /* Add custom field for the GTM ID */

    $wp_customize->add_setting('tm_gtm_id', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('tm_gtm_id', array(
        'label'      => __('GTM ID', 'turtlemint'),
        'description' => sprintf(
            '<p>Your "GTM-XXXXXX" ID appears in the google tag manager window.</p>'
        ),
        'section'    => 'tm_event_tracking_settings',
        'settings'   => 'tm_gtm_id',
    ));
}

add_action('customize_register', 'tm_customize_register');

// Limit content
function limitPostContent($content, $limit, $suffix = '...') {
    // Check if the content length is greater than the limit
    if (mb_strlen($content) > $limit) {
        // Trim the content to the specified limit
        $content = mb_substr($content, 0, $limit);
        
        // Find the last space within the trimmed content
        $lastSpace = mb_strrpos($content, ' ');
        
        // If a space is found, truncate the content there
        if ($lastSpace !== false) {
            $content = mb_substr($content, 0, $lastSpace);
        }
        
        // Add the suffix to the truncated content
        $content .= $suffix;
    }
    
    return $content;
}

/* TM Excerpt */
function tm_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'tm_excerpt_length', 999);

function remove_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'remove_excerpt_more');

// Hide WordPress version
function tm_remove_wp_version() {
    return '';
}
add_filter('the_generator', 'tm_remove_wp_version');

// Disable WordPress XML-RPC
add_filter('xmlrpc_enabled', '__return_false');
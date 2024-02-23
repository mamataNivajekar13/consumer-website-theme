<?php

/****************** Shortcodes ******************/
// Megamenu
include get_stylesheet_directory() . '/shortcodes/tm-megamenu.php';

// FAQs
include get_stylesheet_directory() . '/shortcodes/tm-select-insurance.php';

// Youtube Player
include get_stylesheet_directory() . '/shortcodes/youtube-modal.php';

// Copyright Year
include get_stylesheet_directory() . '/shortcodes/tm-copyright-year.php';

// Social Profiles
include get_stylesheet_directory() . '/shortcodes/tm-social-profiles.php';

// Select Insurance
include get_stylesheet_directory() . '/shortcodes/tm-faqs.php';

// Get A Quote CTAs
include get_stylesheet_directory() . '/shortcodes/tm-get-a-quote-ctas.php';

// Get A Quote
include get_stylesheet_directory() . '/shortcodes/tm-get-a-quote.php';

// Find Advisor
include get_stylesheet_directory() . '/shortcodes/tm-find-advisor.php';

// Banner CTA
include get_stylesheet_directory() . '/shortcodes/tm-banner-cta.php';

// Breadcrumb
include get_stylesheet_directory() . '/shortcodes/tm-breadcrumb.php';

// Sidebar
include get_stylesheet_directory() . '/shortcodes/tm-sidebar.php';

// Related Posts
include get_stylesheet_directory() . '/shortcodes/tm-related-posts.php';

// Pagination
include get_stylesheet_directory() . '/shortcodes/tm-pagination.php';

// Popup
include get_stylesheet_directory() . '/shortcodes/tm-popup.php';

// Partners
include get_stylesheet_directory() . '/shortcodes/tm-partners.php';

// IC Banner
include get_stylesheet_directory() . '/shortcodes/tm-ic-banner.php';

// IC Secondary Navbar
include get_stylesheet_directory() . '/shortcodes/tm-secondary-navbar.php';

// IC About
include get_stylesheet_directory() . '/shortcodes/tm-ic-about.php';

// IC Claim Settlement Ratio
include get_stylesheet_directory() . '/shortcodes/tm-ic-claim-settlement-ratio.php';

// IC Plans
include get_stylesheet_directory() . '/shortcodes/tm-ic-plans.php';

// IC Calculator
include get_stylesheet_directory() . '/shortcodes/tm-ic-calculator.php';

// IC Customer Care
include get_stylesheet_directory() . '/shortcodes/tm-ic-customer-care.php';

// IC Features
include get_stylesheet_directory() . '/shortcodes/tm-ic-features.php';

// IC Exclusions
include get_stylesheet_directory() . '/shortcodes/tm-ic-exclusions.php';

// IC Buying Process
include get_stylesheet_directory() . '/shortcodes/tm-ic-buying-process.php';

// IC Renewal Process
include get_stylesheet_directory() . '/shortcodes/tm-ic-renewal-process.php';

// IC Claim Process
include get_stylesheet_directory() . '/shortcodes/tm-ic-claim-process.php';

// IC FAQs
include get_stylesheet_directory() . '/shortcodes/tm-ic-faqs.php';

// IC Latest Articles
include get_stylesheet_directory() . '/shortcodes/tm-ic-latest-articles.php';

// IC Download App
include get_stylesheet_directory() . '/shortcodes/tm-ic-download-app.php';

// IC Add-ons
include get_stylesheet_directory() . '/shortcodes/tm-ic-add-ons.php';

// IC Documents
include get_stylesheet_directory() . '/shortcodes/tm-ic-documents.php';

// Insurance Companies
include get_stylesheet_directory() . '/shortcodes/tm-insurance-companies.php';

// NH Banner
include get_stylesheet_directory() . '/shortcodes/tm-ic-nh-banner.php';

// NH insurance companies
include get_stylesheet_directory() . '/shortcodes/tm-nh-insurance-companies.php';

// NH popular cities
include get_stylesheet_directory() . '/shortcodes/tm-ic-nh-popular-city.php';

// NH breadcrumb
include get_stylesheet_directory() . '/shortcodes/tm-nh-breadcrumb.php';

// NH states list
include get_stylesheet_directory() . '/shortcodes/tm-ic-nh-states.php';

// NH hospitals list
include get_stylesheet_directory() . '/shortcodes/tm-nh-hospitals.php';

// Download Topbar
include get_stylesheet_directory() . '/shortcodes/tm-app-download-topbar.php';

// nearby cities Topbar
include get_stylesheet_directory() . '/shortcodes/tm-nh-nearby-cities.php';

// nearby insurers
include get_stylesheet_directory() . '/shortcodes/tm-nh-nearby-insurers.php';

// NH search box
include get_stylesheet_directory() . '/shortcodes/tm-nh-search-box.php';

// Author Contact
include get_stylesheet_directory() . '/shortcodes/tm-author-contact.php';

// IC Ancillary Links
include get_stylesheet_directory() . '/shortcodes/tm-ic-ancillary-links.php';

// Lead Unit CTA
include get_stylesheet_directory() . '/shortcodes/tm-lead-unit-cta.php';

// IC Plan Links
include get_stylesheet_directory() . '/shortcodes/tm-ic-plan-links.php';

// CG Banner
include get_stylesheet_directory() . '/shortcodes/tm-cg-banner.php';

// CG Garage listing
include get_stylesheet_directory() . '/shortcodes/tm-cg-list.php';

// CG Breadcrumb
include get_stylesheet_directory() . '/shortcodes/tm-cg-breadcrumb.php';

// CG Popular Cities
include get_stylesheet_directory() . '/shortcodes/tm-cg-popular-cities.php';

// CG States section
include get_stylesheet_directory() . '/shortcodes/tm-cg-states.php';

// CG insurance companies
include get_stylesheet_directory() . '/shortcodes/tm-cg-insurance-companies.php';

// CG nearby insurers
include get_stylesheet_directory() . '/shortcodes/tm-cg-nearby-insurers.php';

// CG nearby insurers
include get_stylesheet_directory() . '/shortcodes/tm-cg-nearby-cities.php';

// CG search box
include get_stylesheet_directory() . '/shortcodes/tm-cg-search-box.php';

/********** File Version **********/
function fileVersion($filePath){
	return filemtime(get_stylesheet_directory() . $filePath);
}

/*****Register Block Pattern Category *****/
function turtlemint_child_pattern_categories() {
    register_block_pattern_category(
        'cards',
        array( 'label' => __( 'Cards', 'turtlemint-child' ) )
    );
}
  
 add_action( 'init', 'turtlemint_child_pattern_categories' );

/******* Enqueue Styles **********/
function tm_child_styles()
{
	// Default styles
	wp_enqueue_style( 'tm-default-styles', get_stylesheet_uri(), [], 0.1);

    global $template;
    $templateName = basename($template);
    if($templateName == 'taxonomy-health-insurer.php'){
        // Icons
        wp_enqueue_style( 'tm-icons', get_stylesheet_directory_uri(). '/tm-assets/css/tm-icons.min.css' , [], fileVersion('/tm-assets/css/tm-icons.min.css'));
        // Theme Styles
        wp_enqueue_style( 'ic-pages', get_stylesheet_directory_uri(). '/tm-assets/css/ic-pages.min.css' , [], fileVersion('/tm-assets/css/ic-pages.min.css'));
    }
    if($templateName == 'ic-renewal.php' || $templateName == 'ic-customer-care.php' || $templateName == 'ic-premium-calculator.php' || $templateName == 'ic-claim-settlement.php' || $templateName == 'ic-benefits.php' || $templateName == 'ic-critical-illness.php' || $templateName == 'ic-plans.php'){
        // Icons
        wp_enqueue_style( 'tm-icons', get_stylesheet_directory_uri(). '/tm-assets/css/tm-icons.min.css' , [], fileVersion('/tm-assets/css/tm-icons.min.css'));
        // Theme Styles
        wp_enqueue_style( 'ancillary-pages', get_stylesheet_directory_uri(). '/tm-assets/css/ancillary-pages.min.css' , [], fileVersion('/tm-assets/css/ancillary-pages.min.css'));
    }
    elseif($templateName == 'taxonomy-bike-insurer.php' || $templateName == 'taxonomy-car-insurer.php'){
        // Icons
        wp_enqueue_style( 'tm-icons', get_stylesheet_directory_uri(). '/tm-assets/css/tm-icons.min.css' , [], fileVersion('/tm-assets/css/tm-icons.min.css'));
        // Theme Styles
        wp_enqueue_style( 'bike-ic-pages', get_stylesheet_directory_uri(). '/tm-assets/css/bike-ic-pages.min.css' , [], fileVersion('/tm-assets/css/bike-ic-pages.min.css'));
    }
    elseif($templateName === 'tm-cg-network.php'){
        wp_enqueue_style( 'cashless-garages-styles', get_stylesheet_directory_uri(). '/tm-assets/css/cashless-garages-pages.min.css' , [], fileVersion('/tm-assets/css/cashless-garages-pages.min.css'));

        wp_enqueue_style( 'tm-icons', get_stylesheet_directory_uri(). '/tm-assets/css/tm-icons.min.css' , [], fileVersion('/tm-assets/css/tm-icons.min.css'));

        wp_enqueue_style( 'select2-styles', get_stylesheet_directory_uri(). '/assets/css/select2.min.css');
    }
    elseif($templateName === 'tm-cg-city-list.php'){
        wp_enqueue_style( 'cashless-garages-styles', get_stylesheet_directory_uri(). '/tm-assets/css/cashless-garages-pages.min.css' , [], fileVersion('/tm-assets/css/cashless-garages-pages.min.css'));

        wp_enqueue_style( 'tm-icons', get_stylesheet_directory_uri(). '/tm-assets/css/tm-icons.min.css' , [], fileVersion('/tm-assets/css/tm-icons.min.css'));

        wp_enqueue_style( 'datatable-css', get_stylesheet_directory_uri(). '/assets/css/dataTables.min.css');
    }
    elseif($templateName === 'ic-network-hospitals.php' || $templateName == 'tm-nh-hospitals-list.php'){
        // Icons
        wp_enqueue_style( 'tm-icons', get_stylesheet_directory_uri(). '/tm-assets/css/tm-icons.min.css' , [], fileVersion('/tm-assets/css/tm-icons.min.css'));
        wp_enqueue_style( 'network-hospitals-styles', get_stylesheet_directory_uri(). '/tm-assets/css/network-hospitals-pages.min.css' , [], fileVersion('/tm-assets/css/network-hospitals-pages.min.css'));
        wp_enqueue_style( 'select2-styles', get_stylesheet_directory_uri(). '/assets/css/select2.min.css');
    }
    else{
        // Icons
        wp_enqueue_style( 'tm-icons', get_stylesheet_directory_uri(). '/tm-assets/css/tm-icons.min.css' , [], fileVersion('/tm-assets/css/tm-icons.min.css'));
        // Theme Styles
        wp_enqueue_style( 'tm-styles', get_stylesheet_directory_uri(). '/tm-assets/css/tm-styles.min.css' , [], fileVersion('/tm-assets/css/tm-styles.min.css'));
        // Slick Styles
        wp_enqueue_style( 'slick-styles', get_stylesheet_directory_uri(). '/assets/css/slick.min.css');
    }

    if($templateName == 'tm-nh-hospitals-list.php'){
        wp_enqueue_style( 'datatable-css', get_stylesheet_directory_uri(). '/assets/css/dataTables.min.css');
    }

    if($templateName == 'page-advisor-intro.php' || $templateName == 'page-advisor-list.php'):
        wp_enqueue_style( 'find-advisor-styles', get_stylesheet_directory_uri(). '/assets/css/find-advisor-pages.min.css' , [], fileVersion('/assets/css/find-advisor-pages.min.css'));
    endif;
}
add_action('wp_enqueue_scripts', 'tm_child_styles');

/******* Enqueue Scripts **********/
function tm_child_scripts()
{
    global $template;
    $templateName = basename($template);

    $htmlTemplateName = get_page_template_slug();

	// jQuery
	wp_enqueue_script( 'tm-jquery', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', array(), '3.6.4', true );

    // Bootstap Bundle Scripts
	wp_enqueue_script( 'bootstrap-bundle-script', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), true );

    if($templateName == 'page-advisor-intro.php' || $templateName == 'page-advisor-list.php' || $htmlTemplateName == 'page-life-insurance' || $htmlTemplateName == 'page-bike-insurance' || $htmlTemplateName == 'page-car-insurance'){
        // Turtlemint Critical js
        wp_enqueue_script( 'tm-critical', get_stylesheet_directory_uri() . '/assets/js/tm-critical.min.js', array(), fileVersion('/assets/js/tm-critical.min.js'), true );
        // Pass the ACF value to the script
        wp_localize_script('tm-critical', 'find_advisor_settings', array(
            'fa_server_1' => get_field('fa_server_1', 'option'),
            'fa_server_2' => get_field('fa_server_2', 'option'),
            'fa_api_key' => get_field('fa_api_key', 'option'),
        ));
    }

    // Turtlemint Scripts
	wp_enqueue_script( 'tm-scripts', get_stylesheet_directory_uri() . '/assets/js/tm-scripts.min.js', array(), fileVersion('/assets/js/tm-scripts.min.js'), true );

    if($templateName == 'ic-network-hospitals.php'){
        wp_enqueue_script( 'select2-js', get_stylesheet_directory_uri() . '/assets/js/select2.min.js', array('jquery'), "", true );
        wp_enqueue_script( 'tm-nh', get_stylesheet_directory_uri() . '/assets/js/tm-nh.min.js', array(), fileVersion('/assets/js/tm-nh.min.js'), true );
    }

    if($templateName != 'taxonomy-health-insurer.php' && $templateName != 'taxonomy-bike-insurer.php' && $templateName != 'taxonomy-car-insurer.php' && $templateName != 'ic-renewal.php' && $templateName != 'ic-customer-care.php' && $templateName != 'ic-premium-calculator.php' && $templateName != 'ic-claim-settlement.php' && $templateName != 'ic-benefits.php' && $templateName != 'ic-critical-illness.php' && $templateName != 'ic-plans.php' && $templateName != 'tm-cg-network.php' && $templateName != 'tm-cg-city-list.php' && $templateName != 'tm-nh-hospitals-list.php' && $templateName != 'ic-network-hospitals.php'){
        // Slick Scripts
        wp_enqueue_script( 'slick-script', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array(), "", true );

        // Sliders Scripts
        wp_enqueue_script( 'sliders-script', get_stylesheet_directory_uri() . '/assets/js/tm-sliders.min.js', array(), "", true );
    }

    if($templateName != 'taxonomy-health-insurer.php' || $templateName == 'taxonomy-bike-insurer.php' || $templateName == 'taxonomy-car-insurer.php' || $templateName == 'ic-renewal.php' || $templateName == 'ic-customer-care.php' || $templateName == 'ic-premium-calculator.php' || $templateName == 'ic-claim-settlement.php' || $templateName == 'ic-benefits.php' || $templateName == 'ic-critical-illness.php' || $templateName == 'ic-plans.php'){
        // Turtlemint Forms
        wp_enqueue_script( 'tm-forms', get_stylesheet_directory_uri() . '/assets/js/tm-forms.min.js', array(), fileVersion('/assets/js/tm-forms.min.js'), true );
    }

    if($templateName == 'page-advisor-intro.php' || $templateName == 'page-advisor-list.php'):
        wp_enqueue_script( 'locator', get_stylesheet_directory_uri() . '/assets/js/locator.js', array(), '', true );
    endif;

    if($templateName == 'tm-nh-hospitals-list.php'){
        // wp_enqueue_script('datatable-js', '//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'dataTables-js', get_stylesheet_directory_uri() . '/assets/js/dataTables.min.js', array('jquery'), "", true );
        wp_enqueue_script( 'tm-nh-listing', get_stylesheet_directory_uri() . '/assets/js/tm-nh-listing.min.js', array(), fileVersion('/assets/js/tm-nh-listing.min.js'), true );
    }

    if($templateName == 'tm-cg-network.php'){
        wp_enqueue_script( 'select2-js', get_stylesheet_directory_uri() . '/assets/js/select2.min.js', array('jquery'), "", true );
        wp_enqueue_script( 'tm-cg', get_stylesheet_directory_uri() . '/assets/js/tm-cg.min.js', array(), fileVersion('/assets/js/tm-cg.min.js'), true );
        wp_enqueue_script( 'tm-cg-search-box', get_stylesheet_directory_uri() . '/assets/js/tm-cg-search-box.min.js', array(), fileVersion('/assets/js/tm-cg-search-box.min.js'), true );
    }

    if($templateName == 'tm-cg-city-list.php'){
        wp_enqueue_script( 'dataTables-js', get_stylesheet_directory_uri() . '/assets/js/dataTables.min.js', array('jquery'), "", true );
        wp_enqueue_script( 'tm-cg-listing', get_stylesheet_directory_uri() . '/assets/js/tm-cg-listing.min.js', array(), fileVersion('/assets/js/tm-cg-listing.min.js'), true );
    }
    
    if($templateName == 'taxonomy-car-insurer.php') {
        wp_enqueue_script( 'tm-cg-search-box', get_stylesheet_directory_uri() . '/assets/js/tm-cg-search-box.min.js', array(), fileVersion('/assets/js/tm-cg-search-box.min.js'), true );
    }
    
}
add_action('wp_enqueue_scripts', 'tm_child_scripts');

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

/************ Footer Scripts ************/
function tm_footer_scripts_bottom() {
    include get_stylesheet_directory() . '/header-footer-scripts/footer-scripts-bottom.php';
}
add_action( 'wp_footer', 'tm_footer_scripts_bottom', 100 );

function tm_footer_scripts_top() {
    include get_stylesheet_directory() . '/header-footer-scripts/footer-scripts-top.php';
}
add_action( 'wp_footer', 'tm_footer_scripts_top', 0 );

/************ Head Scripts ************/
function tm_head_scripts_bottom() {
    include get_stylesheet_directory() . '/header-footer-scripts/head-scripts-bottom.php';
}
add_action( 'wp_head', 'tm_head_scripts_bottom', 100 );

function tm_head_scripts_top() {
    include get_stylesheet_directory() . '/header-footer-scripts/head-scripts-top.php';
}
add_action( 'wp_head', 'tm_head_scripts_top', 0 );

/*********** Customize Fields | Start *************/

/************ Event Tracking Settings ************/

function tm_customize_register($wp_customize){

    $wp_customize->add_section('tm_event_tracking_settings', array(
        'title'    => __('Event Tracking Settings', 'turtlemint-child'),
        'priority' => 120,
    ));

    /* Add custom field for the GA4 tracking ID */

    $wp_customize->add_setting('tm_ga4_tracking_id', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('tm_ga4_tracking_id', array(
        'label'      => __('GA4 Tracking ID', 'turtlemint-child'),
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
        'label'      => __('GA Tracking ID', 'turtlemint-child'),
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

/*********** Customize Fields | End *************/

/**************** Function to add Menu Locations ****************/
function tm_nav_menus() {
    register_nav_menus( array(
        'tm_header_menu'=> __('Header Menu', 'turtlemint-child')
    ));
}
add_action('init', 'tm_nav_menus');

/************************ Widget Areas ************************/

// Megamenu - Car Vertical
function megamenu_car()
{
	register_sidebar(
		array(
			'id' => 'megamenu_car',
			'name' => esc_html__('Megamenu - Car', 'turtlemint-child'),
			'description' => esc_html__('Add megamenu content for the Car vertical', 'turtlemint-child'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title-holder"><p class="widget-title">',
			'after_title' => '</p></div>'
		)
	);
}
add_action('widgets_init', 'megamenu_car');

// Megamenu - Bike Vertical
function megamenu_bike()
{
	register_sidebar(
		array(
			'id' => 'megamenu_bike',
			'name' => esc_html__('Megamenu - Bike', 'turtlemint-child'),
			'description' => esc_html__('Add megamenu content for the Bike vertical', 'turtlemint-child'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title-holder"><p class="widget-title">',
			'after_title' => '</p></div>'
		)
	);
}
add_action('widgets_init', 'megamenu_bike');

// Megamenu - Health Vertical
function megamenu_health()
{
	register_sidebar(
		array(
			'id' => 'megamenu_health',
			'name' => esc_html__('Megamenu - Health', 'turtlemint-child'),
			'description' => esc_html__('Add megamenu content for the Health vertical', 'turtlemint-child'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title-holder"><p class="widget-title">',
			'after_title' => '</p></div>'
		)
	);
}
add_action('widgets_init', 'megamenu_health');

// Megamenu - Life Vertical
function megamenu_life()
{
	register_sidebar(
		array(
			'id' => 'megamenu_life',
			'name' => esc_html__('Megamenu - Life', 'turtlemint-child'),
			'description' => esc_html__('Add megamenu content for the Life vertical', 'turtlemint-child'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title-holder"><p class="widget-title">',
			'after_title' => '</p></div>'
		)
	);
}
add_action('widgets_init', 'megamenu_life');

/************* Custom Taxonomies *************/
function tm_custom_taxonomies() {
    // Taxonomy - Group
    register_taxonomy( 'tm_group', 'Group',  array(
        'labels'      => array(
            'name'          => __('Groups', 'turtlemint-child'),
            'singular_name' => __('Group', 'turtlemint-child'),
            'add_new_item'  => __('Add New Group', 'turtlemint-child'),
            'not_found'     => __('No Groups Found.', 'turtlemint-child')
        ),
        'show_in_rest' => true,
        'show_admin_column' => true
    ) );
    //Vertical Slug Change
    // Taxonomy - Health Insurer
    register_taxonomy('health-insurer', 'Health Insurer',  array(
        'labels'      => array(
            'name'          => __('Health Insurers', 'turtlemint-child'),
            'singular_name' => __('Health Insurer', 'turtlemint-child'),
            'add_new_item'  => __('Add New Health Insurer', 'turtlemint-child'),
            'not_found'     => __('No Health Insurer Found.', 'turtlemint-child')
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite'   =>  [
            'hierarchical' => false,
        ]
    ));

    //Vertical Slug Change
    // Taxonomy - Bike Insurer
    register_taxonomy('bike-insurer', 'Bike Insurer',  array(
        'labels'      => array(
            'name'          => __('Bike Insurers', 'turtlemint-child'),
            'singular_name' => __('Bike Insurer', 'turtlemint-child'),
            'add_new_item'  => __('Add New Bike Insurer', 'turtlemint-child'),
            'not_found'     => __('No Bike Insurer Found.', 'turtlemint-child')
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite'   =>  [
            'hierarchical' => false,
        ]
    ));

    //Vertical Slug Change
    // Taxonomy - Car Insurer
    register_taxonomy('car-insurer', 'Car Insurer',  array(
        'labels'      => array(
            'name'          => __('Car Insurers', 'turtlemint-child'),
            'singular_name' => __('Car Insurer', 'turtlemint-child'),
            'add_new_item'  => __('Add New Car Insurer', 'turtlemint-child'),
            'not_found'     => __('No Car Insurer Found.', 'turtlemint-child')
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite'   =>  [
            'hierarchical' => false,
        ]
    ));

    // Taxonomy - Plan Type
    register_taxonomy('plan-type', 'Plan Type',  array(
        'labels'      => array(
            'name'          => __('Plan Types', 'turtlemint-child'),
            'singular_name' => __('Plan Type', 'turtlemint-child'),
            'add_new_item'  => __('Add New Plan Type', 'turtlemint-child'),
            'not_found'     => __('No Plan Type Found.', 'turtlemint-child')
        ),
        'hierarchical' => false,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
    // Taxonomy - Health Tag
    register_taxonomy('health-tag', 'Health Tag',  array(
        'labels'      => array(
            'name'          => __('Health Tags', 'turtlemint-child'),
            'singular_name' => __('Health Tag', 'turtlemint-child'),
            'add_new_item'  => __('Add New Health Tag', 'turtlemint-child'),
            'not_found'     => __('No Health Tag Found.', 'turtlemint-child')
        ),
        'hierarchical' => false,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
    // Taxonomy - Bike Tag
    register_taxonomy('bike-tag', 'Bike Tag',  array(
        'labels'      => array(
            'name'          => __('Bike Tags', 'turtlemint-child'),
            'singular_name' => __('Bike Tag', 'turtlemint-child'),
            'add_new_item'  => __('Add New Bike Tag', 'turtlemint-child'),
            'not_found'     => __('No Bike Tag Found.', 'turtlemint-child')
        ),
        'hierarchical' => false,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
    // Taxonomy - Car Tag
    register_taxonomy('car-tag', 'Car Tag',  array(
        'labels'      => array(
            'name'          => __('Car Tags', 'turtlemint-child'),
            'singular_name' => __('Car Tag', 'turtlemint-child'),
            'add_new_item'  => __('Add New Car Tag', 'turtlemint-child'),
            'not_found'     => __('No Car Tag Found.', 'turtlemint-child')
        ),
        'hierarchical' => false,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
}
add_action( 'init', 'tm_custom_taxonomies', 0 );

/************* Custom Post Types *************/
function tm_custom_post_types() {
    // Post Type - FAQs
	register_post_type('tm_faqs',
		array(
			'labels'      => array(
				'name'          => __('FAQs', 'turtlemint-child'),
				'singular_name' => __('FAQ', 'turtlemint-child'),
                'add_new_item'  => __('Add New FAQ', 'turtlemint-child'),
                'not_found'     => __('No FAQs Found.', 'turtlemint-child')
			),
			'public'      => true,
			'has_archive' => false,
            'menu_icon'   => 'dashicons-list-view',
            'supports'    => array( 'title', 'editor', 'author'),
            'show_in_rest' => true,
            'exclude_from_search' => true,
            'taxonomies'   => array( 'tm_group'),
		)
	);
    // Post Type - Health Plans
    register_post_type(
        'health-plan',
        array(
            'labels'      => array(
                'name'          => __('Health Plans', 'turtlemint-child'),
                'singular_name' => __('Health Plan', 'turtlemint-child'),
                'add_new_item'  => __('Add New Health Plan', 'turtlemint-child'),
                'not_found'     => __('No Health Plans Found.', 'turtlemint-child')
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-heart',
            'supports'    => array('title', 'editor', 'author', 'excerpt'),
            'show_in_rest' => true,
            'exclude_from_search' => false,
            'taxonomies'   => array('health-insurer', 'plan-type', 'health-tag'),
        )
    );
    // Post Type - Bike Plans
    register_post_type(
        'bike-plan',
        array(
            'labels'      => array(
                'name'          => __('Bike Plans', 'turtlemint-child'),
                'singular_name' => __('Bike Plan', 'turtlemint-child'),
                'add_new_item'  => __('Add New Bike Plan', 'turtlemint-child'),
                'not_found'     => __('No Bike Plans Found.', 'turtlemint-child')
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-shield-alt',
            'supports'    => array('title', 'editor', 'author', 'excerpt'),
            'show_in_rest' => true,
            'exclude_from_search' => false,
            'taxonomies'   => array('bike-insurer', 'bike-tag'),
        )
    );
    // Post Type - car Plans
    register_post_type(
        'car-plan',
        array(
            'labels'      => array(
                'name'          => __('Car Plans', 'turtlemint-child'),
                'singular_name' => __('Car Plan', 'turtlemint-child'),
                'add_new_item'  => __('Add New Car Plan', 'turtlemint-child'),
                'not_found'     => __('No Car Plans Found.', 'turtlemint-child')
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-car',
            'supports'    => array('title', 'editor', 'author', 'excerpt'),
            'show_in_rest' => true,
            'exclude_from_search' => false,
            'taxonomies'   => array('car-insurer', 'car-tag'),
        )
    );
}
add_action('init', 'tm_custom_post_types');

/* Yoast Breadcrumb */
add_filter( 'wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link' );

function yoast_seo_breadcrumb_append_link($links)
{
    if (is_singular('post') || is_category()) {
        $breadcrumb[] = array(
            'url' => site_url('/blog/'),
            'text' => 'Blog',
        );

        array_splice($links, 1, -2, $breadcrumb);
    }

    return $links;
}

/* Sidebar */
function tm_sidebar()
{
	register_sidebar(
		array(
			'id' => 'tm_sidebar',
			'name' => esc_html__('Sidebar', 'turtlemint-child'),
			'description' => esc_html__('Add sidebar content', 'turtlemint-child'),
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
			'name' => esc_html__('Sidebar Popup', 'turtlemint-child'),
			'description' => esc_html__('Add sidebar  popup content', 'turtlemint-child'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title-holder"><p class="widget-title">',
			'after_title' => '</p></div>'
		)
	);
}
add_action('widgets_init', 'sidebar_popup');

/* Policy cancellation popup */
function policy_cancellation_popup()
{
	register_sidebar(
		array(
			'id' => 'policy_cancellation',
			'name' => esc_html__('Policy Cancellation Popup', 'turtlemint-child'),
			'description' => esc_html__('Add Policy Cancellation Popup', 'turtlemint-child'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title-holder"><p class="widget-title">',
			'after_title' => '</p></div>'
		)
	);
}
add_action('widgets_init', 'policy_cancellation_popup');

/* TM Excerpt */
function tm_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'tm_excerpt_length', 999);

function remove_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'remove_excerpt_more');

// To set image title attribute to the value of their alt attribute
function add_alt_to_title() {
    ?>
    <script type="text/javascript">
        var images = document.getElementsByTagName("img");
        for (var i = 0; i < images.length; i++) {
            if (images[i].title === "") { // Check if the title is empty
                images[i].title = images[i].alt;
            }
        }
    </script>
    <?php
}
add_action('wp_footer', 'add_alt_to_title');

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

// Remove Yoast SEO Canonical From All Pages
add_filter( 'wpseo_canonical', '__return_false' );

/* Disable the emoji's */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/* Filter function used to remove the tinymce emoji plugin. */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/* Remove emoji CDN hostname from DNS prefetching hints */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
    /* This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    
   $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
    
   return $urls;
}

add_filter( 'wpseo_schema_organization', 'tm_organization_schema_addition', 11, 2 );

/* Add extra properties to the Yoast SEO Organization */
function tm_organization_schema_addition( $data, $context ) {
    $data['address'] = [
        '@type'  => 'PostalAddress',
        'addressCountry'   => 'India',
        'addressLocality'    => 'Andheri (East), Maharashtra',
        'addressRegion' => 'Mumbai',
        'postalCode' => '400099',
        'streetAddress' => 'The ORB - Sahar, 4B, 1st Floor, A Wing, Marol Village',
    ];
    $data['contactPoint'] = [
        '@type' => 'ContactPoint',
        'email' => 'support@turtlemint.com',
        'telephone' => '+1800-266-0101 / +91-9833248023',
        'contactType'   => 'Customer Service',
        'contactOption' => 'TollFree',
        'areaServed'    => 'IN',
        'availableLanguage' => [
            "en",
            "Hindi"
        ]
    ];

    return $data;
}

add_filter( 'wpseo_schema_webpage', 'tm_webpage_schema_addition' );

function tm_webpage_schema_addition( $data ) {

    $taxonomies_to_check = array( 'health-insurer', 'bike-insurer', 'car-insurer' );

    foreach ( $taxonomies_to_check as $taxonomy ) {
        if ( is_tax( $taxonomy ) ) {
            $data['speakable'] = array(
                '@type' => 'SpeakableSpecification',
                'xpath' => array(
                    '/html/head/title',
                    '/html/head/meta[@name="description"]/@content'
                ),
            );
            break;
        }
    }

    return $data;
}

/* Function to remove parameters */
function removeUrlParameters($url) {
    $parsedUrl = parse_url($url);
    
    if (isset($parsedUrl['scheme']) && isset($parsedUrl['host'])) {
        $newUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
        
        if (isset($parsedUrl['path'])) {
            $newUrl .= $parsedUrl['path'];
        }
        
        return $newUrl;
    }
    
    return $url;
}

/* Pagination issue fixes */
function custom_rewrite_rules() {
    // Define a custom rule for "articles" pagination with a dynamic category name
    add_rewrite_rule(
        '([^/]+)/articles/page/([0-9]+)/?$',
        'index.php?category_name=$matches[1]&paged=$matches[2]',
        'top'
    );

    // This rule should be placed above the default WordPress rewrite rules
}
add_action('init', 'custom_rewrite_rules');

/* Health insurer rewrite rule */
function taxonomy_health_insurer_rewrite_rule() {
    $terms = get_terms(array(
        'taxonomy' => 'health-insurer',
        'hide_empty' => false,
    ));

    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            // Create a rewrite rule for each term
            add_rewrite_rule(
                '^health-insurance/' . $term->slug . '/?$',
                'index.php?health-insurer=' . $term->slug,
                'top'
            );       
            add_rewrite_rule(
                '^health-insurance/' . $term->slug . '/network-hospitals/?$',
                'index.php?health-ic=' . $term->slug,
                'top'
            );
            add_rewrite_rule(
                '^health-insurance/' . $term->slug . '/network-hospitals/([^/]+)/?$',
                'index.php?health-ic=' . $term->slug.'&health-ic-city=$matches[1]',
                'top'
            );

            $ancillary_pages = validate_insurer_data($term, true);

            foreach($ancillary_pages as $page){
                $insurer_url = get_term_link($page['insurer_slug'], 'health-insurer');
                if($page['link'] != $insurer_url){
                    add_rewrite_rule(
                        '^health-insurance/' . $page['insurer_slug'] . '/' . $page['page_slug'] . '/?$',
                        'index.php?health-ic=' . $page['insurer_slug'],
                        'top'
                    );
                }
            }
        }
    }
}
add_action('init', 'taxonomy_health_insurer_rewrite_rule');

/* Bike insurer rewrite rule */
function taxonomy_bike_insurer_rewrite_rule() {
    $terms = get_terms(array(
        'taxonomy' => 'bike-insurer',
        'hide_empty' => false,
    ));

    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            // Create a rewrite rule for each term
            add_rewrite_rule(
                '^bike-insurance/' . $term->slug . '/?$',
                'index.php?bike-insurer=' . $term->slug,
                'top'
            );
        }
    }
}
add_action('init', 'taxonomy_bike_insurer_rewrite_rule');

/* Car insurer rewrite rule */
function taxonomy_car_insurer_rewrite_rule() {
    $terms = get_terms(array(
        'taxonomy' => 'car-insurer',
        'hide_empty' => false,
    ));

    if ($terms && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            // Create a rewrite rule for each term
            add_rewrite_rule(
                '^car-insurance/' . $term->slug . '/?$',
                'index.php?car-insurer=' . $term->slug,
                'top'
            );
            add_rewrite_rule(
                '^car-insurance/' . $term->slug . '/cashless-garages/?$',
                'index.php?car-ic=' . $term->slug,
                'top'
            );
            add_rewrite_rule(
                '^car-insurance/' . $term->slug . '/cashless-garages/([^/]+)/?$',
                'index.php?car-ic=' . $term->slug.'&car-cg-city=$matches[1]',
                'top'
            );
        }
    }
}
add_action('init', 'taxonomy_car_insurer_rewrite_rule');

/* Option pages */
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'tm-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Verticals Settings',
        'menu_title'    => 'Verticals',
        'parent_slug'   => 'tm-general-settings',
    ));
}

// CF7 - Stop loading the JavaScript and CSS stylesheet on all pages
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

function load_cf7_js_css() {

    global $template;
    $templateName = basename($template);

    $htmlTemplateName = get_page_template_slug();

    if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
        wpcf7_enqueue_scripts();
      }
       
    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
        wpcf7_enqueue_styles();
    }
}

add_action('wp_head', 'load_cf7_js_css', 1);

// Convert days into years
function convertDays($days){
    if ($days < 100) {
        // Display days as they are if below 100 days
        if($days == 1){
            return "$days day";
        }else{
            return "$days days";
        }
    } else {
        $months = floor($days / 30); // Assuming an average month has 30 days
        if ($months <= 5) {
            // Display months for the first 5 months
            return "$months months";
        } else {
            $years = number_format($months / 12, 1);
            
            if ($years > 0) {
                // Display years if there are more than 12 months
                $yearsOutput =number_format($days/365, 1);

                // Remove the trailing zero if the decimal part starts with zero
                if (substr($yearsOutput, -2) == '.0') {
                    $yearsOutput = number_format($days / 365, 0);
                }

                if($yearsOutput == 1){
                    return $yearsOutput." year";
                }else{
                    return $yearsOutput." years";
                }
            }
        }
    }
}

function convertDaysToYears($days){
    $years = number_format($days/365, 1);
    if($years == 1){
        return $years." Year";
    }else{
        return $years." Years";
    }
}

// Function convert number into lakh or crore
function convertNumber($number)
{
    if ($number >= 10000000) {
        $convertedNumber = number_format(round($number / 10000000, 2)) . ' Cr';
    } elseif ($number >= 100000) {
        $convertedNumber = number_format(round($number / 100000, 2)) . ' Lakh';
    } else {
        $convertedNumber = number_format($number);
    }
    return $convertedNumber;
}

// Function to create read more link
function readMore($content, $limit)
{
    if (strlen($content) > $limit) {
        $trimmedContent = substr($content, 0, $limit);
        $remainingContent = substr($content, $limit);

        return '<p id="readMoreContent" style="margin-bottom:0px;">' . $trimmedContent . '<span id="remainingContent" style="display:none;">' . $remainingContent . '</span><span id="ellipsis">...</span><a id="readMoreLink" class="tm-link cta" style="display:inline-block" onclick="expandContent(this)">Read More</a></p>';
    } else {
        return '<p>' . $content . '</p>';
    }
}

// Ajax - show all plans
function show_all_plans()
{
    $taxonomy = $_POST['taxonomy'];
    $term = $_POST['term'];
    $plan_subtype = $_POST['subtype'];
    $plan_tag = $_POST['tag'];
    $plan_posttype = $_POST['posttype'];
    $posts_per_page = $_POST['posts_per_page'];
    $display_name = $_POST['display_name'];
    $vertical_name = $_POST['vertical_name'];
    $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));
    $args = [
        'post_type' =>  $plan_posttype,
        'post_status' => 'publish',
        'posts_per_page'  => $posts_per_page,
        'orderby' => array(
            'meta_value_num' => 'DESC', // Sort by the meta value in descending order
            'title' => 'ASC', // Sort titles in ascending order
        ),
        'meta_key' => 'plan_top', // Top plans
        'tax_query' => array(
            'relation'  => 'AND',
            array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $term,
            ),
        ),
    ];

    // Top-up Plans
    if ($plan_subtype == 'top-up') {
        $args['tax_query'][] =
            array(
              'taxonomy' => 'plan-type',
              'field' => 'slug',
              'terms' => 'top-up',
            );
    }else{
        $args['tax_query'][] =
        array(
          'taxonomy' => 'plan-type',
          'field' => 'slug',
          'terms' => 'top-up',
          'operator' => 'NOT IN',
        );
    }

    // Critical Illness Plans
    if($plan_tag != '' && $plan_tag != null && $convertedVerticalName){
        $args['tax_query'][] = 
        array(
            'taxonomy' => $convertedVerticalName.'-tag',
            'field' => 'slug',
            'terms' => $plan_tag,
        );
        }

    $ajaxposts = new WP_Query($args);

    $response = '';

    $totalPlans = $ajaxposts->found_posts;

    if ($ajaxposts->have_posts()) {
        ob_start();
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            $response .= get_template_part( 'parts/card', 'plan', [
                'plan_subtype'  => $plan_subtype,
                'insurer' => $display_name,
                'vertical'  => $vertical_name
              ] );
        endwhile;
        $output = ob_get_contents();
        ob_end_clean();
    } else {
        $response = 'No plans found.';
    }

    $result = [
        'html' => $output,
    ];
    echo json_encode($result);
    exit;
}
add_action('wp_ajax_show_all_plans', 'show_all_plans');
add_action('wp_ajax_nopriv_show_all_plans', 'show_all_plans');

// Smallest number
function findSmallestNumber($array) {
    if (empty($array)) {
        return null; // Return null for an empty array
    }

    $smallest = null; // Initialize with null to find the smallest non-zero number

    foreach ($array as $number) {
        if (!empty($number) && ($smallest === null || $number < $smallest)) {
            $smallest = $number; // Update the smallest number if a smaller one is found and the number is not empty
        }
    }

    return $smallest;
}
// Largest number
function findLargestNumber($array) {
    // Check if the array is empty
    if (empty($array)) {
        return null;
    }

    // Initialize the largest number with the first element of the array
    $largest = $array[0];

    // Iterate through the array to find the largest number
    foreach ($array as $number) {
        if ($number > $largest) {
            $largest = $number;
        }
    }

    return $largest;
}
add_action('init', 'custom_rewrite_rules');

// Phone number format
function formatPhoneNumber($phoneNumber) {
    // Remove any non-numeric characters from the input string
    $numericPhoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    // Format the numeric phone number with spaces
    return substr($numericPhoneNumber, 0, 4) . ' ' . substr($numericPhoneNumber, 4, 4) . ' ' . substr($numericPhoneNumber, 8);
}

// CF7 Custom tags
add_action('wpcf7_init', 'tm_form_tags');

function tm_form_tags()
{
    wpcf7_add_form_tag('vertical', 'tm_form_vertical', true);
    wpcf7_add_form_tag('base_vertical', 'tm_form_base_vertical', true);
    wpcf7_add_form_tag('insurer', 'tm_form_insurer', true);
    wpcf7_add_form_tag('pageurl', 'tm_form_page_url', true);
    wpcf7_add_form_tag('city', 'tm_form_city', true);
}

function tm_form_vertical($tag){
    global $template;
    $templateName = basename($template);

    if (is_tax() || $templateName == 'ic-network-hospitals.php' || $templateName == 'tm-nh-hospitals-list.php' || $templateName == 'ic-renewal.php' || $templateName == 'ic-customer-care.php' || $templateName == 'ic-premium-calculator.php' || $templateName == 'ic-claim-settlement.php' || $templateName == 'ic-benefits.php' || $templateName == 'ic-critical-illness.php' || $templateName == 'ic-plans.php' || $templateName == 'single-health-plan.php' || $templateName == 'tm-cg-network.php' || $templateName == 'tm-cg-city-list.php') {
        /* Theme Settings - start */
        $term = get_queried_object();

        if(!$term){
            $health_term_slug = get_query_var( 'health-ic' );
            $car_term_slug = get_query_var( 'car-ic' );
            if($health_term_slug){
                $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
            }elseif($car_term_slug){
                $term = get_term_by( 'slug', $car_term_slug, 'car-insurer' );
            }
        }

        $taxonomy_slug = $term->taxonomy;
        $theme_settings_verticals = get_field('verticals', 'option');
        $vertical_name = null;
        foreach ($theme_settings_verticals as $theme_settings_vertical) {
            $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

            if($vertical_taxonomy_slug == $taxonomy_slug){
                $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
            }
        }
        /* Theme Settings - end */
        if($vertical_name){
            if($templateName == 'ic-network-hospitals.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name . '-NH-India" type="hidden" id="' . $tag['name'] . '">';
            }else if($templateName == 'tm-nh-hospitals-list.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name . '-NH-' .ucwords(get_query_var( 'health-ic-city' )). '" type="hidden" id="' . $tag['name'] . '">';
            }else if($templateName == 'ic-renewal.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name .ucwords('-Renewal'). '" type="hidden" id="' . $tag['name'] . '">';
            }else if($templateName == 'ic-customer-care.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name .ucwords('-Customer care'). '" type="hidden" id="' . $tag['name'] . '">';
            }else if($templateName == 'ic-premium-calculator.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name .ucwords('-Premium Calculator'). '" type="hidden" id="' . $tag['name'] . '">';
            }else if($templateName == 'ic-claim-settlement.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name .ucwords('-Claim Settlement'). '" type="hidden" id="' . $tag['name'] . '">';
            }
            else if($templateName == 'ic-benefits.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name .ucwords('-Benefits'). '" type="hidden" id="' . $tag['name'] . '">';
            }
            else if($templateName == 'ic-critical-illness.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name .ucwords('-Critical Illness'). '" type="hidden" id="' . $tag['name'] . '">';
            }
            else if($templateName == 'ic-plans.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name .ucwords('-Plans'). '" type="hidden" id="' . $tag['name'] . '">';
            }elseif($templateName == 'tm-cg-network.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name . '-CG-India" type="hidden" id="' . $tag['name'] . '">';
            }else if($templateName == 'tm-cg-city-list.php'){
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name . '-CG-' .ucwords(get_query_var( 'car-cg-city' )). '" type="hidden" id="' . $tag['name'] . '">';
            }
            else{
                return '<input name="' . $tag['name'] . '" value="' . $vertical_name . '" type="hidden" id="' . $tag['name'] . '">';
            }
        }
        else {
            return '';
        }
    } else {
        return '';
    }
}

function tm_form_base_vertical($tag){
    $vertical_name = base_vertical();
    return '<input name="' . $tag['name'] . '" value="' . $vertical_name . '" type="hidden" id="' . $tag['name'] . '">';
}

function tm_form_insurer($tag){
    global $template;
    $templateName = basename($template);

    if (is_tax() || $templateName == 'ic-network-hospitals.php' || $templateName == 'tm-nh-hospitals-list.php' || $templateName == 'ic-renewal.php' || $templateName == 'ic-customer-care.php' || $templateName == 'ic-premium-calculator.php' || $templateName == 'ic-claim-settlement.php' || $templateName == 'ic-benefits.php' || $templateName == 'ic-critical-illness.php' || $templateName == 'ic-plans.php' || $templateName == 'single-health-plan.php' || $templateName == 'tm-cg-network.php' || $templateName == 'tm-cg-city-list.php') {
        $term = get_queried_object();

        if(!$term){
            $health_term_slug = get_query_var( 'health-ic' );
            $car_term_slug = get_query_var( 'car-ic' );
            if($health_term_slug){
                $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
            }elseif($car_term_slug){
                $term = get_term_by( 'slug', $car_term_slug, 'car-insurer' );
            }
        }

        $term_name = $term->name;
        return '<input name="' . $tag['name'] . '" value="' . $term_name . '" type="hidden" id="' . $tag['name'] . '">';
    }else {
        return '';
    }
}

function tm_form_page_url($tag){
    $page_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    return '<input name="' . $tag['name'] . '" value="' . $page_url . '" type="hidden" id="' . $tag['name'] . '">';
}

function tm_form_city($tag){
    global $template;
    $templateName = basename($template);
    $term = get_queried_object();

    if(!$term){
        $health_term_slug = get_query_var( 'health-ic' );
        $car_term_slug = get_query_var( 'car-ic' );
        if($health_term_slug){
            $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
        }elseif($car_term_slug){
            $term = get_term_by( 'slug', $car_term_slug, 'car-insurer' );
        }
    }
    if( $templateName == 'tm-nh-hospitals-list.php'){
        $city = get_query_var( 'health-ic-city' );
        return '<input name="' . $tag['name'] . '" value="' . $city . '" type="hidden" id="' . $tag['name'] . '">';
    }elseif( $templateName == 'tm-cg-city-list.php'){
        $city = get_query_var( 'car-cg-city' );
        return '<input name="' . $tag['name'] . '" value="' . $city . '" type="hidden" id="' . $tag['name'] . '">';
    }else {
        return '';
    }
}

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

// Yoast Breadcrumb
add_filter( 'wpseo_schema_breadcrumb', 'replace_breadcrumb_output', 11, 2 );
function replace_breadcrumb_output( $piece ) {
    if (is_tax('health-insurer') || is_tax('bike-insurer') || is_tax('car-insurer')) {

        $term = get_queried_object();

        $taxonomy_slug = $term->taxonomy;
        
        /* Theme Settings - start */
        $theme_settings_verticals = get_field('verticals', 'option');
        foreach ($theme_settings_verticals as $theme_settings_vertical) {
            $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];
    
            if($vertical_taxonomy_slug == $taxonomy_slug){
              $breadcrumb_links = $theme_settings_vertical['breadcrumb_links'];
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

        $loopOutput = [];

        $vertical_page_slug = strtolower(str_replace(' ', '-', $vertical_name))."-insurance";
        if($vertical_name == "Bike"){
            $vertical_companies_page_slug = "two-wheeler-insurance-companies";
        } elseif($vertical_name == "Car"){
            $vertical_companies_page_slug = "car-insurance-companies";
        }else{
            $vertical_companies_page_slug = strtolower(str_replace(' ', '-', $vertical_name))."-insurance-companies";
        }

        foreach ($breadcrumb_links as $key => $breadcrumb_link) {
            $linkTitle = $breadcrumb_link["title"];
            $link = $homeUrl."/".$breadcrumb_link["link"]."/";
            $key += 2;

            if($breadcrumb_link["link"] != $vertical_page_slug.'/'.$vertical_companies_page_slug){
                $loopOutput[] = [
                    "@type" => "ListItem",
                    "position" => $key,
                    "name" => $linkTitle,
                    "item" => $link
                ];
                $lastItemPosition = count($breadcrumb_links) + 2;
            }else{
                $lastItemPosition = count($breadcrumb_links) + 1;
            }
        }

        if($breadcrumb_links){
            $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }

        if($lastItemPosition && $insurer_display_name && $currentUrl){
            $piece["itemListElement"] = [
                [
                    "@type" => "ListItem",
                    "position" => 1,
                    "name" => "Home",
                    "item" => $homeUrl
                ],
                [
                    "@type" => "ListItem",
                    "position" => $lastItemPosition,
                    "name" => ucwords($insurer_display_name . " ".$vertical_name." Insurance"),
                    "item" => $currentUrl
                ]
            ];
        }

        $insertPosition = 1; // Merge position
        // Merge the loop output into the original array using array_splice
        array_splice($piece["itemListElement"], $insertPosition, 0, $loopOutput);
    }
    return $piece;
}

// Modify url for health insurer taxonomy (in wordpress dashboard & sitemap)
function modify_health_insurer_term_link($termlink, $term, $taxonomy) {
    if ($taxonomy === 'health-insurer') {
        $termlink = str_replace('health-insurer', 'health-insurance', $termlink);
    }
    if ($taxonomy === 'bike-insurer') {
        $termlink = str_replace('bike-insurer', 'bike-insurance', $termlink);
    }
    if ($taxonomy === 'car-insurer') {
        $termlink = str_replace('car-insurer', 'car-insurance', $termlink);
    }
    return $termlink;
}
add_filter('term_link', 'modify_health_insurer_term_link', 10, 3);

// Modify og:url for health insurer taxonomy
add_filter( 'wpseo_opengraph_url', 'my_opengraph_url' );

function my_opengraph_url( $url ) {
    if (strpos($url, 'health-insurer') !== false) {
        return str_replace( 'health-insurer', 'health-insurance', $url );
    }
    if (strpos($url, 'bike-insurer') !== false) {
        return str_replace( 'bike-insurer', 'bike-insurance', $url );
    }
    return $url;
}

// define the callback function 
function filter_wpcf7_is_tel( $result, $tel ) { 
    $result = preg_match('/^[6789]\d{9}$/', $tel);
    return $result; 
}; 
         
// add the filter 
add_filter( 'wpcf7_is_tel', 'filter_wpcf7_is_tel', 10, 2 );

// Templates for rewrite urls
add_filter('template_include', function ($template) {

    // Get the current URL
    $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    $terms = get_terms(array(
        'taxonomy' => 'health-insurer',
        'hide_empty' => false,
    ));

    $ancillary_pages = array();

    foreach ($terms as $term) {
        $ancillary_data = validate_insurer_data($term, true);
        if (is_array($ancillary_data)) {
            foreach ($ancillary_data as $data) {
                if (isset($data['link'])) {
                    $ancillary_pages[] = $data['link'];
                }
            }
        }
    }
    
    if (in_array($currentUrl, $ancillary_pages)) {
        $renewalUrlPattern = '/\/health-insurance\/([^\/]+)\/renewal\//';
        $customerCareUrlPattern = '/\/health-insurance\/([^\/]+)\/customer-care\//';
        $premiumCalculatorUrlPattern = '/\/health-insurance\/([^\/]+)\/premium-calculator\//';
        $claimSettlementUrlPattern = '/\/health-insurance\/([^\/]+)\/claim-settlement\//';
        $benefitsUrlPattern = '/\/health-insurance\/([^\/]+)\/benefits\//';
        $criticalIllnessUrlPattern = '/\/health-insurance\/([^\/]+)\/critical-illness\//';
        $plansUrlPattern = '/\/health-insurance\/([^\/]+)\/plans\//';

        if (preg_match($renewalUrlPattern, $currentUrl, $matches)) {
            return get_stylesheet_directory() . '/templates/ic-renewal.php';
        } elseif (preg_match($customerCareUrlPattern, $currentUrl, $matches)) {
            return get_stylesheet_directory() . '/templates/ic-customer-care.php';
        } elseif (preg_match($premiumCalculatorUrlPattern, $currentUrl, $matches)) {
            return get_stylesheet_directory() . '/templates/ic-premium-calculator.php';
        } elseif (preg_match($claimSettlementUrlPattern, $currentUrl, $matches)) {
            return get_stylesheet_directory() . '/templates/ic-claim-settlement.php';
        } elseif (preg_match($benefitsUrlPattern, $currentUrl, $matches)) {
            return get_stylesheet_directory() . '/templates/ic-benefits.php';
        } elseif (preg_match($criticalIllnessUrlPattern, $currentUrl, $matches)) {
            return get_stylesheet_directory() . '/templates/ic-critical-illness.php';
        } elseif (preg_match($plansUrlPattern, $currentUrl, $matches)) {
            return get_stylesheet_directory() . '/templates/ic-plans.php';
        } else {
            return $template;
        }
    } elseif (get_query_var('health-ic') != false && get_query_var('health-ic') != '' && get_query_var('health-ic-city') == false) {
        return get_stylesheet_directory() . '/templates/ic-network-hospitals.php';
    } elseif (get_query_var('health-ic-city') != false && get_query_var('health-ic-city') != '') {
        return get_stylesheet_directory() . '/templates/tm-nh-hospitals-list.php';
    } else {
        return $template;
    }

});

add_filter( 'template_include', function( $template ) {
    if ( get_query_var( 'car-ic' ) == false || get_query_var( 'car-ic' ) == '' ) {
        return $template;
    }
    if ( get_query_var( 'car-cg-city' ) == false || get_query_var( 'car-cg-city' ) == '' ) {
        return get_stylesheet_directory() . '/templates/tm-cg-network.php';
    }
    return get_stylesheet_directory() . '/templates/tm-cg-city-list.php';
} );


add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'health-ic';
    return $query_vars;
});

add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'health-ic-city';
    return $query_vars;
});

add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'car-ic';
    return $query_vars;
});

add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'car-cg-city';
    return $query_vars;
});

// cashless hospitals db data

function create_custom_state_city_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cashless_hospitals_state_city';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id int(10) NOT NULL AUTO_INCREMENT,
        state VARCHAR(255) NOT NULL,
        city VARCHAR(255) NOT NULL,
        lat VARCHAR(32) NOT NULL,
        lng VARCHAR(32) NOT NULL,
        nearby_cities longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`nearby_cities`)),
        PRIMARY KEY (id)
    )";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    $table_name = $wpdb->prefix . 'cashless_hospitals_insurers';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id int(10) NOT NULL AUTO_INCREMENT,
        cityid int(10) NOT NULL,
        insurer VARCHAR(255) NOT NULL,
        count int(10) NOT NULL, 
        PRIMARY KEY (id)
    )";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

}

add_action( 'init', 'create_custom_state_city_table' );


function insert_city_state_data() {
    global $wpdb;
    if(!isset($_GET['run_import_script'])) {
        return;
    }
    if(get_option('city_data_populated')) {
        return;
    }

    $file_path = get_stylesheet_directory() . '/nh-json-data/nhCityState.json';
    $json_data = file_get_contents($file_path);
    $cityNames = json_decode($json_data, true);
    
    foreach ($cityNames as $cityName) {
        $wpdb->query(
            $wpdb->prepare(
                "INSERT INTO {$wpdb->prefix}cashless_hospitals_state_city
                ( city, state, lat, lng )
                VALUES ( %s, %s, %s, %s )",
                $cityName['city'],
                $cityName['state'],
                $cityName['lat'],
                $cityName['lng']
            )
        );
    }
    echo "run import script successful";
    update_option('city_data_populated', true);
    exit;
}

add_action( 'wp_head', 'insert_city_state_data' );

function insert_insurer_data() {
    global $wpdb;
    if(!isset($_GET['run_insurere_data_script'])) {
        return;
    }
    if(get_option('insurer_data_populated')) {
        return;
    }

    $file_path = get_stylesheet_directory() . '/nh-json-data/nhInsurerData.json';
    $json_data = file_get_contents($file_path);
    $insurer_data = json_decode($json_data, true);
    
    foreach ($insurer_data as $insurer) {
        $city_id = $wpdb->get_var( "SELECT id FROM {$wpdb->prefix}cashless_hospitals_state_city WHERE city = '{$insurer['city']}'" );
        $wpdb->query(
            $wpdb->prepare(
                "INSERT INTO {$wpdb->prefix}cashless_hospitals_insurers
                ( cityid, insurer, count )
                VALUES ( %d, %s, %d )",
                (int)$city_id,
                $insurer['insurer'],
                (int)$insurer['count'],
            )
        );
    }

    echo "run import insurer script successful";
    update_option('insurer_data_populated', true);
    exit;
}

add_action( 'wp_head', 'insert_insurer_data' );


function update_nearby_cities() {
    global $wpdb;
    if(!isset($_GET['run_update_nearby_cities'])) {
        return;
    }
    if(get_option('nearby_citites_updated')) {
        return;
    }

    $file_path = get_stylesheet_directory() . '/nh-json-data/nearbyCities.json';
    $json_data = file_get_contents($file_path);
    $nearby_ctities = json_decode($json_data, true);
    
    foreach ($nearby_ctities as $nearby_city) {
        $city_array = implode("','", $nearby_city['nearby_cities']);
        $city_id = $wpdb->get_var( "SELECT id FROM {$wpdb->prefix}cashless_hospitals_state_city WHERE city = '{$nearby_city['city']}'" );
        $city_ids = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}cashless_hospitals_state_city WHERE city IN ('{$city_array}')" );
        $cityid_int_json = array_map('intval', $city_ids);
        $cityid_json = json_encode($cityid_int_json);
        $wpdb->query("UPDATE {$wpdb->prefix}cashless_hospitals_state_city set nearby_cities = '{$cityid_json}' WHERE id={$city_id}" );
    }

    echo "run update nearby cities script successful";
    update_option('nearby_citites_updated', true);
    exit;
}

add_action( 'wp_head', 'update_nearby_cities' );

function getCitiesByState($i_code) {
    global $wpdb;
    $query = "SELECT state, GROUP_CONCAT(city) AS cities FROM `wp_mdcsm8_cashless_hospitals_insurers` AS i INNER JOIN wp_mdcsm8_cashless_hospitals_state_city AS c ON c.id = i.cityid WHERE i.insurer = '{$i_code}' AND i.count > 0 GROUP BY state";
    $results = $wpdb->get_results($query, ARRAY_A);
    if (!empty($results)) {
        return $results;
    } else {
        return [];
    }
}

function getHospitalData($city, $lat, $lng, $icode) {
    $hospitaldatabycity = getHospitalDataByCity($city, $icode);
    $hospitaldatabycoordinates = getHospitalDataByCoordinates($lat, $lng, $icode);
    $mergedResults = array_merge($hospitaldatabycity['flatListResponse'], $hospitaldatabycoordinates['flatListResponse']);
    $uniqueResults = filter_unique_by_key($mergedResults, 'hospitalId');
    $return = ['flatListResponse' => $uniqueResults, 'count' => count($uniqueResults)];
    return $return;
}

function filter_unique_by_key($array, $key) {
    $uniqueResults = array_reduce($array, function ($carry, $item) use ($key) {
        $identifier = $item[$key];
        if (!isset($carry[$identifier])) {
            $carry[$identifier] = $item;
        }
        return $carry;
    }, []);

    return array_values($uniqueResults);
}

function getHospitalDataByCity($city, $icode) {
    $url = 'https://pro.turtlemint.com/api/ca/v1/public/master/hospital';
    $headers = array(
        'Content-Type' => 'application/json',
        'x-tenant' => 'turtlemint',
        'x-broker' => 'turtlemint',
        'x-api-token' => '1674d9e3-7396-4359-8047-789863d41549',
    );

    $body = json_encode(array(
        'masterRequest' => array(
            'geoSort' => 'ASC',
            'operator' => 'AND',
            'queries' => array(
                array(
                    'field' => 'INSURER',
                    'value' => array(
                        'stringValue' => $icode,
                    ),
                ),
                array(
                    'field' => 'CITY',
                    'value' => array(
                        'stringValue' => $city,
                    ),
                ),
            ),
        ),
        'responseType' => 'FLATLIST',
        'searchCategory' => 'CASHLESS_HOSPITAL',
        'vertical' => 'HEALTH',
    ));

    $response = wp_remote_request($url, array(
        'method' => 'POST',
        'headers' => $headers,
        'body' => $body,
        'timeout' => 30,
    ));

    if (is_wp_error($response)) {
        // echo 'Error: ' . $response->get_error_message();
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        return $data;
    }
}

function getHospitalDataByCoordinates($lat, $lng, $icode) {
    if(!$lat || !$lng) {
        return array('flatListResponse' => []);
    }
    $url = 'https://pro.turtlemint.com/api/ca/v1/public/master/hospital';
    $headers = array(
        'Content-Type' => 'application/json',
        'x-tenant' => 'turtlemint',
        'x-broker' => 'turtlemint',
        'x-api-token' => '1674d9e3-7396-4359-8047-789863d41549',
    );

    $body = json_encode(array(
        'masterRequest' => array(
            'geoSort' => 'ASC',
            'operator' => 'AND',
            'queries' => array(
                array(
                    'field' => 'INSURER',
                    'value' => array(
                        'stringValue' => $icode,
                    ),
                ),
                array(
                    'field' => 'CO_ORDINATES',
                    'value' => array(
                        'geoValue' => array(
                            'distance' => 10,
                            'latitude' => $lat,
                            'longitude' => $lng,
                        ),
                    ),
                ),
            ),
        ),
        'responseType' => 'FLATLIST',
        'searchCategory' => 'CASHLESS_HOSPITAL',
        'vertical' => 'HEALTH',
    ));

    $response = wp_remote_request($url, array(
        'method' => 'POST',
        'headers' => $headers,
        'body' => $body,
        'timeout' => 30,
    ));

    if (is_wp_error($response)) {
        // echo 'Error: ' . $response->get_error_message();
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        return $data;
    }
}

function haversineDistance($lat1, $lon1, $lat2, $lon2) {
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;

    $a = sin($dlat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($dlon / 2) ** 2;
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $radius = 6371;

    return $radius * $c;
}

function sortByDistance($lat, $lon, $cities) {
    usort($cities, function ($a, $b) use ($lat, $lon) {
        $distanceA = haversineDistance($lat, $lon, $a['latitude'], $a['longitude']);
        $distanceB = haversineDistance($lat, $lon, $b['latitude'], $b['longitude']);

        return $distanceA - $distanceB;
    });

    return $cities;
}
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

// Hide WordPress version
function tm_remove_wp_version() {
    return '';
}
add_filter('the_generator', 'tm_remove_wp_version');

/**************************** Custom Sitemaps ****************************/

function get_db_table_last_modified_date($table) {
    global $wpdb;

    $table_name = esc_sql($table);

    $query = "SHOW TABLE STATUS LIKE '{$table_name}'";
    $table_status = $wpdb->get_row($query);

    $updatedTime = $table_status->Update_time;
    $createdTime = $table_status->Create_time;

    if ($table_status !== null) {

        if($updatedTime != null){
            $last_modified_timestamp = strtotime($updatedTime);
        }else{
            $last_modified_timestamp = strtotime($createdTime);
        }

        if ($last_modified_timestamp !== false) {
            $dateTime = new DateTime("@$last_modified_timestamp");

            $last_modified = date_format($dateTime, 'Y-m-d H:i:sP');
            return $last_modified;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

add_filter( 'wpseo_sitemap_index', 'tm_add_sitemap_custom_items' );
add_action( 'init', 'init_wpseo_do_sitemap_actions' );

function tm_add_sitemap_custom_items(){
	global $wpseo_sitemaps;
	$health_insurer_tax_date = $wpseo_sitemaps->get_last_modified('health-plan');
    $car_insurer_tax_date = $wpseo_sitemaps->get_last_modified('car-plan');

	$smp ='';

    // NH Pages
    $smp .= '<sitemap>' . "\n";
	$smp .= '<loc>' . site_url() .'/network-hospitals-sitemap.xml</loc>' . "\n";
	$smp .= '<lastmod>' . htmlspecialchars( $health_insurer_tax_date ) . '</lastmod>' . "\n";
	$smp .= '</sitemap>' . "\n";

    // NH City Pages
    $smp .= '<sitemap>' . "\n";
	$smp .= '<loc>' . site_url() .'/network-hospitals-cities-sitemap.xml</loc>' . "\n";
	$smp .= '<lastmod>' . htmlspecialchars( $health_insurer_tax_date ) . '</lastmod>' . "\n";
	$smp .= '</sitemap>' . "\n";

    // Ancillary Pages - Health
    $smp .= '<sitemap>' . "\n";
	$smp .= '<loc>' . site_url() .'/health-insurance-pages-sitemap.xml</loc>' . "\n";
	$smp .= '<lastmod>' . htmlspecialchars( $health_insurer_tax_date ) . '</lastmod>' . "\n";
	$smp .= '</sitemap>' . "\n";

    // CG Pages
    $smp .= '<sitemap>' . "\n";
    $smp .= '<loc>' . site_url() .'/cashless-garages-sitemap.xml</loc>' . "\n";
    $smp .= '<lastmod>' . htmlspecialchars( $car_insurer_tax_date ) . '</lastmod>' . "\n";
    $smp .= '</sitemap>' . "\n";

    // CG City Pages
    $smp .= '<sitemap>' . "\n";
    $smp .= '<loc>' . site_url() .'/cashless-garages-cities-sitemap.xml</loc>' . "\n";
    $smp .= '<lastmod>' . htmlspecialchars( $car_insurer_tax_date ) . '</lastmod>' . "\n";
    $smp .= '</sitemap>' . "\n";

	return $smp;
}

function init_wpseo_do_sitemap_actions(){
	add_action( "wpseo_do_sitemap_network-hospitals", 'generate_nh_sitemap');
    add_action( "wpseo_do_sitemap_network-hospitals-cities", 'generate_nh_cities_sitemap');
    add_action( "wpseo_do_sitemap_health-insurance-pages", 'generate_health_insurance_pages_sitemap');
    add_action( "wpseo_do_sitemap_cashless-garages", 'generate_cg_sitemap');
    add_action( "wpseo_do_sitemap_cashless-garages-cities", 'generate_cg_cities_sitemap');
}

// CG Sitemap
function generate_cg_sitemap() {
    global $wpseo_sitemaps;
	$taxonomy_date = $wpseo_sitemaps->get_last_modified('car-plan');

    $taxonomy = 'car-insurer';

    $custom_urls = [];

    $insurer_codes = [];

    global $wpdb;

    $insurers_query = "SELECT DISTINCT insurer FROM `wp_mdcsm8_cashless_garages_insurers`";

    $insurers_results = $wpdb->get_results($insurers_query, ARRAY_A);

    foreach($insurers_results as $result){
        $insurer_codes[] = $result['insurer'];
    }

    $meta_query = array(
        'relation' => 'OR',
    );

    foreach ($insurer_codes as $insurer_code) {
        $meta_query[] = array(
            'key' => 'insurer_code',
            'value' => $insurer_code,
            'compare' => '=',
        );
    }

    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'meta_query' => $meta_query,
    ));

    foreach($terms as $term){

        $term_url = get_term_link($term, $taxonomy)."cashless-garages/";
        $term_date = $taxonomy_date;

        $custom_urls[] = [
            'loc'        => $term_url,
            'lastmod'    => $term_date
        ];
    }

    $plugins_dir = plugins_url();

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$plugins_dir.'/wordpress-seo/css/main-sitemap.xsl"?>' . "\n";
    $sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($custom_urls as $url) {
        $sitemap .= '<url>' . "\n";
        $sitemap .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
        $sitemap .= '<lastmod>' . htmlspecialchars($url['lastmod']) . '</lastmod>' . "\n";
        $sitemap .= '</url>' . "\n";
    }

    $sitemap .= '</urlset>';

    $sitemap .= '<!-- XML Sitemap generated by Yoast SEO -->';

    header('Content-Type: text/xml');

    echo $sitemap;
    exit;
}

// CG Cities Sitemap
function generate_cg_cities_sitemap() {

    global $wpseo_sitemaps;
    global $wpdb;

    $last_modified = $wpseo_sitemaps->get_last_modified('car-plan');

	$taxonomy_date = $last_modified;

    $taxonomy = 'car-insurer';

    $insurers_query = "SELECT DISTINCT insurer FROM `wp_mdcsm8_cashless_garages_insurers`";

    $insurers_results = $wpdb->get_results($insurers_query, ARRAY_A);

    foreach($insurers_results as $result){
        $insurer_codes[] = $result['insurer'];
    }

    $meta_query = array(
        'relation' => 'OR',
    );

    foreach ($insurer_codes as $insurer_code) {
        $meta_query[] = array(
            'key' => 'insurer_code',
            'value' => $insurer_code,
            'compare' => '=',
        );
    }

    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'meta_query' => $meta_query,
    ));

    $custom_urls = [];

    foreach($terms as $term){
        $term_date = $taxonomy_date;

        $insurer = $term->slug;
        $insurer_code = ucwords(get_field('insurer_code', $term));

        $getCitiesByInsurerQuery = "SELECT insurer, city FROM `wp_mdcsm8_cashless_garages_insurers` AS i INNER JOIN `wp_mdcsm8_cashless_garages_state_city` AS c ON c.id = i.cityid WHERE insurer = '{$insurer_code}' AND i.count > 0";

        $getCitiesByInsurerResult = $wpdb->get_results($getCitiesByInsurerQuery, ARRAY_A);
    
        if(!empty($getCitiesByInsurerResult)){
    
            foreach($getCitiesByInsurerResult as $result){
                $data_insurer = $result["insurer"];
                $data_city = $result["city"];
        
                if($data_insurer){

                    $data_insurer = $insurer;
        
                    $insurerSlug = str_replace(' ', '-', $data_insurer);
                    $citySlug = str_replace(' ', '-', $data_city);
        
                    $city_url = site_url().'/car-insurance/' . $insurerSlug . '/cashless-garages/' . $citySlug . '/';
            
                    $custom_urls[] = [
                        'loc'        => $city_url,
                        'lastmod'    => $term_date
                    ];
                }
            }
        }

    }

    $plugins_dir = plugins_url();

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$plugins_dir.'/wordpress-seo/css/main-sitemap.xsl"?>' . "\n";
    $sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($custom_urls as $url) {
        $sitemap .= '<url>' . "\n";
        $sitemap .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
        $sitemap .= '<lastmod>' . htmlspecialchars($url['lastmod']) . '</lastmod>' . "\n";
        $sitemap .= '</url>' . "\n";
    }

    $sitemap .= '</urlset>';

    $sitemap .= '<!-- XML Sitemap generated by Yoast SEO -->';

    header('Content-Type: text/xml');

    echo $sitemap;
    exit;
}

// NH Sitemap
function generate_nh_sitemap() {
    global $wpseo_sitemaps;
	$taxonomy_date = $wpseo_sitemaps->get_last_modified('health-plan');

    $taxonomy = 'health-insurer';

    $custom_urls = [];

    $insurer_codes = [];

    global $wpdb;

    $insurers_query = "SELECT DISTINCT insurer FROM `wp_mdcsm8_cashless_hospitals_insurers`";

    $insurers_results = $wpdb->get_results($insurers_query, ARRAY_A);

    foreach($insurers_results as $result){
        $insurer_codes[] = $result['insurer'];
    }

    $meta_query = array(
        'relation' => 'OR',
    );

    foreach ($insurer_codes as $insurer_code) {
        $meta_query[] = array(
            'key' => 'insurer_code',
            'value' => $insurer_code,
            'compare' => '=',
        );
    }

    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'meta_query' => $meta_query,
    ));

    foreach($terms as $term){

        $term_url = get_term_link($term, $taxonomy)."network-hospitals/";
        $term_date = $taxonomy_date;

        $custom_urls[] = [
            'loc'        => $term_url,
            'lastmod'    => $term_date
        ];
    }

    $plugins_dir = plugins_url();

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$plugins_dir.'/wordpress-seo/css/main-sitemap.xsl"?>' . "\n";
    $sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($custom_urls as $url) {
        $sitemap .= '<url>' . "\n";
        $sitemap .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
        $sitemap .= '<lastmod>' . htmlspecialchars($url['lastmod']) . '</lastmod>' . "\n";
        $sitemap .= '</url>' . "\n";
    }

    $sitemap .= '</urlset>';

    $sitemap .= '<!-- XML Sitemap generated by Yoast SEO -->';

    header('Content-Type: text/xml');

    echo $sitemap;
    exit;
}

// NH Cities Sitemap
function generate_nh_cities_sitemap() {

    global $wpseo_sitemaps;
    global $wpdb;

    $last_modified = $wpseo_sitemaps->get_last_modified('health-plan');

	$taxonomy_date = $last_modified;

    $taxonomy = 'health-insurer';

    $insurers_query = "SELECT DISTINCT insurer FROM `wp_mdcsm8_cashless_hospitals_insurers`";

    $insurers_results = $wpdb->get_results($insurers_query, ARRAY_A);

    foreach($insurers_results as $result){
        $insurer_codes[] = $result['insurer'];
    }

    $meta_query = array(
        'relation' => 'OR',
    );

    foreach ($insurer_codes as $insurer_code) {
        $meta_query[] = array(
            'key' => 'insurer_code',
            'value' => $insurer_code,
            'compare' => '=',
        );
    }

    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'meta_query' => $meta_query,
    ));

    $custom_urls = [];

    foreach($terms as $term){
        $term_date = $taxonomy_date;

        $insurer = $term->slug;
        $insurer_code = ucwords(get_field('insurer_code', $term));

        $getCitiesByInsurerQuery = "SELECT insurer, city FROM `wp_mdcsm8_cashless_hospitals_insurers` AS i INNER JOIN `wp_mdcsm8_cashless_hospitals_state_city` AS c ON c.id = i.cityid WHERE insurer = '{$insurer_code}' AND i.count > 0";

        $getCitiesByInsurerResult = $wpdb->get_results($getCitiesByInsurerQuery, ARRAY_A);
    
        if(!empty($getCitiesByInsurerResult)){
    
            foreach($getCitiesByInsurerResult as $result){
                $data_insurer = $result["insurer"];
                $data_city = $result["city"];
        
                if($data_insurer){

                    $data_insurer = $insurer;
        
                    $insurerSlug = str_replace(' ', '-', $data_insurer);
                    $citySlug = str_replace(' ', '-', $data_city);
        
                    $city_url = site_url().'/health-insurance/' . $insurerSlug . '/network-hospitals/' . $citySlug . '/';
            
                    $custom_urls[] = [
                        'loc'        => $city_url,
                        'lastmod'    => $term_date
                    ];
                }
            }
        }

    }

    $plugins_dir = plugins_url();

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$plugins_dir.'/wordpress-seo/css/main-sitemap.xsl"?>' . "\n";
    $sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($custom_urls as $url) {
        $sitemap .= '<url>' . "\n";
        $sitemap .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
        $sitemap .= '<lastmod>' . htmlspecialchars($url['lastmod']) . '</lastmod>' . "\n";
        $sitemap .= '</url>' . "\n";
    }

    $sitemap .= '</urlset>';

    $sitemap .= '<!-- XML Sitemap generated by Yoast SEO -->';

    header('Content-Type: text/xml');

    echo $sitemap;
    exit;
}

// Ancillary Pages - Health
function generate_health_insurance_pages_sitemap(){
    global $wpseo_sitemaps;
	$taxonomy_date = $wpseo_sitemaps->get_last_modified('health-plan');
    $custom_urls = [];

    $taxonomy = 'health-insurer';

    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
    ));

    $ancillary_links = ancillary_links();

    foreach($terms as $term){
        $ancillary_links = validate_insurer_data($term, false);
        $insurer_url = get_term_link($term);
        foreach($ancillary_links as $link){
            if ($link['link'] != $insurer_url) {
                $custom_urls[] = [
                    'loc'     => $link['link'],
                    'lastmod' => $taxonomy_date
                ];
            }
        } 
    }

    $plugins_dir = plugins_url();

    $sitemap = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$plugins_dir.'/wordpress-seo/css/main-sitemap.xsl"?>' . "\n";
    $sitemap .= '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($custom_urls as $url) {
        $sitemap .= '<url>' . "\n";
        $sitemap .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
        $sitemap .= '<lastmod>' . htmlspecialchars($url['lastmod']) . '</lastmod>' . "\n";
        $sitemap .= '</url>' . "\n";
    }

    $sitemap .= '</urlset>';

    $sitemap .= '<!-- XML Sitemap generated by Yoast SEO -->';

    header('Content-Type: text/xml');

    echo $sitemap;
    exit;
}

/* Modify robot tag for NH & NH City Templates */
function nh_modify_meta_robots_tag($robots) {
    global $wpdb;

    $taxonomy = 'health-insurer';

    $insurers_codes = $wpdb->get_col("SELECT DISTINCT insurer FROM `wp_mdcsm8_cashless_hospitals_insurers`");

    $meta_query = array('relation' => 'OR');

    foreach ($insurers_codes as $insurer_code) {
        $meta_query[] = array(
            'key' => 'insurer_code',
            'value' => $insurer_code,
            'compare' => '=',
        );
    }

    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'meta_query' => $meta_query,
    ));

    $insurers = [];
    $insurers_with_city = [];

    foreach ($terms as $term) {
        $term_slug = $term->slug;
        $insurers[] = $term_slug;

        $insurer_code = ucwords(get_field('insurer_code', $term));

        $getCitiesByInsurerQuery = "SELECT insurer, city FROM `wp_mdcsm8_cashless_hospitals_insurers` AS i INNER JOIN `wp_mdcsm8_cashless_hospitals_state_city` AS c ON c.id = i.cityid WHERE insurer = %s AND i.count > 0";
        
        $getCitiesByInsurerResult = $wpdb->get_results($wpdb->prepare($getCitiesByInsurerQuery, $insurer_code), ARRAY_A);

        foreach ($getCitiesByInsurerResult as $result) {
            $insurer = $term_slug;
            $city = str_replace(' ', '-', $result["city"]);
            $insurers_with_city[] = ['insurer' => $insurer, 'city' => $city];
        }
    }

    $health_ic = get_query_var('health-ic');
    $health_ic_city = get_query_var('health-ic-city');

    if ($health_ic && $health_ic_city) {

        $targetKeyValue = ['insurer' => $health_ic, 'city' => $health_ic_city];

        if (isKeyValueInArray($insurers_with_city, $targetKeyValue)) {
            return $robots;
        } else {
            $robots =  'noindex, nofollow';
            return $robots;
        }
    }
    
     elseif ($health_ic && !in_array($health_ic, $insurers)) {
        return 'noindex, nofollow';
    }

    return $robots;
}

function isKeyValueInArray($array, $keyValue){
    foreach ($array as $element) {
        if ($element == $keyValue) {
            return true;
        }
    }
    return false;
}

// add_filter('wpseo_robots', 'nh_modify_meta_robots_tag');
// add_filter('wp_robots', 'nh_modify_meta_robots_tag');

/* Ancillary Links */
function validate_insurer_data($term, $needCurrentUrl){

    global $template;
    $templateName = basename($template);

    $taxonomy_slug = $term->taxonomy;

    $term_slug = $term->slug;

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    $vertical_name = null;
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
            $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
            $calculators = $theme_settings_vertical['calculator_quick_links'];
        }
    }
    /* Theme Settings - end */

    $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));
    $insurer_url = get_term_link($term->slug, 'health-insurer');

    if(get_field('insurer_name', $term)){
        $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
        $insurer_display_name = ucwords($term->name);
    }

    $ancillary_links = [
        [
            'title' => ucwords($insurer_display_name.' Overview'),
            'link'  => $insurer_url,
            'insurer_slug'  => $term->slug,
            'page_slug'  => null
        ]
    ];

    $posts_found = 0;
    $totalPlans = 0;
    $totalTopupPlans = 0;

    /* Plans - start */
    $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));
    $post_type = $convertedVerticalName."-plan";
    $taxonomy_insurer = $convertedVerticalName."-insurer"; /* Vertical Slug Change */

    $plans_args = array(
        'post_type' =>  $post_type,
        'post_status' => 'publish',
        'posts_per_page'  => -1,
        'orderby' => array(
            'meta_value_num' => 'DESC', // Sort by the meta value in descending order
            'title' => 'ASC', // Sort titles in ascending order
        ),
        'meta_key' => 'plan_top', // Top plans
        'tax_query' => array(
            'relation'  => 'AND',
            array(
                'taxonomy' => $taxonomy_insurer,
                'field' => 'slug',
                'terms' =>$term_slug,
            ),
            array(
                'taxonomy' => 'plan-type',
                'field' => 'slug',
                'terms' => 'top-up',
                'operator' => 'NOT IN',
            )
        ),
    );

    $insurance_plans = new WP_Query($plans_args);

    $totalPlans = $insurance_plans->found_posts;

    $topup_plans_args = $plans_args;
    
    // Top-up plans
    $topup_plans_args['tax_query'][] = 
    array(
    'taxonomy' => 'plan-type',
    'field' => 'slug',
    'terms' => 'top-up',
    );

    $insurance_topup_plans = new WP_Query($plans_args);

    $totalTopupPlans = $insurance_topup_plans->found_posts;

    // Critical Illness Plans
    $plan_tag = 'critical-illness';
    if($plan_tag != '' && $plan_tag != null && $convertedVerticalName){
        $plans_args['tax_query'][] = 
        array(
            'taxonomy' => $convertedVerticalName.'-tag',
            'field' => 'slug',
            'terms' => $plan_tag,
        );
    }
    $critical_illness_plans = new WP_Query($plans_args);
    $totalCriticalPlans = $critical_illness_plans->found_posts;

    /* Plans - end */

    // Renewal section
    $insurer_renewal_process = get_field('insurer_renewal_process', $term);

    // Phone & email
    $insurer_phone_no = get_field('insurer_phone_no', $term);
    $insurer_email = get_field('insurer_email', $term);

    // Fetures & exclusion
    $insurer_features = get_field("insurer_features", $term);
    $insurer_exclusions = get_field("insurer_exclusions", $term);

    // Claim settlement ratio
    $insurer_claim_settlement_ratio = get_field('insurer_claim_settlement_ratio', $term);

    /* Links - Start */
    if ($totalPlans > 0 || $totalTopupPlans > 0) {
        $ancillary_links[] = [
            'title' => ucwords($insurer_display_name.' '.$vertical_name.' Insurance Plans'),
            'link'  => $insurer_url.'plans/',
            'insurer_slug'  => $term->slug,
            'page_slug'  => 'plans'
        ];
    }
    if ($insurer_renewal_process) {
        $ancillary_links[] = [
            'title' => ucwords($insurer_display_name.' '.$vertical_name.' Insurance Renewal'),
            'link'  => $insurer_url.'renewal/',
            'insurer_slug'  => $term->slug,
            'page_slug'  => 'renewal'
        ];
    }
    if($insurer_phone_no || $insurer_email) {
        $ancillary_links[] = [
            'title' => ucwords($insurer_display_name.' '.$vertical_name.' Insurance Customer Care'),
            'link'  => $insurer_url.'customer-care/',
            'insurer_slug'  => $term->slug,
            'page_slug'  => 'customer-care'
        ];
    }
    if($templateName =='taxonomy-bike-insurer.php' || $calculators || $templateName == 'taxonomy-car-insurer.php') {
        $ancillary_links[] = [
            'title' => ucwords($insurer_display_name.' '.$vertical_name.' Insurance Premium Calculator'),
            'link'  => $insurer_url.'premium-calculator/',
            'insurer_slug'  => $term->slug,
            'page_slug'  => 'premium-calculator'
        ];
    }
    if($insurer_claim_settlement_ratio) {
        $ancillary_links[] = [
            'title' => ucwords($insurer_display_name.' '.$vertical_name.' Insurance Claim Settlement'),
            'link'  => $insurer_url.'claim-settlement/',
            'insurer_slug'  => $term->slug,
            'page_slug'  => 'claim-settlement'
        ];
    }
    if($insurer_features || $insurer_exclusions) {
        $ancillary_links[] = [
            'title' => ucwords($insurer_display_name.' '.$vertical_name.' Insurance Benefits'),
            'link'  => $insurer_url.'benefits/',
            'insurer_slug'  => $term->slug,
            'page_slug'  => 'benefits'
        ];
    }
    if($totalCriticalPlans > 0) {
        $ancillary_links[] = [
            'title' => ucwords($insurer_display_name.' Critical Illness Plans'),
            'link'  => $insurer_url.'critical-illness/',
            'insurer_slug'  => $term->slug,
            'page_slug'  => 'critical-illness'
        ];
    }
    /* Links - End */

    // Remove the current page link
    $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    if($needCurrentUrl === false){
        foreach ($ancillary_links as $key => $link) {
            if ($link['link'] === $currentUrl) {
                unset($ancillary_links[$key]);
            }
        }
    }

    if($templateName == 'taxonomy-health-insurer.php'){
        foreach ($ancillary_links as $key => &$title) {
            $title = str_replace('Insurance', '', $title);
            $title = str_replace($insurer_display_name, '', $title);
            $title = str_replace($vertical_name, '', $title);
        }
    }
    return $ancillary_links;
}
function ancillary_links(){
    $term = get_queried_object();

    if(!$term){
        $health_term_slug = get_query_var( 'health-ic' );
        $car_term_slug = get_query_var( 'car-ic' );
        if($health_term_slug){
            $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
        }elseif($car_term_slug){
            $term = get_term_by( 'slug', $car_term_slug, 'car-insurer' );
        }
    }

    if($term){
        $ancillary_links = validate_insurer_data($term, false);
        return $ancillary_links;
    }
}

function tm_event_category(){
    global $template;
    $templateName = basename($template);

    $term = get_queried_object();

    if(!$term){
        $health_term_slug = get_query_var( 'health-ic' );
        $car_term_slug = get_query_var( 'car-ic' );
        if($health_term_slug){
            $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
        }elseif($car_term_slug){
            $term = get_term_by( 'slug', $car_term_slug, 'car-insurer' );
        }
    }

    $taxonomy_slug = $term->taxonomy;

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');

    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
            $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
            $vertical_name_category = $vertical_name;
        }
    }
    /* Theme Settings - end */

    if($templateName == 'ic-renewal.php'){
        $vertical_name_category = $vertical_name.'-Renewal';
    }elseif($templateName == 'ic-customer-care.php'){
        $vertical_name_category = $vertical_name.'-Customer-Care';
    }elseif($templateName == 'ic-premium-calculator.php'){
        $vertical_name_category = $vertical_name.'-Premium-Calculator';
    }elseif($templateName == 'ic-claim-settlement.php'){
        $vertical_name_category = $vertical_name.'-Claim-Settlement';
    }elseif($templateName == 'ic-benefits.php'){
        $vertical_name_category = $vertical_name.'-Benefits';
    }elseif($templateName == 'ic-critical-illness.php'){
        $vertical_name_category = $vertical_name.'-Critical-Illness';
    }elseif($templateName == 'ic-plans.php'){
        $vertical_name_category = $vertical_name.'-Plans';
    }elseif($templateName == 'tm-nh-hospitals-list.php'){
        $vertical_name_category = 'NH-City';
    }elseif($templateName == 'ic-network-hospitals.php'){
        $vertical_name_category = 'NH-India';
    }elseif($templateName == 'tm-cg-network.php'){
        $vertical_name_category = 'CG-India';
    }elseif($templateName == 'tm-cg-city-list.php'){
        $vertical_name_category = 'CG-City';
    }elseif(is_single()){
        $vertical_name_category = base_vertical();
    }else{
        $vertical_name_category = base_vertical();
    }
    
    return $vertical_name_category;
}

function base_vertical(){
    $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    if (strpos($currentUrl, 'health-insurance') !== false) {
        $pageType = 'Health';
    }elseif(strpos($currentUrl, 'car-insurance') !== false || strpos($currentUrl, 'four-wheeler-insurance') !== false){
        $pageType = 'Car';
    }elseif(strpos($currentUrl, 'bike-insurance') !== false || strpos($currentUrl, 'two-wheeler-insurance') !== false){
        $pageType = 'Bike';
    }elseif(strpos($currentUrl, 'life-insurance') !== false){
        $pageType = 'Life';
    }elseif(is_front_page()){
        $pageType = 'Homepage';
    }else{
        $pageType = 'Other';
    }
    return $pageType;
}

// Webpages access control
$activate_access_control = get_field('activate_access_control', 'option');

if($activate_access_control === true){
    function restrict_all_pages() {
        if (!is_user_logged_in()) {
            auth_redirect();
        }
    }
    add_action('template_redirect', 'restrict_all_pages');
}

function add_custom_body_class($classes) {

    if(is_single() || in_array('page-template-page-e-tier', $classes)){
        $classes[] = 'tm-style-1';
    }
    
    return $classes;
}
add_filter('body_class', 'add_custom_body_class');

// CF7 Form section validation
function form_section_validation(){ 
    $term = get_queried_object();

    if(!$term){
        $health_term_slug = get_query_var( 'health-ic' );
        $car_term_slug = get_query_var( 'car-ic' );
            if($health_term_slug){
                $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
            }elseif($car_term_slug){
                $term = get_term_by( 'slug', $car_term_slug, 'car-insurer' );
            }
    }

    $taxonomy_slug = $term->taxonomy;

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
        $vertical_form_shortcode = $theme_settings_vertical['vertical_form_shortcode'];
        return $vertical_form_shortcode;
        }
    }
    /* Theme Settings - end */
    return $vertical_form_shortcode = '';
}

/* This code snippet should be at the end of the file */
function tm_acf_fields() {
    // Disable file editor if not already defined
    if (!defined('DISALLOW_FILE_EDIT')) {
        $disable_file_editor_access = get_field('disable_file_editor_access', 'option');
        define('DISALLOW_FILE_EDIT', $disable_file_editor_access);
    }
}

add_action('admin_init', 'tm_acf_fields');

// cashless garages db data

function create_cashless_garages_state_city_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cashless_garages_state_city';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id int(10) NOT NULL AUTO_INCREMENT,
        state VARCHAR(255) NOT NULL,
        city VARCHAR(255) NOT NULL,
        lat VARCHAR(32) NOT NULL,
        lng VARCHAR(32) NOT NULL,
        nearby_cities longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`nearby_cities`)),
        PRIMARY KEY (id)
    )";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    $table_name = $wpdb->prefix . 'cashless_garages_insurers';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id int(10) NOT NULL AUTO_INCREMENT,
        cityid int(10) NOT NULL,
        insurer VARCHAR(255) NOT NULL,
        count int(10) NOT NULL, 
        PRIMARY KEY (id)
    )";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action( 'init', 'create_cashless_garages_state_city_table' );

function getCashlessGaragesDataByCity($city, $icode) {
    $url = 'https://pro.turtlemint.com/api/ca/v1/public/master/garage';
    $headers = array(
        'Content-Type' => 'application/json',
        'x-tenant' => 'turtlemint',
        'x-broker' => 'turtlemint',
        'x-api-token' => '1674d9e3-7396-4359-8047-789863d41549',
    );

    $body = json_encode(array(
        'insurerCode'=> $icode,
        'masterRequest' => array(
            'geoSort' => 'ASC',
            'operator' => 'AND',
            'queries' => array(
                array(
                    'field' => 'CITY',
                    'value' => array(
                        'stringValue' => $city,
                    ),
                ),
            ),
        ),
        'responseType' => 'FLATLIST',
        'searchCategory' => 'CASHLESS_GARAGE',
        'vertical' => 'FOUR_WHEELER',
    ));

    $response = wp_remote_request($url, array(
        'method' => 'POST',
        'headers' => $headers,
        'body' => $body,
        'timeout' => 30,
    ));

    if (is_wp_error($response)) {
        // echo 'Error: ' . $response->get_error_message();
    } else {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        return $data;
    }
}

function insert_cg_city_state_data() {
    global $wpdb;
    if(!isset($_GET['run_import_cg_state_city_script'])) {
        return;
    }
    if(get_option('cg_city_data_populated')) {
        return;
    }

    $file_path = get_stylesheet_directory() . '/cg-json-data/cgCityState.json';
    $json_data = file_get_contents($file_path);
    $cityNames = json_decode($json_data, true);
    
    foreach ($cityNames as $cityName) {
        $wpdb->query(
            $wpdb->prepare(
                "INSERT INTO {$wpdb->prefix}cashless_garages_state_city
                ( city, state, lat, lng )
                VALUES ( %s, %s, %s, %s )",
                $cityName['city'],
                $cityName['state'],
                $cityName['lat'],
                $cityName['lng']
            )
        );
    }
    echo "run import cg state city script successful";
    update_option('cg_city_data_populated', true);
    exit;
}

add_action( 'wp_head', 'insert_cg_city_state_data' );

function insert_cg_insurer_data() {
    global $wpdb;
    if(!isset($_GET['run_cg_insurere_data_script'])) {
        return;
    }
    if(get_option('insurer_cg_data_populated')) {
        return;
    }

    $file_path = get_stylesheet_directory() . '/cg-json-data/cgInsurerData.json';
    $json_data = file_get_contents($file_path);
    $insurer_data = json_decode($json_data, true);
    
    foreach ($insurer_data as $insurer) {
        $city_id = $wpdb->get_var( "SELECT id FROM {$wpdb->prefix}cashless_garages_state_city WHERE city = '{$insurer['city']}'" );
        $wpdb->query(
            $wpdb->prepare(
                "INSERT INTO {$wpdb->prefix}cashless_garages_insurers
                ( cityid, insurer, count )
                VALUES ( %d, %s, %d )",
                (int)$city_id,
                $insurer['insurer'],
                (int)$insurer['count'],
            )
        );
    }

    echo "run import cg insurer script successful";
    update_option('insurer_cg_data_populated', true);
    exit;
}

add_action( 'wp_head', 'insert_cg_insurer_data' );

function update_cg_nearby_cities() {
    global $wpdb;
    if(!isset($_GET['run_update_cg_nearby_cities'])) {
        return;
    }
    if(get_option('cg_nearby_citites_updated')) {
        return;
    }

    $file_path = get_stylesheet_directory() . '/cg-json-data/nearbyCities.json';
    $json_data = file_get_contents($file_path);
    $nearby_ctities = json_decode($json_data, true);
    
    foreach ($nearby_ctities as $nearby_city) {
        $city_array = implode("','", $nearby_city['nearby_cities']);
        $city_id = $wpdb->get_var( "SELECT id FROM {$wpdb->prefix}cashless_garages_state_city WHERE city = '{$nearby_city['city']}'" );
        $city_ids = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}cashless_garages_state_city WHERE city IN ('{$city_array}')" );
        $cityid_int_json = array_map('intval', $city_ids);
        $cityid_json = json_encode($cityid_int_json);
        $wpdb->query("UPDATE {$wpdb->prefix}cashless_garages_state_city set nearby_cities = '{$cityid_json}' WHERE id={$city_id}" );
    }

    echo "run update cg nearby cities script successful";
    update_option('cg_nearby_citites_updated', true);
    exit;
}

add_action( 'wp_head', 'update_cg_nearby_cities' );

function search_cg_city() {
    global $wpdb;
    $query = $_POST['keyword'];
    $sql = "SELECT city, state FROM {$wpdb->prefix}cashless_garages_state_city WHERE city LIKE '$query%'";
    $results = $wpdb->get_results($sql);

    ob_start();

    if ($results) {
        foreach ($results as $result) {
            echo "<div class='cg-city-list-item' onclick='selectCity(\"" . $result->city . "\")'>";
            echo "<span>" . ucwords($result->city) . ", ". ucwords($result->state). "</span>";
            echo "</div>";
        }
    } else {
        echo "<div class='cg-city-list-item'>No results found</div>";
    }

    $response = [
        'html' => ob_get_clean(),
    ];
    echo json_encode($response);

    wp_die();
}
add_action('wp_ajax_search_cg_city', 'search_cg_city');
add_action('wp_ajax_nopriv_search_cg_city', 'search_cg_city');

function getCgCitiesByState($i_code) {
    global $wpdb;
    $query = "SELECT state, GROUP_CONCAT(city) AS cities FROM `wp_mdcsm8_cashless_garages_insurers` AS i INNER JOIN wp_mdcsm8_cashless_garages_state_city AS c ON c.id = i.cityid WHERE i.insurer = '{$i_code}' AND i.count > 0 GROUP BY state";
    $results = $wpdb->get_results($query, ARRAY_A);
    if (!empty($results)) {
        return $results;
    } else {
        return [];
    }
}

<?php
/**
 * Milennial Pink.
 *
 * This file adds functions to the Milennial Pink Theme.
 *
 * @package Milennial Pink
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

define( 'CHILD_THEME_NAME', 'Milennial Pink' );
define( 'CHILD_THEME_URL', 'https://christham.net/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

add_action( 'after_setup_theme', 'milennial_pink_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function milennial_pink_localization_setup() {

	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Required Plugins.
require_once get_stylesheet_directory() . '/lib/required-plugins.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

// Registers the responsive menus.
if ( function_exists( 'genesis_register_responsive_menus' ) ) {
	genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
}

add_action( 'wp_enqueue_scripts', 'milennial_pink_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function milennial_pink_enqueue_scripts_styles() {

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style(
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		genesis_get_theme_version()
	);

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'milennial-pink-font-lato', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', [], genesis_get_theme_version() );
	wp_enqueue_style( 'milennial-pink-font-raleway', '//fonts.googleapis.com/css?family=Raleway:400,500,700,900', [], genesis_get_theme_version() );
	wp_enqueue_style( 'milennial-pink-font-bubblegum-sans', '//fonts.googleapis.com/css?family=Bubblegum+Sans', [], genesis_get_theme_version() );
	wp_enqueue_style( 'milennial-pink-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', [], '4.7.0' );
	wp_enqueue_style( 'milennial-pink-line-awesome', '//maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css', [], '1.1' );
	wp_enqueue_script( 'milennial-pink-match-height', get_stylesheet_directory_uri() . '/js/match-height.js', [ 'jquery' ], '0.5.2', true );
	wp_enqueue_script(
		'milennial-pink-js',
		get_stylesheet_directory_uri() . '/js/milennial-pink.js',
		[ 'jquery', 'milennial-pink-match-height' ],
		genesis_get_theme_version(),
		true
	);

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);
	}

}

add_action( 'wp_enqueue_scripts', 'milennial_pink_rtl_styles', 12 );
/**
 * Enqueue RTL Styles.
 */
function milennial_pink_rtl_styles() {
	// Load RTL stylesheet.
	if ( ! is_rtl() ) {
		return;
	}

	wp_enqueue_style( 'milennial-pink-rtl', get_stylesheet_directory_uri() . '/rtl/style-rtl.css', [], genesis_get_theme_version() );

}

add_action( 'after_setup_theme', 'milennial_pink_theme_support', 9 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 3.0.0
 */
function milennial_pink_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'milennial_pink_post_type_support', 9 );
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 3.0.0
 */
function milennial_pink_post_type_support() {

	$post_type_supports = genesis_get_config( 'post-type-supports' );

	foreach ( $post_type_supports as $post_type => $args ) {
		add_post_type_support( $post_type, $args );
	}

}

add_action( 'genesis_site_title', 'milennial_pink_custom_logo', 0 );
/**
 * Display the custom logo.
 *
 * @since 1.1.0
 */
function milennial_pink_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );
add_image_size( 'genesis-singular-images', 1500, 1000, true );
add_image_size( 'blog', '800', '400', true );
add_image_size( 'portfolio', '570', '390', true );

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Add Genesis Layouts to Portfolio.
add_post_type_support( 'portfolio', 'genesis-layouts' );

// Move image above post title.
// remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
// add_action( 'genesis_entry_header', 'genesis_do_post_image', 8 );

// Register widget areas.
genesis_register_sidebar(
	[
		'id'          => 'topbar',
		'name'        => __( 'Topbar', 'milennial-pink' ),
		'description' => __( 'This is the topbar section.', 'milennial-pink' ),
	]
);

add_action( 'genesis_before_header', 'milennial_pink_topbar' );
/**
 * Topbar with contact info and social links.
 */
function milennial_pink_topbar() {
	genesis_widget_area(
		'topbar',
		[
			'before' => '<div class="site-topbar"><div class="wrap">',
			'after'  => '</div></div>',
		]
	);
}

add_filter( 'body_class', 'milennial_pink_sticky_header_class' );
/**
 * Sticky Header.
 *
 * @param array $classes destination.
 * @return array
 */
function milennial_pink_sticky_header_class( $classes ) {
	$sticky_header = get_option( 'milennial_pink_sticky_header' );
	$classes[]     = ( 'disable' !== $sticky_header ) ? 'sticky-header-active' : '';
	return $classes;
}

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

add_action( 'genesis_footer', 'milennial_pink_footer_menu', 12 );
/**
 * Hook menu in footer.
 */
function milennial_pink_footer_menu() {
	printf( '<nav %s>', genesis_attr( 'nav-footer' ) );
	wp_nav_menu(
		[
			'theme_location' => 'footer',
			'container'      => false,
			'depth'          => 1,
			'fallback_cb'    => false,
			'menu_class'     => 'genesis-nav-menu',
		]
	);
	echo '</nav>';
}

add_filter( 'genesis_attr_nav-footer', 'milennial_pink_footer_nav_attr' );
/**
 * Nav footer attributes.
 *
 * @param array $attributes destination.
 * @return array
 */
function milennial_pink_footer_nav_attr( $attributes ) {
	$attributes['itemscope'] = true;
	$attributes['itemtype']  = 'http://schema.org/SiteNavigationElement';
	return $attributes;
}

add_filter( 'genesis_attr_nav-footer', 'milennial_pink_nav_footer_id' );
/**
 * Add skip link needs to footer nav.
 *
 * @param array $attributes destination.
 * @return array
 */
function milennial_pink_nav_footer_id( $attributes ) {
	$attributes['id'] = 'genesis-nav-footer';
	return $attributes;
}

add_filter( 'genesis_skip_links_output', 'milennial_pink_nav_footer_skip_link' );
/**
 * Add skip link needs to footer nav.
 *
 * @param array $links destination.
 * @return array
 */
function milennial_pink_nav_footer_skip_link( $links ) {
	if ( has_nav_menu( 'footer' ) ) {
		$links['genesis-nav-footer'] = __( 'Skip to footer navigation', 'milennial-pink' );
	}
	return $links;
}

add_action( 'genesis_footer', 'milennial_pink_scrollup', 12 );
/**
 * Scroll to top link.
 */
function milennial_pink_scrollup() {
	echo '<div class="scroll-up">';
	echo '<a href="#" class="scrollup"></a>';
	echo '</div>';
}

/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function milennial_pink_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'milennial_pink_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function milennial_pink_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'milennial_pink_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function milennial_pink_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}

/** Force full width layout on all archive pages*/
add_filter( 'genesis_pre_get_option_site_layout', 'milennial_pink_full_width_layout_archives' );

/**
 * Change archives to use full width layout.
 *
 * @author Brad Dalton
 * @link http://wpsites.net/web-design/change-layout-genesis/
 *
 * @param string $opt destination.
 * @return string
 */
function milennial_pink_full_width_layout_archives( $opt ) {

	if ( is_archive() ) {

		$opt = 'full-width-content';
		return $opt;

	}

}

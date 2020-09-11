<?php
/**
 * Visual Voyager.
 *
 * This file adds functions to the Visual Voyager Theme.
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

define( 'CHILD_THEME_NAME', 'Visual Voyager' );
define( 'CHILD_THEME_URL', 'https://visualvoyager.net/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

add_action( 'after_setup_theme', 'visual_voyager_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function visual_voyager_localization_setup() {

	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

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

add_action( 'wp_enqueue_scripts', 'visual_voyager_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function visual_voyager_enqueue_scripts_styles() {

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style(
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		genesis_get_theme_version()
	);

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'kreativ-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style( 'kreativ-line-awesome', '//maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css', array(), '1.1' );

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);
	}

}

// Enqueue RTL Styles.
add_action( 'wp_enqueue_scripts', 'kreativ_rtl_styles', 12 );
function kreativ_rtl_styles() {
	// Load RTL stylesheet.
	if ( ! is_rtl() ) {
		return;
	}

	wp_enqueue_style( 'kreativ-rtl', get_stylesheet_directory_uri() . '/rtl/style-rtl.css', array(), genesis_get_theme_version() );

}

add_action( 'after_setup_theme', 'visual_voyager_theme_support', 9 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 3.0.0
 */
function visual_voyager_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'visual_voyager_post_type_support', 9 );
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 3.0.0
 */
function visual_voyager_post_type_support() {

	$post_type_supports = genesis_get_config( 'post-type-supports' );

	foreach ( $post_type_supports as $post_type => $args ) {
		add_post_type_support( $post_type, $args );
	}

}

add_action( 'genesis_site_title', 'kreativ_custom_logo', 0 );
/**
 * Display the custom logo.
 *
 * @since 1.1.0
 */
function kreativ_custom_logo() {
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

// Register widget areas.
genesis_register_sidebar( array(
	'id'          => 'topbar',
	'name'        => __( 'Topbar', 'kreativ-pro' ),
	'description' => __( 'This is the topbar section.', 'kreativ-pro' ),
) );

// Topbar with contact info and social links.
add_action( 'genesis_before_header', 'kreativ_topbar' );
function kreativ_topbar() {
	genesis_widget_area( 'topbar', array(
		'before' => '<div class="site-topbar"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

// Sticky Header.
add_filter( 'body_class', 'kreativ_sticky_header_class' );
function kreativ_sticky_header_class( $classes ) {
	$sticky_header = get_option( 'kreativ_sticky_header' );
	$classes[]     = 'sticky-header-active';
	return $classes;
}

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Hook menu in footer.
add_action( 'genesis_footer', 'kreativ_footer_menu', 12 );
function kreativ_footer_menu() {
	printf( '<nav %s>', genesis_attr( 'nav-footer' ) );
	wp_nav_menu( array(
		'theme_location' => 'footer',
		'container'      => false,
		'depth'          => 1,
		'fallback_cb'    => false,
		'menu_class'     => 'genesis-nav-menu',
	) );
	echo '</nav>';
}

// Nav footer attributes.
add_filter( 'genesis_attr_nav-footer', 'kreativ_footer_nav_attr' );
function kreativ_footer_nav_attr( $attributes ) {
	$attributes['itemscope'] = true;
	$attributes['itemtype']  = 'http://schema.org/SiteNavigationElement';
	return $attributes;
}

// Add skip link needs to footer nav.
add_filter( 'genesis_attr_nav-footer', 'kreativ_nav_footer_id' );
function kreativ_nav_footer_id( $attributes ) {
	$attributes['id'] = 'genesis-nav-footer';
	return $attributes;
}

// Add skip link needs to footer nav.
add_filter( 'genesis_skip_links_output', 'kreativ_nav_footer_skip_link' );
function kreativ_nav_footer_skip_link( $links ) {
	if ( has_nav_menu( 'footer' ) ) {
		$links['genesis-nav-footer'] = __( 'Skip to footer navigation', 'kreativ-pro' );
	}
	return $links;
}

/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function visual_voyager_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'visual_voyager_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function visual_voyager_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'visual_voyager_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function visual_voyager_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}

/**
 * Portfolio Template for Taxonomies.
 *
 * @param html $template Template for portfolio.
 * @return html $template
 */
function visual_voyager_portfolio_template( $template ) {
	if ( is_tax( [ 'portfolio_category', 'portfolio_tag' ] ) ) {
		$template = get_query_template( 'archive-portfolio' );
	}
	return $template;
}
add_filter( 'template_include', 'visual_voyager_portfolio_template' );

/**
 * Add 'page-attributes' to Portfolio Post Type.
 *
 * @param array $args arguments passed to register_post_type.
 * @return array $args
 */
function visual_voyager_portfolio_post_type_args( $args ) {
	$args['supports'][] = 'page-attributes';
	return $args;
}
add_filter( 'portfolioposttype_args', 'visual_voyager_portfolio_post_type_args' );

/**
 * Sort projects by menu order
 *
 * @param text $query portfolio query.
 */
function visual_voyager_portfolio_query( $query ) {
	if ( $query->is_main_query() && ! is_admin() && ( is_post_type_archive( 'portfolio' ) || is_tax( [ 'portfolio_category', 'portfolio_tag' ] ) ) ) {
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'visual_voyager_portfolio_query' );

/**
 * Grid Loop on Portfolio archive
 *
 * @author Bill Erickson
 * @link https://github.com/billerickson/Genesis-Grid/wiki/Home
 *
 * @param bool   $grid  whether to use grid loop.
 * @param object $query   the WP Query.
 * @return bool
 */
function visual_voyager_grid_loop_on_portfolio( $grid, $query ) {
	if ( is_post_type_archive( 'portfolio' ) ) {
		$grid = true;
	}

	return $grid;
}
add_filter( 'genesis_grid_loop_section', 'visual_voyager_grid_loop_on_portfolio', 10, 2 );

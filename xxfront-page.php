<?php
/**
 * Visual Voyager.
 *
 * This file adds the front page to the Visual Voyager Theme.
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

add_action( 'genesis_meta', 'vv_front_page_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 * @since 1.0.0
 */
function vv_front_page_genesis_meta() {

	// Enqueue scripts.
	add_action( 'wp_enqueue_scripts', 'vv_enqueue_front_script_styles', 1 );
	function vv_enqueue_front_script_styles() {
		wp_enqueue_style( 'vv-front-styles', get_stylesheet_directory_uri() . '/css/style-front.css' );
	}

	// Add front-page body class.
	add_filter( 'body_class', 'vv_body_class' );
	function vv_body_class( $classes ) {

		$classes[] = 'front-page';

		return $classes;

	}

	// Force full width content layout.
	add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

	// Remove breadcrumbs.
	remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

}

// Run the Genesis loop.
genesis();

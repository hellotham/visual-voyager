<?php
/**
 * Visual Voyager.
 *
 * This file adds the archive template to the Visual Voyager Theme.
 *
 * Template Name: archive
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

/* Add .imagely-grid body class */
add_filter( 'body_class', 'visual_voyager_grid_body_class' );
function visual_voyager_grid_body_class( $classes ) {
	$classes[] = 'vv-grid';
	return $classes;
}

/* Force full width content */
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

/* Reposition the entry meta in the entry header */
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_header', 'genesis_do_post_title', 13 );

/* Customize the entry meta in the entry header */
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'visual_voyager_post_info', 12 );
function visual_voyager_post_info() {
	echo '<p class="entry-meta">' . do_shortcode( '[post_date]' ) . '</p>';
}

/* Remove entry content */
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

/* Remove entry footer content */
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

/* Remove page navigation */
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );

/* Display featured image */
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'visual_voyager_masonry_image', 3 );
function visual_voyager_masonry_image() {
	$image_args = array(
		'size' => 'imagely-square'
	);
	$image = genesis_get_image( $image_args );
	echo '<a rel="bookmark" href="'. get_permalink() .'">'. $image .'</a>';
}

/* Run it all */
genesis();
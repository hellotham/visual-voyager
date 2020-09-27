<?php
/**
 * Milennial Pink.
 *
 * This file adds the archive-portfolio template to the Milennial Pink Theme.
 *
 * @package Milennial Pink
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

/**
 * Display as Columns.
 *
 * @param array $classes classes.
 */
function milennial_pink_portfolio_post_class( $classes ) {

	global $wp_query;
	if ( ! $wp_query->is_main_query() ) {
		return $classes;
	}

	$columns = 3;

	$column_classes = [ '', '', 'one-half', 'one-third', 'one-fourth', 'one-fifth', 'one-sixth' ];
	$classes[]      = $column_classes[ $columns ];
	if ( 0 === $wp_query->current_post % $columns ) {
		$classes[] = 'first';
	}

	return $classes;
}
add_filter( 'post_class', 'milennial_pink_portfolio_post_class' );

// Remove items from loop.
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

/**
 * Add Portfolio Image.
 */
function milennial_pink_portfolio_image() {
	echo esc_html( wpautop( '<a href="' . get_permalink() . '">' . genesis_get_image( [ 'size' => 'medium' ] ) . '</a>' ) );
}
add_action( 'genesis_entry_content', 'milennial_pink_portfolio_image' );
add_filter( 'genesis_pre_get_option_content_archive_thumbnail', '__return_false' );

// Move Title below Image.
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_footer', 'genesis_entry_header_markup_open', 5 );
add_action( 'genesis_entry_footer', 'genesis_entry_header_markup_close', 15 );
add_action( 'genesis_entry_footer', 'genesis_do_post_title' );


genesis();

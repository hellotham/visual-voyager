<?php
/**
 * Visual Voyager.
 *
 * This file adds the category template to the Visual Voyager Theme.
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

/* Remove Default Genesis Loop Output */
remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

/**
 * Add Image and Title.
 */
function visual_voyager_category_grid_content() {
	$img = genesis_get_image(
		[
			'format'  => 'html',
			'size'    => 'home-small',
			'context' => 'archive',
			'attr'    => genesis_parse_attr( 'entry-image' ),
		]
	);
	if ( ! empty( $img ) ) {
		printf(
			'<a href="%s" title="%s">%s</a>',
			esc_url( get_permalink() ),
			esc_attr( the_title_attribute( 'echo=0' ) ),
			esc_html( $img )
		);
	}
}
add_action( 'genesis_entry_header', 'visual_voyager_category_grid_content' );
add_action( 'genesis_entry_header', 'genesis_do_post_title' );

global $visual_voyager_category_count;

/**
 * Add Post Class
 *
 * @param array $classes classes.
 */
function visual_voyager_category_post_class( $classes ) {
	global $visual_voyager_category_count;
	$visual_voyager_category_count++;
	if ( 0 === $visual_voyager_category_count % 2 ) {
		$classes[] = 'one-half';
	} else {
		$classes[] = 'one-half first';
	}

	$classes[] = 'post-grid';

	return $classes;
}
add_action( 'post_class', 'visual_voyager_category_post_class' );

genesis();

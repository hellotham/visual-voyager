<?php
/**
 * Milennial Pink.
 *
 * This file adds the full width page template to the Milennial Pink Theme.
 *
 * Template Name: Page Builder - Full Width
 *
 * @package Milennial Pink
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

add_filter( 'body_class', 'milennial_pink_full_width_body_class' );
/**
 * Add landing page body class to the head.
 *
 * @param array $classes destination.
 * @return array
 */
function milennial_pink_full_width_body_class( $classes ) {

	$classes[] = 'template-full-width';

	return $classes;

}

add_filter( 'genesis_attr_site-inner', 'milennial_pink_attributes_site_inner' );
/**
 * Add attributes for site-inner element.
 *
 * @param array $attributes destination.
 * @return array
 */
function milennial_pink_attributes_site_inner( $attributes ) {
	$attributes['role']     = 'main';
	$attributes['itemprop'] = 'mainContentOfPage';
	return $attributes;
}


// Display Header.
get_header();

// Display Content.
the_post();
the_content();

// Display Comments.
genesis_get_comments_template();

// Display Footer.
get_footer();

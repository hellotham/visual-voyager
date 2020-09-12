<?php
/**
 * Visual Voyager.
 *
 * This file adds the full width page template to the Visual Voyager Theme.
 *
 * Template Name: Page Builder - Full Width
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

add_filter( 'body_class', 'visual_voyager_full_width_body_class' );
/**
 * Add landing page body class to the head.
 *
 * @param array $classes destination.
 * @return array
 */
function visual_voyager_full_width_body_class( $classes ) {

	$classes[] = 'template-full-width';

	return $classes;

}

add_filter( 'genesis_attr_site-inner', 'visual_voyager_attributes_site_inner' );
/**
 * Add attributes for site-inner element.
 *
 * @param array $attributes destination.
 * @return array
 */
function visual_voyager_attributes_site_inner( $attributes ) {
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

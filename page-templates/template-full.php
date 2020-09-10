<?php
/**
 * Visual Voyager.
 *
 * This file adds the Full Width page template to the Visual Voyager Theme.
 *
 * Template Name: Full Width
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

add_filter( 'genesis_attr_site-inner', 'visual_voyager_site_inner_attr' );

/**
 * Adds the attributes from 'entry', since this replaces the main entry.
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/full-width-landing-pages-in-genesis/
 *
 * @param array $attributes Existing attributes.
 * @return array Amended attributes.
 */
function visual_voyager_site_inner_attr( $attributes ) {

	// Adds a class of 'full' for styling this .site-inner differently.
	$attributes['class'] .= ' full';

	// Adds an id of 'genesis-content' for accessible skip links.
	$attributes['id'] = 'genesis-content';

	// Adds the attributes from .entry, since this replaces the main entry.
	$attributes = wp_parse_args( $attributes, genesis_attributes_entry( [] ) );

	return $attributes;
}

// Displays Header.
get_header();

genesis_do_breadcrumbs();

// Displays Content.
the_post(); // sets the 'in the loop' property to true. Needed for Beaver Builder but not Elementor.
the_content();

// Displays Comments (if any are already present and if comments are enabled in Genesis settings - disabled by default for Pages).
genesis_get_comments_template();

// Displays Footer.
get_footer();

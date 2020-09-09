<?php
// Template Name: Full Width

add_filter( 'genesis_attr_site-inner', 'be_site_inner_attr' );
/**
 * Adds the attributes from 'entry', since this replaces the main entry.
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/full-width-landing-pages-in-genesis/
 *
 * @param array $attributes Existing attributes.
 * @return array Amended attributes.
 */
function be_site_inner_attr( $attributes ) {

    // Adds a class of 'full' for styling this .site-inner differently
    $attributes['class'] .= ' full';

    // Adds an id of 'genesis-content' for accessible skip links
    $attributes['id'] = 'genesis-content';

    // Adds the attributes from .entry, since this replaces the main entry
    $attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );

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
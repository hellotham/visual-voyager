<?php
/**
 * Visual Voyager.
 *
 * This file adds the blank page template to the Visual Voyager Theme.
 *
 * Template Name: Page Builder - Blank
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

add_filter( 'body_class', 'visual_voyager_blank_body_class' );

/**
 * Add custom body class to the head.
 *
 * @param array $classes destination.
 * @return array
 */
function visual_voyager_blank_body_class( $classes ) {
	$classes[] = 'template-blank';
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

// Remove div.site-inner's div.wrap.
add_filter( 'genesis_structural_wrap-site-inner', '__return_empty_string' );

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove site topbar.
remove_action( 'genesis_before_header', 'visual_voyager_topbar' );

// Remove site header elements.
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Remove navigation.
remove_action( 'genesis_header', 'genesis_do_nav', 12 );
remove_action( 'genesis_header', 'genesis_do_subnav', 5 );

// Remove breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove site footer widgets.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

// Remove site footer elements.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Remove footer nav menu.
remove_action( 'genesis_footer', 'visual_voyager_footer_menu', 12 );

// Remove Scroll to top link.
remove_action( 'genesis_footer', 'visual_voyager_scrollup', 12 );

// Display Header.
get_header();

// Display Content.
the_post();
the_content();

// Display Comments.
genesis_get_comments_template();

// Display Footer.
get_footer();

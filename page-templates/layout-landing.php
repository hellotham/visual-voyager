<?php
/**
 * Milennial Pink.
 *
 * This file adds the landing page template to the Milennial Pink Theme.
 *
 * Template Name: Landing
 *
 * @package Milennial Pink
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

add_filter( 'body_class', 'milennial_pink_landing_body_class' );
/**
 * Adds landing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function milennial_pink_landing_body_class( $classes ) {

	$classes[] = 'landing-page';
	return $classes;

}

// Removes Skip Links.
remove_action( 'genesis_before_header', 'genesis_skip_links', 5 );

add_action( 'wp_enqueue_scripts', 'milennial_pink_dequeue_skip_links' );
/**
 * Dequeues Skip Links Script.
 *
 * @since 1.0.0
 */
function milennial_pink_dequeue_skip_links() {

	wp_dequeue_script( 'skip-links' );

}

// Remove site topbar.
remove_action( 'genesis_before_header', 'milennial_pink_topbar' );

// Removes site header elements.
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Removes navigation.
remove_theme_support( 'genesis-menus' );

// Remove breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Removes site footer elements.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Remove footer nav menu.
remove_action( 'genesis_footer', 'milennial_pink_footer_menu', 12 );

// Runs the Genesis loop.
genesis();

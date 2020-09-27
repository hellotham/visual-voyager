<?php
/**
 * Milennial Pink child theme.
 *
 * Theme supports.
 *
 * @package Milennial Pink
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/milennial-pink/
 */

return [
	'html5'                           => [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'navigation-widgets',
		'search-form',
		'script',
		'style',
	],
	'genesis-accessibility'           => [
		'drop-down-menu',
		'headings',
		'search-form',
		'skip-links',
	],
	'genesis-structural-wraps'        => [
		'header',
		'menu-primary',
		'menu-secondary',
		'menu-footer',
		'footer-widgets',
		'footer',
	],
	'genesis-after-entry-widget-area' => '',
	'genesis-footer-widgets'          => 3,
	'genesis-menus'                   => [
		'primary'   => __( 'Primary Menu', 'milennial-pink' ),
		'secondary' => __( 'Secondary Menu', 'milennial-pink' ),
		'footer'    => __( 'Footer Menu', 'milennial-pink' ),
	],
	'custom-header'                   => [
		'width'           => 1600,
		'height'          => 1200,
		'flex-height'     => true,
		'flex-width'      => true,
		'header-selector' => '.site-header',
		'header-text'     => false,
	],
	'custom-logo'                     => [
		'width'       => 300,
		'height'      => 60,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => [ '.site-title', '.site-description' ],
	],
];

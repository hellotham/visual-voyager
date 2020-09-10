<?php
/**
 * Visual Voyager child theme.
 *
 * Theme supports.
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/visual-voyager/
 */

return [
	'genesis-custom-logo'             => [
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	],
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
		'footer-widgets',
		'footer',
	],
	'genesis-after-entry-widget-area' => '',
	'genesis-footer-widgets'          => 3,
	'genesis-menus'                   => [
		'primary'   => __( 'Header Menu', 'visual-voyager' ),
		'secondary' => __( 'Footer Menu', 'visual-voyager' ),
	],
];

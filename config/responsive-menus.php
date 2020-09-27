<?php
/**
 * Milennial Pink child theme.
 *
 * @package Milennial Pink
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/milennial-pink/
 */

/**
 * Genesis responsive menus settings. (Requires Genesis 3.0+.)
 */
return [
	'script' => [
		'menuClasses' => [
			'mainMenu' => __( 'Menu', 'milennial-pink' ),
			'subMenu'  => __( 'Menu', 'milennial-pink' ),
			'others'   => [
				'.nav-primary',
				'.nav-secondary',
			],
		],
	],
	'extras' => [
		'media_query_width' => '1500px',
	],
];

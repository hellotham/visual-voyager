<?php
/**
 * Visual Voyager child theme.
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/visual-voyager/
 */

/**
 * Genesis responsive menus settings. (Requires Genesis 3.0+.)
 */
return [
	'script' => [
		'menuClasses' => [
			'mainMenu' => __( 'Menu', 'visual-voyager' ),
			'subMenu'  => __( 'Menu', 'visual-voyager' ),
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

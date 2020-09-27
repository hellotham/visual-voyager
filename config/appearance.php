<?php
/**
 * Milennial Pink appearance settings.
 *
 * @package Milennial Pink
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

$milennial_pink_default_colors = [
	'link'   => '#660099',
	'accent' => '#cc3366',
];

$milennial_pink_link_color = get_theme_mod(
	'milennial_pink_link_color',
	$milennial_pink_default_colors['link']
);

$milennial_pink_accent_color = get_theme_mod(
	'milennial_pink_accent_color',
	$milennial_pink_default_colors['accent']
);

$milennial_pink_link_color_contrast   = milennial_pink_color_contrast( $milennial_pink_link_color );
$milennial_pink_link_color_brightness = milennial_pink_color_brightness( $milennial_pink_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1500,
	'button-bg'            => $milennial_pink_link_color,
	'button-color'         => $milennial_pink_link_color_contrast,
	'button-outline-hover' => $milennial_pink_link_color_brightness,
	'link-color'           => $milennial_pink_link_color,
	'default-colors'       => $milennial_pink_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'milennial-pink' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $milennial_pink_link_color,
		],
		[
			'name'  => __( 'Accent color', 'milennial-pink' ),
			'slug'  => 'theme-secondary',
			'color' => $milennial_pink_accent_color,
		],
	],
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'milennial-pink' ),
			'size' => 12,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'milennial-pink' ),
			'size' => 16,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'milennial-pink' ),
			'size' => 20,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'milennial-pink' ),
			'size' => 24,
			'slug' => 'larger',
		],
	],
];

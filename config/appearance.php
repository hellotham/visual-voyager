<?php
/**
 * Visual Voyager appearance settings.
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

$visual_voyager_default_colors = [
	'link'   => '#0073e5',
	'accent' => '#0073e5',
];

$visual_voyager_link_color = get_theme_mod(
	'visual_voyager_link_color',
	$visual_voyager_default_colors['link']
);

$visual_voyager_accent_color = get_theme_mod(
	'visual_voyager_accent_color',
	$visual_voyager_default_colors['accent']
);

$visual_voyager_link_color_contrast   = visual_voyager_color_contrast( $visual_voyager_link_color );
$visual_voyager_link_color_brightness = visual_voyager_color_brightness( $visual_voyager_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1062,
	'button-bg'            => $visual_voyager_link_color,
	'button-color'         => $visual_voyager_link_color_contrast,
	'button-outline-hover' => $visual_voyager_link_color_brightness,
	'link-color'           => $visual_voyager_link_color,
	'default-colors'       => $visual_voyager_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'visual-voyager' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $visual_voyager_link_color,
		],
		[
			'name'  => __( 'Accent color', 'visual-voyager' ),
			'slug'  => 'theme-secondary',
			'color' => $visual_voyager_accent_color,
		],
	],
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'visual-voyager' ),
			'size' => 12,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'visual-voyager' ),
			'size' => 18,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'visual-voyager' ),
			'size' => 20,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'visual-voyager' ),
			'size' => 24,
			'slug' => 'larger',
		],
	],
];

<?php
/**
 * Milennial Pink.
 *
 * This file adds the Customizer additions to the Milennial Pink Theme.
 *
 * @package Milennial Pink
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

add_action( 'customize_register', 'milennial_pink_customizer_register' );
/**
 * Registers settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function milennial_pink_customizer_register( $wp_customize ) {

	$appearance = genesis_get_config( 'appearance' );

	$wp_customize->add_setting(
		'milennial_pink_link_color',
		[
			'default'           => $appearance['default-colors']['link'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'milennial_pink_link_color',
			[
				'description' => __( 'Change the color of post info links and button blocks, the hover color of linked titles and menu items, and more.', 'milennial-pink' ),
				'label'       => __( 'Link Color', 'milennial-pink' ),
				'section'     => 'colors',
				'settings'    => 'milennial_pink_link_color',
			]
		)
	);

	$wp_customize->add_setting(
		'milennial_pink_accent_color',
		[
			'default'           => $appearance['default-colors']['accent'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'milennial_pink_accent_color',
			[
				'description' => __( 'Change the default hover color for button links, menu buttons, and submit buttons. The button block uses the Link Color.', 'milennial-pink' ),
				'label'       => __( 'Accent Color', 'milennial-pink' ),
				'section'     => 'colors',
				'settings'    => 'milennial_pink_accent_color',
			]
		)
	);

	// Add theme layout setting to the Customizer.
	$wp_customize->add_section(
		'milennial_pink_sticky_header_section',
		[
			'title'       => __( 'Sticky Header', 'milennial-pink' ),
			'description' => __( 'Choose if you would like to display sticky header fixed to the top of page.', 'milennial-pink' ),
			'priority'    => 80.01,
		]
	);

	// Add theme layout setting to the Customizer.
	$wp_customize->add_setting(
		'milennial_pink_sticky_header',
		[
			'capability' => 'edit_theme_options',
			'type'       => 'option',
			'default'    => '',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'milennial_pink_sticky_header',
			[
				'label'    => __( 'Sticky Header', 'milennial-pink' ),
				'section'  => 'milennial_pink_sticky_header_section',
				'settings' => 'milennial_pink_sticky_header',
				'type'     => 'radio',
				'choices'  => [
					''        => __( 'Enable', 'milennial-pink' ),
					'disable' => __( 'Disable', 'milennial-pink' ),
				],
			]
		)
	);

	/*
	$wp_customize->add_setting(
		'milennial_pink_logo_width',
		[
			'default'           => 350,
			'sanitize_callback' => 'absint',
			'validate_callback' => 'milennial_pink_validate_logo_width',
		]
	);

	// Add a control for the logo size.
	$wp_customize->add_control(
		'milennial_pink_logo_width',
		[
			'label'       => __( 'Logo Width', 'milennial-pink' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'milennial-pink' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'milennial_pink_logo_width',
			'type'        => 'number',
			'input_attrs' => [
				'min' => 100,
			],

		]
	);
	*/
}

/**
 * Displays a message if the entered width is not numeric or greater than 100.
 *
 * @param object $validity The validity status.
 * @param int    $width The width entered by the user.
 * @return int The new width.
 */
function milennial_pink_validate_logo_width( $validity, $width ) {

	if ( empty( $width ) || ! is_numeric( $width ) ) {
		$validity->add( 'required', __( 'You must supply a valid number.', 'milennial-pink' ) );
	} elseif ( $width < 100 ) {
		$validity->add( 'logo_too_small', __( 'The logo width cannot be less than 100.', 'milennial-pink' ) );
	}

	return $validity;

}

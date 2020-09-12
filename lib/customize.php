<?php
/**
 * Visual Voyager.
 *
 * This file adds the Customizer additions to the Visual Voyager Theme.
 *
 * @package Visual Voyager
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

add_action( 'customize_register', 'visual_voyager_customizer_register' );
/**
 * Registers settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function visual_voyager_customizer_register( $wp_customize ) {

	$appearance = genesis_get_config( 'appearance' );

	$wp_customize->add_setting(
		'visual_voyager_link_color',
		[
			'default'           => $appearance['default-colors']['link'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'visual_voyager_link_color',
			[
				'description' => __( 'Change the color of post info links and button blocks, the hover color of linked titles and menu items, and more.', 'visual-voyager' ),
				'label'       => __( 'Link Color', 'visual-voyager' ),
				'section'     => 'colors',
				'settings'    => 'visual_voyager_link_color',
			]
		)
	);

	$wp_customize->add_setting(
		'visual_voyager_accent_color',
		[
			'default'           => $appearance['default-colors']['accent'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'visual_voyager_accent_color',
			[
				'description' => __( 'Change the default hover color for button links, menu buttons, and submit buttons. The button block uses the Link Color.', 'visual-voyager' ),
				'label'       => __( 'Accent Color', 'visual-voyager' ),
				'section'     => 'colors',
				'settings'    => 'visual_voyager_accent_color',
			]
		)
	);

	// Add theme layout setting to the Customizer.
	$wp_customize->add_section(
		'visual_voyager_sticky_header_section',
		[
			'title'       => __( 'Sticky Header', 'visual-voyager' ),
			'description' => __( 'Choose if you would like to display sticky header fixed to the top of page.', 'visual-voyager' ),
			'priority'    => 80.01,
		]
	);

	// Add theme layout setting to the Customizer.
	$wp_customize->add_setting(
		'visual_voyager_sticky_header',
		[
			'capability' => 'edit_theme_options',
			'type'       => 'option',
			'default'    => '',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'visual_voyager_sticky_header',
			[
				'label'    => __( 'Sticky Header', 'visual-voyager' ),
				'section'  => 'visual_voyager_sticky_header_section',
				'settings' => 'visual_voyager_sticky_header',
				'type'     => 'radio',
				'choices'  => [
					''        => __( 'Enable', 'visual-voyager' ),
					'disable' => __( 'Disable', 'visual-voyager' ),
				],
			]
		)
	);

	/*
	$wp_customize->add_setting(
		'visual_voyager_logo_width',
		[
			'default'           => 350,
			'sanitize_callback' => 'absint',
			'validate_callback' => 'visual_voyager_validate_logo_width',
		]
	);

	// Add a control for the logo size.
	$wp_customize->add_control(
		'visual_voyager_logo_width',
		[
			'label'       => __( 'Logo Width', 'visual-voyager' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'visual-voyager' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'visual_voyager_logo_width',
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
function visual_voyager_validate_logo_width( $validity, $width ) {

	if ( empty( $width ) || ! is_numeric( $width ) ) {
		$validity->add( 'required', __( 'You must supply a valid number.', 'visual-voyager' ) );
	} elseif ( $width < 100 ) {
		$validity->add( 'logo_too_small', __( 'The logo width cannot be less than 100.', 'visual-voyager' ) );
	}

	return $validity;

}

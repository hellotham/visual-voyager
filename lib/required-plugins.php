<?php
/**
 * Milennial Pink.
 *
 * This file adds the default theme settings to the Milennial Pink Theme.
 *
 * @package Milennial Pink
 * @author  HelloTham
 * @license GPL-2.0-or-later
 * @link    https://www.hellotham.com/
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_stylesheet_directory() . '/lib/class-plugin-activation.php';


add_action( 'tgmpa_register', 'milennial_pink_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 */
function milennial_pink_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 */
	$plugins = [

		[
			'name'     => 'Genesis Portfolio Pro',
			'slug'     => 'genesis-portfolio-pro',
			'required' => true,
		],

		[
			'name'     => 'Simple Social Icons',
			'slug'     => 'simple-social-icons',
			'required' => true,
		],

	];

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 */
	$config = [
		'id'           => 'milennial-pink',           // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	];

	tgmpa( $plugins, $config );
}

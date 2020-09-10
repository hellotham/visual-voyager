<?php

/* Remove Default Genesis Loop Output */
remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

/* Add Image and Title */
function mycategory_grid_content() {
	$img = genesis_get_image(
		[
			'format'  => 'html',
			'size'    => 'home-small',
			'context' => 'archive',
			'attr'    => genesis_parse_attr( 'entry-image' ),
		]
	);
	if ( ! empty( $img ) ) {
		printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );
	}
}
add_action( 'genesis_entry_header', 'mycategory_grid_content' );
add_action( 'genesis_entry_header', 'genesis_do_post_title' );

/* Add Post Class */
global $mycategory_count;
function mycategory_post_class( $classes ) {
	global $mycategory_count;
	$mycategory_count++;
	if ( 0 == $mycategory_count % 2 ) {
		$classes[] = 'one-half';
	} else {
		$classes[] = 'one-half first';
	}

	$classes[] = 'post-grid';

	return $classes;
}
add_action( 'post_class', 'mycategory_post_class' );

genesis();

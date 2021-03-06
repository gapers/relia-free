<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package relia
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function relia_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'relia_body_classes' );

/**
 * Adds manual excerpt to pages as well as to Posts
 */
function relia_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'relia_add_excerpts_to_pages' );

/* Tribe, add structured data to list view */
function tribe_list_view_structured_data ( ) {
    // bail if not list view
    if ( !tribe_is_list_view() ) return;
    global $wp_query;
    Tribe__Events__JSON_LD__Event::instance()->markup( $wp_query->posts );
}
add_action( 'wp_head', 'tribe_list_view_structured_data');

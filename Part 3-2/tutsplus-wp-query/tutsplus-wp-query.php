<?php
/**
* Plugin Name:   Tuts+ WP Query Plugin
* Plugin URI:    http://rachelmccollin.co.uk/
* Description:   Plugin to support tuts+ course on WP_Query.
* Version:       3.2
* Author:        Rachel McCollin
* Author URI:    http://rachelmccollin.co.uk
*
*
*/


function tutsplus_wp_query() {
	
	// query parameters
	$args = array(
		'posts_per_page' => 5
	);
	
	// the query
	$query = new WP_Query( $args );
	
}
add_action( 'blog_way_after_content', 'tutsplus_wp_query' );
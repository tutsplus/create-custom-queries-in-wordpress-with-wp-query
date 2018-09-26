<?php
/**
* Plugin Name:   Tuts+ WP Query Plugin
* Plugin URI:    http://rachelmccollin.co.uk/
* Description:   Plugin to support tuts+ course on WP_Query.
* Version:       3.3
* Author:        Rachel McCollin
* Author URI:    http://rachelmccollin.co.uk
*
*
*/

/*****************************************************************************************
tutsplus_wp_query - outputs five latest posts at the bottom of every page on the site
******************************************************************************************/
function tutsplus_wp_query() {
	
	// query parameters
	$args = array(
		'posts_per_page' => 5
	);
	
	// the query
	$query = new WP_Query( $args );
	
	//the loop
	if( $query-> have_posts() ) {
		
		echo'<h3>';
			_e( 'Latest Posts', 'tutsplus' );
		echo'</h3>';
		
		echo'<ul>';
			
			while( $query->have_posts() ) {
				$query->the_post();
				
				echo'<li>';
					echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
				echo'</li>';
				
			}
			
		echo'</ul>';
		
		wp_reset_postdata();
		
	}
	
}
add_action( 'blog_way_after_content', 'tutsplus_wp_query' );

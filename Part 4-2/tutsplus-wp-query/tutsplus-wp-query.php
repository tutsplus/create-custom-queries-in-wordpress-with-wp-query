<?php
/**
* Plugin Name:   Tuts+ WP Query Plugin
* Plugin URI:    http://rachelmccollin.co.uk/
* Description:   Plugin to support tuts+ course on WP_Query.
* Version:       4.2
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

/*****************************************************************************************
tutsplus_featured_query - outputs five latest posts at the bottom of every page on the site
******************************************************************************************/
function tutsplus_featured_query() {
	
	//query parameters
	$args = array(
		'posts_per_page' => 1,
		'orderby' => 'rand',
		'category_name' => 'featured'
	);
	
	//the query
	$query = new WP_Query( $args );
	
	//the loop
	if( $query->have_posts() ) {
		
		echo '<aside class="featured-post container">';
		
			while( $query->have_posts() ) {
				$query->the_post();
				
				echo '<h3>Featured Post - <a href="' . get_the_permalink() . ' ">' . get_the_title() . '</a></h3>';
				
				if( has_post_thumbnail() ) {
					
					echo '<a href="' . get_the_permalink() . ' ">';
						the_post_thumbnail( 'medium', array(
							'class' => 'alignleft'
						));
					echo '</a>';
					
				} 
				
				the_excerpt();
				
			}
		
		echo'</aside>';
		
		wp_reset_postdata();
		
	}
	
}
add_action( 'blog_way_before_content', 'tutsplus_featured_query' );

/*****************************************************************************************
tutsplus_category_query - outputs latest posts from three categories
******************************************************************************************/
function tutsplus_category_query() {
	
	echo '<aside class="category-latest container">';
	echo '<h3>Latest Posts by Category</h3>';
	
	global $post;
	$do_not_duplicate = array();
	
		//first query - Red category
		$args = array(
			'posts_per_page' => 1,
			'category_name' => 'red'
		);
		
		// set up the query
		$query = new WP_Query( $args );
		
		// the loop
		if( $query->have_posts() ) {
			
			while( $query->have_posts() ) {
				$query->the_post();
				
				echo '<div class="latest-post red clearfix">';
				
					if( has_post_thumbnail() ) {
						
						echo '<a href="' . get_the_permalink() . '">';
							the_post_thumbnail( 'thumbnail', array(
								'class' => 'alignleft'
							));
						echo '</a>';
					}
					
					echo 'Red - <a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
					the_excerpt();
					
				echo '</div>';
				
				$do_not_duplicate[]= $post->ID;
				
				wp_reset_postdata();
			}
			
		}
		
		//second query - Blue category
		$args = array(
			'posts_per_page' => 1,
			'category_name' => 'blue',
			'post__not_in' => $do_not_duplicate
		);
		
		// set up the query
		$query = new WP_Query( $args );
		
		// the loop
		if( $query->have_posts() ) {
			
			while( $query->have_posts() ) {
				$query->the_post();
				
				echo '<div class="latest-post blue clearfix">';
				
					if( has_post_thumbnail() ) {
						
						echo '<a href="' . get_the_permalink() . '">';
							the_post_thumbnail( 'thumbnail', array(
								'class' => 'alignleft'
							));
						echo '</a>';
					}
					
					echo 'Blue - <a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
					the_excerpt();
					
				echo '</div>';
				
				$do_not_duplicate[]= $post->ID;
				
				wp_reset_postdata();
			}
			
		}
		
		//first query - Pink category
		$args = array(
			'posts_per_page' => 1,
			'category_name' => 'pink',
			'post__not_in' => $do_not_duplicate
		);
		
		// set up the query
		$query = new WP_Query( $args );
		
		// the loop
		if( $query->have_posts() ) {
			
			while( $query->have_posts() ) {
				$query->the_post();
				
				echo '<div class="latest-post pink clearfix">';
				
					if( has_post_thumbnail() ) {
						
						echo '<a href="' . get_the_permalink() . '">';
							the_post_thumbnail( 'thumbnail', array(
								'class' => 'alignleft'
							));
						echo '</a>';
					}
					
					echo 'Pink - <a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
					the_excerpt();
					
				echo '</div>';
				
				wp_reset_postdata();
			}
			
		}
	
	echo '</aside>';
	
	
}
add_action( 'blog_way_after_content', 'tutsplus_category_query', 5 );

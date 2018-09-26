<?php
/**
 * The template for displaying category archive pages.
 * based on archive.php from blogway theme
 */

get_header(); 

	/**
	 * Hook - blog_way_before_primary.
	 *
	 * @hooked blog_way_before_primary_action - 10
	 */
	do_action( 'blog_way_before_primary' );
?>


	<?php
		
	$category = get_queried_object();
		
	//first query arguments
	$args = array(
		'category_name' => $category->slug,
		'posts_per_page' => 1
	);
	
	$query = new WP_Query( $args );
	
	if ( $query->have_posts() ) : ?>

		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php
		/* Start the Loop */
		while ( $query->have_posts() ) : $query->the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;

	else :

		get_template_part( 'template-parts/content', 'none' );
		
		wp_reset_postdata();

	endif;
	
	//second query arguments
	$args = array(
		'category_name' => $category->slug,
		'offset' => 1
	);
	
	$query = new WP_Query( $args );
	
	if ( $query->have_posts() ) :
	
	echo'<ul>';
			
			while( $query->have_posts() ) {
				$query->the_post();
				
				echo'<li>';
					echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
				echo'</li>';
				
			}
			
		echo'</ul>';
	
	wp_reset_postdata();
	
	endif; ?>

	
<?php
	/**
	 * Hook - blog_way_after_primary.
	 *
	 * @hooked blog_way_after_primary_action - 10
	 */
	do_action( 'blog_way_after_primary' );

	/**
	 * Hook - blog_way_sidebar.
	 *
	 * @hooked blog_way_sidebar_action - 10
	 */
	do_action( 'blog_way_sidebar' );

get_footer();
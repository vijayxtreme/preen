<?php if ( get_option('permalink_structure') ) { echo 'permalinks enabled'; } ?>

<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="container">
			<div id="primary-inside">
			<div id="content">
			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
			
			</div><!-- #content -->
		</div><!-- #container -->
	
<?php get_footer(); ?>
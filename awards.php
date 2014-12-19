<?php 
/*
Template Name: Awards
*/
?>

<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="primary-inside" style="">

<div id="content" class="awards-style">
<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>

</div>

</div>

<?php get_footer(); ?>
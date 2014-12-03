<?php 
/*
Template Name: Press
*/
?>
<?php get_header(); ?>
<style>
	#wrapper {
		width: 100%;
	}
</style>
<div id="inside-wrap" style="width:100%;">
<?php get_sidebar(); ?>
<div id="press-panel" style="padding-left:40px;">Some Text</div>
<div id="primary-inside" style="margin-left:0;">

<div id="press">
	<div id="content">

<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>
	</div>
</div>
</div>
</div>
<?php get_footer(); ?>
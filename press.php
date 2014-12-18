<?php 
/*
Template Name: Press
*/
?>
<?php get_header(); ?>


<?php get_sidebar(); ?>
<div id="press-panel">
	HATFIELD'S
	<br />LOS ANGELES MAGAZINE
	<br />MAKING THEIR MOVE
	<br />PATRICK KUH
	<br />FEB 2010
	<div style="padding-top:20px; ">
	<br />"Designer Alexis Readinger has fashioned what must be one of the most calming environments in the city.  Olive green banquettes wrap around the main room, mirroring each other on either side of a tweed-covered central divider. <br />Monochrome murals of wheat and corn stretch across one wall, and an oversize honeycomb light fixture hangs from the ceiling.  The light is so soft and the palette so subdued that together with the attentive service, the restaurant is an invitation to savor the moment.  This stab at taming the 6703 [Melrose Ave.] monster seems to have finally done the job.  Finally it is as intimate as it is vast."
	</div>
</div>


<div id="press" class="desktop mobile">
<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>

</div>

<script>
$(function(){
	$("p.wp-caption-text").hide();
	$("#press a").mouseover(function(){
		var idx=$(this).attr("class");
		var text = $(this).next().text();
		//console.log(text);
		$("#press-panel").html(text);
	});


	
});


</script>
<?php get_footer(); ?>


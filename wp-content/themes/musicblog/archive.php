<?php
/* 
Template Name: Archives
*/
?>
<?php get_header(); ?>
<main id="archive" class="archive">
	<?php while ( have_posts() ) : the_post(); ?>
	<h1><?php the_title(); ?></h1>
	
	<div class="entry-content">

	<?php wp_get_archives('type=postbypost&limit=10'); ?>
	</div><!-- .entry-content -->
	
	<?php endwhile; // end of the loop. ?>
</main>
<?php get_footer(); ?>
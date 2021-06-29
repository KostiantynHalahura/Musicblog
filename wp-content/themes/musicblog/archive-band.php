<?php get_header(); ?>
<section class="bands">
<?php
	if( have_posts() ) :
		while( have_posts() ) :
			the_post();
?>
	<article>
		<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<div>
			<span class="band-year"><?php echo get_post_meta( get_the_id(), 'year', true ); ?></span>
			<?php the_content(); ?>
		</div>
	</article>
<?php
		endwhile;
	endif;
?>
</section>
<?php get_footer(); ?>
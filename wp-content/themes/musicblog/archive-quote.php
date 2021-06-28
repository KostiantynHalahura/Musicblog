<?php get_header(); ?>
<section class="quotes">
<?php
	if( have_posts() ) :
		while( have_posts() ) :
			the_post();
?>
	<figure>
		<blockquote cite="">
			<span><?php the_title(); ?></span>
		</blockquote>
		<figcaption>—<?php the_content(); ?></figcaption>
	</figure>
<?php
		endwhile;
	endif;
?>
</section>
<?php get_footer(); ?>
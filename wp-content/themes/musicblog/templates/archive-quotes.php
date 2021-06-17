<?php
	/* Template Name: Quote */
?>
<?php get_header(); ?>
<article class="bands">
	<?php
		$args = array(
		'post_type' => 'quote',
		'posts_per_page' => 10,
		);
		$loop = new WP_Query($args);
		while ( $loop->have_posts() ) {
			$loop->the_post();
		?>
	<div class="content">
		<blockquote><?php the_title() ?></blockquote>
		<b><cite><?php the_content(); ?></cite></b>
	</div>
	<?php
		}?>
</article>
<?php get_footer(); ?>
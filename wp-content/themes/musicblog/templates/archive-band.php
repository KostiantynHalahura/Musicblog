<?php
	/* Template Name: Band */
?>
<?php get_header(); ?>
<article class="bands">
	<?php
		$args = array(
		'post_type' => 'band',
		'posts_per_page' => 10,
		);
		$loop = new WP_Query($args);
		while ( $loop->have_posts() ) {
			$loop->the_post();
		?>
	<div class="content">
		<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
		<?php the_content(); ?>
	</div>
	<?php
		}?>
</article>
<?php get_footer(); ?>
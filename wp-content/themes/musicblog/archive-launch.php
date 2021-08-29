<?php get_header(); ?>
	<section class="launch">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article>
                        <p>Название:</p>
					    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        <p>Предстоящий:</p>
                        <span class="upcoming"><?php echo get_post_meta( get_the_id(), 'upcoming', TRUE ); ?></span>
                        <p>Ракета:</p>
                        <span class="rocket"><?php echo get_post_meta( get_the_id(), 'rocket', TRUE ); ?></span>
                        <p>Дата отправки:</p>
                        <span class="date_utc"><?php echo get_post_meta( get_the_id(), 'date_utc', TRUE ); ?></span>
                        <p>Предстоящий:</p>
                        <span class="upcoming"><?php echo get_post_meta( get_the_id(), 'upcoming', TRUE ); ?></span>
                        <p>Номер полёта:</p>
                        <span class="flight_number"><?php echo get_post_meta( get_the_id(), 'flight_number', TRUE ); ?></span>
                        <hr>
				</article>
			<?php
			endwhile;
		endif;
		?>
	</section>
<?php get_footer(); ?>
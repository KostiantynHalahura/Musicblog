<?php get_header(); ?>
    <section class="quotes">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
                <figure>
                    <blockquote cite="">
                        <span><?php the_title(); ?></span>
                    </blockquote>
                    <figcaption>— <span
                                class="quote-author"><?php echo get_post_meta( get_the_id(), 'author', TRUE ); ?></span>
                    </figcaption>
                </figure>
			<?php
			endwhile;
		endif;
		?>
    </section>
<?php get_footer(); ?>
<?php get_header(); ?>
<?php
	if( have_posts() ){
		while( have_posts() ){
			the_post();
?>
<div>
	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	<?php the_content(); ?>
	</div>
<?php
	}
?>
<?php
	}
	else {
		echo "<h2>Записей нет.</h2>";
	}
?>
<?php get_footer(); ?>
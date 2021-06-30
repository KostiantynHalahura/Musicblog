<?php
	function register_my_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu' ),
				'footer-menu' => __( 'Footer Menu' )
			)
		);
	}
	add_action( 'init', 'register_my_menus' );

	include 'core/base-post-type.php';
	include 'app/post-types/band.php';
	new Band();
	
	function k_create_post_type_quote() {
		register_post_type( 'quote',
		array(
			'labels' => array(
				'name' => __( 'Quotes' ),
				'singular_name' => __( 'Quote' ),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'quotes'),
			'menu_position' => 4,
			'supports' => array( 'title', 'editor', 'post_formats' ),
		)
	);
}
	add_action( 'init', 'k_create_post_type_quote' );
?>

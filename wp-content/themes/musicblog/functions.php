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

	function k_create_post_type_band() {
		register_post_type( 'band',
		array(
			'labels' => array(
				'name' => __( 'Bands' ),
				'singular_name' => __( 'Band' ),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'bands'),
			'menu_position' => 4,
			'supports' => array( 'title', 'editor', 'thumbnail', 'post_formats' ),
		)
	);
}
	add_action( 'init', 'k_create_post_type_band' );

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

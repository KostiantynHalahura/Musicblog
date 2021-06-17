<?php
	add_filter( 'auto_update_core', '__return_false' );
	add_filter( 'auto_update_theme', '__return_false' );
	add_filter( 'auto_update_plugin', '__return_false' );
	add_filter( 'auto_update_translation', '__return_false' );
	add_filter( 'auto_core_update_send_email', '__return_false' );

	function register_my_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu' ),
				'footer-menu' => __( 'Footer Menu' )
			)
		);
	}
	add_action( 'init', 'register_my_menus' );
?>

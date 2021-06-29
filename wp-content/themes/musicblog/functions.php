<?php
	//Styles
	wp_enqueue_style ('main-style', get_template_directory_uri(). '/resources/css/main-style.css');

	//Update switching off
	
	add_filter( 'auto_update_core', '__return_false' );
	add_filter( 'auto_update_theme', '__return_false' );
	add_filter( 'auto_update_plugin', '__return_false' );
	add_filter( 'auto_update_translation', '__return_false' );
	add_filter( 'auto_core_update_send_email', '__return_false' );

	//Menus

	function register_my_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu' ),
				'footer-menu' => __( 'Footer Menu' )
			)
		);
	}
	add_action( 'init', 'register_my_menus' );

	//Post types

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

	//Metaboxes
	
	function k_meta_box() {
		add_meta_box('settings', 'Настройки', 'k_meta_box_html', 'band', 'normal', 'high');
	}

	add_action( 'admin_menu', 'k_meta_box' );
	
	function k_meta_box_html( $post ) {
		$value = get_post_meta( $post->ID, '_wporg_meta_key', true );
		?>
		<label for="wporg_field">Description for this field</label>
		<select name="wporg_field" id="wporg_field" class="postbox">
			<option value="">Select something...</option>
			<option value="something" <?php selected( $value, 'something' ); ?>>Something</option>
			<option value="else" <?php selected( $value, 'else' ); ?>>Else</option>
		</select>
		<?php
	}
	
	function wporg_save_postdata( $post_id ) {
		if ( array_key_exists( 'wporg_field', $_POST ) ) {
			update_post_meta(
				$post_id,
				'_wporg_meta_key',
				$_POST['wporg_field']
			);
		}
	}
	add_action( 'save_post', 'wporg_save_postdata' );
?>
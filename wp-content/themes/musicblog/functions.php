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
	
	//Band
	function band_custom_box() {
		add_meta_box( 'band_form', 'Дополнительно', 'band_custom_box_html', 'band');
}
	add_action('add_meta_boxes', 'band_custom_box');

	function band_custom_box_html( $post ) {
		wp_nonce_field( basename(__FILE__), 'band_noncename' );

	$year = get_post_meta( $post->ID, 'year', 1 );

	echo '<label for="year_field">' . __("Год создания", 'band_custom_box_textdomain' ) . '</label>';
	echo '<input type="number" id="year_field" name="year_field" value="'. $year .'" size="25" />';
}

	function band_custom_box_save( $post_id ) {
		if ( ! isset( $_POST['year_field'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['band_noncename'], basename(__FILE__) ) ) {
			return;
		}
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return;
		}
		if( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$year_field = sanitize_text_field( $_POST['year_field'] );

		update_post_meta( $post_id, 'year', $year_field );
}
	add_action( 'save_post', 'band_custom_box_save' );

	//Quote
	function quote_custom_box() {
		add_meta_box( 'quote_form', 'Дополнительно', 'quote_custom_box_html', 'quote');
}
	add_action('add_meta_boxes', 'quote_custom_box');

	function quote_custom_box_html( $post ) {
		wp_nonce_field( basename(__FILE__), 'quote_noncename' );
	
	$author = get_post_meta( $post->ID, 'author', 1 );
	
	echo '<label for="author_field">' . __("Автор", 'quote_custom_box_textdomain' ) . '</	label> ';
	echo '<input type="text" id="author_field" name="author_field" value="'. $author .'" size="25" />';
	}
	
	add_action( 'save_post', 'quote_custom_box_save' );
	function quote_custom_box_save( $post_id ) {
		if ( ! isset( $_POST['author_field'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['quote_noncename'], basename(__FILE__) ) ) {
			return;
		}
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return;
		}
		if( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	
		$author_field = sanitize_text_field( $_POST['author_field'] );
	
		update_post_meta( $post_id, 'author', $author_field );
}
?>
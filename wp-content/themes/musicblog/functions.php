<?php
//Styles
function mytheme_enqueue_style() {
wp_enqueue_style( 'main-style', get_template_directory_uri() . '/resources/css/main-style.css' );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_style' );

//Update switching off

add_filter( 'auto_update_core', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_translation', '__return_false' );
add_filter( 'auto_core_update_send_email', '__return_false' );

//Menus

function register_my_menus() {
	register_nav_menus(
		[
			'header-menu' => __( 'Header Menu' ),
			'footer-menu' => __( 'Footer Menu' ),
		]
	);
}
add_action( 'init', 'register_my_menus' );

//include 'core/base-post-type.php';
//include 'app/post-types/band.php';
//new Band();

function k_create_post_type_band() {
	register_post_type( 'band',
		[
			'labels'        => [
				'name'          => __( 'Bands' ),
				'singular_name' => __( 'Band' ),
			],
			'public'        => TRUE,
			'has_archive'   => TRUE,
			'rewrite'       => [ 'slug' => 'bands' ],
			'menu_position' => 4,
			'supports'      => [ 'title', 'editor', 'thumbnail', 'post_formats' ],
		]
	);
}
add_action( 'init', 'k_create_post_type_band' );

function k_create_post_type_quote() {
	register_post_type( 'quote',
		[
			'labels'        => [
				'name'          => __( 'Quotes' ),
				'singular_name' => __( 'Quote' ),
			],
			'public'        => TRUE,
			'has_archive'   => TRUE,
			'rewrite'       => [ 'slug' => 'quotes' ],
			'menu_position' => 4,
			'supports'      => [ 'title', 'editor', 'post_formats' ],
		]
	);
}
add_action( 'init', 'k_create_post_type_quote' );

function k_create_post_type_launch() {
	register_post_type( 'launch',
		[
			'labels'        => [
				'name'          => __( 'Launches' ),
				'singular_name' => __( 'Launch' ),
			],
			'public'        => TRUE,
			'has_archive'   => TRUE,
			'rewrite'       => [ 'slug' => 'launch' ],
			'menu_position' => 5,
			'supports'      => [ 'title', 'editor', 'thumbnail' ],
		]
	);
}
add_action( 'init', 'k_create_post_type_launch' );

//SpaceX API
// Launches

function get_launches_from_api() {
	$current_page = ( ! empty( $_POST['current_page'] ) ) ? $_POST['current_page'] : 1;
	$launches     = [];

	$results = wp_remote_retrieve_body( wp_remote_get( 'https://api.spacexdata.com/v4/launches/?page=' . $current_page . '&per_page=20' ) );

	$results = json_decode( $results );

	if ( ! is_array( $results ) || empty( $results ) ) {
		return FALSE;
	}

	$launches[] = $results;
	foreach ( $launches[0] as $launch ) {
		$launch_slug = sanitize_title( $launch->name . '-' . $launch->id );

		$inserted_launch = wp_insert_post( [
			'post_name'   => $launch_slug,
			'post_title'  => $launch_slug,
			'post_type'   => 'launch',
			'post_status' => 'publish',
		] );

		if ( is_wp_error( $inserted_launch ) ) {
			continue;
		}

		$fillable = [
			'field_612bb5c4358b6' => 'name',
			'field_612bb6c1358b9' => 'photo',
			'field_612bb5a3358b5' => 'upcoming',
			'field_612bb65e358b8' => 'flight_number',
			'field_612bb52a358b4' => 'date_utc',
			'field_612bb5dd358b7' => 'rocket',
			'field_612bb79e358ba' => 'description',
		];

		foreach ( $fillable as $key => $name ) {
			update_field( $key, $launch->$name, $inserted_launch );
		}
	}

	$current_page = $current_page + 1;

	wp_remote_post( admin_url( 'admin-ajax.php?action=get_launches_from_api' ), [
		'blocking'  => FALSE,
		'sslverify' => FALSE,
		'body'      => [
			'current_page' => $current_page,
		],
	] );
}
add_action( 'wp_ajax_nopriv_get_launches_from_api', 'get_launches_from_api' );
add_action( 'wp_ajax_get_launches_from_api', 'get_launches_from_api' );

//Metaboxes

//Band
function band_custom_box() {
	add_meta_box( 'band_form', 'Дополнительно', 'band_custom_box_html', 'band' );
}
add_action( 'add_meta_boxes', 'band_custom_box' );

function band_custom_box_html( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'band_noncename' );

	$year = get_post_meta( $post->ID, 'year', 1 );

	echo '<label for="year_field">' . __( "Год создания", 'band_custom_box_textdomain' ) . '</label>';
	echo '<input type="number" id="year_field" name="year_field" value="' . $year . '" size="25" />';
}

function band_custom_box_save( $post_id ) {
	if ( ! isset( $_POST['year_field'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['band_noncename'], basename( __FILE__ ) ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$year_field = sanitize_text_field( $_POST['year_field'] );

	update_post_meta( $post_id, 'year', $year_field );
}
add_action( 'save_post', 'band_custom_box_save' );

//Quote
function quote_custom_box() {
	add_meta_box( 'quote_form', 'Дополнительно', 'quote_custom_box_html', 'quote' );
}
add_action( 'add_meta_boxes', 'quote_custom_box' );

function quote_custom_box_html( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'quote_noncename' );

	$author = get_post_meta( $post->ID, 'author', 1 );

	echo '<label for="author_field">' . __( "Автор", 'quote_custom_box_textdomain' ) . '</	label> ';
	echo '<input type="text" id="author_field" name="author_field" value="' . $author . '" size="25" />';
}

function quote_custom_box_save( $post_id ) {
	if ( ! isset( $_POST['author_field'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['quote_noncename'], basename( __FILE__ ) ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$author_field = sanitize_text_field( $_POST['author_field'] );

	update_post_meta( $post_id, 'author', $author_field );
}
add_action( 'save_post', 'quote_custom_box_save' );

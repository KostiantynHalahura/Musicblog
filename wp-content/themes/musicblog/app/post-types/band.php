<?php
class Band extends BasePostType {
	protected $name = "band";

	protected $args = array(
		'labels' 			=> [
			'name' 			=> 'Bands',
			'singular_name' => 'Band',
		],
		'public' => true,
		'has_archive' => true,
		'rewrite' => ['slug' => 'bands'],
		'menu_position' => 4,
		'supports' => ['title', 'editor', 'thumbnail', 'post_formats'],
	);
}
?>
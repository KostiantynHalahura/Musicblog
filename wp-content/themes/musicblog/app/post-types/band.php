<?php

class Band extends BasePostType {
	protected $name = "band";

	protected $args = [
		'labels'        => [
			'name'          => 'Bands',
			'singular_name' => 'Band',
		],
		'public'        => TRUE,
		'has_archive'   => TRUE,
		'rewrite'       => [ 'slug' => 'bands' ],
		'menu_position' => 4,
		'supports'      => [ 'title', 'editor', 'thumbnail', 'post_formats' ],
	];
}
?>
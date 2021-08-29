<?php

class Launch extends BasePostType {
	protected $name = "launch";
	protected $args = [
		'labels'        => [
			'name'          => 'Launches',
			'singular_name' => 'Launch',
		],
		'public'        => TRUE,
		'has_archive'   => TRUE,
		'rewrite'       => [ 'slug' => 'launches' ],
		'menu_position' => 4,
		'supports'      => [ 'title', 'editor', 'thumbnail', 'post_formats' ],
	];
}

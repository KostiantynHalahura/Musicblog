<?php

class Quote extends BasePostType {
	protected $name = "quote";
	protected $args = [
		'labels'        => [
			'name'          => 'Quotes',
			'singular_name' => 'Quote',
		],
		'public'        => TRUE,
		'has_archive'   => TRUE,
		'rewrite'       => [ 'slug' => 'quotes' ],
		'menu_position' => 4,
		'supports'      => [ 'title', 'editor', 'thumbnail', 'post_formats' ],
	];
}

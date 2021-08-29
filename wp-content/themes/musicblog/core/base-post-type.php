<?php

class BasePostType {
	protected $name;
	protected $args;

	public function __construct() {
		add_action( 'init', [ $this, 'register' ] );
	}

	public function register() {
		register_post_type( $this->name, $this->args );
	}
}
<?php
class Configs {

	private $config;

	public function __construct() {
		require_once 'core/config/main.php';
		@include_once 'app/config/main.php';
		$this->config = $configs;
	}

	public function __get( $name ) {
		return isset( $this->config[ $name ] ) ? $this->config[ $name ] : null;
	}

}

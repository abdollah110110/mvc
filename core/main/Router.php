<?php
//Takes the URL and breaks it into controller, action and parameter sections
//and returns them separately.
class Router {

	private $route;
	private $controller;
	private $action;
	private $params;

	public function __construct() {
		$config = Loader::load( 'Configs' );
		if ( isset( $_GET[ 'r' ] ) ) {
			$path = $_GET[ 'r' ];
		}
		else {
			$path = $config->defaultController;
			if ( ! $path ) {
				$path = 'site';
			}
		}
		$this->route = preg_replace( $config->invalidUrlChars, '', $path );
		$routeParts = explode( '/', $this->route );
		$this->controller = $routeParts[ 0 ];
		$this->action = isset( $routeParts[ 1 ] ) ? $routeParts[ 1 ] : 'index';
		array_shift( $routeParts );
		array_shift( $routeParts );
		foreach ( $routeParts as $key => $value ) {
			if ( trim( $value ) === '' ) {
				unset( $routeParts[ $key ] );
			}
		}
		if ( count( $routeParts ) % 2 == 1 ) {
			throw new Exception( 'You must specify parameters as \'key/value\' pairs (e.g. type/valid/page/2 means type=valid and page=2)', 403 );
		}
		$routeParts = array_values( $routeParts );
		$this->params = [];
		foreach ( array_keys( $routeParts ) as $key ) {
			if ( $key % 2 == 1 ) {
				continue;
			}
			$this->params[ $routeParts[ $key ] ] = $routeParts[ $key + 1 ];
		}
	}

	public function getAction () {
		return (!empty($this->action) ? $this->action : 'index');
	}

	public function getController () {
		return (!empty($this->controller) ? $this->controller : 'Site');
	}

	public function getParams () {
		return (!empty($this->params) ? $this->params : []);
	}

}

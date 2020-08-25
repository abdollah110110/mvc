<?php
set_include_path( get_include_path() . PATH_SEPARATOR . 'core/main' );

spl_autoload_register( function($class) {
	require_once $class . '.php';
} );

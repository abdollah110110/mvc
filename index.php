<?php
require_once 'core/init.php';

try {
	Initializer::init();
	$configs = Loader::load('Configs');
	$router = Loader::load('Router');
	Dispacher::dispach($configs, $router);
}
catch ( Exception $e ) {
	echo '<div style="color:red;border:10px solid red;margin:10vh auto;padding:20px;width:40%;">';
	echo '<h2><strong>Code: </strong>' . $e->getCode() . '</h2>';
	echo '<p><strong>In file: </strong>' . $e->getFile() . '</p>';
	echo '<p><strong>In line: </strong>' . $e->getLine() . '</p>';
	echo '<p><strong>Error message: </strong>' . $e->getMessage() . '</p><div>' . PHP_EOL;
}



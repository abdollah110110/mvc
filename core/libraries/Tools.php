<?php
class Tools {

	public static function debugPre( $value, $exit = true ) {
		if ( is_array( $value ) ) {
			echo '<div style="background:#eee;padding:10px;">';
			echo '<pre>' . print_r( $value, true ) . '</pre>' . PHP_EOL;
			echo '</div>' . PHP_EOL;
		}
		elseif ( is_object( $value ) ) {
			echo '<div style="background:#eee;padding:10px;">';
			echo '<pre>' . print_r( $value, true ) . '</pre>' . PHP_EOL;
			echo '</div>' . PHP_EOL;
		}
		else {
			echo '<div style="background:#eee;padding:10px;">';
			echo '<pre>' . $value . '</pre>' . PHP_EOL;
			echo '</div>' . PHP_EOL;
		}
		if ( $exit ) {
			exit();
		}
	}

	public static function basePath() {
		return str_replace( '\\', '/', dirname( dirname( __DIR__ ) ) . '/' );
	}

	public static function url() {
		return Loader::load( 'Configs' )->homeUrl;
	}

	public static function encode($string){
		return htmlentities($string, ENT_QUOTES, 'utf-8');
	}

}

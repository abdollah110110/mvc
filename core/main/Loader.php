<?php
// Use the Singleton architecture to load specified objects
class Loader {

	private static $loaded = [];

	public static function load( $object ) {
		$valid = [ 'Configs', 'Router' ];
		if ( ! in_array( $object, $valid ) ) {
			self::load( 'Configs' );
			throw new Exception( "'{$object}' is not a valid object to load." );
		}
		if ( empty( self::$loaded[ $object ] ) ) {
			self::$loaded[ $object ] = new $object;
		}
		return self::$loaded[ $object ];
	}

	public static function loaded() {
		Base::inspect( array_keys( self::$loaded ) );
	}

}

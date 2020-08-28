<?php
class Model {

	protected $con;

	public function __construct() {
		$this->connect();
	}

	private function connect() {
		$config = Loader::load( 'Configs' );
		$this->con = new mysqli( $config->dbHost, $config->dbUser, $config->dbPassword, $config->dbName );
		if ( ! $this->con->error ) {
			$this->con->query( "SET NAMES 'utf8'" );
			$this->con->set_charset( 'utf8' );
			echo 'Ok';
		}
		else {
			echo $this->con->connect_error;
		}
	}

	public function query( $query ) {
//		$this->connect();
		return $this->con->query( $query );
	}

	public function escape( $param ) {
//		$this->connect();
		if ( $param == null )
			return 'NULL';
		return $this->con->real_escape_string( $param );
	}

	public function insertId() {
//		$this->connect();
		return $this->con->insert_id();
	}

	public function arrayQuery( $query ) {
//		$this->connect();
		$result = [];
		$values = $this->query( $query );
		if ( $values && $values->num_rows > 0 ) {
			while ($value = $values->fetch_assoc()) {
				$result[] = $value;
			}
		}
		return $result;
	}

}

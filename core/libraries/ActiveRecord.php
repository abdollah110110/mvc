<?php
class ActiveRecord extends Model {

	protected $model;
	protected $tableName;
	protected $fields;
	protected $isNew;

	public function __construct() {
//		$this->model = new Model();
		foreach ( $this->fields as $key => $value ) {
			$this->fields[ $key ] = null;
		}
		$this->isNew = true;
	}

	public function __get( $name ) {
		return (isset( $this->fields[ $name ] ) ? $this->fields[ $name ] : null);
	}

	public function __set( $name, $value ) {
		if ( array_key_exists( $name, $this->fields ) ) {
			$this->fields[ $name ] = $value;
		}
	}

	public function tableColumns() {
		$sql = "SHOW COLUMNS FROM `{$this->tableName}`";
		$result = $this->query( $sql );
		$fields = [];
		while ($row = $result->fetch_assoc()) {
			$fields[] = $row[ 'Field' ];
		}
		return $fields;
	}

	public function findByPk( $id ) {
		$className = get_class( $this );
		$obj = new $className();
		$this->model = new Model();
		$id = $this->model->escape( $id );
		$sql = "SELECT * FROM `{$this->tableName}` WHERE (`id`='{$id}')";
		$data = $this->model->arrayQuery( $sql );
		if ( count( $data ) > 0 ) {
			foreach ( $data[ 0 ] as $fieldName => $value ) {
				$obj->$fieldName = $value; // use of __set : $this->fields.id = 1
			}
			$obj->isNew = false;
			return $obj;
		}
	}

	public function findAll() {
		$modelObject = null;
		$className = get_class( $this );
		$this->model = new $className();
		$sql = "SELECT * FROM `{$this->tableName}` ORDER BY id";
		$data = $this->model->arrayQuery( $sql );
		if ( count( $data ) > 0 ) {
			$modelObjects = [];
			foreach ( $data as $item ) {
				$modelObject = new $className();
				foreach ( $item as $fieldName => $value ) {
					$modelObject->$fieldName = $value;
				}
				$modelObject->isNew = false;
				$modelObjects[] = $modelObject;
			}
			return $modelObjects;
		}
	}

	public function save() {
		return ($this->isNew ? $this->insert() : $this->update());
	}

	public function insert() {
		$fields = array_map( [ $this->model, 'escape' ], $this->fields );
		$sql = "INSERT INTO `{$this->tableName}` VALUES (";
		foreach ( $fields as $field ) {
			$sql .= $field . ',';
		}
		$sql .= substr( $sql, 0, -1 ) . ')';
		$result = $this->model->query( $sql );
		$this->new = false;
		$this->id = $this->model->insertId();
		return $result;
	}

	public function update() {
		$this->model = new Model();
		$fields = array_map( [ $this->model, 'escape' ], $this->fields );
		$sql = "UPDATE `{$this->tableName}` SET ";
		foreach ( $fields as $key => $value ) {
			if ( $key === 'id' ) {
				continue;
			}
			$sql .= "`{$key}`='{$value}',";
		}
		$sql = substr( $sql, 0, -1 ) . " WHERE (`id`={$fields[ 'id' ]})";
		$this->new = false;
	}

	public function delete() {
		$id = $this->model->escape( $this->id );
		$sql = "DELETE FROM `{$this->tableName}` WHERE (`id`={$id})";
		return $this->model->query( $sql );
	}

}

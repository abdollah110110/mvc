<?php
class Categories extends ActiveRecord {

	public function __construct() {
		$this->tableName = strtolower( get_class( $this ) );
		$this->fields = $this->setFieldsNull();
	}

	private function setFieldsNull() {
		$fieldNames = $this->tableColumns();
		$fieldsNull = [];
		foreach ( $fieldNames as $value ) {
			$fieldsNull[ $value ] = null;
		}
		return $fieldsNull;
	}

}

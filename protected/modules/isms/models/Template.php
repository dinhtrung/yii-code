<?php
/**
 * This is the model base class for the table "template".
 *
 * Columns in table "template" available as properties of the model:
 * @property integer $id
 * @property string $title
 * @property string $body
 *
 * There are no model relations.
 */
class Template extends BaseActiveRecord {
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	/**
	 * Initializes this model.
	 */
	public function init() {
		return parent::init();
	}
	/**
	 * This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	 * @return string representing the object
	 */
	public function __toString() {
		return (string)$this->title;
	}
	/**
	 * @return string name of the class table
	 */
	public function tableName() {
		return '{{template}}';
	}
	/**
	 * Provide default sorting and optional condition
	 */
	public function defaultScope() {
		return array(
			'order' => 'title ASC',
		);
	}

	/*
	 */
	protected function createTable() {
		$columns = array(
				'id'	=>	'pk',
				'title'	=>	'string',
				'body'	=>	'text',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
	}
}

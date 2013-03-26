<?php
/**
 * This is the model base class for the table "organization".
 *
 * Columns in table "organization" available as properties of the model:
 * @property integer $id
 * @property string $title
 * @property string $description
 *
 * There are no model relations.
 */
class Organization extends BaseActiveRecord {
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
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
		return '{{organization}}';
	}
	/**
	 * Relation to other models
	 */
	public function relations() {
		return array(
			'users' => array(self::HAS_MANY, 'Users', 'org'),
			'campaigns' => array(self::HAS_MANY, 'Campaign', 'org'),
		);
	}
	/**
	 * Provide default sorting and optional condition
	 */
	public function defaultScope() {
		return array(
			'order' => 'title ASC',
		);
	}
}

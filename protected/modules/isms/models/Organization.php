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
	/*
	CREATE TABLE IF NOT EXISTS `organization` (
	`id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'bearerbox_id',
	`title` varchar(255) NOT NULL COMMENT 'Ten trung tam',
	`description` text NOT NULL COMMENT 'Mo ta di kem',
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
	*/
	protected function createTable() {
		$columns = array(
				'id'	=>	'pk',
				'title'	=>	'string',
				'description'	=>	'text',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
	}
}

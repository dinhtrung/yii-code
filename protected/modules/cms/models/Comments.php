<?php

/**
 * This is the model base class for the table "comments".
 *
 * Columns in table "comments" available as properties of the model:
 * @property integer $id
 * @property string $entity
 * @property integer $pkey
 * @property integer $uid
 * @property integer $createtime
 * @property integer $visible
 * @property string $comment
 *
 * There are no model relations.
 */
class Comments extends BaseActiveRecord{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* Initializes this model.
	*/
	public function init()
	{
		return parent::init();
	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{comments}}';
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'entity ASC',
		);
	}
	/**
	 * Create the table if needed
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'entity'	=>	'string',
				'pkey'	=>	'int',
				'uid'	=>	'int',
				'createtime'	=>	'int',
				'updatetime'	=>	'int',
				'visible'	=>	'boolean',
				'comment'	=>	'text',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
	}
}

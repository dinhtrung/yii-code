<?php
/*
 * This is just a base class for NestedSet behavior...
 */
class BaseNestedSet extends BaseActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Configure additional behaviors
	 */
	public function behaviors()
	{
		return array_merge(
				array(
						'nestedSet' => array(
								'class'=>'ext.behaviors.NestedSetBehavior',
								'hasManyRoots'	=>	TRUE,
								'leftAttribute'=>'lft',
								'rightAttribute'=>'rgt',
								'levelAttribute'=>'level',
						),
				),
				parent::behaviors()
		);
	}

	/**
	 * Create the table if needed
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'root'	=>	'int',
				'lft'	=>	'int',
				'rgt'	=>	'int',
				'level'	=>	'int',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createIndex('pos', $this->tableName(), 'root,lft,rgt,level')
		)->execute();
	}

}
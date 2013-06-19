<?php

class Authassignment extends BaseActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName(){
		return '{{authassignment}}';
	}

	public function relations(){
		return array(
			'authitems' => array(self::HAS_MANY, 'Authitem', 'itemname'),
		);
	}

	protected function createTable(){
		$columns = array (
		  'itemname' => 'string',
		  'userid' => 'int',
		  'bizrule' => 'string',
		  'data' => 'string',
		);
		try {
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('itemname_userid', $this->tableName(), 'itemname,userid')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}

		// Relation to user
		try {
			$ref = new Authitem();
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->addForeignKey('assigned', $this->tableName(), 'itemname', $ref->tableName(), 'name')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
		// INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES ('Admin', '1', NULL, 'N;');
		$this->refreshMetaData();
		/* Create default Authitem */
		$this->setAttributes(array(
				'itemname' => 'Admin',
				'userid' => 1,
				'data' => 'N;'
		));
		$this->setIsNewRecord(TRUE);
		$this->save();
	}
}

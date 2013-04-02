<?php

class Authitem extends BaseActiveRecord
{
	public function connectionId(){
		return Yii::app()->hasComponent('rightsDb')?'rightsDb':'db';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName(){
		return '{{authitem}}';
	}


	public function relations()
	{
		return array(
			'users' => array(self::MANY_MANY, 'Users', 'authassignment(itemname, userid)'),
			'children' => array(self::HAS_MANY, 'Authitemchild', 'parent'),
			'parent' => array(self::HAS_MANY, 'Authitemchild', 'child'),
		);
	}

	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('users, authassignments', 'safe', 'on' => 'insert,update'),
		));
	}


	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'users' => Yii::t('rights', "Users"),
		));
	}

	protected function createTable(){
		$columns = array (
		  'name' => 'string',
		  'type' => 'integer',
		  'description' => 'string',
		  'bizrule' => 'string',
		  'data' => 'string',
		);
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->addPrimaryKey('name', $this->tableName(), 'name')
		)->execute();
		$this->refreshMetaData();
		/* Create default Authitem
		 * INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES ('Admin', 2, NULL, NULL, 'N;')
		*/
		$this->setAttributes(array(
				'name' => 'Admin',
				'type' => CAuthItem::TYPE_ROLE,
				'description' => 'Administration Role',
				'data' => 'N;'
		));
		$this->setIsNewRecord(TRUE);
		$this->save();
	}

	/* Getter and Setter for bizrule column */
	public function getBizRule(){
		return $this->bizrule;
	}
	public function setBizRule($val){
		$this->bizrule = $val;
	}
}

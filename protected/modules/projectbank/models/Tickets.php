<?php
/*
 * Use this file to create models for this module
 */
class Tickets extends BaseActiveRecord
{
	public function connectionId(){
		return Yii::app()->hasComponent('projectbankDb')?'projectbankDb':'db';
	}

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{tickets}}';
	}
	
	public function relations(){
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'author'),
			'project' => array(self::BELONGS_TO, 'Projects', 'project_id'),	
		);
	}
	
	protected function createTable(){
		$columns = array (
				'id'	=>	'pk',
				'title' => 	'string',
				'body' 	=> 	'text',
				'createtime'	=>	'int',
				'updatetime'	=>	'int',
				'author'		=>	'int',
				'project_id'	=>	'int',
				// ENestedSet Behavior
				'root'	=>	'int',
				'lft'	=>	'int',
				'rgt'	=>	'int',
				'level'	=>	'int',
		);
		try {
			$this->getDbConnection()->createCommand(
					$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
		$this->refreshMetaData();
	}
	
	
	public function defaultScope(){
		return array(
			'order' => 'updatetime DESC',
		);
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
								'hasManyRoots'		=>	TRUE,
								'leftAttribute'		=>	'lft',
								'rightAttribute'	=>	'rgt',
								'levelAttribute'	=>	'level',
						),
				),
				parent::behaviors()
		);
	}
	
	protected function beforeValidate() {
		$this->updatetime = time();
		if ($this->isNewRecord)
			$this->createtime = time();
		if (Yii::app()->user)
			$this->author = Yii::app()->user->id;
		return parent::beforeValidate();
	}
	
	public static function getOptions($rootNode = NULL){
		$output = array();
		if (is_null($rootNode)) {
			$rootNodes = self::model()->roots()->findAll();
			foreach ($rootNodes as $rootNode){
				$output += self::getOptions($rootNode);
			}
		} elseif ($rootNode instanceof Tickets){
			$output[$rootNode->id] = str_repeat('-', $rootNode->level) . $rootNode->title;
			$childNodes = $rootNode->children()->findAll();
			foreach ($childNodes as $child){
				$output += self::getOptions($child);
			}
		} elseif (is_scalar($rootNode)){
			$rootNode = Tickets::model()->findByPk($rootNode);
			if ($rootNode)
				$output = self::getOptions($rootNode);
		}
		return $output;
	}
}
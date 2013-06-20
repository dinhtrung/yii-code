<?php
class MessageSource extends BaseActiveRecord{

    public $language;

	static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function connectionId(){
		return Yii::app()->hasComponent('translateDb')?'translateDb':'db';
	}

	function tableName(){
		return '{{sourcemessage}}';
	}

	/*
	 * CREATE TABLE SourceMessage
	(
			id INTEGER PRIMARY KEY,
			category VARCHAR(32),
			message TEXT
	);
	*/
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'category'	=>	'string',
				'message'	=>	'text',
		);
		try {
			$this->getDbConnection()->createCommand(
					Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
	}


	function relations(){
		return array(
				'mt'=>array(self::HAS_MANY,'Message','id','joinType'=>'inner join'),
		);
	}
}
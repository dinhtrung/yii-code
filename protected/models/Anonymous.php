<?php

class Anonymous extends EActiveRecord
{
	public $table = '';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ucb the static model class
	 */
	public static function model($className=__CLASS__)
	{
		$model = parent::model($className);
		$model->refreshMetaData();
		return $model;
	}
	
	
	public function __construct($scenario='insert'){
		if($scenario===null) // internally used by populateRecord() and model()
			return;
		$this->setScenario($scenario);
		$this->setIsNewRecord(true);
		$this->_attributes=$this->getMetaData()->attributeDefaults;
	
		$this->init();
		$this->attachBehaviors($this->behaviors());
		$this->afterConstruct();
	}
	
	protected function instantiate($attributes) {
		$model = new Anonymous(null);
		$model->table = $this->table;
		return $model;
	}
	
	
	public function getClassName(){
		return $this->table;
	}
	
	public static function getModel($table = NULL) {
		$model = new Anonymous(null);
		$model->table = $table;
		return Anonymous::model($model); // Register the instance
	}
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{' . $this->table. '}}';
	}
	
	/**
	 * Return the default dataProvider for searching
	 */
	public function search($criteria = NULL){
		if (is_null($criteria)) $criteria=new CDbCriteria;
		$this->refreshMetaData();
		foreach ($this->tableSchema->columns as $col){
			if ($col->type == 'string') $criteria->compare($col->name, $this->{$col->name}, TRUE);
			else $criteria->compare($col->name, $this->{$col->name});
		}
		return new EActiveDataProvider($this->getClassName(), array(
				'criteria'=>$criteria,
		));
	}
	/*
	 * Return rules based on Gii
	*/
	function rules() {
		$rules=array();
		$required=array();
		$integers=array();
		$numerical=array();
		$length=array();
		$safe=array();
		foreach($this->tableSchema->columns as $column)
		{
			if($column->autoIncrement)
				continue;
			$r=!$column->allowNull && $column->defaultValue===null;
			if($r)
				$required[]=$column->name;
			if($column->type==='integer')
				$integers[]=$column->name;
			else if($column->type==='double')
				$numerical[]=$column->name;
			else if($column->type==='string' && $column->size>0)
				$length[$column->size][]=$column->name;
			else if(!$column->isPrimaryKey && !$r)
				$safe[]=$column->name;
		}
		if($required!==array())
			$rules[]=array(implode(', ',$required), 'required');
		if($integers!==array())
			$rules[]=array(implode(', ',$integers), 'numerical', 'integerOnly'=>true);
		if($numerical!==array())
			$rules[]=array(implode(', ',$numerical), 'numerical');
		if($length!==array())
		{
			foreach($length as $len=>$cols)
				$rules[]=array(implode(', ',$cols), 'length', 'max'=>$len);
		}
		if($safe!==array())
			$rules[]=array(implode(', ',$safe), 'safe');
	
		// Relation Attribute must be set to safe to use CArAdvancedRelationBehavior
		$rules[]=array(implode(', ',array_keys($this->relations())), 'safe', 'on' => 'insert,update');
		return $rules;
	}
	
	public function getAttributeLabel($attribute){
		return Yii::t('app', $attribute);
	}
}

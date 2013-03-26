<?php
class BaseActiveRecord extends MultiActiveRecord {
	public $dbtable;
	protected $_attributeLabels;

	public function __construct($scenario = 'insert'){
		try {
			return parent::__construct($scenario);
		} catch (CDbException $e){
			if (! $this->createTable()) throw $e;
			return parent::__construct($scenario);
		}
	}

	public function tableName(){
		if (empty($this->dbtable))
			$this->dbtable = parent::tableName();
		return $this->dbtable;
	}
	/**
	 * Store old attributes for current Model
	 * @var array
	 */
	private $_oldAttributes = array();
	public function behaviors()
	{
		return array_merge(parent::behaviors(), array(
				// Automatically save relationships
				'AdvancedArBehavior' => array(
			       	 'class' => 'ext.behaviors.CAdvancedArBehavior'
				),
				// 	Update  Timestamp for columns named `updatetime` and `createtime`
				'TimestampBehavior' => array(
					'class' => 'TimestampBehavior'
				),
				// Remember Filter Behavior
				'RememberFiltersBehavior' => array(
	               'class' 					=> 'ext.behaviors.ERememberFiltersBehavior',
	           ),
	           'DataProviderBehavior'=>array(
		            'class'=>'ext.behaviors.DynamicDataProviderBehavior',
		        ),
           )
		);
	}

	public function  __toString() {
		return $this->id;
	}

	protected function afterFind()
    {
        $this->setOldAttributes($this->getAttributes());
        return parent::afterFind();
    }

	protected function beforeSave(){
	    if (!parent::beforeSave()) return false;
	    return TRUE;
	}
	protected function afterSave(){
		// FIXME: Guess up the category name...
		try {
			Yii::app()->user->setFlash('success', Yii::t('app', 'Data saved!'));
		} catch (CException $e){}
	    if (!parent::afterSave()) return false;
	    return TRUE;
	}


	protected function afterDelete(){
		// FIXME: Guess up the category name...
		try {
			Yii::app()->user->setFlash('success', Yii::t('app', 'Data deleted!'));
		} catch (CException $e){}
	    if (!parent::afterSave()) return false;
	    return TRUE;
	}

	/*
	 * On application component configuration, specify a component named '[moduleId]db' that is a CDbConnection class for access this properties directly
	 */
	public function connectionId(){
		if (!is_null(Yii::app()->getController()) && ! is_null(Yii::app()->getController()->getModule())){
			$moduledb = ((string) Yii::app()->getController()->getModule()->getId()) . 'db';
			try {
				if (Yii::app()->$moduledb instanceof CDbConnection)
				return $moduledb;
			} catch (Exception $e) {
		      	return 'db';
			}
		}
      	return 'db';
   }

    public function getOldAttribute($name)
    {
        return array_key_exists($name, $this->_oldAttributes)?$this->_oldAttributes[$name]:NULL;
    }
    public function getOldAttributes()
    {
        return $this->_oldAttributes;
    }

    public function setOldAttributes($value)
    {
        $this->_oldAttributes=$value;
    }

    /**
     * Return the attribute Labels
     */
    public function attributeLabels(){
    	if (! empty($this->_attributeLabels)) return $this->_attributeLabels;
    	else {
    		try {
    			$moduleId = Yii::app()->getController()->getModule()->getId();
    		} catch (CException $e){
    			$moduleId = 'app';
    		}
    		foreach ($this->tableSchema->columns as $col){
    			$this->_attributeLabels[$col->name] = Yii::t(strtolower($moduleId), ucfirst($col->name));
    		}
    		return $this->_attributeLabels;
    	}
    }

    /**
     * Return the default dataProvider for searching
     */
    public function search($criteria = NULL){
    	if (is_null($criteria)) $criteria=new CDbCriteria;
    	foreach ($this->tableSchema->columns as $col){
    		if ($col->type == 'string') $criteria->compare($col->name, $this->{$col->name}, TRUE);
    		else $criteria->compare($col->name, $this->{$col->name});
    	}
    	return new CActiveDataProvider(get_class($this), array(
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

    	return $rules;
    }


    /**
     * Create the table if needed
     */
    protected function createTable(){
    	return FALSE;
    }
}

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

	public static function model($className = __CLASS__){
		return parent::model($className);
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
// 				'TimestampBehavior' => array(
// 					'class' => 'TimestampBehavior'
// 				),
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
		if (Yii::app() instanceof CWebApplication){
			return CVarDumper::dumpAsString($this->getAttributes(), 3, TRUE);
		} else {
			return CVarDumper::dumpAsString($this->getAttributes(), 3, FALSE);
		}
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
   			$moduleId = ($module = Yii::app()->getController()->getModule())?$module->getId():'app';
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

    	// Relation Attribute must be set to safe to use CArAdvancedRelationBehavior
    	$rules[]=array(implode(', ',array_keys($this->relations)), 'safe', 'on' => 'insert,update');
    	return $rules;
    }


    /**
     * Create the table if needed
     *
    pk: an auto-incremental primary key type, will be converted into "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY"
    string: string type, will be converted into "varchar(255)"
    text: a long string type, will be converted into "text"
    integer: integer type, will be converted into "int(11)"
    boolean: boolean type, will be converted into "tinyint(1)"
    float: float number type, will be converted into "float"
    decimal: decimal number type, will be converted into "decimal"
    datetime: datetime type, will be converted into "datetime"
    timestamp: timestamp type, will be converted into "timestamp"
    time: time type, will be converted into "time"
    date: date type, will be converted into "date"
    binary: binary data type, will be converted into "blob"

     */
    protected function createTable(){
    	/*
    	 * $columns = array(
				'id'	=>	'pk',
				'title'	=>	'string',
				'body'	=>	'text',
				'status'	=>	'boolean',
				'comment_cnt'	=>	'int',
				'rating'		=>	'float',
		);
		$this->getDbConnection()->createCommand(
			Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			Yii::app()->getDb()->getSchema()->createIndex('title', $this->tableName(), 'time')
		)->execute();
    	 */
    	return FALSE;
    }
}

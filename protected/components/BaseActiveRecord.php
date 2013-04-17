<?php
class BaseActiveRecord extends MultiActiveRecord {
	public $dbtable;
	protected $_attributeLabels;
	public static $relations = array();

	public function __construct($scenario = 'insert'){
		try {
			return parent::__construct($scenario);
		} catch (CDbException $e){
			if (! $this->createTable()) throw $e;
			$this->refreshMetaData();
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
    	return new CActiveDataProvider(($this->className), array(
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
			Yii::app()->getDb()->getSchema()->createTable($this->tableName()(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			Yii::app()->getDb()->getSchema()->createIndex('title', $this->tableName()(), 'time')
		)->execute();
    	 */
    	return FALSE;
    }


    public function relations(){
    	if (empty(self::$relations)) $this->generateRelations();
    	$className = $this->generateClassName($this->tableName());
    	if (array_key_exists($className, self::$relations))
    		return self::$relations[$className];
    	else return array();
    }

    public function generateRelations()
    {
    	foreach($this->getDbConnection()->schema->getTables() as $table)
    	{
    		if($this->getDbConnection()->tablePrefix!='' && strpos($table->name,$this->getDbConnection()->tablePrefix)!==0)
    			continue;
    		$tableName=$table->name;

    		if ($this->isRelationTable($table))
    		{
    			$pks=$table->primaryKey;
    			$fks=$table->foreignKeys;

    			$table0=$fks[$pks[0]][0];
    			$table1=$fks[$pks[1]][0];
    			$className0=$this->generateClassName($table0);
    			$className1=$this->generateClassName($table1);

    			$unprefixedTableName=$this->removePrefix($tableName);

    			$relationName=$this->generateRelationName($table0, $table1, true);
    			self::$relations[$className0][$relationName]=array(self::MANY_MANY, $className1, "$unprefixedTableName($pks[0], $pks[1])");

    			$relationName=$this->generateRelationName($table1, $table0, true);

    			$i=1;
    			$rawName=$relationName;
    			while(isset(self::$relations[$className1][$relationName]))
    				$relationName=$rawName.$i++;

    			self::$relations[$className1][$relationName]=array(self::MANY_MANY, $className0, "$unprefixedTableName($pks[1], $pks[0])");
    		}
    		else
    		{
    			$className=$this->generateClassName($tableName);
    			foreach ($table->foreignKeys as $fkName => $fkEntry)
    			{
    				// Put table and key name in variables for easier reading
    				$refTable=$fkEntry[0]; // Table name that current fk references to
    				$refKey=$fkEntry[1];   // Key in that table being referenced
    				$refClassName=$this->generateClassName($refTable);

    				// Add relation for this table
    				$relationName=$this->generateRelationName($tableName, $fkName, false);
    				self::$relations[$className][$relationName]=array(self::BELONGS_TO, $refClassName, $fkName);

    				// Add relation for the referenced table
    				$relationType=$table->primaryKey === $fkName ? self::HAS_ONE : self::HAS_MANY;
    				$relationName=$this->generateRelationName($refTable, $this->removePrefix($tableName,false), $relationType==='HAS_MANY');
    				$i=1;
    				$rawName=$relationName;
    				while(isset(self::$relations[$refClassName][$relationName]))
    					$relationName=$rawName.($i++);
    				self::$relations[$refClassName][$relationName]=array($relationType, $className, $fkName);
    			}
    		}
    	}
    	return self::$relations;
    }

    public function removePrefix($tableName,$addBrackets=true)
    {
    	if($addBrackets && $this->getDbConnection()->tablePrefix=='')
    		return $tableName;
    	$prefix=$this->getDbConnection()->tablePrefix!='' ? $this->getDbConnection()->tablePrefix : $this->getDbConnection()->tablePrefix;
    	if($prefix!='')
    	{
    		if($addBrackets && $this->getDbConnection()->tablePrefix!='')
    		{
    			$prefix=$this->getDbConnection()->tablePrefix;
    			$lb='{{';
    			$rb='}}';
    		}
    		else
    			$lb=$rb='';
    		if(($pos=strrpos($tableName,'.'))!==false)
    		{
    			$schema=substr($tableName,0,$pos);
    			$name=substr($tableName,$pos+1);
    			if(strpos($name,$prefix)===0)
    				return $schema.'.'.$lb.substr($name,strlen($prefix)).$rb;
    		}
    		elseif(strpos($tableName,$prefix)===0)
    		return $lb.substr($tableName,strlen($prefix)).$rb;
    	}
    	return $tableName;
    }

    /**
     * Checks if the given table is a "many to many" pivot table.
     * Their PK has 2 fields, and both of those fields are also FK to other separate tables.
     * @param CDbTableSchema table to inspect
     * @return boolean true if table matches description of helpter table.
     */
    protected function isRelationTable($table)
    {
    	$pk=$table->primaryKey;
    	return (count($pk) === 2 // we want 2 columns
    			&& isset($table->foreignKeys[$pk[0]]) // pk column 1 is also a foreign key
    			&& isset($table->foreignKeys[$pk[1]]) // pk column 2 is also a foriegn key
    			&& $table->foreignKeys[$pk[0]][0] !== $table->foreignKeys[$pk[1]][0]); // and the foreign keys point different tables
    }

    protected function generateClassName($tableName)
    {
    	if($this->tableName()===$tableName || ($pos=strrpos($this->tableName(),'.'))!==false && substr($this->tableName(),$pos+1)===$tableName)
    		return get_class($this);

    	$tableName=$this->removePrefix($tableName,false);
    	$className='';
    	foreach(explode('_',$tableName) as $name)
    	{
    		if($name!=='')
    			$className.=ucfirst($name);
    	}
    	return $className;
    }

    /**
     * Generate a name for use as a relation name (inside relations() function in a model).
     * @param string the name of the table to hold the relation
     * @param string the foreign key name
     * @param boolean whether the relation would contain multiple objects
     * @return string the relation name
     */
    protected function generateRelationName($tableName, $fkName, $multiple)
    {
    	if(strcasecmp(substr($fkName,-2),'id')===0 && strcasecmp($fkName,'id'))
    		$relationName=rtrim(substr($fkName, 0, -2),'_');
    	else
    		$relationName=$fkName;
    	$relationName[0]=strtolower($relationName);

//     	if($multiple)
//     		$relationName=$this->pluralize($relationName);

    	$names=preg_split('/_+/',$relationName,-1,PREG_SPLIT_NO_EMPTY);
    	if(empty($names)) return $relationName;  // unlikely
    	for($name=$names[0], $i=1;$i<count($names);++$i)
    		$name.=ucfirst($names[$i]);

    	$rawName=$name;
    	$table=$this->getDbConnection()->schema->getTable($tableName);
    	$i=0;
    	while(isset($table->columns[$name]))
    		$name=$rawName.($i++);

    	return $name;
    }
}

<?php
/**
 * SchemaObserver class file.
 *
 * Inspect a CDbSchema component to get all tables metadata, relations and generate CForm elements for them.
 *
 * @author Nguyen Dinh Trung <nguyendinhtrung141@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

class SchemaObserver extends CComponent
{
	public $dbComponent;
	public static $relations = array();	// List of all available relation ship for this schema.
	public static $forms = array();		// All CForm array generated for this schema.

	/**
     * Logs a message.
     *
     * @param string $message Message to be logged
     * @param string $level Level of the message (e.g. 'trace', 'warning',
     * 'error', 'info', see CLogger constants definitions)
     */
    public static function log($message, $level='error')
    {
        Yii::log($message, $level, __CLASS__);
    }

    /**
     * Dumps a variable or the object itself in terms of a string.
     *
     * @param mixed variable to be dumped
     */
    protected function dump($var='dump-the-object',$highlight=true)
    {
        if ($var === 'dump-the-object') {
            return CVarDumper::dumpAsString($this,$depth=15,$highlight);
        } else {
            return CVarDumper::dumpAsString($var,$depth=15,$highlight);
        }
    }

    /*
     * Initialize the dbComponent schema
     */
    public function init(){
		$this->generateRelations();
		$this->generateCForms();
    }

    public function getDbConnection(){
    	return ($this->dbComponent instanceof CDbConnection)?$this->dbComponent:Yii::app()->getDb();
    }

    public function relations($className){
    	if (empty(self::$relations)) $this->generateRelations();
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
    			self::$relations[$className0][$relationName]=array(CActiveRecord::MANY_MANY, $className1, "$unprefixedTableName($pks[0], $pks[1])");

    			$relationName=$this->generateRelationName($table1, $table0, true);

    			$i=1;
    			$rawName=$relationName;
    			while(isset(self::$relations[$className1][$relationName]))
    				$relationName=$rawName.$i++;

    			self::$relations[$className1][$relationName]=array(CActiveRecord::MANY_MANY, $className0, "$unprefixedTableName($pks[1], $pks[0])");
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
    				self::$relations[$className][$relationName]=array(CActiveRecord::BELONGS_TO, $refClassName, $fkName);

    				// Add relation for the referenced table
    				$relationType=$table->primaryKey === $fkName ? CActiveRecord::HAS_ONE : CActiveRecord::HAS_MANY;
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

    /**
     * Remove table Prefix
     * @param string $tableName
     * @param boolean $addBrackets
     * @return string The table name without prefix
     */
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

    public function generateCForms(){
    	foreach($this->getDbConnection()->schema->getTables() as $table)
    	{
    		if($this->getDbConnection()->tablePrefix!='' && strpos($table->name,$this->getDbConnection()->tablePrefix)!==0)
    			continue;
    		$tableName=$table->name;
   			$className=$this->generateClassName($tableName);
   			self::$forms[$className] = array();
   			foreach ($table->columns as $col){
   				if (!($col instanceof CDbColumnSchema)) continue;
   				// No need to inspect auto increment value
   				if ($col->autoIncrement) continue;
   				$desc = ($col->comment)?($col->comment):"Description for $className - {$col->name}";
   				switch ($col->type){

   					// Numeric values
   					case 'integer':
   					case 'float':
   					case 'double':
	   					self::$forms[$className][$col->name] = array(
	   						'type'	=>	'number',
	   						'hint'	=>	Yii::t('hint', $desc),
	   					);
   						break;
   					// Default
   					default:
	   					self::$forms[$className][$col->name] = array(
	   						'type'	=>	'text',
	   						'hint'	=>	Yii::t('hint', $desc),
	   					);
   						break;
   				}
   				if ($col->dbType == 'text')
   					self::$forms[$className][$col->name]['type'] = 'text';
   				if ($col->dbType == 'date')
   					self::$forms[$className][$col->name]['type'] = 'date';
   				if ($col->dbType == 'datetime')
   					self::$forms[$className][$col->name]['type'] = 'date';
   				if ($col->type == 'integer' && $col->size == 1)
   					self::$forms[$className][$col->name]['type'] = 'checkbox';
   			}
    	}
    	return self::$forms;

    }

}

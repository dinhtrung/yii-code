<?php

class QuerybuilderModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'querybuilder.models.*',
			'querybuilder.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}



	protected function removePrefix($tableName,$addBrackets=true)
	{
		if($addBrackets && Yii::app()->db->tablePrefix=='')
			return $tableName;
		$prefix=Yii::app()->getDb()->tablePrefix!='' ? Yii::app()->getDb()->tablePrefix : Yii::app()->db->tablePrefix;
		if($prefix!='')
		{
			if($addBrackets && Yii::app()->db->tablePrefix!='')
			{
				$prefix=Yii::app()->db->tablePrefix;
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

	public function generateRelations()
	{
		$relations=array();
		foreach(Yii::app()->db->schema->getTables() as $table)
		{
			if(Yii::app()->getDb()->tablePrefix!='' && strpos($table->name,Yii::app()->getDb()->tablePrefix)!==0)
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
				$relations[$className0][$relationName]=array(CActiveRecord::MANY_MANY, $className1, "$unprefixedTableName($pks[0], $pks[1])");

				$relationName=$this->generateRelationName($table1, $table0, true);

				$i=1;
				$rawName=$relationName;
				while(isset($relations[$className1][$relationName]))
					$relationName=$rawName.$i++;

				$relations[$className1][$relationName]=array(CActiveRecord::MANY_MANY, $className0, "$unprefixedTableName($pks[1], $pks[0])");
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
					$relations[$className][$relationName]=array(CActiveRecord::BELONGS_TO, $refClassName, $fkName);

					// Add relation for the referenced table
					$relationType=$table->primaryKey === $fkName ? CActiveRecord::HAS_ONE : CActiveRecord::HAS_MANY;
					$relationName=$this->generateRelationName($refTable, $this->removePrefix($tableName,false), $relationType==='HAS_MANY');
					$i=1;
					$rawName=$relationName;
					while(isset($relations[$refClassName][$relationName]))
						$relationName=$rawName.($i++);
					$relations[$refClassName][$relationName]=array($relationType, $className, $fkName);
				}
			}
		}
		return $relations;
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
		return $tableName;
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

		if($multiple)
			$relationName=$this->pluralize($relationName);

		$names=preg_split('/_+/',$relationName,-1,PREG_SPLIT_NO_EMPTY);
		if(empty($names)) return $relationName;  // unlikely
		for($name=$names[0], $i=1;$i<count($names);++$i)
			$name.=ucfirst($names[$i]);

		$rawName=$name;
		$table=Yii::app()->db->schema->getTable($tableName);
		$i=0;
		while(isset($table->columns[$name]))
			$name=$rawName.($i++);

		return $name;
	}

	/**
	 * Converts a word to its plural form.
	 * Note that this is for English only!
	 * For example, 'apple' will become 'apples', and 'child' will become 'children'.
	 * @param string $name the word to be pluralized
	 * @return string the pluralized word
	 */
	public function pluralize($name)
	{
		$rules=array(
				'/(m)ove$/i' => '\1oves',
				'/(f)oot$/i' => '\1eet',
				'/(c)hild$/i' => '\1hildren',
				'/(h)uman$/i' => '\1umans',
				'/(m)an$/i' => '\1en',
				'/(t)ooth$/i' => '\1eeth',
				'/(p)erson$/i' => '\1eople',
				'/([m|l])ouse$/i' => '\1ice',
				'/(x|ch|ss|sh|us|as|is|os)$/i' => '\1es',
				'/([^aeiouy]|qu)y$/i' => '\1ies',
				'/(?:([^f])fe|([lr])f)$/i' => '\1\2ves',
				'/(shea|lea|loa|thie)f$/i' => '\1ves',
				'/([ti])um$/i' => '\1a',
				'/(tomat|potat|ech|her|vet)o$/i' => '\1oes',
				'/(bu)s$/i' => '\1ses',
				'/(ax|test)is$/i' => '\1es',
				'/s$/' => 's',
		);
		foreach($rules as $rule=>$replacement)
		{
			if(preg_match($rule,$name))
				return preg_replace($rule,$replacement,$name);
		}
		return $name.'s';
	}

}

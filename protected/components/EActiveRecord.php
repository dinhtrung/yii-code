<?php
class EActiveRecord extends CActiveRecord {

	private static $_models=array();			// class name => model
	
	private $_md;								// meta data
	private $_new=false;						// whether this instance is new or not
	private $_attributes=array();				// attribute name => attribute value
	private $_related=array();					// attribute name => related objects
	private $_c;								// query criteria (used by finder only)
	private $_pk;								// old primary key value
	private $_alias='t';						// the table alias being used for query
	
	public function getClassName() {
		return get_class($this);
	}
	
	public function getRelated($name,$refresh=false,$params=array())
	{
		if(!$refresh && $params===array() && (isset($this->_related[$name]) || array_key_exists($name,$this->_related)))
			return $this->_related[$name];
	
		$md=$this->getMetaData();
		if(!isset($md->relations[$name]))
			throw new CDbException(Yii::t('yii','{class} does not have relation "{name}".',
					array('{class}'=>$this->getClassName(), '{name}'=>$name)));
	
		Yii::trace('lazy loading '.$this->getClassName().'.'.$name,'system.db.ar.CActiveRecord');
		$relation=$md->relations[$name];
		if($this->getIsNewRecord() && !$refresh && ($relation instanceof CHasOneRelation || $relation instanceof CHasManyRelation))
			return $relation instanceof CHasOneRelation ? null : array();
	
		if($params!==array()) // dynamic query
		{
			$exists=isset($this->_related[$name]) || array_key_exists($name,$this->_related);
			if($exists)
				$save=$this->_related[$name];
	
			if($params instanceof CDbCriteria)
				$params = $params->toArray();
	
			$r=array($name=>$params);
		}
		else
			$r=$name;
		unset($this->_related[$name]);
	
		$finder=new CActiveFinder($this,$r);
		$finder->lazyFind($this);
	
		if(!isset($this->_related[$name]))
		{
			if($relation instanceof CHasManyRelation)
				$this->_related[$name]=array();
			elseif($relation instanceof CStatRelation)
			$this->_related[$name]=$relation->defaultValue;
			else
				$this->_related[$name]=null;
		}
	
		if($params!==array())
		{
			$results=$this->_related[$name];
			if($exists)
				$this->_related[$name]=$save;
			else
				unset($this->_related[$name]);
			return $results;
		}
		else
			return $this->_related[$name];
	}
	
	public static function model($className=__CLASS__)
	{
		if(is_string($className) && isset(self::$_models[$className]))
			return self::$_models[$className];
		else if(($className instanceof CActiveRecord) && isset(self::$_models[$className->getClassName()]))
			return self::$_models[$className->getClassName()];
		else
		{
			if($className instanceof CActiveRecord) {
				$model = $className;
				$className = $model->getClassName();
			} else {
				$model=new $className(null);
			}
			self::$_models[$className]=$model;
			$model->attachBehaviors($model->behaviors());
			return $model;
		}
	}
	
	
	/**
	 * Returns the meta-data for this AR
	 * @return CActiveRecordMetaData the meta for this AR class.
	 */
	public function getMetaData()
	{
		if($this->_md!==null)
			return $this->_md;
		elseif ($this->_md=self::model($this->getClassName())->_md)
			return $this->_md;
		else {
			$this->refreshMetaData();
			return $this->getMetaData();
		}
	}
	
	public function refreshMetaData()
	{
		$finder=self::model($this->getClassName());
		$finder->_md=new CActiveRecordMetaData($finder);
		if($this!==$finder)
			$this->_md=$finder->_md;
	}
	public function tableName()
	{
		return $this->getClassName();
	}
	
	protected function instantiate($attributes)
	{
		$class=$this->getClassName();
		$model=new $class(null);
		return $model;
	}
	
}
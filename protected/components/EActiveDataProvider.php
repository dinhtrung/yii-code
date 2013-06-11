<?php
class EActiveDataProvider extends CActiveDataProvider {

	public function __construct($modelClass,$config=array())
	{
		if(is_string($modelClass))
		{
			$this->modelClass=$modelClass;
			$this->model=EActiveRecord::model($this->modelClass);
		}
		elseif($modelClass instanceof EActiveRecord)
		{
			$this->modelClass=$modelClass->getClassName();
			$this->model=$modelClass;
		} 
		elseif($modelClass instanceof CActiveRecord)
     	{
			$this->modelClass=get_class($modelClass);
       		$this->model=$modelClass;
     	}
		$this->setId($this->modelClass);
		foreach($config as $key=>$value)
			$this->$key=$value;
	}
	
	public function getSort($className='ESort')
	{
		if(($sort=parent::getSort('ESort'))!==false)
			$sort->modelClass=$this->modelClass;
		return $sort;
	}
}
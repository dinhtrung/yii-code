<?php
class ESort extends CSort {
	
	public function resolveAttribute($attribute)
	{
		if($this->attributes!==array())
			$attributes=$this->attributes;
		elseif($this->modelClass!==null)
		$attributes=EActiveRecord::model($this->modelClass)->attributeNames();
		else
			return false;
		foreach($attributes as $name=>$definition)
		{
			if(is_string($name))
			{
				if($name===$attribute)
					return $definition;
			}
			elseif($definition==='*')
			{
				if($this->modelClass!==null && EActiveRecord::model($this->modelClass)->hasAttribute($attribute))
					return $attribute;
			}
			elseif($definition===$attribute)
			return $attribute;
		}
		return false;
	}
	
	public function resolveLabel($attribute)
	{
		$definition=$this->resolveAttribute($attribute);
		if(is_array($definition))
		{
			if(isset($definition['label']))
				return $definition['label'];
		}
		elseif(is_string($definition))
		$attribute=$definition;
		if($this->modelClass!==null)
			return EActiveRecord::model($this->modelClass)->getAttributeLabel($attribute);
		else
			return $attribute;
	}
	
	public function getOrderBy($criteria=null)
	{
		$directions=$this->getDirections();
		if(empty($directions))
			return is_string($this->defaultOrder) ? $this->defaultOrder : '';
		else
		{
			if($this->modelClass!==null)
				$schema=EActiveRecord::model($this->modelClass)->getDbConnection()->getSchema();
			$orders=array();
			foreach($directions as $attribute=>$descending)
			{
				$definition=$this->resolveAttribute($attribute);
				if(is_array($definition))
				{
					if($descending)
						$orders[]=isset($definition['desc']) ? $definition['desc'] : $attribute.' DESC';
					else
						$orders[]=isset($definition['asc']) ? $definition['asc'] : $attribute;
				}
				elseif($definition!==false)
				{
					$attribute=$definition;
					if(isset($schema))
					{
						if(($pos=strpos($attribute,'.'))!==false)
							$attribute=$schema->quoteTableName(substr($attribute,0,$pos)).'.'.$schema->quoteColumnName(substr($attribute,$pos+1));
						else
							$attribute=($criteria===null || $criteria->alias===null ? EActiveRecord::model($this->modelClass)->getTableAlias(true) : $schema->quoteTableName($criteria->alias)).'.'.$schema->quoteColumnName($attribute);
					}
					$orders[]=$descending?$attribute.' DESC':$attribute;
				}
			}
			return implode(', ',$orders);
		}
	}
}
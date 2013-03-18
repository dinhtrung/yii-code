<?php
/**
 * @desc This behavior lets a model return CActiveDataProviders for its relations
 *
 * @author Asgaroth[dot]Belem[at]gmail[dot]com
 * @version 0.2
 * @since Jan 13, 2011 - 5:40:48 PM
 */
class DynamicDataProviderBehavior extends CActiveRecordBehavior {
	/**
	 *
	 * Returns a CActiveDataProvider of a relation
	 * @param string $relation the relation
	 * @param CDbCriteria $criteria to add extra filtering if needed
	 * @param mixed $sort CSort or array configuration for the CActiveDataProvider::$sort property
	 * @param mixed $pagination CPagination or array configuration for the CActiveDataProvider::$pagination property
	 */
	public function getDataProvider($relation, $criteria = null, $sort = null, $pagination = null) {

		$relations = $this->owner->relations();
		if(!isset($relations[$relation])){
			throw new CDbException(Yii::t('yii','{class} does not have relation "{name}".',
				array('{class}'=>get_class($this->owner), '{name}'=>$name)));
		}
		$config = array();

		if($criteria === null){
			$criteria=new CDbCriteria;
		}
		$criteria->compare($relations[$relation][2], $this->owner->{$this->owner->getTableSchema()->primaryKey});
		$config['criteria'] = $criteria;

		if($sort !== null){
			$config['sort'] = $sort;
		}
		if($pagination !== null){
			$config['pagination'] = $pagination;
		}
		return new CActiveDataProvider($relations[$relation][1], $config);
	}//getDataProvider
}

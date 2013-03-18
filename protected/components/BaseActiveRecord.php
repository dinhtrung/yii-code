<?php
abstract class BaseActiveRecord extends MultiActiveRecord {
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
	    if (!parent::afterSave()) return false;
	    return TRUE;
	}

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
}

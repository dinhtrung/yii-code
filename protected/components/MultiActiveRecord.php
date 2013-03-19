<?php
abstract class MultiActiveRecord extends CActiveRecord
{
    /**
     * @var CDbConnection the default database connection for all active record classes.
     * By default, this is the 'db' application component.
     * @see getDbConnection
     */
    public static $db;

    /**
     * Override some private variables
     */
    protected $_md;
    protected static $_models=array();
    /**
     * Returns the database connection used by active record.
     * By default, the "db" application component is used as the database connection.
     * If you override the method connectionId it will use this connection.
     *
     * @return CDbConnection the database connection used by active record.
     */
    public function getDbConnection()
    {
        $dbName=$this->connectionId();

        if(!isset(self::$db[$dbName])){
            if(Yii::app()->hasComponent($dbName) && (self::$db[$dbName]=Yii::app()->getComponent($dbName)) instanceof CDbConnection){
    			self::$db[$dbName]->setActive(true);
            }else
                throw new CDbException(Yii::t('yii','Active Record requires a "'.$dbName.'" CDbConnection application component.'));
        }

        return self::$db[$dbName];
    }
    /**
     * workaround to try the model's name, if not given
     * doesnt always work, and thats the reason its not included in the framework's core
     *
     * @param string $className
     * @return CModel
     */
    public static function model($className=__CLASS__){
        if($className===__CLASS__){
            if(version_compare(PHP_VERSION,'5.3',">"))
                $className=get_called_class();
            else
                throw new CException("You must define a static function 'model' in your models");
        }
        if(isset(self::$_models[$className]))
        	return self::$_models[$className];
        else
        {
        	$model=self::$_models[$className]=new $className(null);
        	$model->attachBehaviors($model->behaviors());
        	$model->_md=new ExtendedActiveRecordMetaData($model);
        	return $model;
        }
    }
    /**
     * try to guess the model's name, models should override this function to improve speed and better customization
     * it does the inverse process of gii's model creator
     *
     * @return string name of the class table
     */
    public function tableName(){
        $tableName=get_class($this);
        $tableName=strtolower(substr($tableName,0,1)).substr($tableName,1);
        $tableName=preg_replace_callback('/([A-Z])/',create_function('$matches','return "_".strtolower($matches[0]);'),$tableName);
        return $tableName;
    }
    /**
     * define which connection to use in the model, default to 'db'
     *
     * @return string
     */
    public function connectionId(){
        return 'db';
    }

	/**
	 * Returns the static model of the specified AR class.
	 * The model returned is a static instance of the AR class.
	 * It is provided for invoking class-level methods (something similar to static class methods.)
	 *
	 * EVERY derived AR class must override this method as follows,
	 * <pre>
	 * public static function model($className=__CLASS__)
	 * {
	 *     return parent::model($className);
	 * }
	 * </pre>
	 *
	 * @param string active record class name.
	 * @return CActiveRecord active record model instance.
	 */

	/**
	 * @return CActiveRecordMetaData the meta for this AR class.
	 */
	public function getMetaData()
	{
		if($this->_md!==null)
			return $this->_md;
		else
			return $this->_md=self::model(get_class($this))->_md;
	}
}

/**
 * ExtendedActiveRecordMetaData is extended from CActiveRecordMetaData.
 * It's modified to create tables that don't exist.
 */
class ExtendedActiveRecordMetaData Extends CActiveRecordMetaData
{
	/**
	 * Constructor.
	 * @param CActiveRecord the model instance
	 */
	public function __construct($model)
	{
		$tableName=$model->tableName();
		if(($table=$model->getDbConnection()->getSchema()->getTable($tableName))===null) {
			if (YII_DEBUG)
			{
				$command=$model->getDbConnection()->createCommand(
						$createTableQuery = Yii::app()->getDb()->getSchema()->createTable($tableName, array('id' => 'pk'))
					);;
				$command->execute();

				$model->getDbConnection()->getSchema()->refresh();
				$table=$model->getDbConnection()->getSchema()->getTable($tableName);
			}
			else
			{
				throw new CDbException(Yii::t('yii','The table "{table}" for active record class "{class}" cannot be found in the database.',
						array('{class}'=>get_class($model),'{table}'=>$tableName)));
			}
		}
		return parent::__construct($model);
	}
}

<?php
/*
 * Generic Query Builder ActiveRecord
 */
class GenericTable extends BaseActiveRecord
{
	public static $tableName = NULL;
	private static $_modelObjects=array();      // class name => model


	public static function model($tableName = __CLASS__)
  	{
  		self::$tableName = $tableName;
  		$res = parent::model('GenericTable');
  		$res->refreshMetaData();
  		self::$_modelObjects[$tableName] = $res;
  		return $res;
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{' . self::$tableName . '}}';
	}
}
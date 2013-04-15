<?php

/**
 * This is the model base class for the table "tags".
 *
 * Columns in table "tags" available as properties of the model:
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 *
 * There are no model relations.
 */
class Tags extends BaseActiveRecord{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* Initializes this model.
	*/
	public function init()
	{
		return parent::init();
	}
	/**
	* This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	* @return string representing the object
	*/
	public function __toString() {
		return (string) $this->name;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{tags}}';
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'name ASC',
		);
	}
	/**
	 * Suggests a list of existing tags matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function suggestTags($keyword,$limit=20)
	{
		$tags=$this->findAll(array(
			'condition'=>'name LIKE :keyword',
			'order'=>'frequency DESC, Name',
			'limit'=>$limit,
			'params'=>array(
				':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
			),
		));
		$names=array();
		foreach($tags as $tag)
			$names[]=$tag->name;
		return $names;
	}

	/**
	 * Create the table if needed
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'name'	=>	'string',
				'frequency'	=>	'int',
		);
		try {
			$this->getDbConnection()->createCommand(
					$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
		$columns = array(
				'nid'	=>	'int',
				'tid'	=>	'int',
		);
		try {
			$this->getDbConnection()->createCommand(
					$this->getDbConnection()->getSchema()->createTable('{{node_tag}}', $columns)
			)->execute();
			$this->getDbConnection()->createCommand(
					$this->getDbConnection()->getSchema()->addPrimaryKey('nid_tid', '{{node_tag}}', 'nid,tid')
			)->execute();
			$this->getDbConnection()->createCommand(
					$this->getDbConnection()->getSchema()->addForeignKey('node', '{{node_tag}}', 'nid', '{{node}}', 'id')
			)->execute();
			$this->getDbConnection()->createCommand(
					$this->getDbConnection()->getSchema()->addForeignKey('tags', '{{node_tag}}', 'tid', '{{tags}}', 'id')
			)->execute();
		} catch (CDbException $e){
			Yii::log($e->getMessage(), 'warning');
		}
		$this->refreshMetaData();
	}
}

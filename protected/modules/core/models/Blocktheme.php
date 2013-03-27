<?php

/**
 * This is the model base class for the table "blocktheme".
 *
 * Columns in table "blocktheme" available as properties of the model:
 * @property string $id
 * @property string $block
 * @property string $theme
 * @property string $region
 * @property integer $weight
 *
 * Relations of table "blocktheme" available as properties of the model:
 * @property Block $block0
 */
class Blocktheme extends BaseActiveRecord{

	public function connectionId(){
		return 'db';
	}


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
		return (string) $this->block;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{blocktheme}}';
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array(
			array('block, theme, region, weight', 'required'),
			array('weight', 'default', 'setOnEmpty'=>true, 'value' => 5),
			array('weight', 'numerical', 'integerOnly'=>true),
			array('block', 'length', 'max'=>11),
			array('theme, region', 'length', 'max'=>255),
			array('id, block, theme, region, weight', 'safe', 'on'=>'search'),
		);
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
			'owner' => array(self::BELONGS_TO, 'Block', 'block'),
		);
	}
	/**
	* Attribute labels
	*/
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
				'owner'	=>	Yii::t('core', 'Owner'),
		));
	}

	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'region ASC, weight ASC',
		);
	}

	/**
	 * Create the table if needed
	 */
	protected function createTable(){
		 $columns = array(
					'block'	=>	'int',
					'theme'	=>	'string',
					'region'	=>	'string',
					'weight'	=>	'int',
			);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('btr', $this->tableName(), 'block,theme,region')
		)->execute();
		return FALSE;
	}
}

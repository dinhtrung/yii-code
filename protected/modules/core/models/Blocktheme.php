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
		return 'blocktheme';
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
		return array(
			'id' => Yii::t('app', 'ID'),
			'block' => Yii::t('app', 'Block'),
			'theme' => Yii::t('app', 'Theme'),
			'region' => Yii::t('app', 'Region'),
			'weight' => Yii::t('app', 'Weight'),
		);
	}
	/**
	* Which attribute are safe for search
	*/
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('block', $this->block);
		$criteria->compare('theme', $this->theme, true);
		$criteria->compare('region', $this->region, true);
		$criteria->compare('weight', $this->weight);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
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
	* Run before validate()
	*/
	protected function beforeValidate() {
		return parent::beforeValidate();
	}
	/**
	* Run after validate()
	*/
	protected function afterValidate() {
		return parent::afterValidate();
	}
	/**
	* Run before save()
	*/
	protected function beforeSave() {
		return parent::beforeSave();
	}
	/**
	* Run after save()
	*/
	protected function afterSave() {
		return parent::afterSave();
	}
	/**
	* Run before delete()
	*/
	protected function beforeDelete() {
		return parent::beforeDelete();
	}
	/**
	* Run after delete()
	*/
	protected function afterDelete() {
		return parent::afterDelete();
	}
	/**
	* Configure additional behaviors
	*
	public function behaviors()
	{
		return array_merge(
			array(
				'BehaviourName' => array(
					'class' => 'CWhateverBehavior'
				)
			),
			parent::behaviors()
		);
	}
	*/
}

<?php

/**
 * This is the model base class for the table "comments".
 *
 * Columns in table "comments" available as properties of the model:
 * @property integer $id
 * @property string $entity
 * @property integer $pkey
 * @property integer $uid
 * @property integer $createtime
 * @property integer $visible
 * @property string $comment
 *
 * There are no model relations.
 */
class Comments extends BaseActiveRecord{

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
		return (string) $this->entity;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return 'comments';
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array(
			array('entity, pkey', 'required'),
			array('uid, createtime, visible, comment', 'default', 'setOnEmpty' => true, 'value' => null),
			array('pkey, uid, createtime, visible', 'numerical', 'integerOnly'=>true),
			array('entity', 'length', 'max'=>255),
			array('comment', 'safe'),
			array('id, entity, pkey, uid, createtime, visible, comment', 'safe', 'on'=>'search'),
		);
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
		);
	}
	/**
	* Attribute labels
	*/
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('core', 'ID'),
			'entity' => Yii::t('core', 'Entity'),
			'pkey' => Yii::t('core', 'Pkey'),
			'uid' => Yii::t('core', 'Uid'),
			'createtime' => Yii::t('core', 'Createtime'),
			'visible' => Yii::t('core', 'Visible'),
			'comment' => Yii::t('core', 'Comment'),
		);
	}
	/**
	* Which attribute are safe for search
	*/
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('entity', $this->entity, true);
		$criteria->compare('pkey', $this->pkey);
		$criteria->compare('uid', $this->uid);
		$criteria->compare('createtime', $this->createtime);
		$criteria->compare('visible', $this->visible);
		$criteria->compare('comment', $this->comment, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'entity ASC',
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

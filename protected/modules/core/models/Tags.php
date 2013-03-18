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
		return 'tags';
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array(
			array('name', 'required'),
			array('frequency', 'default', 'setOnEmpty' => true, 'value' => null),
			array('frequency', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('name, frequency', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('tags', 'Name'),
			'frequency' => Yii::t('tags', 'Frequency'),
		);
	}
	/**
	* Which attribute are safe for search
	*/
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('name', $this->name, true);
		$criteria->compare('frequency', $this->frequency);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
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

	/**
	 * Helper function for Tags
	 */
	function getLink($method = "view") {
		return CHtml::link($this->name, array("/core/tags/view", "id" => $this->id),
			array("title" => CHtml::encode($this->name)));
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
}

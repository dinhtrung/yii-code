<?php

/**
 * This is the model base class for the table "category".
 *
 * Columns in table "category" available as properties of the model:
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $title
 * @property string $description
 *
 * There are no model relations.
 */
class Category extends BaseActiveRecord{

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
		return (string) Yii::t('core', $this->title, array(), 'dbmessages');

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{category}}';
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array(
			array('title', 'required'),
			array('title, description', 'safe'),
			array('title', 'length', 'max'=>255),
			array('root, lft, rgt, level', 'unsafe', 'on' => 'insert, update, delete'),
			array('root, lft, rgt, level', 'numerical', 'integerOnly'=>true),
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
			'root' => Yii::t('core', 'Root'),
			'title' => Yii::t('core', 'Title'),
			'description' => Yii::t('core', 'Description'),
		);
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'root ASC, lft ASC',
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
	*/
	public function behaviors()
	{
		return array_merge(
			array(
				'nestedSet' => array(
				'class'=>'ext.yiiext.behaviors.model.trees.NestedSetBehavior',
				'hasManyRoots'	=>	TRUE,
				'leftAttribute'=>'lft',
				'rightAttribute'=>'rgt',
				'levelAttribute'=>'level',
				),
			),
			parent::behaviors()
		);
	}

	/*
	 * Category Helper functions
	 */

	public static function getOption($rid = NULL){
		$output = array();
		if (is_null($rid)) {
			$categorys = self::model()->roots()->findAll();
			foreach ($categorys as $n => $category){
				$output[$category->id] = Yii::t('core', $category->title, array(), 'dbmessages');
				$categories = $category->descendants()->findAll();
				foreach ($categories as $cat){
					$output[$cat->id] = str_repeat('-', $cat->level) . Yii::t('core', $cat->title, array(), 'dbmessages');
				}
			}
		} else {
			$category = self::model()->findByPk($rid);
			if (is_null($category)) return array();
			$output = array();
			$output[$category->id] = Yii::t('core', $category->title, array(), 'dbmessages');
			$categories = $category->descendants()->findAll();
			foreach ($categories as $cat){
				$output[$cat->id] = str_repeat('-', $cat->level) . Yii::t('core', $cat->title, array(), 'dbmessages');;
			}
		}
		return $output;
	}

	function getLink($dest = "view") {
		return CHtml::link($this->title, array("core/category/view", "id" => $this->id),
			array("title" => CHtml::encode($this->description)));
	}
	/**
	* Tree Category widget configuration.
	* Return a CForm config array for choosing a root category.
	*/
	public static function getTreeConfig(){
		return array (
				'title'	=>	Yii::t('core', "Get Tree configuration"),
				'description'	=>	Yii::t('core', "Select a Category to use as root, and the level of depth for recursive."),
			  	'elements' => array (
				    'root' => array (
			      		'type' => 'dropdownlist',
			      		'items' => Category::getOption(),
					),
				    'level'	=>	array(
				    	'type'	=>	'text',
					)
			)
		);
	}
	/**
	 * Dynamic Tree Menu Portlet support: Data Provider
	 * The data that can be used to generate the tree view content.
	 * 	text: string, required, the HTML text associated with this node.
    	expanded: boolean, optional, whether the tree view node is expanded.
    	id: string, optional, the ID identifying the node. This is used in dynamic loading of tree view (see url).
    	hasChildren: boolean, optional, defaults to false, whether clicking on this node should trigger dynamic loading of more tree view nodes from server. The url property must be set in order to make this effective.
    	children: array, optional, child nodes of this node.
    	htmlOptions: array, additional HTML attributes (see CHtml::tag). This option has been available since version 1.1.7.
	 */
	public static function getTreeData($root, $level){
		$output = array();
		if ($level == 0) return $output;
		if (!($root instanceof CActiveRecord)) $root = self::model()->findByPk($root);
		$output = array('root' => NULL, 'children' => array(), 'level' => $level);
		if (! is_null($root)){
			$output['root']	= $root;
			$children = $root->children()->findAll();
			foreach ($children as $idx => $child) {
				$children[$idx] = self::getTreeData($child, $level - 1);
			}
			$output['children'] = $children;
		}
		return $output;
	}
}

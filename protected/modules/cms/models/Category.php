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
	* This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	* @return string representing the object
	*/
	public function getTitle() {
		return (string) Yii::t('cms', $this->title, array(), 'dbmessages');

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{category}}';
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
	* Configure additional behaviors
	*/
	public function behaviors()
	{
		return array_merge(
			array(
				'nestedSet' => array(
				'class'=>'ext.behaviors.NestedSetBehavior',
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
				$output[$category->id] = Yii::t('cms', $category->title, array(), 'dbmessages');
				$categories = $category->descendants()->findAll();
				foreach ($categories as $cat){
					$output[$cat->id] = str_repeat('-', $cat->level) . Yii::t('cms', $cat->title, array(), 'dbmessages');
				}
			}
		} else {
			$category = self::model()->findByPk($rid);
			if (is_null($category)) return array();
			$output = array();
			$output[$category->id] = Yii::t('cms', $category->title, array(), 'dbmessages');
			$categories = $category->descendants()->findAll();
			foreach ($categories as $cat){
				$output[$cat->id] = str_repeat('-', $cat->level) . Yii::t('cms', $cat->title, array(), 'dbmessages');;
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
				'title'	=>	Yii::t('cms', "Get Tree configuration"),
				'description'	=>	Yii::t('cms', "Select a Category to use as root, and the level of depth for recursive."),
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

	/**
	 * Create the table if needed
	 */
	protected function createTable(){
		$columns = array(
				'id'	=>	'pk',
				'root'	=>	'int',
				'lft'	=>	'int',
				'rgt'	=>	'int',
				'level'	=>	'int',
				'title'	=>	'string',
				'description'	=>	'text',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createIndex('pos', $this->tableName(), 'root,lft,rgt,level')
		)->execute();
	}
}

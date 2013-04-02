<?php

/**
 * This is the model base class for the table "menu".
 *
 * Columns in table "menu" available as properties of the model:
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $label
 * @property string $description
 * @property string $url
 * @property string $template
 * @property integer $visible
 *
 * There are no model relations.
 */
Yii::import('cms.models.File');
class Webmenu extends BaseActiveRecord{

	private $path = "files/webmenu/icons";
	public $icon;

	public function connectionId(){
		return Yii::app()->hasComponent('coreDb')?'coreDb':'db';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	* @return string representing the object
	*/
	public function getLabel() {
		return (string) Yii::t('core', $this->label, array(), 'dbmessages');
	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{menu}}';
	}

	/*
	 * Create Table:
	 * CREATE TABLE IF NOT EXISTS `menu` (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `root` int(10) unsigned DEFAULT NULL,
		  `lft` int(10) unsigned NOT NULL,
		  `rgt` int(10) unsigned NOT NULL,
		  `level` smallint(5) unsigned NOT NULL,
		  `label` varchar(255) NOT NULL,
		  `description` text NOT NULL,
		  `url` varchar(255) NOT NULL,
		  `template` varchar(255) DEFAULT NULL,
		  `visible` tinyint(1) NOT NULL DEFAULT '1',
		  `icon` varchar(255) NOT NULL,
		  `task` varchar(255) NOT NULL,
		  PRIMARY KEY (`id`),
		  KEY `root` (`root`),
		  KEY `lft` (`lft`),
		  KEY `rgt` (`rgt`),
		  KEY `level` (`level`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	 */
	protected function createTable(){
		$ref = new Block();
		$columns = array(
				'id'	=>	'pk',
				'root'	=>	'int',
				'lft'	=>	'int',
				'rgt'	=>	'int',
				'level'	=>	'int',
				'label'	=>	'string',
				'description'	=>	'text',
				'url'	=>	'string',
				'template'	=>	'string',
				'visible'	=>	'boolean',
				'icon'	=>	'string',
				'task'	=>	'string',
		);
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('rlrl', $this->tableName(), 'root,lft,rgt,level')
		)->execute();
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array_merge( parent::rules(), array(
			array('visible', 'boolean'),
			array('icon', 'file', 'on' => 'insert, update', 'types' => File::IMAGETYPES, 'allowEmpty' => true),

		));
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'root ASC, lft ASC, label ASC',
		);
	}
	/**
	* Configure additional behaviors
	*/
	public function behaviors()
	{
		Yii::import("ext.image.CImageComponent");
		Yii::import("ext.image.Image");
		DirectoryHelper::safe_directory(Yii::getPathOfAlias("webroot") . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $this->path));
		return array_merge( array(
				'nestedSet' => array(
						'class'=>'ext.yiiext.behaviors.model.trees.NestedSetBehavior',
						'hasManyRoots'	=>	TRUE,
						'leftAttribute'=>'lft',
						'rightAttribute'=>'rgt',
						'levelAttribute'=>'level',
					),
				'Image' => array(
						'class' => 'ext.behaviors.ImageARBehavior',
						'attribute' => 'icon',
						//'attributeForName' => 'id',
						'extension' => File::IMAGETYPES,
						'prefix' => 'icon_',
						'relativeWebRootFolder' => $this->path,
						'forceExt' => 'png',
					)
				),
			parent::behaviors()
		);
	}
	/**
	 * Return a list of available menuitems
	 * Enter description here ...
	 */
	public static function getMenuOption(){
		$output = array();
		$trees = self::model()->roots()->findAll();
		foreach ($trees as $n => $tree){
			$output[$tree->id] = TextHelper::word_limiter($tree->label . ': ' . $tree->description, 30);
			$menuitem = $tree->descendants()->findAll();
			foreach ($menuitem as $cat){
				$output[$cat->id] = TextHelper::word_limiter(str_repeat('-', $cat->level) . $cat->label . ': ' . $cat->description, 50);
			}
		}
		return $output;
	}

	/**
	 * Dynamic Menu Portlet support: Data Provider
	 */
	public static function getMenuData($root = NULL, $level = 0){
		$output = array();
		if ($level == 0) return $output;
		if (!($root instanceof Webmenu)) $root = self::model()->findByPk($root);
		if (! is_null($root)){
			$output["title"] = $root->label;
			$output["items"] = array();
			$menuitems = $root->children()->findAll();
			foreach ($menuitems as $menuitem) {
				$t = $menuitem->getAttributes(array('id', 'label', 'description', 'url', 'template'));
				$t['htmlOptions'] = array('title' => $menuitem->description);
				if ($t['url'] && ! strpos($t['url'], '://') && ! ($t['url'][0] == '#')){
					if (Yii::app()->getRequest()->getRequestUri() == Yii::app()->getController()->createUrl($t['url'])) $t['active'] = TRUE;
					if (($t['url'] == Yii::app()->setting->get('Website', 'homeUrl', 'site/index')) && (! Yii::app()->getRequest()->getRequestUri())) $t['active'] = TRUE;
					if (! is_array($t['url'])) $t['url'] = array($t['url']);
				}
				$tmp = self::getMenuData($menuitem, $level - 1);
				if (count($tmp)) $t['items'] = $tmp['items'];
				else unset($t['items']);
				unset($tmp);
				unset($t['id']);
				unset($t['description']);
				if (is_null($t['template'])) unset($t['template']);
				$output["items"][] = $t;
			}
		} else throw new CException("Invalid root element.", 404);
		if (count($output['items'])) return $output;
		else return array();
	}
	/**
	 * Dynamic Menu Portlet support: Data Configuration.
	 * Return an array of CForm configuration.
	 */
	public static function getMenuConfig(){
		return array (
			'title'	=>	Yii::t('core', "Menu Portlet Configuration"),
			'description'	=>	Yii::t('core', "Configuration for Menu Portlet."),
		  	'elements' => array (
			    'root' => array (
		      		'type' => 'dropdownlist',
		      		'items' => self::getMenuOption(),
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
	public static function getTreeMenuData($root, $level){
		$output = array();
		if ($level == 0) return $output;
		if (!($root instanceof Webmenu)) $root = self::model()->findByPk($root);
		$output = array(
			'text'		=>	$root->label,
			'expanded'	=>	FALSE,	//FIXME: Check with current request URL
		);
		if (! is_null($root)){
			$menuitems = $root->children()->findAll();
			$children = array();
			foreach ($menuitems as $idx => $menuitem) {
				$url = $menuitem->url;
				if ($url  && ! is_array($url) && ! strpos($url, '://') && ! ($url[0] == '#')){
					$url = array($url);
				}
				$tmp = self::getTreeMenuData($menuitem, $level - 1);
				$children[$idx] = array(
					'id'		=>	$menuitem->id,
					'text'		=>	CHtml::link($menuitem->label, $url, array('title' => $menuitem->description)),
					'expanded'	=>	FALSE,	//FIXME: Check with current request URL
				);
				if (count($tmp)) $children[$idx]['children'] = $tmp['children'];
				unset($tmp);
			}
		} else throw new CException("Invalid root element.", 404);
		if (count($children)) $output['children'] = $children;
		return $output;
	}
	/**
	 * Tree Menu Portlet support: Data Configuration.
	 * Return an array of CForm configuration.
	 */
	public static function getTreeMenuConfig(){
		return array (
			'title'	=>	Yii::t('core', "Menu Portlet Configuration"),
			'description'	=>	Yii::t('core', "Configuration for Menu Portlet."),
		  	'elements' => array (
			    'root' => array (
		      		'type' => 'dropdownlist',
		      		'items' => Webmenu::getMenuOption(),
			    ),
			    'level'	=>	array(
			    	'type'	=>	'text',
			    )
			)
		);
	}
	/**
	* Return all the menu of a children menu item
	*/
	public static function getChildrenData($root){
		$output = array();
		if (!($root instanceof Webmenu)) $root = self::model()->findByPk($root);
		if (! is_null($root)){
			$output["root"]  = $root;
			$output["items"] = $root->children()->findAll();
			return $output;
		} else throw new CException("Invalid root element.", 404);
	}
	/**
	 * Dynamic Menu Portlet support: Data Configuration.
	 * Return an array of CForm configuration.
	 */
	public static function getChildrenConfig(){
		return array (
				'title'	=>	Yii::t('core', "Menu Portlet Configuration"),
				'description'	=>	Yii::t('core', "Please select the root elements."),
			  	'elements' => array (
				    'root' => array (
			      		'type' => 'dropdownlist',
			      		'items' => Webmenu::getMenuOption(),
			     	),
				),
			);
	}
}

<?php
class Webtheme extends CFormModel
{
	public $perPage;
	public $serverEmail;
	public $contactEmail;
	public $theme;
	public $layout;
	public $siteName;
	public $siteSlogan;
	public $siteLogo;
	public $homeUrl;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('siteSlogan, siteName, layout, theme, serverEmail, contactEmail, perPage, homeUrl', 'safe', 'on' => 'settings'),
			array('layout, perPage', 'safe', 'on' => 'block'),
			array('layout', 'validView', 'on' => 'settings, block'),
			array('perPage, siteName', 'required'),
			array('serverEmail, contactEmail', 'email'),
			array('siteLogo', 'file', 'allowEmpty' => TRUE, 'types' => 'png, jpg, gif'),
			array('perPage', 'numerical', 'allowEmpty' => FALSE, 'integerOnly' => TRUE, 'min' => 10, 'max' => 1000),
			array('theme', 'in', 'range' => Yii::app()->getThemeManager()->getThemeNames()),
		);
	}
	function validView($attribute,$params) {
		if(!$this->hasErrors()){
			if (! Yii::app()->getController()->getLayoutFile($this->layout)){
				$this->addError($attribute, Yii::t('layout', "Layout :view does not valid.", array(':view' => $this->layout)));
			}
		}
	}


	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'perPage'		=>	Yii::t('webtheme', 'Records per Page'),
			'serverEmail'	=>	Yii::t('webtheme', 'Server Email'),
			'contactEmail'	=>	Yii::t('webtheme', 'Contact Email'),
			'theme'			=>	Yii::t('webtheme', 'Website Theme'),
			'layout'		=>	($this->getScenario() != "block")?Yii::t('webtheme', 'Website Layout'):Yii::t('webtheme', 'Content'),
			'siteSlogan'	=>	Yii::t('webtheme', 'Site Slogan'),
			'siteLogo'		=>	Yii::t('webtheme', 'Site Logo'),
			'siteName'		=>	Yii::t('webtheme', 'Site Name'),
		);
	}

	function init() {
		parent::init();
	}

	public static function themeOptions($param = NULL) {
		$themes = Yii::app()->getThemeManager()->getThemeNames();
		$themes = array_combine($themes, $themes);
		if (is_null($param)) return $themes;
		elseif (array_key_exists($param, $themes)) return $themes[$param];
		else return NULL;
	}

	public static function regionOption($theme = NULL) {
		$data = self::getThemeInfo($theme);
		return $data["region"];
	}
	protected function beforeSave() {
		$this->siteLogo = CUploadedFile::getInstance($this, 'siteLogo');
		if (! is_null($this->siteLogo))
		$this->siteLogo->saveAs(Yii::getPathOfAlias("webroot.images") . DIRECTORY_SEPARATOR . $this->siteLogo->name);
		$this->siteLogo = sprintf("%s", $this->siteLogo);
		return parent::beforeSave();
	}

	public static function getThemeInfo($theme = NULL){
		if (is_null($theme)) $theme = Yii::app()->setting->get('Webtheme', 'theme', 'classic');
		$path = Yii::app()->getThemeManager()->getBasePath() . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR . "theme.ini";
		if (file_exists($path)){
			return parse_ini_file($path, TRUE);
		} else {
			return array(
				'information' => array(
					"name" => $theme,
					"description" => Yii::t('webtheme', 'No description available'),
				),
				'region' => array(),
			);
		}
	}
	/**
	 * Custom HTML block, using CKEditor as editor
	 */
	public static function getBlockConfig() {
		$path = DirectoryHelper::safe_directory(Yii::getPathOfAlias( "webroot") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("File", "path", "files"));
		return array (
			'description'	=>	Yii::t('webtheme', "Configuration for Custom Content."),
		  	'elements' => array (
			    'perPage' => array (
		      		'type' 	=> 'ext.widgets.editor.CKkceditor',
					'hint'	=>	Yii::t('gallery', "Content of the block."),
					"height"=>'400px',
			        "width"=>'100%',
			       	"filespath"	=>	$path,
			        "filesurl"	=>	Yii::app()->baseUrl . "/". Yii::app()->setting->get("File", "path", "files") . "/",
			    ),
			)
		);
	}
	public static function getBlockData($content = '') {
		return array("htmlContents" => $content);
	}
	/**
	 * Custom Layout block
	 */
	public static function setLayoutConfig() {
		return array (
			'description'	=>	Yii::t('webtheme', "Configuration for Custom Content."),
		  	'elements' => array (
			    'layout' => array (
		      		'type' 	=> 'text',
		      		'label'	=>	Yii::t('webtheme', 'Choose the layout to use'),
		      		'required'	=>	TRUE,
			    ),
			)
		);
	}
	public static function setLayoutData($layout = '//layouts/column2') {
		return array("layout" => $layout);
	}
}
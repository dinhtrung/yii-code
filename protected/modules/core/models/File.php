<?php

/**
 * This is the model base class for the table "file".
 *
 * Columns in table "file" available as properties of the model:
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $name
 * @property string $path
 * @property string $ext
 * @property string $size
 * @property string $type
 * @property string $entity
 * @property int	$pkey
 * @property int 	$createtime
 * @property int	$updatetime
 *
 * Relations of table "file" available as properties of the model:
 */
class File extends BaseActiveRecord{

	const IMAGETYPES = 'gif,png,jpg,jpeg,bmp,ief,jpe,jpeg,jpg,pbm,pgm,pnm,ppm,ras,rgb,tif,tiff,xbm,xpm';
	const AUDIOTYPES = 'aif,aifc,aiff,au,kar,mid,midi,mp2,mp3,mpga,ra,ram,rm,rpm,snd,tsi,wav';
	const TEXTTYPES = 'asc,c,cc,css,etx,f,f90,h,hh,htm,html,m,rtf,rtx,sgm,sgml,tsv,txt,';
	public $attachment;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* Initializes this model.
	*/
	public function init()
	{
		parent::init();
	}
	/**
	* This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	* @return string representing the object
	*/
	public function __toString() {
		return (string) $this->title;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{file}}';
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array(
			array('name', 'file', 'on' => 'insert'),
			array('name', 'file', 'on' => 'update', 'allowEmpty' => TRUE),
			array('path', 'validRelativeUploadPath', 'on' => 'settings'),
			array('path', 'filter', 'on' => 'insert, update', 'filter' => array('DirectoryHelper', 'safe_directory')),
			array('title', 'required', 'on' => 'insert, update'),
			array('description', 'safe'),
            array('path, ext, size, type, entity', 'default', 'setOnEmpty' => TRUE, 'value' => NULL),
            array('title, name, path, ext, type, entity', 'length', 'max'=>255),
            array('size, pkey, createtime, updatetime', 'length', 'max'=>10),
            array('id, title, description, name, path, ext, size, type, entity, pkey, createtime, updatetime', 'safe', 'on'=>'search'),
		);
	}
	/**
	 * Valid Relative upload path
	 */
	function validRelativeUploadPath($attribute, $value) {
		if (! $this->hasErrors()){
			$path = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $this->path);
			try {
				DirectoryHelper::safe_directory($path);
			} catch (CException $e) {
				$this->addError("path", $e->getMessage());
			}
		}
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array();
	}
	/**
    * Attribute labels
    */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('core', 'ID'),
            'title' => Yii::t('core', 'Title'),
            'description' => Yii::t('core', 'Description'),
            'name' => Yii::t('core', 'Name'),
            'path' => Yii::t('core', 'Path'),
            'ext' => Yii::t('core', 'Ext'),
            'size' => Yii::t('core', 'Size'),
            'type' => Yii::t('core', 'Type'),
            'entity' => Yii::t('core', 'Entity'),
            'pkey' => Yii::t('core', 'Pkey'),
            'createtime' => Yii::t('core', 'Createtime'),
            'updatetime' => Yii::t('core', 'Updatetime'),
        );
    }
    /**
    * Provide default sorting and optional condition
    */
    public function defaultScope() {
        return array(
            'order' => 'title ASC',
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
		if ($this->name instanceof CUploadedFile){
			if (! $this->getIsNewRecord()){
				$oldfile = $this->getOldAttributes("path") . DIRECTORY_SEPARATOR . $this->getOldAttributes("name");
				if (file_exists($oldfile) && is_file($oldfile)) @unlink($oldfile);
			}
			$this->size = $this->name->getSize();
			$this->type = $this->name->getType();
			$this->ext  = $this->name->getExtensionName();
			$this->name->saveAs($this->path . DIRECTORY_SEPARATOR . $this->name->getName());
		} else unset($this->name);
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
		@unlink($this->path . DIRECTORY_SEPARATOR . $this->name);
		return parent::afterDelete();
	}
	/**
	* Run before find()
	*/
	protected function beforeFind() {
		return parent::beforeFind();
	}
	/**
	* Run after delete()
	*/
	protected function afterFind() {
		$res = parent::afterFind();
		if (! file_exists($this->path . DIRECTORY_SEPARATOR . $this->name)){
			$this->path
			= $this->name
			= $this->ext
			= $this->size
			= $this->type
			= NULL;
		}
		try {
			if (class_exists($this->entity)){
				$tmp = call_user_func(array($this->entity, 'model'));
				$this->attachment = $tmp->findByPk($this->pkey);
			}
		} catch (Exception $e) {
			Yii::log("File attachment is invalid.");
			$this->entity = NULL;
			$this->pkey = 0;
		}
		return $res;
	}

	function getLink($action = "view") {
		$file = $this->path . DIRECTORY_SEPARATOR . $this->name;
		if ($action == "download"){
			if (file_exists($file)){
				return CHtml::link(CHtml::encode($this->name),
					Yii::app()->getAssetManager()->publish($file)
				);
			} else return Yii::t('core', "The file :file is removed.", array(":file" => $this->name));
		} else return parent::getLink($action);

	}

	function render(){
		$views = explode("/", $this->type);
		$current = "core.views.file";
		foreach ($views as $k => $v){
			$current .= "." . $v;
			$views[$k] = $current;
		}
		$views = array_reverse($views);
		foreach ($views as $vf){
			if (! file_exists(Yii::getPathOfAlias($vf) . ".php")) continue;
				return Yii::app()->getController()->renderPartial($vf, $this->getAttributes(), TRUE);
		}
		return $this->getLink("download");
	}

	function setFile($path) {
		if (! file_exists($path) OR is_dir($path)) throw new CException("Invalid file specified.", 500);
		$pathinfo = pathinfo($path);
		$this->name 	= $pathinfo['filename'];
		$this->ext 		= $pathinfo['extension'];
		$this->path 	= $pathinfo['dirname'];
		$this->createtime 	= filectime($path);
		$this->updatetime 	= fileatime($path);
		$this->size		= filesize($path);
		$this->type		= CFileHelper::getMimeType($path);
	}
}

<?php
/**
 * This is the model base class for the table "file".
 *
 * Columns in table "file" available as properties of the model:
 * @property integer $fid
 * @property string $filename
 * @property string $uri
 * @property string $filemime
 * @property string $filesize
 * @property integer $status
 *
 * Relations of table "file" available as properties of the model:
 * @property Cpfile[] $cpfiles
 */
class Datafile extends BaseActiveRecord {
	public $fileInstance;
	public $filepath;
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	/**
	 * Initializes this model.
	 */
	public function init() {
		return parent::init();
	}
	/**
	 * This magic method is used for setting a string value for the object. It will be used if the object is used as a string.
	 * @return string representing the object
	 */
	public function __toString() {
		return (string)$this->filename;
	}
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
	/**
	 * @return string name of the class table
	 */
	public function tableName() {
		return '{{datafile}}';
	}
	/**
	 * Define validation rules
	 */
	public function rules() {
		return array_merge(parent::rules(), array(
			array('uri', 'unique'),
		));
	}
	/**
	 * Relation to other models
	 */
	public function relations() {
		return array(
			'cpfiles' => array( self::HAS_MANY, 'Cpfile', 'fid' ) ,
			'campaigns' => array(self::MANY_MANY, 'Campaign', 'cpfile(fid, cid)'),
		);
	}


	public function beforeSave(){
		if ($this->getScenario() == 'insert'){
			$this->uid = UserModule::user()->getId();
		}
		return parent:: beforeSave();
	}

	/**
	 * Provide default sorting and optional condition
	 */
	public function defaultScope() {
		return array(
			'order' => 'updatetime DESC',
		);
	}
	/**
	 * Run after validate()
	 */
	private function getBasePath(){
		return DirectoryHelper::safe_directory(Yii::getPathOfAlias("application") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("File", "public_directory", "data"));
	}
	public function fileUri2Path($uri = NULL){
		if (empty($uri)) $uri = $this->uri;
		return str_replace('public://', $this->getBasePath(), $uri);
	}
	public function filePath2Uri($path = NULL){
		if (empty($path)) $path = $this->filepath;
		return str_replace($this->getBasePath(), 'public://', $path);
	}
	public function getDownload($path = NULL){
		if (empty($path)) $path = $this->filepath;
		return  '<a href="'.Yii::app()->getBaseUrl() . str_replace(Yii::getPathOfAlias("application"), '/protected', $path) . '">'.$this->filename.'</a>' ;
	}
	public function fileProperties($path = NULL){
		if (empty($path)) $path = $this->filepath;
		$fileinfo = pathinfo($path);
		if (empty($this->title)) $this->title = $fileinfo['basename'];
		if (empty($this->description)) $this->description = $fileinfo['basename'];
		$this->filename = $fileinfo['basename'];
		$this->filesize = filesize($path);
		$this->filemime = CFileHelper::getMimeType($path);
		$this->uri = $this->filePath2Uri($path);
		$this->status = $this->getFileStatus($path);
	}

	public function getFileStatus($path = NULL){
		if (empty($path)) $path = $this->filepath;
		return ((file_exists($path))?(self::STATUS_EXISTS):(self::STATUS_REMOVED));
	}
	protected function afterFind() {
		$this->filepath = $this->fileUri2Path();
		$this->status = $this->getFileStatus();
		if ($this->status == self::STATUS_REMOVED) $this->delete();
		return parent::afterFind();
	}
	/**
	 * Set the file instance for this module.
	 * @param CUploadedFile $file The uploaded file.
	 * @param string $directory	The directory to save to.
	 */
	public function setFileInstance(CUploadedFile $file, $directory = NULL) {
		if (empty($directory)) {
			$directory = $this->getBasePath();
		} else $directory = DirectoryHelper::safe_directory($directory);
		$this->fileInstance = $file;
		$this->filepath = $directory . DIRECTORY_SEPARATOR . $file->getName();
		$ext = $file->getExtensionName();
		if ($ext)
		$prefix = substr($this->filepath, 0, strpos($this->filepath, $ext));
		else $prefix = $this->filepath;
		$suffix = 0;
		while (file_exists($this->filepath)) {
			$this->filepath = $prefix . '_' . $suffix . '.' . $ext;
			$suffix++;
		}
		$file->saveAs($this->filepath);
		$this->filename = basename($this->filepath);
		if (empty($this->title)) $this->title = $this->filename;
		if (empty($this->description)) $this->description = $this->filename;
		$this->filesize = $file->getSize();
		$this->filemime = $file->getType();
		$this->uri = $this->filePath2Uri();
		$this->status = $this->getFileStatus();
	}
	/**
	 * Helper functions for options
	 */
	const STATUS_REMOVED = 0;
	const STATUS_EXISTS = 1;
	public static function statusOption($param = NULL) {
		$options = array(
			self::STATUS_REMOVED	=>	Yii::t('isms', "This file is no longer exists"),
			self::STATUS_EXISTS		=>	Yii::t('isms', "This file is exists"),
		);
		if (is_null($param)) return $options;
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	protected function beforeDelete(){
		@unlink($this->fileUri2Path());
		Cpfile::model()->deleteAllByAttributes(array('fid' => $this->getPrimaryKey()));
		return parent::beforeDelete();
	}
}

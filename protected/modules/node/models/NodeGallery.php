<?php
Yii::import("core.models.Node");
Yii::import("core.models.File");
class NodeGallery extends Node {
	public $images;
	private $dir;
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
		return (string) $this->title;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{node}}';
	}


	/*
	 * Category Helper functions
	 */

	function getLink($dest = "view") {
		return CHtml::link($this->title, array("node/nodeGallery/view", "id" => $this->id),
			array("title" => CHtml::encode($this->description)));
	}

	/**
	 * Get the aliasectory that store gallery, ensure that this aliasectory actually exists.
	 */
	public function getDirectory() {
		if (is_null($this->dir)) {
			$this->dir = DirectoryHelper::safe_directory(Yii::getPathOfAlias("webroot") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("File", "path", "files") . DIRECTORY_SEPARATOR . $this->alias);
		}
		return $this->dir;
	}
	/**
	 * List all files
	 * Enter description here ...
	 */
	function getImages() {
		if (is_null($this->images)) {
			$this->images = CFileHelper::findFiles($this->getDirectory(), array('fileTypes' => explode(',', File::IMAGETYPES), 'level' => 0));
			foreach ($this->images as $k => $path){
				$this->images[$k] = pathinfo($path);
				$this->images[$k]['path']	=	$path;
				$this->images[$k]['src']	=	Yii::app()->assetManager->publish($path);
				$imginfo = getimagesize($path);
				if ($imginfo) {
					$imginfo["width"] = $imginfo[0]; unset($imginfo[0]);
					$imginfo["height"] = $imginfo[1]; unset($imginfo[1]);
					$imginfo["type"] = $imginfo[2]; unset($imginfo[2]);
					$imginfo["size"] = $imginfo[3]; unset($imginfo[3]);
					$this->images[$k] = array_merge($this->images[$k], $imginfo);
				} else {
					@unlink($path);
					unset($this->images[$k]);
				}
			}
		}
		return $this->images;
	}
	/**
	 * Return CArrayDataProvider for images
	 */
	function getImageDataProvider() {
		$images = $this->getImages();
		return new CArrayDataProvider($images, array(
			'keyField'	=>	'path',
			'pagination'	=>	array(
				'pageSize'	=>	Yii::app()->setting->get("Webtheme", "pageSize", 10),
			),
			'sort'	=>	array(
				'attributes'=>array(
					'width', 'height', 'type', 'size', 'filename'
				),
		    ),
		));
	}

	/**
	 * Block configuration for Gallery
	 */
	public static function getBlockConfig() {
		return array (
			'title'	=>	Yii::t('nodeGallery', "Gallery Portlet Configuration"),
			'description'	=>	Yii::t('nodeGallery', "Configuration for Gallery."),
		  	'elements' => array (
			    'root' => array (
					'label'	=>	Yii::t('nodeGallery', "Select Gallery"),
					'hint'	=>	Yii::t('nodeGallery', "Choose the gallery with images to put on the slide show"),
		      		'type' => 'dropdownlist',
		      		'items' => array("" => Yii::t("gallery", "-- Select gallery --")) + self::getOption(),
			    ),
			    'level'	=>	array(
					'label'	=>	Yii::t('nodeGallery', "Number of images"),
					'hint'	=>	Yii::t('nodeGallery', "The number of image to select from"),
			    	'type'	=>	'text',
			    )
			)
		);
	}
	/**
	 * Return the block data to its Views
	 * @param integer $rootNodeId
	 * @param integer $imageCount
	 * @throws CException
	 */
	public static function getBlockData($rootNodeId = NULL, $imageCount = NULL) {
		$output = array('gallery' => self::model()->findByPk($rootNodeId), 'imageCount' => $imageCount);
		return $output;
	}
}
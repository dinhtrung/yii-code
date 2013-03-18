<?php
/**
 * This is the model base class for the table "node".
 *
 * Columns in table "node" available as properties of the model:
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property string $body
 * @property integer $createtime
 * @property integer $updatetime
 * @property integer $uid
 * @property integer $cid
 * @property string $tags
 *
 * There are no model relations.
 */
Yii::import('core.models.Node');
class NodeImage extends Node {
	public $image;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{node}}';
	}

	public function rules(){
		return array_merge(
			array(
				array('image', 'file', 'types' => 'png, gif, jpg', 'allowEmpty' => true),
				array('alias, image', 'safe', 'on' => 'configure'),
			),
			parent::rules()
		);
	}
	/**
	* Configure additional behaviors
	*/
	public function behaviors()	{
		Yii::import("ext.image.CImageComponent");
		Yii::import("ext.image.Image");
		$path = "files/image";
		DirectoryHelper::safe_directory(Yii::getPathOfAlias("webroot") . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path));
		return array_merge(
			array(
				'Image' => array(
					'class' => 'ext.behaviors.ImageARBehavior',
					'attribute' => 'image',
					'extension' => 'png, gif, jpg',
					'prefix' => 'NodeFile_',
					'relativeWebRootFolder' => $path,
					'forceExt' => 'png',
					'formats' => array(
						'thumb' => array(
							'suffix' => '_thumb',
							'process' => array(
								'resize' => array(240, 180, Image::WIDTH),
								'grayscale' => true
							),
						),
						'large' => array(
							'suffix' => '_large',
						),
						'normal' => array(
							'process' => array(
								'resize' => array(720, 540, Image::WIDTH)
							),
						),
					),
					'defaultName' => 'default',
				)
			),
			parent::behaviors()
		);
	}
}

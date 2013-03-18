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
class NodeDocument extends Node {
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
	 * Override relations
	 */
	public function relations() {
		return array_merge(
			array(
				'files'		=>	array(self::HAS_MANY, 'File', 'pkey',
					'condition' => 'files.entity="'.trim($this->tableName(), '{}').'"',
				),
			),
			parent::relations()
		);
	}
/**
	* Configure additional behaviors
	*/
	public function behaviors()	{
		$path = "files/documents";
		DirectoryHelper::safe_directory(Yii::getPathOfAlias("webroot") . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path));
		return array_merge(
			array(
				'Document' => array(
					'class' => 'ext.behaviors.FileARBehavior',
					'attributeForName'	=>	'alias',
					'attribute' => 'file',
					'extension' => 'doc, pdf, txt',
					'prefix' => 'Document_',
					'relativeWebRootFolder' => $path,
					'defaultName' => 'default',
				)
			),
			parent::behaviors()
		);
	}
}

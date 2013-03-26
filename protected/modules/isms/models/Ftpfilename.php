<?php

/**
 * This is the model base class for the table "ftpfilename".
 *
 * Columns in table "ftpfilename" available as properties of the model:
 * @property integer $id
 * @property integer $cid
 * @property string $filename
 *
 * Relations of table "ftpfilename" available as properties of the model:
 * @property Campaign $c
 */
class Ftpfilename extends BaseActiveRecord{
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
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
		return (string) $this->filename;

	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{ftpfilename}}';
	}
	/**
	* Define validation rules
	*/
	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('cid, filename', 'uniqueKeys'),
		));
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
			'c' => array(self::BELONGS_TO, 'Campaign', 'cid'),
		);
	}
	/**
	* Attribute labels
	*/
	public function attributeLabels()
	{
		return array(
			'status' => Yii::t('isms', 'Status'),
			'cid' => Yii::t('isms', 'Cid'),
			'filename' => Yii::t('isms', 'Filename'),
		);
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'filename ASC',
		);
	}
	/**
	/** Helper functions for options **/

	const STATUS_NEW = 0;
	const STATUS_PROCESSING = 1;
	const STATUS_PROCESSED = 2;
	public static function statusOption($param = NULL) {
		$options = array(
			self::STATUS_NEW	=>	Yii::t('isms', "Not processed"),
			self::STATUS_PROCESSING	=>	Yii::t('isms', "Processing..."),
			self::STATUS_PROCESSED	=>	Yii::t('isms', "Processed"),
		);
		if (is_null($param)) return $options;
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}
	public function uniqueKeys() {
		$this->validateCompositeUniqueKeys();
	}
	public function behaviors() {
		return array_merge(parent::behaviors() , array(
				'ECompositeUniqueKeyValidatable' => array(
					'class' => 'ext.behaviors.ECompositeUniqueKeyValidatable',
					'uniqueKeys' => array(
						'attributes' => 'cid, filename',
						'errorMessage' => Yii::t('isms', 'This FTP filename is already linked with this campaign') ,
		)
		) ,
		));
	}
}

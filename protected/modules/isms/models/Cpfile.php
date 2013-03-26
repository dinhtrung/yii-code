<?php
/**
 * This is the model base class for the table "cpfile".
 *
 * Columns in table "cpfile" available as properties of the model:
 * @property integer $cid
 * @property integer $fid
 * @property boolean $status
 *
 * Relations of table "cpfile" available as properties of the model:
 * @property File $f
 * @property Campaign $c
 */
class Cpfile extends BaseActiveRecord {
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
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
		return (string)$this->cid;
	}
	/**
	 * @return string name of the class table
	 */
	public function tableName() {
		return '{{cpfile}}';
	}
	/**
	 * Define validation rules
	 */
	public function rules() {
		return array_merge(parent::rules(), array(
			array('cid,fid', 'uniqueKeys'),
		));
	}
	/**
	 * Relation to other models
	 */
	public function relations() {
		return array(
			'f' => array( self::BELONGS_TO, 'Datafile', 'fid' ) ,
			'c' => array( self::BELONGS_TO, 'Campaign', 'cid' ) ,
		);
	}

	/**
	 * Provide default sorting and optional condition
	 */
	public function defaultScope() {
		return array(
			'order' => 'fid ASC',
		);
	}
	/**
	 * Set default values when missing
	 * @see CModel::beforeValidate()
	 */
	public function beforeValidate(){
		if (is_null($this->status)) $this->status = self::STATUS_NEW;
		return parent::beforeValidate();
	}
	public function getId(){
		return array('fid' => $this->fid, 'cid' => $this->cid);
	}
	/**
	 * Configure additional behaviors
	 */
	public function uniqueKeys() {
		$this->validateCompositeUniqueKeys();
	}
	public function behaviors() {
		return array_merge(parent::behaviors() , array(
			'ECompositeUniqueKeyValidatable' => array(
				'class' => 'ext.behaviors.ECompositeUniqueKeyValidatable',
				'uniqueKeys' => array(
					'attributes' => 'fid, cid',
					'errorMessage' => Yii::t('isms', 'This file is already linked with this campaign') ,
				)
			) ,
		));
	}

	/** Helper functions for options **/

	const STATUS_NEW = 0;
	const STATUS_PROCESSING = 1;
	const STATUS_PROCESSED = 2;
	public static function statusOption($param = NULL) {
		$options = array(
			self::STATUS_NEW	=>	Yii::t('isms', "Not processed"),
			self::STATUS_PROCESSING	=>	Yii::t('isms', "Processing..."),
			self::STATUS_PROCESSED	=>	Yii::t('isms', "Imported"),
		);
		if (is_null($param)) return $options;
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}
	function getStatus(){
		return self::statusOption($this->status);
	}
}

<?php
/**
 * This is the model base class for the table "blacklist".
 *
 * Columns in table "blacklist" available as properties of the model:
 * @property integer $id
 * @property integer $fid
 * @property string $isdn
 *
 * Relations of table "blacklist" available as properties of the model:
 * @property Filter $f
 */
class Blacklist extends BaseActiveRecord {
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
		return (string)$this->isdn;
	}
	/**
	 * @return string name of the class table
	 */
	public function tableName() {
		return '{{blacklist}}';
	}
	/**
	 * Define validation rules
	 */
	public function rules() {
		return array_merge(parent::rules(), array(
				array('fid+isdn', 'uniqueKeys') ,
			)
		);
	}
	/**
	 * Relation to other models
	 */
	public function relations() {
		return array(
			'f' => array(self::BELONGS_TO, 'Filter', 'fid') ,
		);
	}
	/**
	 * Provide default sorting and optional condition
	 */
	public function defaultScope() {
		return array(
			'order' => 'isdn ASC',
		);
	}
	public function getId() {
		return array(
			'fid' => $this->fid,
			'isdn' => $this->isdn
		);
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
					'attributes' => 'fid, isdn',
					'errorMessage' => Yii::t('isms', 'This ISDN number is already exists') ,
				)
			) ,
		));
	}
}

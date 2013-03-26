<?php
/**
 * This is the model base class for the table "syntax".
 *
 * Columns in table "syntax" available as properties of the model:
 * @property integer $fid
 * @property string  $syntax
 * @property boolean $type
 *
 * Relations of table "syntax" available as properties of the model:
 * @property FilterSyntax[] $filterSyntaxes
 */
class Syntax extends BaseActiveRecord {
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string name of the class table
	 */
	public function tableName() {
		return '{{syntax}}';
	}
	/**
	 * Define validation rules
	 */
	public function rules() {
		return array_merge(parent::rules(), array(
			array( '*', 'uniqueKeys' ) ,
			array('filter', 'safe'),
		));
	}
	/**
	 * Relation to other models
	 */
	public function relations() {
		return array(
			'filter' => array( self::BELONGS_TO, 'Filter', 'fid' ) ,
		);
	}
	/**
	 * Provide default sorting and optional condition
	 */
	public function defaultScope() {
		return array(
			'order' => 'syntax ASC',
		);
	}
	public function getId() {
		return array( 'fid' => $this->fid, 'syntax' => $this->syntax );
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
					'attributes' => 'fid, syntax',
					'errorMessage' => Yii::t('isms', 'This syntax is already exists in this filter') ,
				)
			) ,
		));
	}

	const TYPE_BLACKLIST = 0;
	const TYPE_WHITELIST = 1;

	public static function typeOption($param = NULL) {
		$options = array(
				self::TYPE_BLACKLIST	=>	Yii::t('isms', "Blacklist"),
				self::TYPE_WHITELIST		=>	Yii::t('isms', "Whitelist"),
		);
		if (is_null($param)) return $options;
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}
}

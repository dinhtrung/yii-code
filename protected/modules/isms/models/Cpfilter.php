<?php
/**
 * This is the model base class for the table "campaign_filter".
 *
 * Columns in table "campaign_filter" available as properties of the model:
 * @property integer $id
 * @property integer $cid
 * @property integer $fid
 * @property integer $type
 *
 * Relations of table "campaign_filter" available as properties of the model:
 * @property Filter $f
 * @property Campaign $c
 */
class Cpfilter extends BaseActiveRecord {
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
	 * @return string name of the class table
	 */
	public function tableName() {
		return '{{cpfilter}}';
	}
	/**
	 * Define validation rules
	 */
	public function rules() {
		return array_merge(parent::rules(), array(
			array( '*', 'uniqueKeys' ) ,
		));
	}
	/**
	 * Relation to other models
	 */
	public function relations() {
		return array(
			'f' => array( self::BELONGS_TO, 'Filter', 'fid' ) ,
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
	public function uniqueKeys() {
		$this->validateCompositeUniqueKeys();
	}


	const TYPE_WHITELIST = 1;
	const TYPE_BLACKLIST = 0;

	public static function typeOption($param = NULL) {
		$options = array(
				self::TYPE_WHITELIST	=>	Yii::t('isms', "Whitelist"),
				self::TYPE_BLACKLIST		=>	Yii::t('isms', "Blacklist"),
		);
		if (is_null($param)) return $options;
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}
	public function behaviors() {
		return array_merge(parent::behaviors() , array(
			'ECompositeUniqueKeyValidatable' => array(
				'class' => 'ext.behaviors.ECompositeUniqueKeyValidatable',
				'uniqueKeys' => array(
					'attributes' => 'fid, cid, type',
					'errorMessage' => Yii::t('isms', 'This Syntax is already in the filter') ,
				)
			) ,
		));
	}

	/*
	 * CREATE TABLE IF NOT EXISTS `cpfilter` (
  `cid` int(11) NOT NULL COMMENT 'Campaign.id',
  `fid` int(11) NOT NULL COMMENT 'Filter.id',
  `type` int(1) NOT NULL COMMENT '0:blacklist, 1:whitelist',
  PRIMARY KEY (`cid`,`fid`),
  KEY `fid` (`fid`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	*/
	protected function createTable() {
		$columns = array(
				'cid'	=>	'int',
				'fid'	=>	'int',
				'type'	=>	'boolean',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->addPrimaryKey('cid_fid', $this->tableName(), 'fid,cid')
		)->execute();
	}
}

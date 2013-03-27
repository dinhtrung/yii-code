<?php
/**
 * This is the model base class for the table "filter".
 *
 * Columns in table "filter" available as properties of the model:
 * @property integer $id
 * @property string $title
 * @property string $reply_refuse
 * @property string $reply_accept
 * @property string $reply_false_syntax
 * @property string $description
 * @property ftpblack
 * @property ftpblackfile
 * @property ftpwhite
 * @property ftpwhitefile
 *
 * Relations of table "filter" available as properties of the model:
 * @property string $accept_count
 * @property string $refuse_count
 * @property Blacklist[] $blacklists
 * @property Cpfilter[] $Cpfilters
 * @property FilterSyntax[] $filterSyntaxes
 * @property Whitelist[] $whitelists
 * @property Ftpsetting $ftpblacklist
 * @property Ftpsetting $ftpwhitelist
 */
class Filter extends BaseActiveRecord {
	public $whiteSyntax;
	public $blackSyntax;
	private $dir;
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
		return (string)$this->title;
	}
	/**
	 * @return string name of the class table
	 */
	public function tableName() {
		return '{{filter}}';
	}
	/**
	 * Define validation rules
	 */
	public function rules() {
		return array_merge(parent::rules(), array(
				array( 'whiteSyntax, blackSyntax', 'safe', 'on' => 'update, insert' ) ,
		));
	}

	/**
	 * Get the aliasectory that store gallery, ensure that this aliasectory actually exists.
	 */
	public function getDirectory() {
		if (is_null($this->dir)) {
			$this->dir = DirectoryHelper::safe_directory(Yii::getPathOfAlias("application") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("File", "public_directory", "data") . DIRECTORY_SEPARATOR . 'filters');
		}
		return $this->dir;
	}
	/**
	 * Relation to other models
	 */
	public function relations() {
		return array(
			'blacklists' => array( self::HAS_MANY, 'Blacklist', 'fid' ) ,
			'accept_count' => array( self::STAT, 'Blacklist', 'fid', ),
			'whitelists' => array( self::HAS_MANY, 'Whitelist', 'fid' ) ,
			'refuse_count' => array( self::STAT, 'Whitelist', 'fid', ),
			'Cpfilters' => array( self::HAS_MANY, 'Cpfilter', 'fid' ) ,
			'ftpblacklist'	=>	array(self::BELONGS_TO, 'Ftpsetting', 'ftpblack'),
			'ftpwhitelist'	=>	array(self::BELONGS_TO, 'Ftpsetting', 'ftpwhite'),
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
	 * Run after save()
	 */
	protected function afterSave() {
		Syntax::model()->deleteAllByAttributes(array(
			'fid' => $this->id
		));
		if (is_string($this->blackSyntax)) {
			$this->blackSyntax = explode("\n", $this->blackSyntax);
			foreach ($this->blackSyntax as $syntax) {
				if (trim($syntax)) {
					$n = new Syntax();
					$n->fid = $this->id;
					$n->syntax = strtoupper(trim($syntax));
					$n->type = 0;
					$n->save();
				}
			}
		}
		if (is_string($this->whiteSyntax)) {
			$this->whiteSyntax = explode("\n", $this->whiteSyntax);
			foreach ($this->whiteSyntax as $syntax) {
				if (trim($syntax)) {
					$n = new Syntax();
					$n->fid = $this->id;
					$n->syntax = strtoupper(trim($syntax));
					$n->type = 1;
					$n->save();
				}
			}
		}
		return parent::afterSave();
	}

	/*
	CREATE TABLE IF NOT EXISTS `filter` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(20) DEFAULT NULL COMMENT 'Ten cua bo loc tin nhan',
	`reply_refuse` varchar(256) DEFAULT 'Ban da tu choi thanh cong dich vu' COMMENT 'Noi dung tin nhan tra loi khi khach hang dang ky tu choi tin nhan qua bo loc nay',
	`reply_accept` varchar(256) DEFAULT 'Ban da chap nhan thanh cong dich vu' COMMENT 'Noi dung tin nhan tra loi khi khach hang dang ky nhan tin nhan qua bo loc nay',
	`reply_false_syntax` varchar(256) DEFAULT 'Ban da nhap sai cu phap',
	`description` varchar(256) DEFAULT NULL COMMENT 'Mo ta cho bo loc tin nhan nay',
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
	*/
	protected function createTable() {
		$columns = array(
				'id'	=>	'pk',
				'title'	=>	'string',
				'description' => 'text',
				'reply_refuse' => 'string',
				'reply_accept' => 'string',
// 				'reply_refuse' => 'string',
// 				'reply_refuse' => 'string',
// 				'tid'	=>	'int',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
	}
}

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
		return array(
			array( 'whiteSyntax, blackSyntax', 'safe', 'on' => 'update, insert' ) ,
			array( 'title, accept_count, refuse_count, ftpblack, ftpwhite', 'length', 'max' => 20 ) ,
			array( 'reply_refuse, reply_accept, reply_false_syntax, description, ftpblackfile, ftpwhitefile', 'length', 'max' => 256 ) ,
			array(
				'id, title, reply_refuse, reply_accept, reply_false_syntax, description',
				'safe',
				'on' => 'search'
			) ,
		);
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
}

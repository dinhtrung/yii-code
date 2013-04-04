<?php

/**
 * This is the model base class for the table "ftpsetting".
 *
 * Columns in table "ftpsetting" available as properties of the model:
 * @property integer $id
 * @property integer $cid
 * @property string $title
 * @property string $description
 * @property string $hostname
 * @property string $username
 * @property string $password
 * @property string $path
 *
 * Relations of table "ftpsetting" available as properties of the model:
 * @property Campaign[] $campaigns
 * @property Cpfilter $c
 */
class Ftpsetting extends BaseActiveRecord{

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
		return '{{ftpsetting}}';
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
			'cid' => array(self::HAS_MANY, 'Campaign', 'ftpserver'),
			'blacksync' => array(self::HAS_MANY, 'Filter', 'ftpblack'),
			'whitesync' => array(self::HAS_MANY, 'Filter', 'ftpwhite'),
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
	 * Return the FTP URL used by CURL
	 */
	function getUrl() {
		if (! empty($this->password)) {
			return rtrim("ftp://" . $this->username . ':' . $this->password . '@' . $this->hostname . '/' . $this->path, '/') . '/';
		} else {
			return rtrim("ftp://" . $this->hostname . '/' . $this->path, '/') .'/';
		}
	}

	/*
	CREATE TABLE IF NOT EXISTS `ftpsetting` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL COMMENT 'Ten ket noi FTP',
	`description` text NOT NULL COMMENT 'Thong tin mo ta',
	`hostname` varchar(40) NOT NULL COMMENT 'IP hoac hostname cua May chu FTP',
	`path` varchar(255) NOT NULL COMMENT 'Duong dan tren may chu FTP, khong co / o truoc va sau',
	`username` varchar(40) NOT NULL COMMENT 'Thong tin dang nhap neu co',
	`password` varchar(40) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
	*/
	protected function createTable() {
		$columns = array(
				'id'	=>	'pk',
				'title'	=>	'string',
				'description'	=>	'text',
				'hostname'	=>	'string',
				'path'	=>	'string',
				'username'	=>	'string',
				'password'	=>	'string',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
	}
}

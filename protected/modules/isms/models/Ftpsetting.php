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
}

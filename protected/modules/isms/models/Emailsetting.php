<?php

/**
 * This is the model base class for the table "emailsetting".
 *
 * Columns in table "emailsetting" available as properties of the model:
 * @property integer $id
 * @property string $hostname
 * @property string $email
 * @property string $password
 * @property string $option
 *
 * Relations of table "emailsetting" available as properties of the model:
 * @property Campaign[] $campaigns
 */
class Emailsetting extends BaseActiveRecord{

	private $status;
	public $username;
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
		return $this->email;
	}
	/**
	* @return string name of the class table
	*/
	public function tableName()
	{
		return '{{emailsetting}}';
	}
	/**
	* Relation to other models
	*/
	public function relations()
	{
		return array(
			'campaigns'	=>	array(self::HAS_MANY, 'Campaign', 'emailbox'),
		);
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'hostname ASC',
		);
	}
	/**
	* Run before validate()
	*/
	protected function beforeValidate() {
		if (is_array($this->option)) $this->option = implode('/', $this->option);
		return parent::beforeValidate();
	}
	/**
	 * List available options for php_imap.
	 * @param string $param	The option value to reference for.
	 */
	public static function optionOption($param = NULL) {
		$options = array(
			'debug' => Yii::t('isms', 'Enable Debug'),
			'secure' => Yii::t('isms', 'Do not transmit a plaintext password over the network'),
			'imap' => Yii::t('isms', 'Using IMAP service'),
			'pop3' => Yii::t('isms', 'Using POP3 service'),
			'nntp' => Yii::t('isms', 'Using NNTP service'),
			'norsh' => Yii::t('isms', 'Do not use rsh or ssh to establish a preauthenticated IMAP session'),
			'ssl' => Yii::t('isms', 'Use the Secure Socket Layer to encrypt the session'),
			'novalidate-cert' => Yii::t('isms', 'Do not validate certificates from TLS SSL server'),
			'tls' => Yii::t('isms', 'Force use of start-TLS to encrypt the session, and reject connection to servers that do not support it'),
			'notls' => Yii::t('isms', 'Do not do start-TLS to encrypt the session, even with servers that support it'),
			'readonly' => Yii::t('isms', 'Request read-only mailbox open (IMAP only; ignored on NNTP, and an error with SMTP and POP3)'),
		);
		if (is_null($param)) return $options;
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	function getMailbox() {
		return '{' . trim($this->hostname) . '/' . trim($this->option) . '}INBOX';
	}

	function getStatus(){
		if (is_null($this->status)) {
			$mailbox = $this->openMailbox();
			if ($mailbox === FALSE){
				$this->status = FALSE;
			} else {
				$this->status = TRUE;
				imap_close($mailbox);
			}
		}
		return $this->status;
	}

	function openMailbox() {
		if (! function_exists('imap_open')) return FALSE;
		$connection = @imap_open($this->getMailbox(), $this->getUsername(), $this->password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'));
		return $connection;
	}

	public function getUsername(){
		if (empty($this->username)) {
			$this->username = explode('@', $this->email);
			$this->username = $this->username[0];
		}
		return $this->username;
	}

	/*
	 * CREATE TABLE IF NOT EXISTS `emailsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(40) NOT NULL COMMENT 'IP hoac hostname cua mail server',
  `email` varchar(255) NOT NULL COMMENT 'Dia chi Email',
  `password` varchar(255) NOT NULL COMMENT 'Mat khau dang nhap',
  `option` varchar(255) NOT NULL COMMENT 'Cac tham so cua imap_open',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
	*/
	protected function createTable() {
		$columns = array(
				'id'	=>	'pk',
				'hostname'	=>	'string',
				'email'	=>	'string',
				'password'	=>	'string',
				'option'	=>	'text',
		);
		$this->getDbConnection()->createCommand(
				$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
	}
}

<?php
/**
* This is the model base class for the table "campaign".
 * The followings are the available columns in table 'campaign':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $createtime
 * @property integer $updatetime
 * @property string $codename
 * @property string $request_date
 * @property string $request_owner
 * @property string $datasender
 * @property string $tosubscriber
 * @property string $start
 * @property string $end
 * @property integer $status
 * @property integer $approved
 * @property integer $finished
 * @property integer $active
 * @property string $sender
 * @property integer $ready
 * @property integer $type
 * @property integer $throughput
 * @property integer $col
 * @property integer $isdncol
 * @property string $template
 * @property integer $priority
 * @property integer $velocity
 * @property string $cpworkday
 * @property integer $emailbox
 * @property string $esubject
 * @property string $eattachment
 * @property integer $ftpserver
 * @property integer $smsimport
 * @property integer $blockimport
 * @property bool $limit_exceeded
 * @property integer $send
 * @property integer $blocksend
 * @property integer $sent
 * @property integer $blocksent
* Columns in table "campaign" available as properties of the model:
*
* SQLBOX properties:
* @property integer $id
* @property integer $status
* @property integer $active
* @property integer $ready
* @property integer $type
* @property string $throughput
* @property integer $priority
* @property integer $velocity
*
* SMS properties:
* @property integer $col
* @property integer $isdncol
* @property string $sender
* @property string $template
*
* Extra information properties
* @property string $title
* @property string $description
* @property integer $createtime
* @property integer $updatetime
* @property string $request_date
* @property string $request_owner
* @property string $datasender
* @property string $tosubscriber
* @property integer $org
* @property string $codename

* Entity type
* @property integer $type
*
* Start & stop
* @property	datetime	$start
* @property	datetime	$end
* @property	string	$cpworkday
*
* Email Campaign
* @property	int	$emailbox
* @property	string	$esubject
* @property	string	$eattachment
*
* FTP Campaign
* @property int $ftpserver
*
* Relations of table "campaign" available as properties of the model:
* @property Cpfilter[] $filters
*/
class Campaign extends BaseActiveRecord
{
	public $acceptFilters;
	public $denyFilters;
	public $datafiles;
	private $dir;
	public $cpworktimes;
	public $ftpfilenames = array();
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	function __toString() {
		return $this->title;
	}
	/**
	* Initializes this model.
	* Set default values here
	*/
	public function init() {
		if ($this->getScenario() == 'insert'){
			if (empty($this->priority)) $this->priority = self::PRIORITY_MEDIUM;
			if (empty($this->throughput)) $this->throughput = self::THROUGHPUT_MEDIUM;
			if (empty($this->col)) $this->col = 1;
			if (empty($this->isdncol )) $this->isdncol  = 1;
			if (empty($this->active)) $this->active = self::ACTIVE_PENDING;
			if (empty($this->status)) $this->status = self::STATUS_ENABLE;
			if (empty($this->ready)) $this->ready = self::READY_NOTYET;
			if (empty($this->cpworkday)) $this->cpworkday = '1234567';
			if (Yii::app()->getComponent('user', FALSE)) $this->sender = UserModule::user()->sender;
		}
		return parent::init();
	}

	public function tableName()
	{
		return '{{campaign}}';
	}

	public function myCampaign(){
		$criteria = new CDbCriteria();
		$criteria->join = 'LEFT JOIN cporder o ON t.id = o.cid LEFT JOIN smsorder s ON o.oid = s.id LEFT JOIN users u ON s.userid = u.id';
		$criteria->compare('u.id', UserModule::user()->getId());
		return $this->search($criteria);
	}

	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('cpworktimes, filters, cpf, worktimes, ftpfilenames, acceptFilters, denyFilters, datafiles, cporders', 'safe'),
		));
	}

	public function relations()
	{
		return array(
			'filters' => array(self::HAS_MANY, 'Cpfilter', 'cid'),
			'cpf' => array(self::HAS_MANY, 'Cpfile', 'cid'),
			'worktimes' => array(self::MANY_MANY, 'Worktime', 'cpworktime(cid, tid)'),
			'cporders' => array(self::HAS_MANY, 'Cporder', 'cid'),
			'ftpfilenames' => array(self::HAS_MANY, 'Ftpfilename', 'cid'),
			'send'	=>	array(self::HAS_MANY, 'Sendsms', 'campaign_id'),
			'sent'	=>	array(self::HAS_MANY, 'Sentsms', 'campaign_id'),
		);
	}

	function attributeLabels() {
		return array_merge(parent::attributeLabels(), array(
			'worktimes'	=>	Yii::t('isms', 'Worktime'),
			'cpf'	=>	Yii::t('isms', 'Exists Datafiles'),
			'datafiles'	=>	Yii::t('isms', 'Upload datafiles'),
			'ftpfilenames'	=>	Yii::t('isms', 'Datafiles retrieve from FTP'),
			'filters'	=>	Yii::t('isms', 'Campaign Filters'),
			'acceptFilters'	=>	Yii::t('isms', 'Add ISDN from following filters'),
			'denyFilters'	=>	Yii::t('isms', 'Remove ISDN from following filters'),
		));
	}
	/**
	* Provide default sorting and optional condition
	*/
	public function defaultScope() {
		return array(
			'order' => 'updatetime DESC',
		);
	}

	protected function beforeValidate(){
		if (is_array($this->cpworkday)) $this->cpworkday = implode('', $this->cpworkday);
		return parent::beforeValidate();
	}

	/** Delete Has Many Relations **/
	protected function deleteHasManyRelations(){
		Sendsms::model()->deleteAllByAttributes(array('campaign_id' => $this->id));
//		Sentsms::model()->deleteAllByAttributes(array('cid' => $this->id));
		Cpworktime::model()->deleteAllByAttributes(array('cid' => $this->id));
		Cpfilter::model()->deleteAllByAttributes(array( 'cid' => $this->id));
//		Cporder::model()->deleteAllByAttributes(array( 'cid' => $this->id));
	}
	/** Insert Has Many Relations **/
	protected function insertHasManyRelations(){
		if (is_array($this->acceptFilters)) {
			foreach ($this->acceptFilters as $fid) {
				$n = new Cpfilter();
				$n->type = 1;
				$n->cid = $this->id;
				$n->fid = $fid;
				$n->save();
			}
		}
		if (is_array($this->denyFilters)) {
			foreach ($this->denyFilters as $fid) {
				$n = new Cpfilter();
				$n->type = 0;
				$n->cid = $this->id;
				$n->fid = $fid;
				$n->save();
			}
		}
		// Worktimes
		if (is_array($this->cpworktimes)) {
			foreach ($this->cpworktimes as $tid){
				$n = new Cpworktime();
				$n->cid = $this->id;
				$n->tid = $tid;
				$n->save();
			}
		}

		if (is_array($this->cporders)) {
			foreach ($this->cporders as $oid){
				$n = new Cporder();
				$n->cid = $this->id;
				$n->oid = $oid;
				$n->save();
			}
		}
	}
	/**
	* Run before save()
	*/
	protected function beforeSave() {
		if (($this->getScenario() == 'insert') OR ($this->getScenario() == 'update')){
			if (empty($this->approved)) $this->approved = self::APPROVED_FALSE;
			if (is_array($this->cpworkday)) $this->cpworkday = implode('', $this->cpworkday);
			$this->template = TextHelper::utf2ascii($this->template);
			$this->limit_exceeded = $this->getLimitExceeded();
			$this->velocity = self::VELOCITY;
			if (empty($this->priority)) $this->priority = self::PRIORITY_MEDIUM;
		}
		return parent::beforeSave();
	}

	protected function beforeDelete(){
		$this->deleteHasManyRelations();
		@unlink("/var/www/isms/results/campaign_" . $this->id . ".tar.gz");
		return parent::beforeDelete();
	}
	/**
	 * Run after save()
	 */
	protected function afterSave() {
		if ($this->getScenario() == 'insert'){
			$this->insertHasManyRelations();
		} elseif ($this->getScenario() == 'update'){
			$this->deleteHasManyRelations();
			$this->insertHasManyRelations();
		}
		return parent::afterSave();
	}

	/**
	 * Get the aliasectory that store gallery, ensure that this aliasectory actually exists.
	 */
	public function getDirectory() {
		if (is_null($this->dir)) {
			$this->dir = DirectoryHelper::safe_directory(Yii::getPathOfAlias("application") . DIRECTORY_SEPARATOR . Yii::app()->setting->get("File", "public_directory", "data") . DIRECTORY_SEPARATOR . 'campaigns');
		}
		return $this->dir;
	}


	/** Helper functions for select options **/
	/*
	 * Throughput : Number of records per selection of Sqlbox
	*/
	const THROUGHPUT_LOWEST = 20;
	const THROUGHPUT_LOWER	= 40;
	const THROUGHPUT_LOW	= 60;
	const THROUGHPUT_MEDIUM	= 80;
	const THROUGHPUT_HIGH	= 100;
	const THROUGHPUT_HIGHER	= 120;
	const THROUGHPUT_HIGHEST= 140;
	public static function throughputOption($param = NULL) {
		$options = array(
			self::THROUGHPUT_LOWEST => Yii::t('isms', 'Minimum speed'),
			self::THROUGHPUT_LOWER	=> Yii::t('isms', 'Lower speed'),
			self::THROUGHPUT_LOW	=> Yii::t('isms', 'Low speed'),
			self::THROUGHPUT_MEDIUM	=> Yii::t('isms', 'Normal speed'),
			self::THROUGHPUT_HIGH	=> Yii::t('isms', 'High speed'),
			self::THROUGHPUT_HIGHER	=> Yii::t('isms', 'Higher speed'),
			self::THROUGHPUT_HIGHEST=> Yii::t('isms', 'Highest speed'),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; } }
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}
	/*
	 * Velocity : Number of records per selection of Sqlbox
	*/
	const VELOCITY = 150;
	public static function velocityOption($param = NULL) {
		$options = array(
			self::VELOCITY => Yii::t('isms', 'SMS per routine'),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; } }
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}
	/*
	 * Velocity : Number of records per selection of Sqlbox
	*/
	const PRIORITY_LOWEST 	= 0;
	const PRIORITY_LOWER	= 1;
	const PRIORITY_LOW		= 2;
	const PRIORITY_MEDIUM	= 3;
	const PRIORITY_HIGH		= 4;
	const PRIORITY_HIGHER	= 5;
	const PRIORITY_HIGHEST	= 6;
	public static function priorityOption($param = NULL) {
		$options = array(
			self::PRIORITY_LOWEST => Yii::t('isms', 'Minimum priority'),
			self::PRIORITY_LOWER	=> Yii::t('isms', 'Lower priority'),
			self::PRIORITY_LOW	=> Yii::t('isms', 'Low priority'),
			self::PRIORITY_MEDIUM	=> Yii::t('isms', 'Normal priority'),
			self::PRIORITY_HIGH	=> Yii::t('isms', 'High priority'),
			self::PRIORITY_HIGHER	=> Yii::t('isms', 'Higher priority'),
			self::PRIORITY_HIGHEST=> Yii::t('isms', 'Highest priority'),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; }
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	const STATUS_ENABLE = 1;
	const STATUS_DISABLE = 0;

	public static function statusOption($param = NULL) {
		$options = array(
				self::STATUS_ENABLE		=>	Yii::t('isms', "Enabled"),
				self::STATUS_DISABLE	=>	Yii::t('isms', "Disabled"),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; }
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	const FINISHED_TRUE 	= 1;
	const FINISHED_FALSE	= 0;

	public static function finishedOption($param = NULL) {
		$options = array(
				self::FINISHED_FALSE		=>	Yii::t('isms', "Not finished"),
				self::FINISHED_TRUE	=>	Yii::t('isms', "Has Finished"),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; }
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	const APPROVED_TRUE = 1;
	const APPROVED_FALSE= 0;
	public static function approvedOption($param = NULL) {
		$options = array(
				self::APPROVED_FALSE	=>	Yii::t('isms', "Not Approved"),
				self::APPROVED_TRUE		=>	Yii::t('isms', "Approved Okay"),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; }
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	const ACTIVE_PENDING = 0;
	const ACTIVE_RUNNING = 1;
	public static function activeOption($param = NULL) {
		$options = array(
				self::ACTIVE_PENDING	=>	Yii::t('isms', "Not Activated"),
				self::ACTIVE_RUNNING	=>	Yii::t('isms', "Activated"),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; }
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	const LIMIT_EXCEEDED = 1;
	const LIMIT_AVAILABLE = 0;
	public static function limit_exceededOption($param = NULL) {
		$options = array(
				self::LIMIT_AVAILABLE	=>	Yii::t('isms', "SMS Order can be charged."),
				self::LIMIT_EXCEEDED	=>	Yii::t('isms', "More SMS Order required..."),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; }
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	const READY_NOTYET	= 0;
	const READY_IMPORT	= 1;
	const READY_ALL		= 2;
	public static function readyOption($param = NULL) {
		$options = array(
				self::READY_NOTYET		=>	Yii::t('isms', "No data imported"),
				self::READY_IMPORT		=>	Yii::t('isms', "Has data imported, but not filtered."),
				self::READY_ALL			=>	Yii::t('isms', "Finished import files, ready to run."),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; }
		elseif (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}

	public static function cpweekdayOption($param = NULL) {
		$options = array(
		1	=>	Yii::t('app', "Sunday"),
		2	=>	Yii::t('app', "Monday"),
		3	=>	Yii::t('app', "Tuesday"),
		4	=>	Yii::t('app', "Wednesday"),
		5	=>	Yii::t('app', "Thursday"),
		6	=>	Yii::t('app', "Friday"),
		7	=>	Yii::t('app', "Saturday"),
		);
		if (is_null($param)) { foreach ($options as $k => $v) $options[$k] = strip_tags($v); return $options; }
		elseif (array_key_exists((int) $param, $options)) return $options[(int) $param];
		else return NULL;
	}


	public function scope(){
		return array(
			'finished'	=>	array('condition' => 'finished=' . self::FINISHED_TRUE),
			'locked'	=>	array('condition' => 'ready=' . self::READY_IMPORT),
		);
	}

	public function isLocked(){
		return (bool) (/*($this->ready == self::READY_IMPORT) || ($this->ready == self::READY_ALL) || */($this->finished == self::FINISHED_TRUE) || ($this->active == self::ACTIVE_RUNNING));
	}

	public function getSent(){
		if ($this->getPrimaryKey()){
			if (! is_null($this->sent) AND ($this->finished == self::FINISHED_TRUE) AND ($this->sent != 0)) return $this->sent;
			$this->sent = Yii::app()->getDb()->createCommand("SELECT COUNT(*) FROM sent_sms WHERE campaign_id = " . $this->getPrimaryKey() . " AND ((dlr IS NULL) OR (dlr = 1))")
			->queryScalar();
			if ($this->finished == self::FINISHED_TRUE){
				$sent = intval($this->sent);
				Yii::app()->db->createCommand('UPDATE campaign SET sent='.$sent.' WHERE id='.$this->getPrimaryKey())->execute();
			}
			return $this->sent;
		}
		else return NULL;
	}

	public function getBlocksent(){
		if ($this->getPrimaryKey()){
			if (! is_null($this->blocksent) AND ($this->finished == self::FINISHED_TRUE) AND ($this->blocksent != 0)) return $this->blocksent;
			if (strpos($this->template, '{') === FALSE){
    			$this->blocksent = ceil(strlen($this->template) / 160) * $this->getSent();
			} else {
					$this->blocksent = Yii::app()->db->createCommand( "SELECT SUM(CEIL(CHAR_LENGTH(URLDECODE(msgdata))/160)) AS count FROM {{sent_sms}} WHERE campaign_id = :id AND ((dlr IS NULL) OR (dlr = 1))")->queryScalar(array(':id' => $this->id));
			}
			if ($this->finished == self::FINISHED_TRUE){
				$sent = intval($this->blocksent);
				Yii::app()->db->createCommand('UPDATE campaign SET blocksent='.$sent.' WHERE id='.$this->getPrimaryKey())->execute();
				Yii::app()->db->createCommand('UPDATE cporder SET smsblock=0 WHERE cid='.$this->getPrimaryKey())->execute();
				$orders = Cporder::model()->with('o')->findAllByAttributes(array('cid' => $this->getPrimaryKey()));
				$quota = 0;
				foreach ($orders as $o){
					$smsorder = $o->getRelated('o', TRUE);
					if ($smsorder instanceof Smsorder)
						$quota += $smsorder->getSmsleft();
				}
				if ($sent > $quota)
					$this->limit_exceeded = Campaign::LIMIT_EXCEEDED;
				else {
					foreach ($orders as $o){
						$smsorder = $o->getRelated('o', TRUE);
					 	if (! ($smsorder instanceof Smsorder)) continue;
						$t = $smsorder->getSmsleft();	// so block SMS con lai cua don hang
				  		if ($t <= $sent){		// Don hang khong du?
				  			$o->smsblock = $t;
				  		} else {
				  			$o->smsblock = $sent;	// Don hang du?
				  		}
				  		$sent -= $o->smsblock;
						$o->save();
				  	}
				  	$this->limit_exceeded = Campaign::LIMIT_AVAILABLE;
				}
			}
			return $this->blocksent;
		}
		return NULL;
	}


	public function getSend(){
		if ($this->getPrimaryKey()){
			if (! is_null($this->send) AND ($this->finished == self::FINISHED_TRUE)) return $this->send;
			$this->send = Yii::app()->getDb()->createCommand("SELECT COUNT(*) FROM send_sms WHERE campaign_id = " . $this->getPrimaryKey())
			->queryScalar();
			if ($this->finished == self::FINISHED_TRUE)
				Yii::app()->db->createCommand('UPDATE campaign SET send='.intval($this->send).' WHERE id='.$this->getPrimaryKey())->execute();
			return $this->send;
		}
		else return NULL;
	}

	public function getBlocksend(){
		if ($this->getPrimaryKey()){
			if (! is_null($this->blocksend) AND ($this->finished == self::FINISHED_TRUE))  return $this->blocksend;
			if (strpos($this->template, '{') === FALSE){
    			$this->blocksend = ceil(strlen($this->template) / 160) * $this->getSend();
	    } else {
	    		$this->blocksend = Yii::app()->db->createCommand( "SELECT SUM(CEIL(CHAR_LENGTH(URLDECODE(msgdata))/160)) AS count FROM {{send_sms}} WHERE campaign_id = :id")->queryScalar(array(':id' => $this->id));
	    }
	    if ($this->finished == self::FINISHED_TRUE)
		    Yii::app()->db->createCommand('UPDATE campaign SET blocksend= '.intval($this->blocksend).' WHERE id = '.$this->getPrimaryKey())->execute();
	    return $this->blocksend;
		}
		return NULL;
	}


	public function getLimitExceeded(){
		if ($this->getPrimaryKey()){
			$smsblock = Yii::app()->getDb()->createCommand("SELECT SUM(smsblock) FROM cporder WHERE cid = " . $this->getPrimaryKey())->queryScalar();
			$orderblock = Yii::app()->getDb()->createCommand("SELECT SUM(smscount) FROM smsorder LEFT JOIN cporder ON cporder.oid=smsorder.id WHERE cporder.cid = " . $this->getPrimaryKey())->queryScalar();
			if ($this->blockimport > ($orderblock - $smsblock))
				return self::LIMIT_EXCEEDED;
			else
				return self::LIMIT_AVAILABLE;
		}
		else return self::LIMIT_AVAILABLE;
	}


	protected function createTable(){

		$columns = array(
		 		'id'	=>	'pk',
		 		'title'	=>	'string',
		 		'description'	=>	'text',
		 		'status'	=>	'boolean',
		 		'approved'	=>	'boolean',
		 		'active'	=>	'boolean',
		 		'ready'	=>	'boolean',
		 		'limit_exceeded'	=>	'boolean',
		 		'priority'	=>	'int',
		 		'velocity'	=>	'int',
		 		'throughput'	=>	'int',
		 		'col'	=>	'int',
		 		'isdncol'	=>	'int',
		 		'template'	=>	'string',
		 );
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
				Yii::app()->getDb()->getSchema()->createIndex('title', $this->tableName(), 'title')
		)->execute();
	}
}

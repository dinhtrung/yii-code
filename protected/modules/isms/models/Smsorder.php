<?php

/**
 * This is the model class for table "smsorder".
 *
 * The followings are the available columns in table 'smsorder':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property integer $createtime
 * @property integer $updatetime
 * @property integer $userid
 * @property string $expired
 * @property integer $smscount
 *
 * The followings are the available model relations:
 * @property Campaign[] $campaigns
 */
class Smsorder extends BaseActiveRecord
{
	public function connectionId() {
		return IsmsModule::getDbComponent();
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Smsorder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function init(){
		parent::init();
		if ($this->getScenario() == 'insert'){
			$this->userid = Yii::app()->getUser()->getId();
		}
	}


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{smsorder}}';
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cporders' => array(self::HAS_MANY, 'Cporder', 'oid'),
			'user'	=>	array(self::BELONGS_TO, 'User', 'userid'),
		);
	}

	/*
		Calculate the sms left for this order.
		Only sum block import for campaign which is Enable+Activated, or Finished...
	*/
	public function getSmsleft(){
		if ($this->getPrimaryKey())
		return $this->smscount - Yii::app()->getDb()->createCommand("SELECT SUM(`smsblock`) FROM cporder LEFT JOIN campaign ON cporder.cid = campaign.id WHERE ((campaign.status=1 AND campaign.approved=1) OR campaign.finished=1) AND cporder.oid=" . $this->getPrimaryKey())
		->queryScalar();
		else return NULL;
	}

	public function getSelectTitle(){
		return $this->title . ' <' . ($this->smsleft ). '>';
	}

	public function beforeSave(){
		if ($this->expired < date('Y-m-d H:i:s')) $this->status = self::STATUS_OUTDATE;
		return parent::beforeSave();
	}


	public function getOwner(){
		return $this->user->site . ' - ' . $this->user->username;
	}

	const STATUS_TRUE = 1;
	const STATUS_FALSE = 0;
	const STATUS_OUTDATE = -1;
	public static function statusOption($param = NULL) {
		$options = array(
			self::STATUS_TRUE => Yii::t('app', 'Valid Order'),
			self::STATUS_FALSE => Yii::t('app', 'Invalid Order'),
		);
		if (is_null($param)) return $options;
		$options[self::STATUS_OUTDATE] = Yii::t('app', 'Expired');
		if (array_key_exists((string) $param, $options)) return $options[(string) $param];
		else return NULL;
	}
}

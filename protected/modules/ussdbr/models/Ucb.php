<?php

/**
 * This is the model class for table "mbvn_ucb_hist_201306".
 *
 * The followings are the available columns in table 'mbvn_ucb_hist_201306':
 * @property string $data_timestamp
 * @property string $node_id
 * @property string $leg1_cg
 * @property string $leg1_cd
 * @property string $leg1_starttime
 * @property string $leg1_answertime
 * @property string $leg1_endtime
 * @property integer $leg1_callduration
 * @property integer $leg1_status
 * @property string $leg2_cg
 * @property string $leg2_cd
 * @property string $leg2_starttime
 * @property string $leg2_answertime
 * @property string $leg2_endtime
 * @property integer $leg2_callduration
 * @property integer $leg2_status
 * @property string $bridge_starttime
 * @property string $bridge_endtime
 * @property integer $bridge_callduration
 * @property string $ivr_cd
 * @property string $ivr_starttime
 * @property string $ivr_answertime
 * @property string $ivr_endtime
 * @property integer $ivr_callduration
 * @property integer $ivr_status
 * @property string $getnotif_status
 * @property string $notif_type
 * @property string $notif_status
 * @property string $call_type
 * @property string $subscriber_type
 * @property string $redial_type
 * @property string $chargingprefix
 * @property string $reverse_type
 * @property string $diameter_status
 * @property string $diameter_status_refund
 * @property string $getredial_status
 * @property string $updateredial_status
 * @property string $cdr_inserthistory_status
 * @property string $calling_vlr
 * @property string $called_vlr
 */
class Ucb extends EActiveRecord
{
	public $tableSuffix = '';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ucb the static model class
	 */
	public static function model($className=__CLASS__)
	{
		$model = parent::model($className);
		$model->refreshMetaData();
		return $model;
	}
	
	
	public function __construct($scenario = 'insert'){
		try {
			return parent::__construct($scenario);
		} catch (CDbException $e){
			if (! $this->createTable()) throw $e;
			$this->refreshMetaData();
			return parent::__construct($scenario);
		}
	}
	
	public function getClassName(){
		return 'Ucb';
	}
	
	public static function getModel($suffix = NULL) {
		if (is_null($suffix)) $suffix = date('Ym', time());
		$model = new Ucb(null);
		$model->tableSuffix = $suffix;
		$model->createTable();
		return Ucb::model($model); // Register the instance
	}
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		if (empty($this->tableSuffix)) $this->tableSuffix = date('Ym', time());
		return 'mbvn_ucb_hist_' . $this->tableSuffix;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('leg1_callduration, leg1_status, leg2_callduration, leg2_status, bridge_callduration, ivr_callduration, ivr_status', 'numerical', 'integerOnly'=>true),
			array('node_id, getnotif_status, notif_type, notif_status, call_type, subscriber_type, redial_type, chargingprefix, reverse_type, diameter_status, diameter_status_refund, getredial_status, updateredial_status, cdr_inserthistory_status, calling_vlr, called_vlr', 'length', 'max'=>32),
			array('leg1_cg, leg1_cd, leg2_cg, leg2_cd, ivr_cd', 'length', 'max'=>20),
			array('data_timestamp, leg1_starttime, leg1_answertime, leg1_endtime, leg2_starttime, leg2_answertime, leg2_endtime, bridge_starttime, bridge_endtime, ivr_starttime, ivr_answertime, ivr_endtime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('data_timestamp, node_id, leg1_cg, leg1_cd, leg1_starttime, leg1_answertime, leg1_endtime, leg1_callduration, leg1_status, leg2_cg, leg2_cd, leg2_starttime, leg2_answertime, leg2_endtime, leg2_callduration, leg2_status, bridge_starttime, bridge_endtime, bridge_callduration, ivr_cd, ivr_starttime, ivr_answertime, ivr_endtime, ivr_callduration, ivr_status, getnotif_status, notif_type, notif_status, call_type, subscriber_type, redial_type, chargingprefix, reverse_type, diameter_status, diameter_status_refund, getredial_status, updateredial_status, cdr_inserthistory_status, calling_vlr, called_vlr', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('data_timestamp',$this->data_timestamp,true);
		$criteria->compare('node_id',$this->node_id,true);
		$criteria->compare('leg1_cg',$this->leg1_cg,true);
		$criteria->compare('leg1_cd',$this->leg1_cd,true);
		$criteria->compare('leg1_starttime',$this->leg1_starttime,true);
		$criteria->compare('leg1_answertime',$this->leg1_answertime,true);
		$criteria->compare('leg1_endtime',$this->leg1_endtime,true);
		$criteria->compare('leg1_callduration',$this->leg1_callduration);
		$criteria->compare('leg1_status',$this->leg1_status);
		$criteria->compare('leg2_cg',$this->leg2_cg,true);
		$criteria->compare('leg2_cd',$this->leg2_cd,true);
		$criteria->compare('leg2_starttime',$this->leg2_starttime,true);
		$criteria->compare('leg2_answertime',$this->leg2_answertime,true);
		$criteria->compare('leg2_endtime',$this->leg2_endtime,true);
		$criteria->compare('leg2_callduration',$this->leg2_callduration);
		$criteria->compare('leg2_status',$this->leg2_status);
		$criteria->compare('bridge_starttime',$this->bridge_starttime,true);
		$criteria->compare('bridge_endtime',$this->bridge_endtime,true);
		$criteria->compare('bridge_callduration',$this->bridge_callduration);
		$criteria->compare('ivr_cd',$this->ivr_cd,true);
		$criteria->compare('ivr_starttime',$this->ivr_starttime,true);
		$criteria->compare('ivr_answertime',$this->ivr_answertime,true);
		$criteria->compare('ivr_endtime',$this->ivr_endtime,true);
		$criteria->compare('ivr_callduration',$this->ivr_callduration);
		$criteria->compare('ivr_status',$this->ivr_status);
		$criteria->compare('getnotif_status',$this->getnotif_status,true);
		$criteria->compare('notif_type',$this->notif_type,true);
		$criteria->compare('notif_status',$this->notif_status,true);
		$criteria->compare('call_type',$this->call_type,true);
		$criteria->compare('subscriber_type',$this->subscriber_type,true);
		$criteria->compare('redial_type',$this->redial_type,true);
		$criteria->compare('chargingprefix',$this->chargingprefix,true);
		$criteria->compare('reverse_type',$this->reverse_type,true);
		$criteria->compare('diameter_status',$this->diameter_status,true);
		$criteria->compare('diameter_status_refund',$this->diameter_status_refund,true);
		$criteria->compare('getredial_status',$this->getredial_status,true);
		$criteria->compare('updateredial_status',$this->updateredial_status,true);
		$criteria->compare('cdr_inserthistory_status',$this->cdr_inserthistory_status,true);
		$criteria->compare('calling_vlr',$this->calling_vlr,true);
		$criteria->compare('called_vlr',$this->called_vlr,true);

		return new EActiveDataProvider($this->getClassName(), array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
		));
	}
	
	public function defaultScope(){
		return array(
			'order' => 'data_timestamp DESC',
		);
	}
	
	public function getA(){
		return $this->leg1_cd;
	}
	
	public function getB(){
		return ($this->leg2_cd)?($this->leg2_cd):str_replace($this->chargingprefix, '', $this->leg1_cg);
	}
	
	/* Tra ve trang thai cuoc goi 
	* @TODO: Một số trạng thái khác ko lấy được từ DB:
			- A-Party Blacklist
			- A-Party Country Blacklist
			- B-Party Blacklist
			- B-Party Country Blacklist
	*/
	public function getStatus(){
		if ($this->bridge_callduration) return 'Cuộc gọi thành công';
		elseif ($this->bridge_starttime > '0000-00-00 00:00:00') return 'Cuộc gọi thành công';
		elseif ($this->leg2_status == 17) return 'B-Party bận';
		elseif ($this->leg2_status == 20) return 'B-Party Mất kết nối';
		
		return '<strong class="small">KHÔNG THÀNH CÔNG</strong>';		
	}
	
	/**
	 * Automatically create the table if needed...
	 */
	protected function createTable(){
		$columns = array(
				'data_timestamp' => 'string',    //
				'node_id' => 'string',    //
				'leg1_cg' => 'string',    //
				'leg1_cd' => 'string',    //
				'leg1_starttime' => 'string',    //
				'leg1_answertime' => 'string',    //
				'leg1_endtime' => 'string',    //
				'leg1_callduration' => 'integer',    //
				'leg1_status' => 'integer',    //
				'leg2_cg' => 'string',    //
				'leg2_cd' => 'string',    //
				'leg2_starttime' => 'string',    //
				'leg2_answertime' => 'string',    //
				'leg2_endtime' => 'string',    //
				'leg2_callduration' => 'integer',    //
            'leg2_status' => 'integer',    //
				'bridge_starttime' => 'string',    //
				'bridge_endtime' => 'string',    //
				'bridge_callduration' => 'integer',    //
				'ivr_cd' => 'string',    //
				'ivr_starttime' => 'string',    //
				'ivr_answertime' => 'string',    //
				'ivr_endtime' => 'string',    //
				'ivr_callduration' => 'integer',    //
				'ivr_status' => 'integer',    //
				'getnotif_status' => 'string',    //
            'notif_type' => 'string',    //
				'notif_status' => 'string',    //
				'call_type' => 'string',    //
				'subscriber_type' => 'string',    //
				'redial_type' => 'string',    //
				'chargingprefix' => 'string',    //
				'reverse_type' => 'string',    //
            'diameter_status' => 'string',    //
				'diameter_status_refund' => 'string',    //
				'getredial_status' => 'string',    //
				'updateredial_status' => 'string',    //
				'cdr_inserthistory_status' => 'string',    //
				'calling_vlr' => 'string',    //
				'called_vlr' => 'string',    //
		);
		try {
			$this->getDbConnection()->createCommand(
					$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
					)->execute();
			$this->getDbConnection()->createCommand(
	            $this->getDbConnection()->getSchema()->addPrimaryKey('', $this->tableName(), '')
		    )->execute();
		} catch (CDbException $e) { Yii::log($e->getMessage(), 'warning'); }
	}
}

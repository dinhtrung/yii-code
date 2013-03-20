<?php

/**
 * This is the model class for table "cdr".
 *
 * The followings are the available columns in table 'cdr':
 * @property string $time
 * @property string $a_number
 * @property string $b_number
 * @property string $eventid
 * @property string $cpid
 * @property string $contentid
 * @property integer $status
 * @property string $cost
 * @property string $channeltype
 * @property string $information
 */
class Cdr extends BaseActiveRecord
{
	public $time_start;
	public $time_end;
	public $phatsinhcuoc;
	public $khongphatsinhcuoc;
	public $khongtrucuoc;
	public $sanluong;
	public $doanhthu;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cdr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cdr}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('a_number, b_number, eventid, cpid, contentid, cost', 'length', 'max'=>20),
			array('channeltype', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('time, time_start, time_end, a_number, b_number, eventid, cpid, contentid, status, cost, channeltype, information', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'time' => 'Thời gian',
			'time_start' => 'Thời gian bắt đầu',
			'time_end' => 'Thời gian kết thúc',
			'a_number' => 'Số thuê bao',
			'b_number' => 'Mã dịch vụ',
			'eventid' => 'Mã sự kiện',
			'cpid' => 'Mã CP',
			'contentid' => 'Mã nội dung',
			'status' => 'Trạng thái',
			'cost' => 'Cước',
			'channeltype' => 'Loại kênh',
			'information' => 'Thông tin khác',
			// Custom properties
				'phatsinhcuoc' => 'Phát sinh cước',
				'khongphatsinhcuoc' => 'Không phát sinh cước',
				'khongtrucuoc'	=>	'Không trừ cước',
				'sanluong'	=>	'Sản lượng',
				'doanhthu'	=>	'Doanh thu',
		);
	}



	public function summary(){
		$criteria=new CDbCriteria;

		$criteria->group = 'cpid, b_number';
		$criteria->select = 'time,
							cpid,
							b_number,
							COUNT(*) AS sanluong,
							SUM((status = 1) AND (cost = 0)) AS khongphatsinhcuoc,
							SUM((status=1) AND (cost > 0)) AS phatsinhcuoc,
							SUM((status=0)) AS khongtrucuoc,
							SUM(cost) AS doanhthu';
		$criteria->compare('time',$this->time,true);
		$criteria->compare('time', '>=' . $this->time_start);
		$criteria->compare('time', '<=' . $this->time_end);
		$criteria->compare('b_number',$this->b_number,true);
		$criteria->compare('cpid',$this->cpid);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));

	}

	protected function createTable(){
		$columns = array(
				'time'	=>	'datetime',
				'b_number'	=>	'string',
				'a_number'	=>	'string',
				'status'	=>	'boolean',
				'eventid'	=>	'int',
				'cpid'		=>	'int',
				'contentid'	=>	'int',
				'cost'		=>	'float',
				'channeltype'	=>	'string',
				'information'	=>	'string',
		);
		$this->getDbConnection()->createCommand(
			Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			Yii::app()->getDb()->getSchema()->createIndex('time', $this->tableName(), 'time')
		)->execute();
		$this->getDbConnection()->createCommand(
			Yii::app()->getDb()->getSchema()->createIndex('b_number', $this->tableName(), 'b_number')
		)->execute();
		$this->getDbConnection()->createCommand(
			Yii::app()->getDb()->getSchema()->createIndex('cpid', $this->tableName(), 'cpid')
		)->execute();

	}
}
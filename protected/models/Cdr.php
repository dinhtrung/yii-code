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
class Cdr extends CActiveRecord
{
	public $time_start;
	public $time_end;
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
		return 'cdr';
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
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
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

		$criteria->compare('time',$this->time,true);
		$criteria->compare('a_number',$this->a_number,true);
		$criteria->compare('b_number',$this->b_number,true);
		$criteria->compare('eventid',$this->eventid,true);
		$criteria->compare('cpid',$this->cpid,true);
		$criteria->compare('contentid',$this->contentid,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('cost',$this->cost,true);
		$criteria->compare('channeltype',$this->channeltype,true);
		$criteria->compare('information',$this->information,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
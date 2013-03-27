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
	 * Summary reports
	 * @return CActiveDataProvider
	 */
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

	/**
	 * Table structure
	 * @see BaseActiveRecord::createTable()
	 */
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
			$this->getDbConnection()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createIndex('time', $this->tableName(), 'time')
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createIndex('b_number', $this->tableName(), 'b_number')
		)->execute();
		$this->getDbConnection()->createCommand(
			$this->getDbConnection()->getSchema()->createIndex('cpid', $this->tableName(), 'cpid')
		)->execute();

	}
}
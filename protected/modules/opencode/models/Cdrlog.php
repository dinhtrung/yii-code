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
class Cdrlog extends BaseActiveRecord
{
	public function tableName() {
		return '{{cdrlog}}';
	}

	protected function createTable() {
		$columns = array(
				'filename'	=>	'string',
		);
		$this->getDbConnection()->createCommand(
			Yii::app()->getDb()->getSchema()->createTable($this->tableName(), $columns)
		)->execute();
		$this->getDbConnection()->createCommand(
			Yii::app()->getDb()->getSchema()->createIndex('filename', $this->tableName(), 'filename', TRUE)
		)->execute();
	}
}
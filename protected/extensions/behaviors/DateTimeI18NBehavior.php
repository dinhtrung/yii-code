<?php

/*
 * DateTimeI18NBehavior
 * Automatically converts date and datetime fields to I18N format
 *
 * Author: Ricardo Grana <rickgrana@yahoo.com.br>, <ricardo.grana@pmm.am.gov.br>
 * Version: 1.1
 * Requires: Yii 1.0.9 version
 */

class DateTimeI18NBehavior  extends CActiveRecordBehavior
{
	public $dateOutcomeFormat = 'Y-m-d';
	public $dateTimeOutcomeFormat = 'Y-m-d H:i:s';

	public $dateIncomeFormat = 'yyyy-MM-dd';
	public $dateTimeIncomeFormat = 'yyyy-MM-dd hh:mm:ss';

	public $inFormat = 'long|short|medium';
	public $outFormat = 'medium';
	public function beforeSave($event){
		$informat = explode('|', $this->inFormat);

		//search for date/datetime columns. Convert it to pure PHP date format
		foreach($event->sender->tableSchema->columns as $columnName => $column){
			if (($column->dbType != 'date') and ($column->dbType != 'datetime')) continue;
			if (!is_string($event->sender->$columnName)) continue;
			if (!strlen($event->sender->$columnName)){
				$event->sender->$columnName = null;
				continue;
			}

			if (($column->dbType == 'date')) {
				foreach ($informat as $dateWidth) {
					Yii::log("Convert ".$event->sender->$columnName . " from format " . $dateWidth . ":" . Yii::app()->locale->getDateFormat($dateWidth), 'warning', 'ext.behaviors.DateTimeI18N');
					$timestamp = CDateTimeParser::parse($event->sender->$columnName, Yii::app()->locale->getDateFormat($dateWidth));
					if ($timestamp != FALSE) {
						$event->sender->$columnName = date($this->dateOutcomeFormat, $timestamp);
						break;
					}
				}
				if ($timestamp == FALSE) {
					$msg = "";
					foreach ($informat as $dateWidth) {
						$msg .= Yii::app()->locale->getDateFormat($dateWidth)."\n";
					}
					throw new CException("Invalid date time specified: ".$event->sender->$columnName." Available formats are: ".$msg, 500);
				}

			}else{
				foreach ($informat as $dateWidth) {
					Yii::log("Convert ".$event->sender->$columnName . " from format " . $dateWidth . ":" . Yii::app()->locale->getDateFormat($dateWidth), 'warning', 'ext.behaviors.DateTimeI18N');
					$timestamp = CDateTimeParser::parse($event->sender->$columnName,
						strtr('{0} {1}',
							array("{0}" => Yii::app()->locale->getTimeFormat($dateWidth),
								  "{1}" => Yii::app()->locale->getDateFormat($dateWidth))));
					if ($timestamp != FALSE) {
						$event->sender->$columnName = date($this->dateTimeOutcomeFormat, $timestamp);
						break;
					}
					$timestamp = CDateTimeParser::parse($event->sender->$columnName,
						strtr('{1} {0}',
							array("{0}" => Yii::app()->locale->getTimeFormat($dateWidth),
								  "{1}" => Yii::app()->locale->getDateFormat($dateWidth))));
					if ($timestamp != FALSE) {
						$event->sender->$columnName = date($this->dateTimeOutcomeFormat, $timestamp);
						break;
					}
				}
				if ($timestamp == FALSE) {
					$msg = "";
					foreach ($informat as $dateWidth)
						foreach ($informat as $timeWidth)
							$msg .= strtr(Yii::app()->locale->dateTimeFormat, array("{0}" => Yii::app()->locale->getTimeFormat($timeWidth), "{1}" => Yii::app()->locale->getDateFormat($dateWidth)))."\n";
					throw new CException("Invalid date time specified: ".$event->sender->$columnName." Available formats are: ".$msg, 500);
				}
			}

		}

		return true;
	}
	public function afterFind($event){

		foreach($event->sender->tableSchema->columns as $columnName => $column){

			if (($column->dbType != 'date') and ($column->dbType != 'datetime')) continue;
			if (!is_string($event->sender->$columnName)) continue;
			if (!strlen($event->sender->$columnName)){
				$event->sender->$columnName = null;
				continue;
			}

			if ($column->dbType == 'date'){
				$event->sender->$columnName = Yii::app()->dateFormatter->formatDateTime(
								CDateTimeParser::parse($event->sender->$columnName, $this->dateIncomeFormat),$this->outFormat,null);
			}else{
				$event->sender->$columnName =
					Yii::app()->dateFormatter->formatDateTime(
							CDateTimeParser::parse($event->sender->$columnName,	$this->dateTimeIncomeFormat),
							$this->outFormat, $this->outFormat);
			}
		}
		return true;
	}
}
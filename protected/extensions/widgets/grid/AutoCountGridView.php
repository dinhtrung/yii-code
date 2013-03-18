<?php

Yii::import('zii.widgets.grid.CGridView');

/**
 * AutoCountGridView extends CGridView. It works together with
 * AutoCountSqlDataProvider in order to browse large tables without first
 * counting their rows, thus increasing performance.
 */
class AutoCountGridView extends CGridView
{
	/**
	 * The name of the GET variable used to force counting of the table's rows.
	 */
	public $count_get_variable = 'count';

	/**
	 * Override renderSummary of CBaseListView.
	 */
	public function renderSummary()
	{
		$this->dataProvider->fetchData();
		if ($this->dataProvider->hasMore)
		{
			$url = CHtml::normalizeUrl(array('', $this->count_get_variable=>''));

			$options = array(
				'title'=>'Calculating the total row count of the table will slow down navigation.',
				'onclick'=>'$.fn.yiiGridView.update("'.$this->id.'",{url:$(this).attr("href")});return false;',
			);
			$this->summaryText = 'Displaying {start}-{end} of '.CHtml::link('more than {count} result(s)',$url, $options).'.';
		}
		parent::renderSummary();
	}
}

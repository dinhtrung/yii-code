<?php

class SentsmsController extends WebBaseController
{
	public function allowedActions()
	{
		return 'overview';
	}
	public function init(){
		parent::init();
		// TODO: Configure settings for this controller
	}

	/**
	 * Common code base for CRUD
	 * @see CController::actions()
	 */
	function actions() {
		return array(
			'index'		=>	'ext.actions.AdminAction',  // public function actionAdmin()
			'create'	=>	'ext.actions.CreateAction',  // public function actionCreate()
			'update'	=>	'ext.actions.UpdateAction',  // public function actionUpdate()
			'delete'	=>	'ext.actions.DeleteAction',  // public function actionDelete()
		);
	}

	function actionOverview(){
		$time = date('Y-m-d');
		if (isset($_GET['time']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', trim($_GET['time']))) $time = trim($_GET['time']);
		$offset = new DateTime($time);
		$offset = $offset->add(new DateInterval('P1D'))->format('Y-m-d');
		if (isset($_GET['offset']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', trim($_GET['offset']))) $offset = trim($_GET['offset']);



		$sentok=Yii::app()->db->createCommand("SELECT campaign_id, sender, time, URLDECODE(msgdata) AS msgdata, count(*) AS cnt FROM sent_sms WHERE dlr=1 AND time >= '$time 00:00:00' AND time < '$offset 00:00:00' GROUP BY campaign_id ORDER BY cnt DESC;")->queryAll();
		// or using: $rawData=User::model()->findAll();
		$sentok=new CArrayDataProvider($sentok, array(
				'id'=>'sentok',
				'sort'=>array(
				    'attributes'=>array(
				         'campaign_id', 'sender', 'time', 'msgdata', 'cnt',
				    ),
				),
				'pagination'=> false,
		));
		$sentfailed=Yii::app()->db->createCommand("SELECT campaign_id, sender, time, URLDECODE(msgdata) AS msgdata, count(*) AS cnt FROM sent_sms WHERE dlr=0 AND time >= '$time 00:00:00' AND time < '$offset 00:00:00' GROUP BY campaign_id ORDER BY cnt DESC;")->queryAll();
		// or using: $rawData=User::model()->findAll();
		$sentfailed=new CArrayDataProvider($sentfailed, array(
				'id'=>'sentfailed',
				'sort'=>array(
				    'attributes'=>array(
				         'campaign_id', 'sender', 'time', 'msgdata', 'cnt',
				    ),
				),
				'pagination'=>array(
				    'pageSize'=>10,
				),
		));

		$this->render('overview', array('sentok' => $sentok, 'sentfailed' => $sentfailed, 'time' => $time, 'offset' => $offset));
	}
}

<?php
class BlacklistController extends WebBaseController {
	public function allowedActions() {
		return 'add,remove';
	}
	public function init() {
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


	// index.php/isms/blacklist/add/isdn/[isdn]/keyword/[keyword]/service/[service]/smsc/[SMSCHN1]
	// @link: 10.151.183.176/isms/index.php/isms/blacklist/add/isdn/isdn test/keyword/TC 9241/service/default/smsc/SMSCHN1
	function actionAdd(){
		if (! isset($_GET['keyword'])) exit;
		if (empty($_GET['isdn'])) exit;
		$keyword = strtoupper(trim(TextHelper::utf2ascii($_GET['keyword'])));
		$isdn = trim(str_replace('+', '', $_GET['isdn']));
		$syn = Syntax::model()->findByAttributes(array('syntax' => $keyword));

		// Noi dung tra ve mac dinh...
		$sender = '9241';
		$msg = 'Quy khach muon nhan SMS ve cac san pham, dich vu, khuyen mai tu MobiFone. Dong y soan DK, Tu choi soan TC gui 9241 hoac truy cap www.mobifone.com.vn';

		// Gan tin....
		if (! empty($syn)){
			$fid = $syn->fid;
			$filter = $syn->filter;
			$sender = $filter->title;
			if ($syn->type){		// Dang ky
				$old = new Blacklist();
				$old->deleteAllByAttributes(array('fid' => $fid, 'isdn' => $isdn));
				$sub = new Whitelist;
				$sub->fid = $fid;
				$sub->isdn = $isdn;
				if ($sub->save()){
					$msg = $filter->reply_accept;
				} else {
					$msg = '';	foreach ($sub->getErrors() as $attr => $errString)	$msg .= implode(', ' , $errString);
				}

			}	else {
				$old = new Whitelist();
				$old->deleteAllByAttributes(array('fid' => $fid, 'isdn' => $isdn));
				$sub = new Blacklist;
				$sub->fid = $fid;
				$sub->isdn = $isdn;
				if ($sub->save()){
					$msg = $filter->reply_refuse;
				} else {
					$msg = '';	foreach ($sub->getErrors() as $attr => $errString)	$msg .= implode(', ' , $errString);
				}
			}
		}
		// @TODO: Send and SMS notification here....
		$reply = new Sendsms();
		$reply->campaign_id = 0;
		$reply->msgdata = urlencode(TextHelper::utf2ascii(str_replace('{@date}', date('d/m/Y', time() + 86400), $msg)));
		$reply->sender = $sender;
		$reply->coding = 0;
		$reply->sms_type = 2;
		$reply->receiver = $isdn;
		$reply->momt = 'MT';
		$reply->charset = 'UTF-8';
		$reply->meta_data = 0;
		$reply->time = time();
		if (! $reply->save())			echo $reply->msgdata;
		exit;
	}
}

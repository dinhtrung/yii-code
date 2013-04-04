<?php
class CampaignController extends WebBaseController {
	public function allowedActions() {
		return 'excel';
	}
	public function init() {
		parent::init();
		// TODO: Configure settings for this controller

	}

	/**
	 * Create a new campaign
	 */
	public function actionCreate() {
		$model = new Campaign;
		$this->performAjaxValidation($model, 'campaign-form');
		if (!empty($_POST['Campaign'])) {
			$model->attributes = $_POST['Campaign'];
			if ($model->emailbox) {
				$model->ready = Campaign::READY_ALL;
				$model->finished = Campaign::FINISHED_TRUE;
				$model->template = '';
			} else {
				$model->finished = Campaign::FINISHED_FALSE;
				$model->ready = Campaign::READY_NOTYET;
			}
			if ($model->save()) {
				// Check to see if this campaign is for email activation...
				$model->datafiles = CUploadedFile::getInstances($model, 'datafiles');
				foreach ($model->datafiles as $file) {
					// FIXME: Check to see if this file already exists...
					$fileModel = new Datafile();
					$fileModel->setFileInstance($file, $model->getDirectory());
					$fileModel->save();
					$cpfile = new Cpfile();
					$cpfile->cid = $model->id;
					$cpfile->fid = $fileModel->fid;
					$cpfile->save();
				}
				$cpf = array();
				if (! empty($_POST['Campaign']['cpf']) && is_array($cpf = $_POST['Campaign']['cpf']))
				foreach ($cpf as $fid) {
					if (empty($fid)) continue;
					$n = new Cpfile();
					$n->cid = $model->id;
					$n->fid = $fid;
					$n->save();
				}
				$this->redirect(array('view','id' => $model->id));
			}
		}
		$this->render('create', array('model' => $model));
	}
	public function actionUpdate() {
		$model = $this->loadModel();
		$this->performAjaxValidation($model, 'campaign-form');
		if ($model->finished == Campaign::FINISHED_TRUE) throw new CHttpException(403, 'Chương trình này đã hoàn thành nên không thể sửa đổi được nữa.');
		// Chi cho admin hoac manager sua doi chuong trinh da xet duyet...
		if (!(Yii::app()->getUser()->checkAccess('Isms.Sendsms.Admin')) && ($model->approved == Campaign::APPROVED_TRUE)) throw new CHttpException(403, 'Chương trình này đã được xét duyệt nên không thể sửa đổi được nữa.');
		if (!empty($_POST['Campaign'])) {
			$model->setAttributes($_POST['Campaign']);
			$model->ready = Campaign::READY_NOTYET;
			if ($model->save()) {
				if ($model->approved) Sendsms::model()->deleteAllByAttributes(array('campaign_id' => $model->getPrimaryKey()));
				Cpfile::model()->updateAll(array('status' => Cpfile::STATUS_NEW), 'cid=:cid', array(':cid' => $model->getPrimaryKey()));
				$model->datafiles = CUploadedFile::getInstances($model, 'datafiles');
				foreach ($model->datafiles as $file) {
					// FIXME: Check to see if this file already exists...
					$fileModel = new Datafile();
					$fileModel->setFileInstance($file, $model->getDirectory());
					$fileModel->save();
					$cpfile = new Cpfile();
					$cpfile->cid = $model->id;
					$cpfile->fid = $fileModel->fid;
					$cpfile->save();
				}
				$cpf = array();
				if (! empty($_POST['Campaign']['cpf']) && is_array($cpf = $_POST['Campaign']['cpf'])){
				foreach ($cpf as $fid) {
					if (empty($fid)) continue;
					$n = new Cpfile();
					$n->cid = $model->id;
					$n->fid = $fid;
					$n->save();
				}
				}
				$this->redirect(array('view', 'id' => $model->id));
			}
		}
		$this->render('update', array('model' => $model,));
	}
	/**
	 * Delete a campaign...
	 * @throws CHttpException
	 */
	public function actionDelete() {
		if (Yii::app()->request->isPostRequest) {
			$model = $this->loadModel();
			if ($model->finished != Campaign::FINISHED_TRUE){
				$model->delete();
			} else throw new CHttpException(403, 'Chương trình này đã hoàn thành nên không thể sửa đổi được nữa.');
			if (empty($_GET['ajax'])) {
				if (!empty($_POST['returnUrl'])) $this->redirect($_POST['returnUrl']);
				else $this->redirect(array('index'));
			}
		} else throw new CHttpException(400, Yii::t('isms', 'Yêu cầu không hợp lệ.'));
	}

	/**
	 * Delete a campaign...
	 * @throws CHttpException
	 */
	public function actionApproved() {
		if (Yii::app()->request->isPostRequest) {
			$model = $this->loadModel();
			$model->approved = ! $model->approved;
			$model->update();
			if (empty($_GET['ajax'])) {
				if (!empty($_POST['returnUrl'])) $this->redirect($_POST['returnUrl']);
				else $this->redirect(array('index'));
			}
		} else throw new CHttpException(400, Yii::t('isms', 'Yêu cầu không hợp lệ.'));
	}


	/**
	* Export to Excel
	**/
	public function actionExcel(){
		$model=$this->loadModel();
		$accessSend = TRUE;
		foreach ($model->cpf as $file){
			if ($file->f->uid != UserModule::user()->getId()){
				$accessSend = FALSE;
				break;
			}
		}
		if (Yii::app()->getUser()->checkAccess('Isms.Sendsms.Admin') // User cap admin hoac manager
			OR
			$accessSend
		){
			$sentSms = new Sentsms('search');
			$sentSms->campaign_id = $model->getPrimaryKey();
			$title = "Tin nhắn đã gửi cho ". $model->title;
			$this->widget('ext.widgets.excelview.EExcelView', array(
					 'dataProvider'=> $sentSms->search(),
					 'title'=> $title,
					 'grid_mode' => 'export',
					 'exportType' => 'CSV',
					 'creator' => 'iSMS',
					 'subject' => $title,
					 'autoWidth'=>TRUE,
					 'disablePaging' => TRUE,
					 'filename' => TextHelper::utf2ascii($title, TRUE, '-'),
					 'columns' => array(
							'receiver',
							'time',
							'sender',
							array('name' => 'msgdata', 'value' => 'urldecode($data->msgdata)', 'type' => 'raw'),
						) ,
			));
		} else throw new CHttpException(404, Yii::t('isms', 'Bạn không được quyền truy cập vào trang này.'));
	}


	/**
	 * Using default action set for Admin and View
	 * @see CController::actions()
	 */
	public function actions(){
		return array(
				'index'	=>	'ext.actions.AdminAction',
				'view'	=>	'ext.actions.ViewAction',
		);
	}
}

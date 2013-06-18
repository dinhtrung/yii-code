<?php

class SiteController extends WebBaseController
{
	function allowedActions(){
		return 'index, error, contact, captcha, page, language, previewMarkdown';
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if ((Yii::app()->getHomeUrl() == '') OR (Yii::app()->getHomeUrl() == '/site/index')) 
			$this->render('index');
 		elseif (! empty(Yii::app()->homeUrl))
 			$this->forward(Yii::app()->getHomeUrl());
	}

	/**
	 * This is the action to handle external exceptions.
	 *
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$message = new YiiMailMessage;
				$message->setBody($model->body, 'text/html');
				$message->setSubject($model->subject);
				// Send the requested email to contactEmail setting.
				$message->setFrom(array($model->email => $model->name));
				$message->addTo(Yii::app()->setting->get('Webtheme', 'contactEmail', Yii::app()->params['adminEmail']));
				Yii::app()->mail->send($message);
				// Send a reply for notice the user
				$message->setFrom(array(Yii::app()->setting->get('Webtheme', 'serverEmail', Yii::app()->params['adminEmail']) => Yii::app()->setting->get('Webtheme', 'siteName', Yii::app()->name)));
				$message->addTo($model->email, $model->name);
				Yii::app()->mail->send($message);
				$model = new ContactForm();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	/**
	 * Set User language
	 */
	public function actionLanguage(){
		if (! isset($_GET['lang']) || (! in_array($_GET['lang'], Yii::app()->getLocale()->getLocaleIDs()))){
			throw new CHttpException(404, "The requested page is not found.");
		} else {
			Yii::app()->getUser()->setState("language", $_GET['lang']);
			$this->redirect(Yii::app()->getUser()->getReturnUrl());
		}
	}

	/**
	 * Markdown previewer
	 */
	public function actionPreviewMarkdown()
	{
		if (isset($_POST['data'])){
		    $parser=new CMarkdownParser;
		    $parsedText = $parser->safeTransform($_POST['data']);
		    echo $parsedText;
		}
	}
	
	/**
	 * @TODO: Separate into 2 step: preview - import.
	 * 
	 * @throws CHttpException
	 */
	public function actionDevel(){
		$importModel = new CsvFileUpload();
		$dataModel = array();
		$columns = array();
		$tmpFiles = array();
		if (isset($_POST[get_class($importModel)])) $importModel->attributes = $_POST[get_class($importModel)];
		if ($importModel->validate()){
			$files = CUploadedFile::getInstances($importModel, 'files');
			foreach ($files as $file){
				$rawData = array();
				if ($file instanceof CUploadedFile){
					// Create a random name and path here...
					$tmpFiles[$file->getName()] = Yii::app()->assetManager->basePath . DIRECTORY_SEPARATOR . $file->getName();
					$file->saveAs($filePath);
					$fh = fopen($filePath, 'r');
					$line = 0;
					$header = fgetcsv($fh, 4096, $importModel->delimiter, $importModel->enclosure, $importModel->escape);
					foreach ($header as $k => $v)
						$header[$k] = @str_replace(array('-', '_', ' '), '', Transliteration::file(mb_convert_encoding($v, $importModel->encode_to, $importModel->encode_from)));
					$columns[$file->getName()] = $header;
					
					// Process further if import is submit...
					if (isset($_POST['import'])){
						$line ++;
						if (empty($header) OR is_null($header[0])) Yii::log("The file uploaded must have the first row as header", 'error');
						else {
							while ($row = fgetcsv($fh, 4096, $importModel->delimiter, $importModel->enclosure, $importModel->escape)){
								$line++;
								if (count($row) != count($header)) Yii::trace("Data in line #$line is malformed...", 'error');
								else {
									foreach ($row as $k => $v){
										$attr[$header[$k]] = @mb_convert_encoding($v, $importModel->encode_to, $importModel->encode_from);
									}
									$rawData[] = $attr;
								}
							}
						}
					}
					fclose($fh);
					@unlink($filePath);
					$dataModel[$file->getName()] = new CArrayDataProvider($rawData, array('keyField' => $header[0]));
				} else throw new CHttpException(500, "Error processing uploaded file");
			}
		}
		$this->render('devel', array('model' => $importModel, 'dataModel' => $dataModel, 'columns' => $columns, 'tmpFiles' => $tmpFiles));
	}
}

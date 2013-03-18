<?php

class WebthemeController extends WebBaseController
{
	function actions() {
		return array(
			'settings'	=> array(
				'class'	=>	'ext.actions.SettingsAction',
			),
		);
	}
	/**
	 * List available themes
	 */
	public function actionIndex()
	{
		$this->render('index', array('themes' => Webtheme::themeOptions()));
	}
	/**
	 * View detail information for a theme
	 */
	public function actionView()
	{
		if (isset($_GET['theme'])) Yii::app()->theme = $_GET['theme'];
		$this->render('view');
	}
}
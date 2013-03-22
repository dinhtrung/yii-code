<?php

class ShopController extends WebBaseController
{
	public function actionAdmin()
	{
		$this->render('admin', array( ));
	}

	public function actionIndex()
	{
		$this->redirect(array('//shop/products/index'));
	}
}

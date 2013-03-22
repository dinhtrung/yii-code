<?php
class DefaultController extends WebBaseController {
	public function actionIndex() {
   		 $this->redirect(array('shop/index'));
	}

 }

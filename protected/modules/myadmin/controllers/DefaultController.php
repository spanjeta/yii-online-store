<?php

class DefaultController extends AdminController
{
	public function actionIndex()
	{
		$model=new EmailTemplate('search');
		$this->render('index',
			array('model'=>$model));	

	}

    public function actionSendNew()
    {
        print_r("Send New");

    }
}

<?php

class OfferTypeController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
				array('allow',
						'actions'=>array('index','view', /* 'download', 'thumbnail' */),
						'users'=>array('*'),
				),
				array('allow',
						'actions'=>array('create','update', 'search'),
						'users'=>array('@'),
				),
				array('allow',
						'actions'=>array('admin','delete'),
						'expression'=>'Yii::app()->user->isAdmin',
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}

	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$models = OfferType::model()->findAll();
		if($models)
		{
			$json_list = array();
			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}

			$arr['discounts'] = $json_list;
			$arr['status'] = 'OK';

		}
		$this->sendJSONResponse($arr);
	}

}
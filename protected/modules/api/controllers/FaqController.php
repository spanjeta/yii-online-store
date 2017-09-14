<?php

class FaqController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('index','view','refine', 'search','rating'),
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
	public function actionView($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$faq = Faq::model()->findByPk($id);
		if($faq)
		{
			$list[] = $faq->toArray();
			$arr['contents'] = $list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}
	public function actionRating($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$faq = Faq::model()->findByPk($id);
		if($faq)
		{
			//$arr['status'] = 'OK';
		}
		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}
	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$types = FaqCategory::model()->findAll();
		if($types)
		{

			foreach($types as $type)
			{
				$list[] = $type->toArray();
			}
			$arr['categories'] = $list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}
	public function actionSearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Faq;
		if (isset($_POST['Faq']))
		{
			$questions = $model->seacrhData();
			if($questions)
			{
				foreach($questions as $question)
				{
					$json_list[] = $question->toArrayQuestion();
				}
				$arr['status'] = 'OK';
				$arr['contents'] = $json_list;
			}
			else {
				$arr['contents'] = 'no record found';
			}
		}
		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}


}
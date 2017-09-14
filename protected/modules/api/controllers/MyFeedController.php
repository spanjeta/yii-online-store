<?php

class MyFeedController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
				array('allow',
						'actions'=>array('view', /* 'download', 'thumbnail' */),
						'users'=>array('*'),
				),
				array('allow',
						'actions'=>array('create','update', 'search','refine','index'),
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

	public function actionCreate()
	{

		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new MyFeed;

		$criteria = new CDbCriteria;
		$issetFeed = Yii::app()->user->model->myFeed;

		if($issetFeed)
		{
			$model = $issetFeed;
		}
		if (isset($_POST['MyFeed'])) {

			$model->setAttributes($_POST['MyFeed']);
			$arr['type_id'] = $_POST['MyFeed']['type_id'];
			if ($model->save()) {
				$arr['status'] = 'OK';
			}

			else
			{
				$err = '';
				foreach($model->getErrors() as $error)
					$err .= implode( ".",$error);
				$arr['error'] = $err;
			}
		}
		else
		{
			$required = $model->sendPost(true);
			$other = $model->sendPost();
			$arr['message'] = 'Please check required post parameter';
			$arr['required_param'] = $required;
			$arr['other_param'] = $other;
		}

		$this->sendJSONResponse($arr);
	}
	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$sortlists = array('Latest','Most Relevant');

		foreach ($sortlists as $key=>$value)
		{
			$types[] = array('type_id'=>$key,'title'=>$value);
		}

		$arr['status'] = 'OK';

		$arr['types'] = $types;

		$this->sendJSONResponse($arr);
	}

	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$feed = Yii::app()->user->model->myFeed;

		if(!$feed)
		{
			$feed = new MyFeed();
			$feed->save();
		}
		$myfeed = $feed->toArray();

		$arr['status'] = 'OK';
		$arr['feeds'] = $myfeed;
		$this->sendJSONResponse($arr);
	}

}
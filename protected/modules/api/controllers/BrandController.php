<?php

class BrandController extends Controller {

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



	public function actionCreate()
	{
		$model = new Brand;

		$this->performAjaxValidation($model, 'brand-form');

		if (isset($_POST['Brand'])) {
			$model->setAttributes($_POST['Brand']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('index'));
			}
		}
		$this->updateMenuItems($model);
		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id, 'Brand');

		//if( !($this->isAllowed ( $model)))	throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));

		$this->performAjaxValidation($model, 'brand-form');

		if (isset($_POST['Brand'])) {
			$model->setAttributes($_POST['Brand']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}
		$this->updateMenuItems($model);
		$this->render('update', array(
				'model' => $model,
		));
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id, 'Brand');

		//if( !($this->isAllowed ( $model)))	throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));

		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Brand')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('state_id = 1');
		$models = Brand::model()->findAll($criteria);

		if($models)
		{

			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}

			$arr['brands'] = $json_list;

			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}


}
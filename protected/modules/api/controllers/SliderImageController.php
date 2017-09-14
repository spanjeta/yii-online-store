<?php

class SliderImageController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
				array('allow',
						'actions'=>array('index','view','download','thumbnail'),
						'users'=>array('*'),
				),
				array('allow',
						'actions'=>array('create','update', 'search','ajaxUpdate','add'),
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
		$criteria = new CDbCriteria;
		$criteria->limit = 4;
		//$criteria->order = 'id asc';

		$models = SliderImage::model()->findAll($criteria);
		if($models)
		{
			$json_list = array();
			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}

			$arr['sliderimages'] = $json_list;
			$arr['status'] = 'OK';

		}
		$this->sendJSONResponse($arr);
	}


	public function actionCreate()
	{

		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new SliderImage();

		//	$arr['params'] = $_POST;

		//var_dump($_FILES); exit;

		if (isset($_FILES))
		{
			//$model->setAttributes($_POST['SliderImage']);

			//	$uploaded_file = CUploadedFile::getInstanceByName('SliderImage[slider_image]');

			$company = Yii::app()->user->model->company;
			if($company)
			{
				$uploaded_file = CUploadedFile::getInstance($model, 'slider_image');

				if(isset( $uploaded_file))
				{
					$path = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER ;
					$filename = $path .get_class($model).'_'.uniqid().'_' .time() . '.' .$uploaded_file->getExtensionName();
					$file = $uploaded_file->saveAs($filename);
					$model->slider_image = basename($filename);
					$model->store_id = $company->id;
					if ($model->save())
					{
						$arr['status'] = 'OK';
						$arr['message'] = 'slider image is successfully added';
					}

					else
					{
						$arr['image'] = 'image not save';
					}
				}

				else {
					$arr['image'] = 'image not posted';
				}
			}

		}

		else
		{
			$arr['data'] = 'data not posted';
		}
		$this->sendJSONResponse($arr);
	}

}
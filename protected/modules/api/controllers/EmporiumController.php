<?php

class EmporiumController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
				array('allow',
						'actions'=>array('index','view', 'download','thumbnail','thumb','latest','popular' ),
						'users'=>array('*'),
				),
				array('allow',
						'actions'=>array('create','update','refine',
								'delete','active','inactive','feature','unfeature','getOperation','getfields',
								'search','images','getproducts'),
						'users'=>array('@'),
				),
				array('allow',
						'actions'=>array('admin'),
						'expression'=>'Yii::app()->user->isAdmin',
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}

	public function actionLatest()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$models = Emporium::model()->latest()->findAll();
		//	$model = Emporium::model()->find();
		if($models)
		{
			$json_list = array();
			foreach($models as $model)
			{
				if($model->empproducts)
				{
					$json_list[] = $model->toArray();
				}
			}
			$arr['emporium'] = $json_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}
	public function actionPopular()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$models = Emporium::model()->mostView()->findAll();
		//	$model = Emporium::model()->find();
		if($models)
		{
			$json_list = array();
			foreach($models as $model)
			{
				if($model->empproducts)
				{
					$json_list[] = $model->toArray();
				}
			}
			$arr['emporium'] = $json_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionCreate()
	{

		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new Emporium();

		if(isset($_POST['Emporium']))
		{
			$model->attributes = $_POST['Emporium'];

			$uploaded_file = CUploadedFile::getInstance($model, 'image_file');

			if(isset( $uploaded_file))
			{
				$path = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER ;
				$filename = $path . get_class($model). '_' .time() . '.' .$uploaded_file->getExtensionName();
				$uploaded_file->saveAs($filename);
				$model->image_file = basename( $filename );
					
				if($model->save())
				{
					$records = json_decode($_POST['Emporium']['products']);

					$model->addHomeFeatured(Home::TYPE_EMPORIUM);
					$model->addSitedata(Home::TYPE_EMPORIUM);

					if($records)
					{
						foreach($records as $record)
						{
							$product = Product::model()->findByPk($record->id);
							if($product)
							{
								$emppro = new EmpProduct();
								$emppro->product_id = $product->id;
								$emppro->emp_id =$model->id;
								$emppro->tag_x = $record->tag_x;
								$emppro->tag_y = $record->tag_y;
								if($emppro->save())
								{
									$arr['status'] = 'OK';
									$arr['message'] = 'Your post is successfully submitted';
								}
							}
							else{
								$arr['error'] = 'product not saved';
							}
						}
					}
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
				$arr['image'] = 'image not posted';
			}
		}
		else
		{
			$arr['data'] = 'data not posted';
		}
		$this->sendJSONResponse($arr);
	}
	public function actiongetproducts()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$products = Product::model()->findAll();
		if($products)
		{
			$json_list = array();

			foreach($products as $product)
			{
				$json_list[$product->title]  = $product->id;
			}
			$arr['products'] = $json_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionView($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = $this->loadModel($id, 'Emporium');

		if($model)
		{
			$json_list = array();

			$products = $model->empproducts;

			$json_list[] = $model->toArray();

			$taged = array();

			if($products)
			{
				foreach($products as $product)
				{
					$taged[] = $product->toArray();
				}
			}
			$arr['emporium'] = $json_list;
			$arr['products'] = $taged;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$models = Emporium::model()->findAll();
		//	$model = Emporium::model()->find();
		if($models)
		{
			$json_list = array();
			foreach($models as $model)
			{
				if($model->empproducts)
				{
					$json_list[] = $model->toArray();
				}
			}
			$arr['emporium'] = $json_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionImages()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$models = Emporium::model()->findAll();

		if($models)
		{
			$json_list = array();
			//foreach($models as $model)
			foreach($models as $model)
			{
				if($model->empproducts)
					$json_list[] = $model->toArray();
			}
			$arr['images'] = $json_list;
			$arr['status'] = 'OK';

		}
		$this->sendJSONResponse($arr);
	}

	public function actionDelete()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		if (isset($_POST['Emporium']))
		{
			//$model->setAttributes($_POST['Product']);
			$ids = ($_POST['Emporium']['ids']);

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = Emporium::model()->findByPk($id);
					if($model)
					{
						$model->delete();
					}
				}
				$arr['status'] = 'OK';
				$arr['message'] = 'Your post is successfully submitted';
			}
		}
		else
		{
			$arr['error'] = 'data not posted';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionActive()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		if (isset($_POST['Emporium']))
		{
			$ids = ($_POST['Emporium']['ids']);;

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = Emporium::model()->findByPk($id);
					if($model)
					{
						$model->state_id = 1;
						$model->saveAttributes(array('state_id'));
					}
				}
				$arr['status'] = 'OK';
			}
		}
		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}
	public function actionInactive()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		if (isset($_POST['Emporium']))
		{
			//$model->setAttributes($_POST['Product']);
			$ids = ($_POST['Emporium']['ids']);;

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = Emporium::model()->findByPk($id);
					if($model)
					{
						$model->state_id = 0;
						$model->saveAttributes(array('state_id'));
					}
				}
				$arr['status'] = 'OK';
			}

		}

		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionFeature()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		if (isset($_POST['Emporium']))
		{
			//$model->setAttributes($_POST['Product']);
			$ids = ($_POST['Emporium']['ids']);;

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = Emporium::model()->findByPk($id);
					if($model)
					{
						$model->is_featured = 1;
					}
				}
				$arr['status'] = 'OK';
			}
		}

		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionUnfeature()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		if (isset($_POST['Emporium']))
		{
			//$model->setAttributes($_POST['Product']);
			$ids = ($_POST['Emporium']['ids']);;

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = Emporium::model()->findByPk($id);
					if($model)
					{
						$model->is_featured = 0;
					}
				}
				$arr['status'] = 'OK';
			}
		}

		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionSearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Emporium;
		if (isset($_POST['Emporium']))
		{
			$model->setAttributes($_POST['Emporium']);
			$json_list = array();
			$models = $model->getempSearch();
			if($models)
			{
				foreach ($models as $model)
				{
					$json_list[] = $model->toArray();
				}
				$arr['results'] = $json_list;
				$arr['status'] = 'OK';
			}
			else
			{
				$arr['results'] = 'no record found';
			}

		}

		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}

	public function actiongetOperation()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$lists = array('active','inactive','feature','unfeature','delete');
		foreach ($lists as $key=>$value)
		{
			$jsonentry[] = $value;
		}
		$arr['operations'] = $jsonentry;
		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

 	public function actiongetfields()
	{
		self::actionRefine();
	/* 	$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$lists = array('1'=>'title','2'=> 'description','3'=>'tags');
		foreach ($lists as $key=>$value)
		{
			$jsonentry[$value] = $key;
		}
		$arr['type_id'] = $jsonentry;
		$arr['status'] = 'OK';
		$this->sendJSONResponse($arr); */
	}

	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$status = array('Active','InActive');
		$fields = array('title','description','tags');
		$operations =  array('active','inactive','feature','unfeature','delete');

		foreach ($status as $key=>$value)
		{
			$status_list[] = array('id'=>$key,'state_id'=>$value);
		}
		foreach ($fields as $key=>$value)
		{
			$fields_list[] = array('id'=>$key,'type_id'=>$value);
		}
		foreach ($operations as $key=>$value)
		{
			$operation_list[] = array('id'=>$key,'name'=>$value);
		}
		$arr['status_list'] = $status_list;
		$arr['fields'] = $fields_list;

		$arr['operations'] = $operation_list;
		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

}
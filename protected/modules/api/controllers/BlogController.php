<?php

class BlogController extends Controller {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('index','view','list' ,'listview','info','refine','sort'/* 'download', 'thumbnail' */),
						'users'=>array('*'),
		),
		array('allow',
						'actions'=>array('create','update', 'search','my','order','bcategory','delete'),
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
	/**
	 * this api is used for Blog search in case of tab
	 */
	public function actionSearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Blog();

		/*$_POST['Blog']['title'] = 'My Blog For Educar';
		$_POST['Blog']['field_id'] = 0;
		$_POST['Blog']['is_featured'] = 0;
		$_POST['Blog']['is_publish'] = 0;
		$_POST['Blog']['is_home'] = 0;*/

		$arr['post'] = $_POST;
		if (isset($_POST['Blog']))
		{
			$field_id = isset($_POST['Blog']['field_id']) ? $_POST['Blog']['field_id'] : '';
			$is_publish = isset($_POST['Blog']['is_publish']) ? $_POST['Blog']['is_publish'] : '';
            $is_featured = isset($_POST['Blog']['is_featured']) ? $_POST['Blog']['is_featured'] : '';
             $is_home = isset($_POST['Blog']['is_home']) ? $_POST['Blog']['is_home'] : '';
			$model->setAttributes($_POST['Blog']);
			$json_list = array();
			$models = $model->searchTab($field_id,$is_publish,$is_featured,$is_home);
			if($models)
			{
				foreach ($models as $model)
				{
					$json_list[] = $model->toArray();
				}
				$arr['results'] = $json_list;
				$arr['status'] = 'OK';
			}else{
				$arr['results'] = 'no record found';
			}


		}else{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}
	public function actionBcategory()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$models = BlogCategory::model()->findAll();
		if($models)
		{
			$json_list = array();

			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}
			$arr['category'] = $json_list;
			$arr['status'] = 'OK';

		}
		$this->sendJSONResponse($arr);
	}

	public function actionCreate()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new Blog();
		$path = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER;
		if(!is_dir($path))
		{
			mkdir($path);
		}
		if(isset($_POST['Blog']))
		{
			$model->attributes = $_POST['Blog'];
			if($model->save())
			{
				$model->saveUploadedFile($model,'image_file');
				if(Yii::app()->user->isBuser)
				$model->addHomeFeatured(Home::TYPE_BLOG);
				$model->addSitedata(Home::TYPE_BLOG);
				$arr['status'] = 'OK';
				$arr['message'] = 'Your post is successfully submitted';
			}
			else
			{
				$err = '';
				foreach($model->getErrors() as $error)
				$err .= implode( ".",$error);
				$arr['error'] = $err;
			}
		}
		$this->sendJSONResponse($arr);
	}

	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$models = Blog::model()->findAll();
		if($models)
		{
			$json_list = array();
			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}
			$arr['blogs'] = $json_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}
	public function actionMy()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$models = Blog::model()->my()->findAll();
		if($models)
		{
			$json_list = array();
			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}
			$arr['blogs'] = $json_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionInfo($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = Blog::model()->findByPk($id);
		if($model)
		{
			$realated_blog = array();
			$criteria = new CDbCriteria;
			$criteria->limit = 2;
			//	$criteria->addCondition('type_id ='.$model->type_id);
			$criteria->addNotInCondition('id',array($model->id));
			$related = Blog::model()->findAll($criteria);
			if($model)
			{
				$json_list[] = $model->toArray();
				if($related)
				{
					foreach($related as $relate)
					{
						$realated_blog[] = $relate->toArray();
					}
				}
				$arr['info'] = $json_list;
				$arr['related'] = $realated_blog;
				$arr['status'] = 'OK';
			}
		}
		else
		{
			$arr['error'] = 'Please pass valid id';
		}
		$this->sendJSONResponse($arr);
	}

	/**
	 * options for blog refines
	 */
	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		/* Please do not change the order of the following array*/
		$sortlists = array('Latest','Most Viewed');

		$fields = array('Title','Description');
		$status = array('UnPublished','Published');
		$fetures = array('No','Yes');
		$homes = array('No','Yes');

		foreach ($sortlists as $key=>$value)
		{
			$sorts[] = array('id'=>$key,'title'=>$value);
		}

		foreach ($fields as $key=>$value)
		{
			$field[] = array('field_id'=>$key,'title'=>$value);
		}
		foreach ($status as $key=>$value)
		{
			$pubs[] = array('is_publish'=>$key,'title'=>$value);
		}
		foreach ($fetures as $key=>$value)
		{
			$features[] = array('is_featured'=>$key,'title'=>$value);
		}
		foreach ($homes as $key=>$value)
		{
			$home[] = array('is_home'=>$key,'title'=>$value);
		}

		$arr['status'] = 'OK';

		$arr['fields'] = $field;
		$arr['publish'] = $pubs;
		$arr['featured'] = $features;
		$arr['home'] = $home;
		$arr['sorts'] = $sorts;
		$this->sendJSONResponse($arr);
	}

	/**
	 * blog sort functionality  o for latest 1 most view
	 * @param unknown_type $id
	 */
	public function actionSort($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$criteria = new CDbCriteria;
		if($id == 1)
		$blogs = Blog::model()->mostView()->findAll();
		else	$blogs = Blog::model()->latest()->findAll();

		if($blogs)
		{
			$json_list = array();
			foreach ($blogs as $model)
			{
				$json_list[] = $model->toArray();
			}
		}

		$arr['status'] = 'OK';

		$arr['blogs'] = $json_list;

		$this->sendJSONResponse($arr);
	}
	public function actionDelete($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = $this->loadModel($id, 'Blog');

		if( $model){

			$model->delete();
			$arr['status'] = 'OK';
			$arr['message'] = 'Successfully deleted';

		}
		$this->sendJSONResponse($arr);

	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id, 'Blog');
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$old_image = $model->image_file;

		if (isset($_POST['Blog'])) {

			$model->setAttributes($_POST['Blog']);

			$image = 	$model->saveFile($model,'image_file');
			if(!$image)
			{
				$model->image_file = $old_image;
			}
			else
			{
				$imagefile = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER.$old_image;
				if(file_exists($imagefile)  && !is_dir($imagefile))
				{
					unlink($imagefile);
				}
			}
			if ($model->save()) {
				$arr['status'] = 'OK';
			}
			else
			{
				$error = '';
				foreach($model->getErrors() as $error)
				{
					$error .= implode('.',$error);
				}
				$arr['error'] = $error;
			}
		}

		$this->sendJSONResponse($arr);

	}

}

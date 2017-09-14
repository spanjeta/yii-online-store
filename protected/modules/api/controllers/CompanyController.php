<?php

class CompanyController extends Controller {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('index','view', 'download', 'thumbnail','product','shopType','refine'),
						'users'=>array('*'),
		),
		array('allow',
						'actions'=>array('create','update', 'search','info'),
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

		$company = Company::model()->findByPk($id);
		if($company)
		{
			$slider_list = array();
			$product_list = array();
			$info[] = $company->toArray();
			//		$sliders = $company->sliderimages;


			$criteria1 = new CDbCriteria;
			$criteria1->addCondition('create_user_id ='.$company->create_user_id);
			$sliders = SliderImage::model()->findAll($criteria1);


			$criteria = new CDbCriteria;
			$criteria->addCondition('store_id ='.$id);

			$homes = Home::model()->findAll($criteria);
			$b_list = array();
			if($homes)
			{
				foreach ($homes as $home)
				{
					$wishtype = $home->getContentType();
					if($wishtype)
					$b_list[] = $wishtype->toArray();
				}
			}
			if($sliders)
			{
				foreach($sliders as $slider)
				{
					$slider_list[] = $slider->toArray();
				}
			}

			else {
				$slider_list[] = array('id'=>1,'slider_image'=>Yii::app()->createAbsoluteUrl('product/download',array('file'=>'banner-1.jpg')));
			}
			$arr['info'] = $info;
			$arr['slider'] = $slider_list;
			$arr['contents'] = $b_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionInfo()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$company = Yii::app()->user->model->company;

		if($company)
		{
			$jsonlist[] = $company->toArray();
			$arr['companyinfo'] = $jsonlist;
			$arr['status']='OK';
		}

		$this->sendJSONResponse($arr);
	}

	public function actionProduct($id=null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->limit = 10;
		$criteria->order = 'rand()';
		$models = Product::model()->findAll($criteria);
		if($models)
		{
			$json_list = array();
			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}

			$arr['products'] = $json_list;
			$arr['status'] = 'OK';

		}
		$this->sendJSONResponse($arr);
	}

	public function actionUpdate($id = null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		if($id == null)
		{
			$com = Yii::app()->user->model->company;
			if($com)
			$id = Yii::app()->user->model->company->id;
		}
		$model = $this->loadModel($id, 'Company');

		if($model){
			if (isset($_POST['Company'])) {
				$model->setAttributes($_POST['Company']);

				if ($model->save())
				{
					$model->saveUploadedFile($model, 'logo_file');
					$arr['status'] = 'OK';
					$arr['message'] = 'Your shop is successfully updated';
					//	$arr['success'] = 'your account is successfully closed';
				}

				else
				{
					$err = '';
					foreach($model->getErrors() as $error){
						$err .=  implode(',',$error);
							
					}
					$arr['error'] = $err;
				}
			}

			else{
				$required = $model->sendPost(true);
				$other = $model->sendPost();
				$arr['message'] = 'Please check required post parameter';
				$arr['required_param'] = $required;
				$arr['other_param'] = $other;
			}
		}
		else {
			$arr['company'] = 'company not found';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$models = Company::model()->findAll();
		if($models)
		{
			$json_list = array();
			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}
			$arr['stores'] = $json_list;
			$arr['status'] = 'OK';

		}
		$this->sendJSONResponse($arr);
	}
	public function actionshopType()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$types = ShopCategory::model()->findAll();
		if($types)
		{
			$json_list = array();
			foreach ($types as $type)
			{
				$json_list[] = $type->toArray();
			}

			$arr['shop_categories'] = $json_list;
			$arr['status'] = 'OK';

		}
		$this->sendJSONResponse($arr);
	}
	/**
	 * This action is used on store page where user can select its type and refine bu sorts
	 *  here category is basically post type and blank category is for All Type contents
	 * Enter description here ...
	 */

	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$sorts = array('1'=>'Most Viewd','Latest','Featured');
		$categorys = Home::getContentList();

		$sort_list = array();
		$cat_list = array();
		if($sorts)
		{
			foreach ($sorts as $key=>$value)
			{
				$sort_list[] = array('sort_id'=>$key,'title'=>$value );
			}
		}
		if($categorys)
		{
			foreach ($categorys as $key=>$value)
			{
				$cat_list[] =  array('type_id'=>$key,'title'=>$value );
			}
			$cat_list[] =  array('type_id'=>-1,'title'=>'All' );
		}

		$arr['sorts'] = $sort_list;
		$arr['PostTyped'] = $cat_list;

		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}


	/**
	 * This is using on store to search on the basis of category id and sort here they post store_id , category_id, and sort_id
	 * @param unknown_type $store_id
	 * @param unknown_type $cat_id
	 */

	public function actionSearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		//	$arr['post'] = $_POST;
		if (isset($_POST['Company']) && !empty($_POST['Company']['store_id'])) {

			$arr['datapost']  = $_POST;
			$storeid = $_POST['Company']['store_id'];
			$type_id = isset($_POST['Company']['type_id'])? $_POST['Company']['type_id'] : '';
			$sort_id = isset($_POST['Company']['sort_id']) ? $_POST['Company']['sort_id'] :'' ;

			if(isset($sort_id) && !empty($sort_id)) {
				switch($sort_id) {
					case 1:{
						$criteria->order = 'view_count desc';
						break;
					}
					case 2:
						{
							$criteria->order = 'create_time desc';
							break;
						}
					case 3: {
						$criteria->addCondition('is_feature = 1');
						break;
					}
				}
			}
			if($type_id >= 0){

				$arr['type_send'] = $type_id;
				$criteria->addCondition('type_id ='.$type_id);
			}
			$criteria->addCondition('store_id ='.$storeid);
			$homes = Home::model()->findAll($criteria);
			$data_list = array();
			if($homes)
			{
				foreach ($homes as $home)
				{
					$datatype = $home->getContentType();
					if($datatype)
					$data_list[] = $datatype->toArray($home->id);
				}
			}
		}

		$arr['status'] = 'OK';
		$arr['contents'] = $data_list;
		$this->sendJSONResponse($arr);
	}
}
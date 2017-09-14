<?php

class CategoryController extends Controller {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('index','view','search','view','tabSearch'),
						'users'=>array('*'),
		),
		array('allow',
						'actions'=>array('create','update'),
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

	/**
	 * This is using on store to search on the basis of category id and sort here they post store_id , category_id, and sort_id
	 * @param unknown_type $store_id
	 * @param unknown_type $cat_id
	 */

	public function actionSearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$json_list = array();
		if($store_id)
		{
			$criteria->addCondition('store_id = '.$store_id);
		}
		if($cat_id)
		{
			$criteria->addCondition('category_id = '.$cat_id);
		}
		$products = Product::model()->findAll($criteria);
		if($products)
		{
			foreach($products as $product)
			{
				$json_list[] = $product->toArray();
			}
		}
		$arr['products'] = $json_list;

		$arr['status'] = 'OK';
		$this->sendJSONResponse($arr);
	}

	public function actionView($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$criteria = new CDbCriteria;
		$criteria->addCondition('category_id ='.$id);

		$models = Product::model()->findAll($criteria);
		$json_list = array();
		if($models)
		{
			$json_list = array();
			foreach ($models as $model)
			{
				if($model->images)
				$json_list[] = $model->toArray();
			}

			$arr['status'] = 'OK';
		}

		$arr['products'] = $json_list;
		$this->sendJSONResponse($arr);
	}

	/**
	 * this api is used for tab search for product for tab device
	 */
	public function actionTabSearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Product();
		$arr['post'] = $_POST;
		/*	$_POST['Product']['category_id'] = '4';
		 $_POST['Product']['color_id']='10';
		 $_POST['Product']['store_id']='2';
		 $_POST['Product']['category_id'] = '1';
		 $_POST['Product']['price_id']= 1;
		$_POST['Product']['category_id'] = '5';
		$_POST['Product']['is_sale']= 1;*/
	
		if (isset($_POST['Product']))
		{
			$price_id = isset($_POST['Product']['price_id']) ? $_POST['Product']['price_id'] : '';
            $is_sale=isset($_POST['Product']['is_sale']) ? $_POST['Product']['is_sale'] : '';
			$model->attributes = $_POST['Product'];
			$products = $model->TabSearchApi($price_id,$is_sale);
			$json_list = array();
			if($products)
			{
				foreach($products as $product)
				{
					$json_list[] = $product->toArray();
				}
				$arr['status'] = 'OK';
			}
			$arr['products'] = $json_list;
		}
		$this->sendJSONResponse($arr);
	}
	/**
	 * This api is used for auto list
	 * Enter description here ...
	 * @param unknown_type $q
	 */
	public function actionTabAutoList($q=null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Product();
		if (isset($_POST['Product']))
		{
			$model->attributes = $_POST['Product'];

			$products = $model->TabSearchApi();
			$json_list = array();
			if($products)
			{
				foreach($products as $product)
				{
					$json_list[] = $product->toArray();
				}
				$arr['status'] = 'OK';
			}
			$arr['products'] = $json_list;
		}

		$this->sendJSONResponse($arr);
	}

}
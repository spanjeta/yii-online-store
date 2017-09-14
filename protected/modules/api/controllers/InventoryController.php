<?php

class InventoryController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
				array('allow',
						'actions'=>array('view', 'download', 'thumbnail','pcategory','deals'),
						'users'=>array('*'),
				),
				array('allow',
						'actions'=>array('create','update','related','index',
								'search','manage','inventory',
								'invsearch','invdelete','active','inactive','feature','refine','delete'),
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

	public function actionCreate()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new Product();

		if(isset($_POST['Product']))
		{
			$model->attributes = $_POST['Product'];

			if($model->save())
			{
				$arr['status'] = 'OK';
			}
			else
			{
				$err = '';
				foreach( $model->getErrors() as $error)
					$err .= implode( ".",$error);
				$arr['error'] = $err;
			}
		}
		$this->sendJSONResponse($arr);
	}

	public function actionPcategory()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$models = Category::model()->findAll();
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
	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$models = Product::model()->my()->findAll();
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


	public function actionDeals()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->limit = 6;
		$models = Product::model()->findAll($criteria);
		if($models)
		{
			$json_list = array();
			foreach ($models as $model)
			{
				$json_list[] = $model->toArraydeals();
			}

			$arr['deals'] = $json_list;
			$arr['status'] = 'OK';

		}
		$this->sendJSONResponse($arr);
	}


	/* 	public function actionInventory()
	 {
	$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
	$criteria = new CDbCriteria;
	$criteria->addCondition('create_user_id ='. Yii::app()->user->id);
	$criteria->limit = 20;
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
	*/

	public function actionDelete()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		if (isset($_POST['Product']))
		{
			//$model->setAttributes($_POST['Product']);
			$ids = ($_POST['Product']['ids']);

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = Product::model()->findByPk($id);
					if($model)
					{
						$model->delete();
					}
				}
				$arr['status'] = 'OK';
			}

		}

		else
		{

		}
		$this->sendJSONResponse($arr);
	}


	public function actionActive()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		if (isset($_POST['Product']))
		{
			//$model->setAttributes($_POST['Product']);
			$ids = ($_POST['Product']['ids']);;

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = Product::model()->findByPk($id);
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
	public function actionInActive()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		if (isset($_POST['Product']))
		{
			//$model->setAttributes($_POST['Product']);
			$ids = ($_POST['Product']['ids']);;

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = Product::model()->findByPk($id);
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

		if (isset($_POST['Product']))
		{
			//$model->setAttributes($_POST['Product']);
			$ids = ($_POST['Product']['ids']);;

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = Product::model()->findByPk($id);
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


	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$status = array('InActive','Active');
		$fields = array('title','description','tags');
		$discounts = array('No','Yes');
		$operations = array('active','inActive','delete');
		foreach ($status as $key=>$value)
		{
			$status_list[] = array('id'=>$key,'state_id'=>$value);
		}
		foreach ($fields as $key=>$value)
		{
			$fields_list[] = array('id'=>$key,'type_id'=>$value);
		}
		foreach ($discounts as $key=>$value)
		{
			$discount_list[] = array('id'=>$key,'discount_id'=>$value);
		}
		foreach ($operations as $key=>$value)
		{
			$operation_list[] = array('id'=>$key,'name'=>$value);
		}
		$arr['status_list'] = $status_list;
		$arr['fields'] = $fields_list;
		$arr['discounts'] = $discount_list;
		$arr['operations'] = $operation_list;
		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}


	public function actionInvsearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Product;
		if (isset($_POST['Product']))
		{
			$model->setAttributes($_POST['Product']);
			$json_list = array();
			$models = $model->invsearch();
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

	public function actionRelated()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$colors = Color::model()->findAll();
		$brands = Brand::model()->findAll();
		$categorys = Category::model()->findAll();
		$variations = Size::model()->findAll();
		$products = Product::model()->my()->findAll();
		$product_list = array();
		$var_list = array();
		$brand_list = array();
		$color_list = array();
		if($colors)
		{
			foreach ($colors as $color)
			{
				$color_list[] = $color->toArray();
			}
			foreach ($brands as $brand)
			{
				$brand_list[] = $brand->toArray();
			}

			foreach ($categorys as $category)
			{
				$cat_list[] = $category->toArray();
			}
			foreach ($variations as $variation)
			{
				$var_list[] = $variation->toArray();
			}

			foreach ($products as $product)
			{
				$product_list[] = $product->toArrayMini();
			}
			$arr['colors'] = $color_list;
			$arr['brands'] = $brand_list;
			$arr['categories'] = $cat_list;
			$arr['variations'] = $var_list;
			$arr['products'] = $product_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}
}
<?php

class ProductController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('index','view', 'download', 'thumbnail','category','deals','getColor','info','test'),
						'users'=>array('*'),
		),
		array('allow',
						'actions'=>array('create','update','upload',
								'search','manage','inventory','invsearch','invdelete','my','remove',
								'active','inactive','feature','getOperation','delete'),
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


	public function actionTest()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new Product();


		if(isset($_POST['Product']))
		{
			$model->attributes = $_POST['Product'];

			$code = User::randomPassword(3,true);
			$model->product_code = $company->shop_code.$code;
			$model->store_id = $company->id;
			if($model->save())
			{
				if(!empty($model->related_items))
				{
					$model->addRelatedByApi();
				}
				if(!empty($model->size_id))
				{
					$model->addRelatedSize();
				}

				$model->addHomeFeatured(Home::TYPE_PRODUCT);
				$model->addSitedata(Home::TYPE_PRODUCT);
				$arr['status'] = 'OK';
				$json_list[] =  $model->toArrayMini();
				$arr['info'] =  $json_list;
			}
			else
			{
				$err = '';
				foreach( $model->getErrors() as $error)
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


	public function actionCreate()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new Product();

		$company = 	Yii::app()->user->model->company;

		if($company)
		{
			if(isset($_POST['Product']))
			{
				$model->attributes = $_POST['Product'];
				$code = User::randomPassword(3,true);
				$model->product_code = $company->shop_code.$code;
				$model->store_id = $company->id;
				if($model->save())
				{
					if(!empty($model->related_items))
					{
						$model->addRelatedItems();
					}
					if(!empty($model->size_id))
					{
						$model->addRelatedSize();
					}
					$model->addHomeFeatured(Home::TYPE_PRODUCT);
					$model->addSitedata(Home::TYPE_PRODUCT);
					$arr['status'] = 'OK';
					$json_list[] =  $model->toArray();
					$arr['info'] =  $json_list;
				}
				else
				{
					$err = '';
					foreach( $model->getErrors() as $error)
					$err .= implode( ".",$error);
					$arr['error'] = $err;
				}
			}
		}
		$this->sendJSONResponse($arr);
	}

	public function actionUpload($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new ProductImage();

		if(isset($_FILES))
		{
			//$model->attributes = $_POST['ProductImage'];

			$uploaded_file = CUploadedFile::getInstance($model, 'image_path');

			if(isset( $uploaded_file))
			{
				$path = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER ;
				$filename = $path . get_class($model). '_' .time() . '.' .$uploaded_file->getExtensionName();
				$uploaded_file->saveAs($filename);
				$model->image_path = basename( $filename );
				$model->product_id = $id;
			}
			else {
				$arr['file'] = 'file not uploaded';
			}
			if($model->save())
			{
				$arr['status'] = 'OK';
				$arr['id'] = $id;
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
			$arr['data'] = 'data not posted';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionCategory()
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

	public function actiongetColor()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$models = Color::model()->findAll();
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
			$models = Product::model()->findAll();
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
	    //  echo json_encode($arr);
		$this->sendJSONResponse($arr);
	}

	public function actionInfo($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$product = Product::model()->findByPk($id);
		$image_list = array();
		//$relate_list = array();
		//$rev_list = array();
		if($product)
		{
			$images = $product->images;
			//$related = $product->related;
			//$reviews = $product->getReviews();
			$list_info[] = $product->toArray();
			if($images)
			{
				foreach($images as $image)
				{
					$image_list[] =  $image->toArray();
				}
			}
			else {
				$image_list[] = array('id'=>1,'image_path'=>Yii::app()->createAbsoluteUrl('product/download',array('file'=>'p11.jpg')));
			}

			/*if($related)
			{
				foreach($related as $relate)
				{
					$relate_list[] =  $relate->linkProduct->toArray();
				}
			}
			if($reviews) {
				foreach($reviews as $reviews)
				{
					$rev_list[] =  $reviews->toArray();
				}
			}*/
			$arr['images'] = $image_list;
			$arr['info'] = $list_info;
			//$arr['related'] = $relate_list;
			//$arr['reviews'] = $rev_list;
			$arr['options'] = $product->sizeOptionOnPurchase();

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

	/**
	 * this is used after login
	 */
	public function actionInventory()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('create_user_id ='. Yii::app()->user->id);
		$criteria->limit = 20;
		$models = Product::model()->findAll($criteria);
		$json_list = array();
		if($models)
		{
			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}
		}
		$arr['status'] = 'OK';
		$arr['products'] = $json_list;
		$this->sendJSONResponse($arr);
	}

	public function actionMy()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$products = Product::model()->my()->findAll();
		$json_items = array();
		if($products)
		{
			foreach($products as $product)
			{
				$json_items[] = $product->toArray();
			}
		}
		$arr['products'] = $json_items;
		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

	public function actionInvsearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Product;
		//$_POST['Product']['title'] = 'blue';
		//$_POST['Product']['type_id'] = 0;
		//$_POST['Product']['state_id'] = 0;
		//$_POST['Product']['discount_id'] = 0;
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
			$arr['data']= 'data not posted';

		}
		$this->sendJSONResponse($arr);
	}
	/**
	 * for a single item
	 * @param unknown_type $id
	 */
	public function actionRemove($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = $this->loadModel($id, 'Product');

		if( $model){

			$model->delete();
			$arr['status'] = 'OK';
			$arr['message'] = 'Successfully deleted';

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
	public function actionInactive()
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
	/**
	 * used to get list of featured products
	 */
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

	public function actionUpdate($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = $this->loadModel($id, 'Product');

		if (isset($_POST['Product'])) {
			$model->setAttributes($_POST['Product']);
			if ($model->save())
			{
				$arr['status'] = 'OK';
			}
			else
			{
				$error = '';
				foreach($model->getErrors() as $error)
				{
					$error .= implode('.'.$error);
				}
			}
		}
		$this->sendJSONResponse($arr);
	}
}
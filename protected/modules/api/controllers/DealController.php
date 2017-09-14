<?php

class DealController extends Controller {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('index','view','feature','today','info' /* 'download', 'thumbnail' */),
						'users'=>array('*'),
		),
		array('allow',
						'actions'=>array('create','update', 'search','extension','type','cancel','feature','today','refine','delete'),
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
	public function actionFeature()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('is_featured = 1');

		$deals = Deal::model()->findAll($criteria);

		$deal_list = array();
		if($deals)
		{
			$deal_list = array();
			foreach ($deals as $deal)
			{
				if($deal->item)
				$deal_list[] = $deal->toArray();
			}

		}
		$arr['deals'] = $deal_list;
		$arr['status'] = 'OK';
		$this->sendJSONResponse($arr);
	}
	public function actionToday()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->limit = 3;
		$criteria->order = 'id ASC';

		$deal_list = array();
		$deals = Deal::model()->findAll($criteria);
		if($deals)
		{
			foreach ($deals as $deal)
			{
				if($deal->item)
				$deal_list[] = $deal->toArray();
			}
			$arr['deals'] = $deal_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}


	public function actionInfo($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = $this->loadModel($id, 'Deal');

		if($model)
		{
			$deal_info[] = $model->toArray();
			$product = $model->item->product;

			$image_list = array();
			$relate_list = array();

			if($product)
			{
				$images = $product->images;
				$related = $product->related;
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
					
				if($related)
				{
					foreach($related as $relate)
					{
						$relate_list[] =  $relate->linkProduct->toArray();
					}
				}
					
				$arr['dealinfo'] = $deal_info;
				$arr['images'] = $image_list;
				$arr['info'] = $list_info;
				$arr['related'] = $relate_list;

			}
			$arr['status'] = 'OK';
			$this->sendJSONResponse($arr);
		}
	}


	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$extlists = array('1 times','2 times','3 times','4 times','5 times');
		$fields = array('Title','Description','Sku');

		$dislists = array('% off','$ off');
		foreach ($dislists as $key=>$value)
		{
			$jsondeal[] = array('type_id'=>$key,'title'=>$value);
		}

		foreach ($extlists as $key=>$value)
		{
			$jsonext[] = array('automatic_extension'=>$key,'title'=>$value);
		}
		foreach ($fields as $key=>$value)
		{
			$field[] = array('id'=>$key,'title'=>$value);
		}
		$arr['dealtype'] = $jsondeal;
		$arr['extension'] = $jsonext;
		$arr['fields'] = $field;
		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

	public function actionSearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Product();
		if (isset($_POST['Product']))
		{
			$model->setAttributes($_POST['Product']);
			$json_list = array();
			$models = $model->offersearch();
			if($models)
			{
				foreach ($models as $model)
				{
					$json_list[] = $model->toArray();
				}
				$arr['results'] = $json_list;
			}
			else
			{
				$arr['results'] = 'no record found';
			}

			$arr['status'] = 'OK';
		}

		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionView($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = $this->loadModel($id, 'Deal');

		if($model)
		{
			$json_list = array();
			$json_list[] = $model->toArray();

			$arr['dealinfo'] = $json_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionCreate()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new Deal();

		if(isset($_POST['Deal']))
		{
			$arr['post data'] = $_POST;
			$model->attributes = $_POST['Deal'];
			
			$model->automatic_extension = (int)($model->automatic_extension);
			$item_id = $_POST['Deal']['item_id'];

			$product = Product::model()->findByPk($item_id);
			if($product)
			{
				if($model->save())
				{
					if($item_id)
					{
						$offeritem = new DealItem();
						$offeritem->product_id = $item_id;
						$offeritem->deal_id = $model->id;
						if($offeritem->save())
						{
							$arr['status'] = 'OK';
							$model->addHomeFeatured(Home::TYPE_DEAL);
							$model->addSitedata(Home::TYPE_DEAL);
						}
					}
					$arr['message'] = 'Your deal is successfully created';
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
				$arr['error'] = 'Please add item';
			}
		}
		$this->sendJSONResponse($arr);
	}

	public function actionUpdate($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$deal = Deal::model()->findByPk($id);

		if($deal)
		{
			if(isset($_POST['Deal']))
			{
				$deal->attributes = $_POST['Deal'];

				if($deal->save())
				{
					$arr['status'] = 'OK';
					$arr['message'] = 'Your deal is successfully updated';
				}
				else
				{
					$err = '';
					foreach( $deal->getErrors() as $error)
					$err .= implode( ".",$error);
					$arr['error'] = $err;
				}
			}

		}
		$this->sendJSONResponse($arr);
	}

	public function actionCancel($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = $this->loadModel($id, 'Deal');

		if ($model)
		{
			$model->state_id = Deal::STATUS_DELETED;
			$arr['status'] = 'OK';
			$arr['message'] = 'Your deal is successfully cancelled';
		}
		$this->sendJSONResponse($arr);
	}
	/**
	 * deal list come on home page
	 */
	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$deals = Deal::model()->findAll();
		if($deals)
		{
			foreach ($deals as $deal)
			{
				if($deal->item)
				$deal_list[] = $deal->toArray();
			}
			$arr['deals'] = $deal_list;
			$arr['status'] = 'OK';

		}
		$this->sendJSONResponse($arr);
	}

	public function actionDelete($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = $this->loadModel($id, 'Deal');
		if ($model)
		{
			$model->delete();
			$arr['status'] = 'OK';
			$arr['message'] = 'Your deal is successfully deleted';
		}
		else
		{
			$arr['error'] = 'deal not exists';
		}
		$this->sendJSONResponse($arr);
	}

}
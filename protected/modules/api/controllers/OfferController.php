<?php

class OfferController extends GxController {

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
						'actions'=>array('create','update', 'search','edit','availProduct',
						'items','search','delete','refine','dactivate','index','products'),
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
	 * This action is used to show the product list on offer and deal create page.
	 * Enter description here ...
	 */
	public function actionAvailProduct()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$alreadyIds = Offer::getOffered();

		$criteria = new CDbCriteria;
		$criteria->addNotInCondition('id',$alreadyIds);

		$products = Product::model()->my()->findAll($criteria);
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

	/**
	 * This api is used for showing the dropdown related data
	 * Enter description here ...
	 */

	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$types = OfferType::model()->findAll();
		$fields = array('Title','Description','Sku');
		$jsontype = array();
		foreach ($types as $type)
		{
			$jsontype[] = array('type_id'=>$type->id,'title'=>$type->title);
		}
		foreach ($fields as $key=>$value)
		{
			$field[] = array('id'=>$key,'title'=>$value);
		}
		$arr['offertypes'] = $jsontype;
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
			}
			$arr['results'] = $json_list;
			$arr['status'] = 'OK';
		}
		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionDactivate()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$ids = $_POST['Product']['ids'];
		$offerid = $_POST['Product']['offer_id'];
		if($ids)
		{
			$pids= explode(',',$ids);
			foreach($pids as $pid)
			{
				$criteria = new CDbCriteria;
				$criteria->addCondition('offer_id ='.$offerid);
				$criteria->addCondition('product_id ='.$pid);
				$offeritem = OfferItem::model()->find($criteria);
				if($offeritem)
				{
					$offeritem->delete();
				}
			}
			$arr['status'] = 'OK';
			$arr['message'] = 'Your offer is successfully deactivated';
		}
		else
		{
			$arr['data'] = 'no data post';
		}

		$this->sendJSONResponse($arr);
	}
	/**
	 * I will update it after this built response
	 * Enter description here ...
	 */


	public function actionCreate()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new Offer();

		$arr['post'] = $_POST;

		if(isset($_POST['Offer']))
		{
			$model->attributes = $_POST['Offer'];

			$ids = $_POST['Offer']['ids'];
			if($model->save())
			{
				if($ids)
				{
					$pids= explode(',',$ids);
					foreach($pids as $id)
					{
						$offeritem = new OfferItem();
						$offeritem->product_id = $id;
						$offeritem->offer_id = $model->id;
						$offeritem->save();
					}
				}
				$arr['status'] = 'OK';
				$arr['message'] = 'Your offer is successfully created';
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
	/**
	 * this will use after login
	 */
	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('state_id = 1');
		$models = Offer::model()->my()->findAll($criteria);
		$deals = Deal::model()->my()->findAll();
		$json_list = array();
		$deal_list = array();
		if($models)
		{
			$json_list = array();
			$deal_list = array();
			foreach ($models as $model)
			{
				$json_list[] = $model->toArray();
			}
		}
		if($deals)
		{

			foreach ($deals as $deal)
			{
				if($deal->item)
				$deal_list[] = $deal->toArray();
			}
		}
		$arr['status'] = 'OK';

		$arr['offers'] = $json_list;
		$arr['deals'] = $deal_list;

		$this->sendJSONResponse($arr);
	}

	public function actionEdit($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$offer = Offer::model()->findByPk($id);

		if($offer)
		{
			$ids = array();
			$criteria = new CDbCriteria;
			$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
			$ids = $offer->getProductids();
			$criteria->addNotInCondition('id',$ids);
			$products = Product::model()->my()->findAll($criteria);
			$json_list[] = $offer->toArray();
			$json_items =array();
			foreach ($products as $product)
			{
				$json_items[] = $product->toArray();
			}
			$arr['offerinfo'] = $json_list;
			$arr['items'] = $json_items;
			$arr['status'] = 'OK';
			//	$arr['message'] = 'Your offer is successfully updated';
		}
		$this->sendJSONResponse($arr);
	}


	public function actionUpdate($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$offer = Offer::model()->findByPk($id);
		$arr['id'] = $id;
		if($offer)
		{
			if(isset($_POST['Offer']))
			{
				$offer->attributes = $_POST['Offer'];

				$ids = $_POST['Offer']['ids'];

				//	$offer->type_id = (int)$offer->type_id;
				//	$offer->percent_off = (int)$offer->percent_off;
				if($offer->save())
				{
					if($ids)
					{
						$pids= explode(',',$ids);
						foreach($pids as $id)
						{
							$offeritem = new OfferItem();
							$offeritem->product_id = $id;
							$offeritem->offer_id = $offer->id;
							if($offeritem->save())
							{
								$arr['res'] = 'offer item saved';
							}
							else
							{
								$err = '';
								foreach($offeritem->getErrors() as $error)
								$err .= implode( ".",$error);
								$arr['error'] = $err;
							}
						}
					}
					$arr['status'] = 'OK';
				}
				else
				{
					$err = '';
					foreach( $offer->getErrors() as $error)
					$err .= implode( ".",$error);
					$arr['error'] = $err;
				}
			}

			else
			{
				$arr['offer'] = 'offer not post';
			}
		}
		else
		{
			$arr['offer'] = 'offer not found from given id';
		}
		$this->sendJSONResponse($arr);
	}


	public function actionItems($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$offer = Offer::model()->findByPk($id);

		if($offer)
		{
			$ids = array();
			$criteria = new CDbCriteria;
			$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
			$ids = $offer->getProductids();
			$criteria->addInCondition('id',$ids);
			$products = Product::model()->findAll($criteria);
			$json_list = array();
			$json_items = array();
			$json_list[] = $offer->toArray();
			foreach ($products as $product)
			{
				$json_items[] = $product->toArray();
			}
			$arr['offerinfo'] = $json_list;
			$arr['items'] = $json_items;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionDelete($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = $this->loadModel($id, 'Offer');

		if ($model)
		{
			$model->delete();
			$arr['status'] = 'OK';
			$arr['message'] = 'Your offer is successfully deleted';
		}
		else
		{
			$arr['error'] = 'deal not exists';
		}
		$this->sendJSONResponse($arr);
	}

}
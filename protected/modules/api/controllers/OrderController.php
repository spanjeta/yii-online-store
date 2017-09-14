<?php

class OrderController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}
	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('index','logout'),
						'users'=>array('*'),
		),
		array('allow',
						'actions'=>array('index','sell','buy','app','sell','refine','searchBuy','searchSell','view','update','delete','changeState',
		),
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
	 *
	 * Enter description here ...
	 */
	public function actionChangeState()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		//$_POST['Order']['ids']=6;
		//$_POST['Order']['state_id']=3;
		if (isset($_POST['Order']))
		{

			//$model->setAttributes($_POST['Product']);
			$json_order_ids = array();
			$ids = ($_POST['Order']['ids']);
			$state_id = ($_POST['Order']['state_id']);

			$arr['ids']= $ids;

			$listids = explode(',',$ids);

			if($listids)
			{
				foreach($listids as $id)
				{
					$model = null;
					$model = Payment::model()->findByPk($id);
					$model->state_id = $state_id;
					if($model != null){
						if($model->save()){
							$arr['status'] = 'OK';
							$json_order_ids[] = $model->id; 
							
						}else{
							$arr['error'] = $model->getErrors();
						}
					}
					/*
					 if($model)
					 {
						$model->delete();
						}
						if($model->saveAttributes(array('state_id')))
						$arr['status'] = 'OK';*/
				}

					
			}
			$arr['test_order_id'] = $json_order_ids;

		}

		else
		{

		}
		$this->sendJSONResponse($arr);
	}
	/**
	 *
	 * Enter description here ...
	 * This action is basiclly used for
	 * @param unknown_type $id
	 */

	public function actionDelete($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$payment = Payment::model()->findByPk($id);

		if ($payment)
		{
			$payment->state_id = Payment::STATUS_DELETED;
			$payment->saveAttributes(array('state_id'));
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

	/**
	 * This one is used for adding a notes in payment table which we are using as a order
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function actionUpdate($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = $this->loadModel($id, 'Payment');
		if($model){
			if (isset($_POST['Order'])) {
				$notes = ($_POST['Order']['notes']);
				$model->notes = $notes;
				if(	$model->saveAttributes(array('notes'))){
					$arr['status'] = 'OK';
				}
			}
			else {
				$arr['error'] = 'Data not posted';
			}
		}
		else {
			$arr['error'] = 'this order is not exist';
		}

		$this->sendJSONResponse($arr);
	}
	/**
	 * Order view api where we send full order details
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function actionView($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = Payment::model()->findByPk($id);
		if($model) {
			$cart = $model->cart;
			if($cart) {
				$items = $cart->cartItems;

				if($items) {

					foreach($items as $item){

						$itemlist[] = $item->toArray();

					}

				}

				$orderinfo[] = $cart->toArray();
			}
		}
		$arr['status'] = 'OK';
		$arr['orderItems'] = $itemlist;
		$arr['orderInfo'] = $orderinfo;
		$this->sendJSONResponse($arr);
	}
	public function actionBuy()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$buys = Payment::model()->my()->findAll();
		$lists  = array();
		if($buys)
		{
			foreach($buys as $buy) {
				$lists[] = $buy->toArray();
			}
		}
		$arr['status'] = 'OK';
		$arr['buyItems'] = $lists;
		$arr['item_counts'] = Cart::getTotalItemCount();
		$this->sendJSONResponse($arr);
	}
	/**
	 * This action is only for business user
	 * Enter description here ...
	 */
	public function actionSell()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		if(Yii::app()->user->isBuser)
		{
			$lists  = array();
			$user = Yii::app()->user->model;
			$shop_id = $user->company->id;
			$criteria = new CDbCriteria;

			$criteria->addCondition('shop_id ='.$shop_id);
			$sells = Payment::model()->my()->findAll();
			if($sells)
			{
				foreach($sells as $sell) {
					$lists[] = $sell->toArray();
				}
			}

			$options = Payment::changeOperation();

			foreach ($options as $key=>$value)
			{
				$statslists[] = array('state_id'=>$key,'title'=>$value);
			}
			$arr['operations'] = $statslists;

			$arr['status'] = 'OK';
			$arr['sellItems'] = $lists;
			$arr['item_counts'] = Cart::getTotalItemCount();
		}
		else {
			$arr['error'] = 'Please login with business user';
		}
		$this->sendJSONResponse($arr);
	}



	/**
	 * This action is used for the dropdown data in case of search
	 * Enter description here ...
	 */
	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$options = Payment::changeOperation();

		foreach ($options as $key=>$value)
		{
			$lists[] = array('state_id'=>$key,'title'=>$value);
		}
		$arr['states'] = $lists;
		$arr['status'] = 'OK';
		$this->sendJSONResponse($arr);
	}
	/**
	 * This api is used for Searching the buying order on backend  in thiswe also search by shop name
	 * Enter description here ...
	 */
	public function actionSearchBuy()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$buylist = array();
		//$_POST['Order']['order_id'] = "12345ORDNlm";
		$arr['post_data'] = $_POST;

		if (isset($_POST['Order'])) {


			$orderid = isset($_POST['Order']['order_id']) ? $_POST['Order']['order_id']: '';
			$start_time = isset($_POST['Order']['start_time']) ? $_POST['Order']['start_time'] : '' ;
			$end_time = isset($_POST['Order']['end_time'])? $_POST['Order']['end_time'] : '';
			$state_id = isset($_POST['Order']['state_id']) ? $_POST['Order']['state_id'] :'' ;
			$shop_name = isset($_POST['Order']['shop_name']) ? $_POST['Order']['shop_name']:'' ;



			if(isset($shop_name) && !empty($shop_name)) {
				$hopids = Payment::getMyShopIds($shop_name);
				$criteria->addInCondition('shop_id',$hopids);
			}


			$criteria->addCondition('create_user_id ='.Yii::app()->user->id);

			if($start_time && $end_time){
				$arr['start_time'] =  $start_time;
				$arr['end_time'] =  $end_time;
				$criteria->addBetweenCondition('create_time', $start_time, $end_time);
			}
			if(isset($orderid) && !empty($orderid)){
				$arr['order_id'] =  $orderid;

				$criteria->addCondition('order_no = "'.$orderid.'"');
			}
			if(isset($state_id) && !empty($state_id)){
				$arr['state_id'] =  $state_id;
				$criteria->addCondition('state_id ='.$state_id);
			}
			$buyorders = Payment::model()->findAll($criteria);

			if($buyorders) {
				foreach($buyorders as $buyorder) {
					$buylist[] = $buyorder->toArray();
				}
			}
		}

		else{
			$arr['data'] = 'data not posted';
		}
		$arr['buyItems'] = $buylist;
		$arr['status'] = 'OK';
		$this->sendJSONResponse($arr);
	}

	/**
	 * This api is used for Searching the order on backend
	 * Enter description here ...
	 */
	public function actionSearchSell()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$arr['post_data'] = $_POST;
		$criteria = new CDbCriteria;
		$selllist = array();
		//$_POST['Order']['order_id'] = 10;
		if (isset($_POST['Order']))
		{
			$orderid = isset($_POST['Order']['order_id']) ? $_POST['Order']['order_id']: '';
			$start_time = isset($_POST['Order']['start_time']) ? $_POST['Order']['start_time'] : '' ;
			$end_time = isset($_POST['Order']['end_time'])? $_POST['Order']['end_time'] : '';
			$state_id = isset($_POST['Order']['state_id']) ? $_POST['Order']['state_id'] :'' ;
			$user_name = isset($_POST['Order']['user_name']) ? $_POST['Order']['user_name'] : '';
			//	$orderid = 8;

			if(isset($user_name) && !empty($user_name)) {
				$userids = Payment::getMyCustomerIds($user_name);
				$criteria->addInCondition('create_user_id',$userids);
			}

			$user = Yii::app()->user->model;
			$shop_id = $user->company->id;
			$criteria = new CDbCriteria;

			$criteria->addCondition('shop_id ='.$shop_id);

			if($start_time && $end_time){
				$arr['start_time'] =  $start_time;
				$arr['end_time'] =  $end_time;
				$criteria->addBetweenCondition('create_time', $start_time, $end_time);
			}
			if(isset($orderid) && !empty($orderid)){
				$arr['order_id'] =  $orderid;
			 $criteria->addCondition('order_no ='.$orderid);
			}
			if(isset($state_id) && !empty($state_id)){
				$arr['state_id'] =  $state_id;
				$criteria->addCondition('state_id ='.$state_id);
			}
			$orders = Payment::model()->findAll($criteria);

			if($orders) {
				foreach($orders as $order){
					$selllist[] = $order->toArray();
				}
			}


		}
		$arr['sellItems'] = $selllist;
		$arr['status'] = 'OK';
		$this->sendJSONResponse($arr);
	}
}
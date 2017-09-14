<?php
class OrderController extends Controller {
	public function filters() {
		return array (
				'accessControl' 
		);
	}
	public function accessRules() {
		return array (
				
				array (
						'allow',
						'actions' => array (
								'index',
								'sell',
								'buy',
								'makeCsv',
								'pdf',
								'updateState',
								'makeSellCsv',
								'pay',
								'view',
								'reject',
								'paypalSuccess',
								'paid'
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'update',
								'delete',
								'admin',
								'accept',
								'reject',
								'delivered',
								'on',
								'shipped',
								'view',
						),
						'expression' => 'Yii::app()->user->isAdmin' 
				),
				array (
						'deny',
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	public function actionAdmin() {
		$model = new Order ( 'search' );
		$model->unsetAttributes ();
		// $this->updateMenuItems($model);
		
		if (isset ( $_GET ['Order'] ))
			$model->setAttributes ( $_GET ['Order'] );
		
		$this->render ( 'admin', array (
				'model' => $model 
		) );
	}
	public function actionPay($id) {
		$model = Order::model ()->findByPk ( $id );
		
		$this->render ( '_paypalform', array (
				'model' => $model 
		) );
	}
	public function actionPaypalSuccess($id) {
		Yii::app()->request->enableCsrfValidation = false;
		 $values = $_POST;
		$payment = new Payment ();
		$order = Order::model ()->findByPk ( $id );
		
		if ($order) {
			$payment = $payment = new Payment ();
			$payment->order_id = $id;
			$payment->type_id = Payment::TYPE_PAYPAL;
			$payment->state_id = Payment::STATUS_COMPLETED;
			
			$payment->txn_id = (isset ( $_POST ['txn_id'] ) && ! empty ( $_POST ['txn_id'] )) ? $_POST ['txn_id'] : '';
			$payment->payer_email = (isset ( $_POST ['payer_email'] ) && ! empty ( $_POST ['payer_email'] )) ? $_POST ['payer_email'] : '';
			$payment->rec_email = (isset ( $_POST ['receiver_email'] ) && ! empty ( $_POST ['receiver_email'] )) ? $_POST ['receiver_email'] : '';
			$payment->amount = (isset ( $_POST ['payment_gross'] ) && ! empty ( $_POST ['payment_gross'] )) ? $_POST ['payment_gross'] : $order->amount;
			
			
			if ($payment->save ()) {
				$order->payment_id = $payment->id;
				$order->state_id = Order::STATE_PAID;
				$order->paid = Order::PAID;
				$order->save();
				$this->redirect ( array (
						'order/index' 
				) );
			} else {
				print_r ( $payment->getErrors () );
			}
		} 
		else {
			$this->redirect ( array (
					'order/index' 
			) );
		}
	}
	public function actionMakeSellCsv() {
		$type = $_POST ['type_id'];
		$ids = $_POST ['order_ids'];
		if (isset ( $ids ) && ! empty ( $ids )) {
			
			$file = 'sellorder.csv';
			
			$id = $ids;
			$sql = 'select order_no,company_name,amount from tbl_payment as p, tbl_company as c where p.id in  ( ' . $ids . ' ) and p.shop_id=c.id';
			
			// $sql = 'select order_no,shop_id,amount from tbl_payment where id in ( ' .$ids. ' ) ';
			$array = Yii::app ()->db->createCommand ( $sql )->queryAll ();
			
			// echo '<pre>'; print_r($array); exit;
			
			// $array = Coupon::model()->findAll();
			echo $this->array2csv ( $array, $file );
			if (isset ( $array )) {
				$csvfile = Yii::app ()->basePath . '/..' . UPLOAD_PATH . basename ( $file );
				if (file_exists ( $csvfile )) {
					$request = Yii::app ()->getRequest ();
					$request->sendFile ( basename ( $csvfile ), file_get_contents ( $csvfile ) );
				}
			}
		} else {
			$this->redirect ( array (
					'index' 
			) );
		}
	}
	
	/**
	 * this action is used for export csv in case of buying orders
	 * Enter description here ...
	 */
	public function actionMakeCsv() {
		$type = $_POST ['type_id'];
		
		$ids = $_POST ['order_ids'];
		
		if (isset ( $ids ) && ! empty ( $ids )) {
			$file = 'buyorder.csv';
			
			$id = $ids;
			$sql = 'select order_no,company_name,amount from tbl_payment as p, tbl_company as c where p.id in  ( ' . $ids . ' ) and p.shop_id=c.id';
			$array = Yii::app ()->db->createCommand ( $sql )->queryAll ();
			// $array = Coupon::model()->findAll();
			echo $this->array2csv ( $array, $file );
			if (isset ( $array )) {
				$csvfile = Yii::app ()->basePath . '/..' . UPLOAD_PATH . basename ( $file );
				if (file_exists ( $csvfile )) {
					$request = Yii::app ()->getRequest ();
					$request->sendFile ( basename ( $csvfile ), file_get_contents ( $csvfile ) );
				}
			}
		} else {
			$this->redirect ( array (
					'buy' 
			) );
		}
	}
	function array2csv($array, $file) {
		if (count ( $array ) == 0) {
			return null;
		}
		ob_start ();
		$path = Yii::app ()->basePath . "/.." . UPLOAD_PATH;
		$df = fopen ( $path . $file, "w" );
		
		fputcsv ( $df, array_keys ( reset ( $array ) ) );
		
		foreach ( $array as $row ) {
			fputcsv ( $df, $row );
		}
		fclose ( $df );
		return ob_get_clean ();
	}
	
	/**
	 * Here we updated the order by adding additional notes
	 * Enter description here ...
	 * 
	 * @param unknown_type $id        	
	 */
	/* public function actionUpdate($id) {
		$model = $this->loadModel ( $id, 'Payment' );
		
		$cart = $model->cart;
		$items = $cart->cartItems;
		$dataProvider = new CActiveDataProvider ( 'Cart', array (
				'data' => $items 
		) );
		
		if (isset ( $_POST ['Payment'] )) {
			
			$model->setAttributes ( $_POST ['Payment'] );
			
			if ($model->save ()) {
				$this->redirect ( array (
						'index' 
				) );
			}
		}
		$this->render ( 'update', array (
				'model' => $model,
				'cart' => $cart,
				'dataProvider' => $dataProvider 
		) );
	} */
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id, 'Order' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		$this->performAjaxValidation ( $model, 'page-form' );
		
		if (isset ( $_POST ['Order'] )) {
			$model->setAttributes ( $_POST ['Order'] );
			
			if ($model->save ()) {
				$this->redirect ( array (
						'order/admin'
				) );
			}
		}
		//	$this->updateMenuItems ( $model );
		$this->render ( 'update', array (
				'model' => $model
		) );
	}
	public function actionAccept($id) {
		
		$model = Order::model ()->findByPk ( $id );
		$model->state_id = Order::STATE_ACCEPT;
		
		$items = $model->orderItems;
		$dataProvider = new CActiveDataProvider ( 'Order', array (
				'data' => $items
		) );
		
		
		if($model->save())
		{
			Yii::app ()->user->setFlash ( 'accept', Yii::t('app','the order has been successfully accepted') );
		}
		
		
		$this->render ( 'view', array (
				'model' => $model,
				
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionReject($id) {
		
		$model = Order::model ()->findByPk ( $id );
		
		
		$items = $model->orderItems;
		$dataProvider = new CActiveDataProvider ( 'Order', array (
				'data' => $items
		) );
		if($model->state_id != Order::STATE_REJECT){
			foreach($items as $item){
				$cri = new CDbCriteria ();
				$cri->compare ( 'color_id', $item->color_id);
				$cri->compare ( 'size_id', $item->size_id);
				//$varproduct = VarProduct::model ()->find ( $cri );
				$modelvar = VarProduct::model ()->find ( $cri );
				if(!empty($model)){
					$quantity = $modelvar->quantity + $item->quantity;
					$modelvar->quantity = $quantity;
					$modelvar->save();
				}
			}			
			$model->state_id = Order::STATE_REJECT;
			if($model->save())
			{
				Yii::app ()->user->setFlash ( 'reject',  Yii::t('app','the order has been successfully rejected') );
			}
		} else {
			Yii::app ()->user->setFlash ( 'reject',  Yii::t('app','the order has been already rejected') );
		}
		
		
		
		$this->render ( 'view', array (
				'model' => $model,
				
				'dataProvider' => $dataProvider
		) );
	}
	public function actionDelivered($id) {
		
		$model = Order::model ()->findByPk ( $id );
		$model->state_id = Order::STATE_DELIVERED;
		
		$items = $model->orderItems;
		$dataProvider = new CActiveDataProvider ( 'Order', array (
				'data' => $items
		) );
		
		
		if($model->save())
		{
			Yii::app ()->user->setFlash ( 'delivered',  Yii::t('app','the order has been successfully delivered') );
		}
		
		
		$this->render ( 'view', array (
				'model' => $model,
				
				'dataProvider' => $dataProvider
		) );
	}
	public function actionOn($id) {
		
		$model = Order::model ()->findByPk ( $id );
		$model->state_id = Order::STATE_ON;
		
		$items = $model->orderItems;
		$dataProvider = new CActiveDataProvider ( 'Order', array (
				'data' => $items
		) );
		
		
		if($model->save())
		{
			Yii::app ()->user->setFlash ( 'On',  Yii::t('app','the order has been on the way') );
		}
		
		
		$this->render ( 'view', array (
				'model' => $model,
				
				'dataProvider' => $dataProvider
		) );
	}
	public function actionShipped($id) {
		
		$model = Order::model ()->findByPk ( $id );
		$model->state_id = Order::STATE_SHIPPED;
		
		$items = $model->orderItems;
		$dataProvider = new CActiveDataProvider ( 'Order', array (
				'data' => $items
		) );
		
		
		if($model->save())
		{
			Yii::app ()->user->setFlash ( 'Shipped',  Yii::t('app','the order has been shipped') );
		}
		
		
		$this->render ( 'view', array (
				'model' => $model,
				
				'dataProvider' => $dataProvider
		) );
	}
	
	public function actionPaid($id) {
		
		$model = Order::model ()->findByPk ( $id );
		$model->paid = Order::PAID;
		
		$items = $model->orderItems;
		$dataProvider = new CActiveDataProvider ( 'Order', array (
				'data' => $items
		) );
		
		
		if($model->save())
		{
			Yii::app ()->user->setFlash ( 'Paid',  Yii::t('app','the payment status chantged as paid') );
		}
		
		
		$this->render ( 'view', array (
				'model' => $model,
				
				'dataProvider' => $dataProvider
		) );
	}
	/* public function actionManageProduct($id) {
		$model=Order::model()->findAll(
				
				array(
					
						'condition'=>'status="A"',
					
						'group'=>'type'
				
				));
		
		
		$model = Order::find()->where(['order_id' => $orderid])->all();
		$categorys = Category::model ()->findAll ();
	foreach($model as $m)
	{
		$Product =  Product::findAllByAttributes()->where(['id' => $m->product_id])->all();
		
		foreach($Product as $pro)
		{
			$pro->quantity = $pro->quantity - $m->quantity;
			$pro->save();
		}
	}
	
	foreach($model as $v)
	{
		$VarProduct = VarProduct::find()->where(['id' => $m->var_product_id])->all();
		foreach($VarProduct as $v)
		{
			$pro->quantity = $pro->quantity - $v->quantity;
			$pro->save();
		}
	}
	} */
	/**
	 * This action is used for view the order informations
	 * Enter description here ...
	 * 
	 * @param unknown_type $id        	
	 */
	public function actionView($id) {
		/* $this->redirect ( array (
				'buy' 
		) ); */
		$model = Order::model ()->findByPk ( $id );
		
		$items = $model->orderItems;
		$dataProvider = new CActiveDataProvider ( 'Order', array (
				'data' => $items 
		) );
		$this->render ( 'view', array (
				'model' => $model,
				
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionIndex() {
		$this->redirect ( array (
				'buy' 
		) );
	}
	public function actionBuy() {
		$this->layout = 'column1';
		$model = new Order ( 'search' );
		$model->unsetAttributes ();
		$model->create_user_id = Yii::app ()->user->id;
		
		
		if (isset ( $_GET ['Order'] )) {
			
			$model->setAttributes ( $_GET ['Order'] );
		}
		
		
		$this->render ( 'buybasic', array (
				'model' => $model 
		) );
	}
	/**
	 *
	 * Enter description here ...
	 * here we change the order state and mark as deleted
	 * 
	 * @param unknown_type $id        	
	 * @throws CHttpException
	 */
	/* public function actionDelete($id) {
		$payment = Payment::model ()->findByPk ( $id );
		
		$payment->state_id = Payment::STATUS_DELETED;
		
		if ($payment->saveAttributes ( array (
				'state_id' 
		) )) {
			Yii::app ()->user->setFlash ( 'delete', 'The order has been successfully deleted' );
		}
		
		$this->redirect ( array (
				'index' 
		) );
	} */
	 public function actionDelete($id) { 
		
		
		$order= Order::model ()->findByPk ( $id );
		
		
		
		
		//var_dump($payment);exit;
		if($order){
			$order->state_id = Order::STATE_DELETED;
			
			
			
			if ($order->save()) {
				
				
				Yii::app ()->user->setFlash ( 'delete',  Yii::t('app','the order has been successfully deleted') );
				
				//print_R("saved"); exit;
				
			}
			else {
				print_R("failed"); exit;
				print_R($order); exit;
			}
			$this->redirect ( array (
					'order/admin'
			) );}
			
	 } 
	/**
	 * Enter description here ...
	 * thhis action is basically used for changing order statef
	 */
	public function actionUpdateState() {
		$vals = ($_POST ['checkedValues']);
		$state_id = ($_POST ['state_id']);
		
		switch ($state_id) {
			case Payment::STATUS_PENDING :
				{
					foreach ( $vals as $val ) {
						$model = $this->loadModel ( $val, 'Payment' );
						$model->state_id = Payment::STATUS_PENDING;
						$model->saveAttributes ( array (
								'state_id' 
						) );
					}
					break;
				}
			
			case Payment::STATUS_COMPLETED :
				{
					foreach ( $vals as $val ) {
						$model = $this->loadModel ( $val, 'Payment' );
						$model->state_id = Payment::STATUS_COMPLETED;
						$model->saveAttributes ( array (
								'state_id' 
						) );
					}
					break;
				}
			
			case Payment::STATUS_POSTED :
				{
					foreach ( $vals as $val ) {
						$model = $this->loadModel ( $val, 'Payment' );
						$model->state_id = Payment::STATUS_POSTED;
						$model->saveAttributes ( array (
								'state_id' 
						) );
					}
					break;
				}
			
			case Payment::STATUS_REVIEWED :
				{
					foreach ( $vals as $val ) {
						$model = $this->loadModel ( $val, 'Payment' );
						$model->state_id = Payment::STATUS_REVIEWED;
						$model->saveAttributes ( array (
								'state_id' 
						) );
					}
					break;
				}
			case Payment::STATUS_CANCEL :
				{
					foreach ( $vals as $val ) {
						$model = $this->loadModel ( $val, 'Payment' );
						$model->state_id = Payment::STATUS_CANCEL;
						$model->saveAttributes ( array (
								'state_id' 
						) );
					}
					break;
				}
		}
		
		echo 'success';
		exit ();
	}
}
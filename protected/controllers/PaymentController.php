<?php
class PaymentController extends Controller {
	/**
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 *      using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column3';
	
	/**
	 *
	 * @return array action filters
	 */
	public function filters() {
		return array (
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete'  // we only allow deletion via POST request
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * 
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
		/* 	array('allow',  // allow all users to perform 'index' and 'view' actions
		 'actions'=>array('index','view','create','success','cancel'),
		 'users'=>array('*'),
		 ), */
		array (
						'allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions' => array (
								'update',
								'index',
								'view',
								'create',
								'success',
								'cancel',
								'notify',
								'invoice',
								'print',
								'review',
								'successApp',
								'cancelApp' 
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions' => array (
								'admin',
								'delete' 
						),
						'expression' => 'Yii::app()->user->isAdmin()' 
				),
				array (
						'deny', // deny all users
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	
	/**
	 * Displays a particular model.
	 * 
	 * @param integer $id
	 *        	the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render ( 'view', array (
				'model' => $this->loadModel ( $id ) 
		) );
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Payment ();
		$model->amount = 10;
		$model->user_id = yii::app ()->user->id;
		$model->status_id = Payment::STATUS_INCOMPLETED;
		$model->transaction_id = 'Not verified';
		$model->validity_time = 0;
		if ($model->save ())
			
			$this->render ( 'create', array (
					'model' => $model 
			) );
	}
	public function actionIndex() {
		$model = new Payment ( 'search' );
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['Payment'] ))
			$model->attributes = $_GET ['Payment'];
		
		$this->render ( 'admin', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Payment ( 'search' );
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['Payment'] ))
			$model->attributes = $_GET ['Payment'];
		
		$this->render ( 'admin', array (
				'model' => $model 
		) );
	}
	/**
	 * This success url is for web payment here i am not using layout false
	 * Enter description here ...
	 * 
	 * @param unknown_type $id        	
	 */
	public function actionSuccess($id) {
		$values = $_POST;
		$payment = new Payment ();
		$cart = Cart::model ()->findByPk ( $id );
		
		if ($cart) {
			if (isset ( $values ) && ! empty ( $values )) {
				$payment->data = $values;
			}
			
			$order_no = $cart->shop->shop_code . 'ORD' . User::randomPassword ( 3 );
			
			$cart->state_id = Cart::CART_PAY;
			$cart->saveAttributes ( array (
					'state_id' 
			) );
			
			$criteria = new CDbCriteria ();
			$criteria->addCondition ( 'cart_id =' . $cart->id );
			
			$isPayment = Payment::model ()->find ( $criteria );
			if ($isPayment) {
				$payment = $isPayment;
			}
			$payment->cart_id = $id;
			$payment->order_no = (isset ( $isPayment ) && ! empty ( $isPayment )) ? $isPayment->order_no : $order_no;
			
			$payment->type_id = Payment::TYPE_PAYPAL;
			$payment->shop_id = $cart->shop->id;
			$payment->state_id = Payment::STATUS_COMPLETED;
			$payment->txn_id = (isset ( $_POST ['txn_id'] ) && ! empty ( $_POST ['txn_id'] )) ? $_POST ['txn_id'] : '';
			$payment->payer_email = (isset ( $_POST ['payer_email'] ) && ! empty ( $_POST ['payer_email'] )) ? $_POST ['payer_email'] : '';
			$payment->rec_email = (isset ( $_POST ['receiver_email'] ) && ! empty ( $_POST ['receiver_email'] )) ? $_POST ['receiver_email'] : '';
			$payment->amount = (isset ( $_POST ['payment_gross'] ) && ! empty ( $_POST ['payment_gross'] )) ? $_POST ['payment_gross'] : $cart->amount;
			
			if ($payment->save ()) {
				$this->render ( 'success', array (
						'payment' => $payment 
				) );
			} else {
				print_r ( $payment->getErrors () );
			}
		} 
		else {
			$method = new PaymentSetting ();
			$this->render ( 'cancel' );
		}
	}
	/**
	 * This action is using on web end to handle cancel request
	 * Enter description here ...
	 * 
	 * @param unknown_type $id        	
	 */
	public function actionCancel($id) {
		$method = new PaymentSetting ();
		$this->render ( 'cancel', array (
				'method' => $method,
				'cart_id' => $id 
		) );
	}
	/**
	 * This success url is for payment by app end payment here i am using layout false
	 * Enter description here ...
	 * 
	 * @param unknown_type $id        	
	 */
	public function actionSuccessApp($id) {
		$this->layout = false;
		$values = $_POST;
		$payment = new Payment ();
		$cart = Cart::model ()->findByPk ( $id );
		
		if ($cart) {
			if (isset ( $values ) && ! empty ( $values )) {
				$payment->data = $values;
			}
			$order_no = $cart->shop->shop_code . 'ORD' . User::randomPassword ( 3 );
			
			$cart->state_id = Cart::CART_PAY;
			$cart->saveAttributes ( array (
					'state_id' 
			) );
			
			$criteria = new CDbCriteria ();
			$criteria->addCondition ( 'cart_id =' . $cart->id );
			
			$isPayment = Payment::model ()->find ( $criteria );
			if ($isPayment) {
				$payment = $isPayment;
			}
			$payment->cart_id = $id;
			$payment->order_no = (isset ( $isPayment ) && ! empty ( $isPayment )) ? $isPayment->order_no : $order_no;
			
			$payment->type_id = Payment::TYPE_PAYPAL;
			$payment->shop_id = $cart->shop->id;
			$payment->state_id = Payment::STATUS_COMPLETED;
			$payment->txn_id = (isset ( $_POST ['txn_id'] ) && ! empty ( $_POST ['txn_id'] )) ? $_POST ['txn_id'] : '';
			$payment->payer_email = (isset ( $_POST ['payer_email'] ) && ! empty ( $_POST ['payer_email'] )) ? $_POST ['payer_email'] : '';
			$payment->rec_email = (isset ( $_POST ['receiver_email'] ) && ! empty ( $_POST ['receiver_email'] )) ? $_POST ['receiver_email'] : '';
			$payment->amount = (isset ( $_POST ['payment_gross'] ) && ! empty ( $_POST ['payment_gross'] )) ? $_POST ['payment_gross'] : $cart->amount;
			
			if ($payment->save ()) {
				$this->render ( 'successapp', array (
						'payment' => $payment 
				) );
			} else {
				print_r ( $payment->getErrors () );
			}
		} 
		else {
			$method = new PaymentSetting ();
			$this->render ( 'cancel', array (
					'method' => $method,
					'cart_id' => $id 
			) );
		}
	}
	/**
	 * This action is using on web end to handle cancel request
	 * Enter description here ...
	 * 
	 * @param unknown_type $id        	
	 */
	public function actionCancelApp($id) {
		$this->layout = false;
		$method = new PaymentSetting ();
		$this->render ( 'cancelapp', array (
				'method' => $method,
				'cart_id' => $id 
		) );
	}
	public function actionInvoice($id) {
		$criteria = new CDbCriteria ();
		$online_end = date ( 'Y-m-d H:i:s', time () );
		$criteria->addCondition ( 'user_id = \'' . $id . '\'' );
		$criteria->addCondition ( 'validity_time >=\'' . $online_end . '\'' );
		$model = Payment::model ()->find ( $criteria );
		if ($model) {
			$this->render ( 'success', array (
					'model' => $model 
			) );
		}
		Yii::app ()->end ();
	}
	public function actionPrint($id) {
		$criteria = new CDbCriteria ();
		$online_end = date ( 'Y-m-d H:i:s', time () );
		$criteria->addCondition ( 'user_id = \'' . $id . '\'' );
		$criteria->addCondition ( 'validity_time >=\'' . $online_end . '\'' );
		$model = Payment::model ()->find ( $criteria );
		if ($model) {
			$this->renderPartial ( 'invoice', array (
					'model' => $model 
			) );
		}
		Yii::app ()->end ();
	}
	public function actionReview($id) {
		$method = new PaymentSetting ();
		$this->render ( 'cancel' );
	}
}

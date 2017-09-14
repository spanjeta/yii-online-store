<?php
class CartController extends Controller {
	public function filters() {
		return array (
				'accessControl'
		);
	}
	public function accessRules() {
		return array(
				/*	array('allow',
				 'actions'=>array('index','view', 'download', 'thumbnail','add','updateSize','updateCart','updateCoupon'),
				 'users'=>array('*'),
				 ), */
				array (
						'allow',
						'actions' => array (
								'create',
								
								'search',
								'editable',
								
								
								'payment',
								'test',
								
								'index',
								
								'download',
								'thumbnail',
								'add',
								'addcart',
								'updateSize',
								'updateCart',
								'updateCoupon',
								'varAdd',
								'billing',
								
								'addwishlist'
						),
						'users' => array (
								'@'
						)
				),
				array (
						'allow',
						'actions' => array (
								'view',
								'addquantity',
								'subquantity',
								'delete',
								'checkout',
								
						),
						'expression' => 'Yii::app()->user->id'
				),
				array (
						'allow',
						'actions' => array (
								'admin',
								'update',
								'delete'
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
	
	/**
	 * this action is used only for testing purpose
	 * Enter description here ...
	 *
	 * @param unknown_type $cart_id
	 */
	public function actionTest($cart_id = 1) {
		$payment = Payment::model ()->findByPk ( $cart_id );
		$this->render ( 'cash_home', array (
				'payment' => $payment
		) );
	}
	public function actionCheckout($cart_id = null) {
		$this->layout = 'column1';
		$cart = Cart::model ()->findByPk ( $cart_id );
		if ($cart == null or ! ($cart->isAllowed ()))
			throw new CHttpException ( 403, Yii::t ( 'app', 'You are not allowed to access this page.' ) );
			
			$addresses = Address::model ()->findAllByAttributes ( array (
					'create_user_id' => Yii::app ()->user->id
			) );
			
			$this->render ( 'billing', array (
					'addresses' => $addresses,
					'id' => $cart->id
			) );
	}
	public function actionBilling($id = null, $cart_id = null) {
		$this->layout = 'column1';
		$address = Address::model ()->findByPk ( $id );
		$cart = Cart::model ()->findByPk ( $cart_id );
		if ($address != null) {
			$address->cart_id = $cart_id;
			$address->saveAttributes ( array (
					'cart_id'
			) );
		}
		
		$this->render ( 'pay', array (
				'cart' => $cart
		) );
	}
	/*
	 * public function actionCheckout($cart_id = null)
	 * {
	 * $this->layout = 'column1';
	 * $cart = Cart::model()->findByPk($cart_id);
	 * if($cart == null or !($cart->isAllowed( ))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	 *
	 *
	 * $address = new Address();
	 *
	 * $criteria = new CDbCriteria;
	 * $criteria->addCondition('cart_id ='.$cart_id);
	 * $cartAddress = Address::model()->find($criteria);
	 *
	 * if($cartAddress) {
	 * $address = $cartAddress;
	 * }
	 * //$this->performAjaxValidation($badd, 'user-form-bus-bill');
	 * if (isset($_POST['Address']))
	 * {
	 * $address->setAttributes($_POST['Address']);
	 * $address->create_user_id = Yii::app()->user->id;
	 * $address->cart_id = $cart_id;
	 * if($address->save()) {
	 * $this->redirect(array('payment','cart_id'=>$cart_id));
	 * Yii::app()->end();
	 * }
	 * else {
	 * print_r($address->getErrorS());exit;
	 * }
	 * }
	 *
	 * $this->render('billing',array(
	 * 'address'=>$address,
	 * ));
	 *
	 * }
	 */
	 protected function ProductInventory($color_id,$size_id,$qty){
	 	$quantity = 0;
	 	
	 	$arr  = array();
	 	$cri = new CDbCriteria ();
	 	$cri->compare ( 'color_id', $color_id);
	 	$cri->compare ( 'size_id', $size_id);
	 	//$varproduct = VarProduct::model ()->find ( $cri );
	 	$model = VarProduct::model ()->find ( $cri );
	 	
	 	if($model->quantity > 0 and ($model->quantity - $qty) >= 0) {
	 		$quantity = $model->quantity - $qty;
	 		$model->quantity = $quantity;
	 		if(!$model->save()){
	 			$err = '';
	 			foreach($model->getErrors() as $e){
	 				$err .= implode(',',$e);
	 			}
	 			$arr ['result'] = false;
	 			$arr ['error'] = $err;
	 			return $arr;
	 		}
	 	}else {
	 		$arr ['error'] = $model->title.'item is out of stock!';
	 		$arr ['result'] = false;
	 		return $arr;
	 	}
	 	$arr ['result'] = true;
	 	$arr ['error'] = 'success';
	 	return $arr;
	 	
	 }
	 public function actionPayment($cart_id, $method) {
	 	$transaction = Yii::app ()->db->beginTransaction ();
	 	$arr ['status'] = 'NOK';
	 	$model = Cart::model ()->findByPk ( $cart_id );
	 	
	 	if ($model) {
	 		$address = Address::model ()->findByAttributes ( array (
	 				'cart_id' => $cart_id
	 		) );
	 		$order = new Order ();
	 		$order->amount = $model->amount;
	 		if(!empty($address->ph_no))
	 			$order->phone_no = $address->ph_no;
	 			$order_email = User::model()->findByAttributes(array(
	 					'id' => Yii::app()->user->id
	 			));
	 			$order->order_email = $order_email->email;
	 			if ($method == Order::CASH_ON_DELIVERY) {
	 				$order->state_id = Order::STATE_UNPAID;
	 			}
	 			$order->type_id = $method;
	 			$order->ship_address_id = $address->id;
	 			$order->bil_address_id = $address->id;
	 			if ($order->save ()) {
	 				$noty = new Feed();
	 				$noty->model_id = $order->id;
	 				$noty->model_type = get_class($model);
	 				$noty->content = 'New Order Placed by' . ' ' . $order_email->first_name .''. ' Order Id :' .''.$order->id;
	 				$noty->create_user_id = $order_email->id;
	 				if (! $noty->save ()) {
	 					$transaction->rollback();
	 					print_r ( $noty->getErrors () );
	 					exit ();
	 				}
	 				$cartItems = CartItem::model ()->findAllByAttributes ( array (
	 						'cart_id' => $model->id
	 				) );
	 				if ($cartItems) {
	 					foreach ( $cartItems as $val ) {
	 						$orderItems = new OrderItem ();
	 						$orderItems->amount = $val->amount;
	 						$orderItems->quantity = $val->quantity;
	 						$orderItems->product_id = $val->product_id;
	 						$orderItems->color_id = $val->color_id;
	 						$orderItems->size_id = $val->size_id;
	 						$orderItems->create_user_id = $val->create_user_id;
	 						$orderItems->order_id = $order->id;
	 						if ($orderItems->save ()) {
	 							$cartsizes = CartSize::model ()->findAllByAttributes ( array (
	 									'cart_item_id' => $val->id
	 							) );
	 							
	 							$result = $this->ProductInventory($orderItems->color_id, $orderItems->size_id,  $orderItems->quantity);
	 							if(!$result['result']){
	 								$transaction->rollback();
	 								$arr ['error'] = $result['error'];
	 								$this->sendJSONResponse ( $arr );
	 								exit;
	 							}
	 							if ($cartsizes != null) {
	 								foreach ( $cartsizes as $cartsize ) {
	 									$ordersize = new OrderSize ();
	 									$ordersize->amount = $cartsize->amount;
	 									$ordersize->quantity = $cartsize->quantity;
	 									$ordersize->size_id = $cartsize->size_id;
	 									$ordersize->order_item_id = $orderItems->id;
	 									if ($ordersize->save ()) {
	 										$cartsize->delete ();
	 									}
	 								}
	 							}
	 						} else {
	 							$transaction->rollback();
	 							$err = '';
	 							foreach($orderItems->getErrors () as $e){
	 								$err .= implode(',',$e);
	 							}
	 							$arr ['error'] = $err;
	 							$this->sendJSONResponse ( $arr );
	 							exit ();
	 						}
	 					}
	 					if ($model->delete ()) {
	 						$transaction->commit();
	 						$arr ['status'] = 'OK';
	 						if ($method == Order::CASH_ON_DELIVERY) {
	 							$arr ['url'] = Yii::app ()->createUrl ( 'order/index' );
	 						} else {
	 							$arr ['url'] = Yii::app ()->createUrl ( 'order/pay', array (
	 									'id' => $order->id
	 							) );
	 						}
	 					}
	 				} else {
	 					$arr ['error'] = 'No item in the cart';
	 				}
	 			}
	 	}
	 	$this->sendJSONResponse ( $arr );
	 }
	 
	 /*
	  * public function actionPayment($cart_id = null)
	  * {
	  * Yii::log('Shakti Sharma id is '.$cart_id, CLogger::LEVEL_WARNING);
	  * //print_r($_GET);exit;
	  * $model = $this->loadModel($cart_id, 'Cart');
	  * if( !($model->isAllowed( ))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	  *
	  * // here is calculation about payment method
	  * $paymentmethods = $model->createUser->paymentSetting;
	  * $method = new PaymentSetting();
	  *
	  * $paypal = $model->createUser->Paypal;
	  *
	  * if (isset($_POST['PaymentSetting']) && isset($_POST['PaymentSetting']['pay_by']))
	  * {
	  * $payby = $_POST['PaymentSetting']['pay_by'];
	  * // echo $payby; exit;
	  * // $method->setAttributes($_POST['PaymentSetting']);
	  * if($payby == 0) {
	  *
	  * $this->render('_paypalform',array('model'=>$model));
	  * }
	  * else if($payby == 1) {
	  * $this->render('_cartform',array('model'=>new CreditCard(),'cart_id'=>$cart_id));
	  * }
	  * else if($payby == 2){
	  * $payment = $model->verifyPayment(Payment::TYPE_DEPOSIT);
	  * $this->render('deposit',array('payment'=>$payment));
	  * }
	  * else if($payby == 3){
	  * $payment = $model->verifyPayment(Payment::TYPE_CASHPICKUP);
	  * $this->render('cash_pick',array('payment'=>$payment));
	  * }
	  * else if($payby == 4){
	  * $payment =$model->verifyPayment(Payment::TYPE_CASHDELIVERY);
	  * $this->render('cash_home',array('payment'=>$payment));
	  * }
	  * else {
	  * $this->render('_paypalform',array('model'=>$model));
	  * }
	  * Yii::app()->end();
	  * }
	  * $this->render('payment', array(
	  * 'model' => $model,
	  * 'method'=>$method
	  * ));
	  *
	  * // $this->render('deposit');
	  * }
	  */
	  public function actionEditable() {
	  	// print_r($_GET);exit;
	  	$model = $this->loadModel ( $id, 'Cart' );
	  	
	  	$id = $_GET ['pk'];
	  	$quantity = $_GET ['value'];
	  	// if(!($this->isAllowed($model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	  	
	  	$this->updateMenuItems ( $model );
	  	$this->render ( 'view', array (
	  			'model' => $model
	  	) );
	  }
	  public function isAllowed($model) {
	  	return $model->isAllowed ();
	  }
	  
	  /**
	   * here we can add product in cart and link them with cart items.
	   */
	  public function actionVarAdd($id) {
	  	
	  	$arr = array (
	  			'controller' => $this->id,
	  			'action' => $this->action->id,
	  			'status' => 'NOK',
	  			'error' => 'error'
	  	);
	  	// This section is used for a particular shop
	  	$item_id = $id;
	  	
	  	$previous_amt = 0;
	  	$previous_quantity = 0;
	  	
	  	$product = VariantProduct::model ()->findByPk ( $id );
	  	if ($product != null) {
	  		$mainproduct = Product::model ()->findByAttributes ( array (
	  				'prod_id' => $product->product_id
	  		) );
	  	}
	  	
	  	$criteria = new CDbCriteria ();
	  	// $criteria->addCondition('shop_id ='.$shop_id);
	  	$criteria->addCondition ( 'create_user_id =\'' . Yii::app ()->user->id . '\'' );
	  	// $criteria->addCondition('state_id ='.Cart::CART_NEW);
	  	$iscart = Cart::model ()->find ( $criteria );
	  	
	  	if ($iscart) {
	  		$cart = $iscart;
	  	} else {
	  		$cart = new Cart ();
	  		// $cart->shop_id = $shop_id;
	  		$cart->state_id = Cart::CART_NEW;
	  		$cart->save ();
	  	}
	  	$previous_amt = $cart->amount;
	  	
	  	// Now section is cart item. here we add item in cart with using of cart id...
	  	$cartItem = new CartItem ();
	  	$criteria1 = new CDbCriteria ();
	  	$criteria1->addCondition ( 'cart_id =' . $cart->id );
	  	$criteria1->addCondition ( 'product_id =\'' . $item_id . '\'' );
	  	$isItem = CartItem::model ()->find ( $criteria1 );
	  	if (! $isItem) {
	  		
	  		$cartItem->product_id = $mainproduct->id;
	  		$cartItem->var_product_id = $item_id;
	  		$cartItem->cart_id = $cart->id;
	  		
	  		if ($cartItem->save ()) {
	  			if (isset ( $_POST ['size'] )) {
	  				$sizes = $_POST ['size'];
	  				if ($sizes) {
	  					$quantity = 0;
	  					$old_amount = 0;
	  					foreach ( $sizes as $size ) {
	  						$quantity = $quantity + $size;
	  					}
	  					foreach ( $sizes as $key => $size ) {
	  						$cartSize = CartSize::model ()->findByAttributes ( array (
	  								'size_id' => $key,
	  								'cart_item_id' => $cartItem->id
	  						) );
	  						if ($size != '') {
	  							if ($cartSize == null) {
	  								$cartSize = new CartSize ();
	  							}
	  							$cartSize->cart_item_id = $cartItem->id;
	  							$cartSize->size_id = $key;
	  							$cartSize->quantity = $size;
	  							$cartSize->amount = $mainproduct->getAmountOfSize ( $key, $size, $quantity );
	  							$old_amount = $old_amount + ($size * $cartSize->amount);
	  							$cartSize->save ();
	  						}
	  					}
	  					
	  					$cartItem->amount = $old_amount;
	  					$cartItem->saveAttributes ( array (
	  							'amount'
	  					) );
	  				}
	  			}
	  			$cart->amount = $previous_amt + $cartItem->amount;
	  			$cart->saveAttributes ( array (
	  					'amount'
	  			) );
	  			Yii::log ( CVarDumper::DumpAsString ( $cart->amount ), CLogger::LEVEL_WARNING, '$cart->amount' );
	  			$arr ['status'] = 'OK';
	  		}
	  	} else {
	  		$arr ['error'] = 'Product is already added into cart';
	  	}
	  	$this->sendJSONResponse ( $arr );
	  }
	  public function actionAdd() {
	  	
	  	if(isset($_POST['id']) and $id = $_POST['id']){
	  		$arr = array (
	  				'controller' => $this->id,
	  				'action' => $this->action->id,
	  				'status' => 'NOK',
	  				'error' => 'error'
	  		);
	  		// This section is used for a particular shop
	  		
	  		$item_id = $id;
	  		$previous_amt = 0;
	  		$previous_quantity = 0;
	  		$product = Product::model ()->findByPk ( $id );
	  		
	  		
	  		
	  		$criteria = new CDbCriteria ();
	  		$criteria->addCondition ( 'create_user_id =\'' . Yii::app ()->user->id . '\'' );
	  		$iscart = Cart::model ()->find ( $criteria );
	  		
	  		if ($iscart) {
	  			$cart = $iscart;
	  			//	$cart->amount = $cart->amount + $product->price;
	  			
	  		} else {
	  			$cart = new Cart ();
	  			//$cart->amount = $product->price;
	  			$cart->state_id = Cart::CART_NEW;
	  			$cart->save ();
	  		}
	  		$previous_amt = $cart->amount;
	  		Yii::log ( CVarDumper::DumpAsString ( $previous_amt ), CLogger::LEVEL_WARNING, '$previous_amt' );
	  		// Now section is cart item. here we add item in cart with using of cart id...
	  		$cartItem = new CartItem ();
	  		
	  		$criteria1 = new CDbCriteria ();
	  		$criteria1->addCondition ( 'cart_id =' . $cart->id );
	  		$criteria1->addCondition ( 'product_id =\'' . $item_id . '\'' );
	  		$isItem = CartItem::model ()->find ( $criteria1 );
	  		
	  		
	  		if (! $isItem) {
	  			$cartItem->product_id = $item_id;
	  			$cartItem->cart_id = $cart->id;
	  			$cartItem->amount = $product->price;
	  			
	  			$cartItem->quantity = CartItem::QUANTITY;
	  			if($product->color_id != null)
	  				$cartItem->color_id = $product->color_id;
	  				
	  				if($product->size_id != null)
	  					$cartItem->size_id = $product->size_id;
	  					
	  					if ($cartItem->save ()) {
	  						if (isset ( $_POST ['size'] )) {
	  							$sizes = $_POST ['size'];
	  							if ($sizes) {
	  								$quantity = 0;
	  								$old_amount = 0;
	  								foreach ( $sizes as $size ) {
	  									$quantity = $quantity + $size;
	  								}
	  								foreach ( $sizes as $key => $size ) {
	  									$cartSize = CartSize::model ()->findByAttributes ( array (
	  											'size_id' => $key,
	  											'cart_item_id' => $cartItem->id
	  									) );
	  									if ($size != '') {
	  										if ($cartSize == null) {
	  											$cartSize = new CartSize ();
	  										}
	  										$cartSize->cart_item_id = $cartItem->id;
	  										$cartSize->size_id = $key;
	  										$cartSize->quantity = $size;
	  										$cartSize->amount = $product->getAmountOfSize ( $key, $size, $quantity );
	  										$old_amount = $old_amount + ($size * $cartSize->amount);
	  										$cartSize->save ();
	  									}
	  								}
	  								
	  								$cartItem->amount = $old_amount;
	  								$cartItem->saveAttributes ( array (
	  										'amount'
	  								) );
	  							}
	  						}
	  						$cart->amount = $previous_amt + $cartItem->amount;
	  						$cart->saveAttributes ( array (
	  								'amount'
	  						) );
	  						Yii::log ( CVarDumper::DumpAsString ( $cart->amount ), CLogger::LEVEL_WARNING, '$cart->amount' );
	  						$arr ['status'] = 'OK';
	  						$arr ['error'] = 'Item is Added Successfully in cart';
	  						
	  						
	  					}
	  		} else {
	  			$arr ['error'] = 'Product is already added into cart';
	  		}
	  		$criteria = new CDbCriteria ();
	  		$criteria->compare ( 'create_user_id', Yii::app ()->user->id);
	  		$arr ['count'] = CartItem::model ()->count($criteria);
	  		
	  		$criteria = new CDbCriteria ();
	  		$criteria->compare ( 'create_user_id', Yii::app ()->user->id);
	  		$amount = Cart::model ()->find ( $criteria );
	  	} else {
	  		$arr['error'] = 'Product is empty!';
	  	}
	  	$this->sendJSONResponse ( $arr );
	  }
	  public function actionAddCart($id) {
	  	
	  	$arr = array (
	  			'controller' => $this->id,
	  			'action' => $this->action->id,
	  			'status' => 'NOK',
	  			'error' => 'error'
	  	);
	  	// This section is used for a particular shop
	  	
	  	$item_id = $id;
	  	$previous_amt = 0;
	  	$previous_quantity = 0;
	  	$product = Product::model ()->findByPk ( $id );
	  	
	  	
	  	
	  	$criteria = new CDbCriteria ();
	  	$criteria->addCondition ( 'create_user_id =\'' . Yii::app ()->user->id . '\'' );
	  	$iscart = Cart::model ()->find ( $criteria );
	  	
	  	if ($iscart) {
	  		$cart = $iscart;
	  		//	$cart->amount = $cart->amount + $product->price;
	  		
	  	} else {
	  		$cart = new Cart ();
	  		//$cart->amount = $product->price;
	  		$cart->state_id = Cart::CART_NEW;
	  		$cart->save ();
	  	}
	  	$previous_amt = $cart->amount;
	  	Yii::log ( CVarDumper::DumpAsString ( $previous_amt ), CLogger::LEVEL_WARNING, '$previous_amt' );
	  	// Now section is cart item. here we add item in cart with using of cart id...
	  	$cartItem = new CartItem ();
	  	
	  	$criteria1 = new CDbCriteria ();
	  	$criteria1->addCondition ( 'cart_id =' . $cart->id );
	  	$criteria1->addCondition ( 'product_id =\'' . $item_id . '\'' );
	  	$isItem = CartItem::model ()->find ( $criteria1 );
	  	
	  	
	  	if (! $isItem) {
	  		
	  		$cartItem->product_id = $item_id;
	  		$cartItem->cart_id = $cart->id;
	  		$cartItem->amount = $product->price;
	  		$cartItem->quantity = CartItem::QUANTITY;
	  		if(!empty($_POST['checkedValueColor']))
	  			$cartItem->color_id = $_POST['checkedValueColor'];
	  			else
	  				$cartItem->color_id = $product->color_id;
	  				if (!empty($_POST['checkedValueSize']))
	  					$cartItem->size_id = $_POST['checkedValueSize'];
	  					else
	  						$cartItem->size_id =$product->size_id;
	  						
	  						
	  						if ($cartItem->save ()) {
	  							if (isset ( $_POST ['size'] )) {
	  								$sizes = $_POST ['size'];
	  								if ($sizes) {
	  									$quantity = 0;
	  									$old_amount = 0;
	  									foreach ( $sizes as $size ) {
	  										$quantity = $quantity + $size;
	  									}
	  									foreach ( $sizes as $key => $size ) {
	  										$cartSize = CartSize::model ()->findByAttributes ( array (
	  												'size_id' => $key,
	  												'cart_item_id' => $cartItem->id
	  										) );
	  										if ($size != '') {
	  											if ($cartSize == null) {
	  												$cartSize = new CartSize ();
	  											}
	  											$cartSize->cart_item_id = $cartItem->id;
	  											$cartSize->size_id = $key;
	  											$cartSize->quantity = $size;
	  											$cartSize->amount = $product->getAmountOfSize ( $key, $size, $quantity );
	  											$old_amount = $old_amount + ($size * $cartSize->amount);
	  											$cartSize->save ();
	  										}
	  									}
	  									
	  									$cartItem->amount = $old_amount;
	  									$cartItem->saveAttributes ( array (
	  											'amount'
	  									) );
	  								}
	  							}
	  							$cart->amount = $previous_amt + $cartItem->amount;
	  							$cart->saveAttributes ( array (
	  									'amount'
	  							) );
	  							Yii::log ( CVarDumper::DumpAsString ( $cart->amount ), CLogger::LEVEL_WARNING, '$cart->amount' );
	  							$arr ['status'] = 'OK';
	  							$arr ['error'] = 'Item is Added Successfully in cart';
	  						}
	  	} else {
	  		$arr ['error'] = 'Product is already added into cart';
	  	}
	  	$cart = Cart::model()->findByAttributes(array('create_user_id'=> Yii::app()->user->id));
	  	$count = 0;
	  	if($cart != null){
	  		$count = CartItem::model()->countByAttributes(array('cart_id'=>$cart->id));
	  	}
	  	$arr ['count'] = $count;
	  	$this->sendJSONResponse ( $arr );
	  }
	  public function actionaddWishList($id) {
	  	$arr = array (
	  			'controller' => $this->id,
	  			'action' => $this->action->id,
	  			'status' => 'NOK',
	  			'error' => ''
	  	);
	  	// This section is used for a particular shop
	  	$wishlist = WishList::getWishList($id,Yii::app()->user->id);
	  	
	  	if (empty($wishlist)) {
	  		$wishlist = new WishList();
	  		
	  		$wishlist->model_id = $id;
	  		
	  		$color_id = '';
	  		$size_id = '';
	  		if(isset($_POST['color_id']) and $_POST['color_id']){
	  			$color_id = $_POST['color_id'];
	  		}
	  		if(isset($_POST['size_id']) and $_POST['size_id']){
	  			$size_id= $_POST['size_id'];
	  		}
	  		if($color_id != '' and $size_id != ''){
	  			$criteria = new CDbCriteria ();
	  			$criteria->compare('color_id', $color_id);
	  			$criteria->compare('size_id', $size_id);
	  			$varProduct = VarProduct::model()->find($criteria);
	  			if(!empty($varProduct)){
	  				$wishlist->var_id = $varProduct->id;
	  			}else {
	  				$wishlist->var_id = 0;
	  			}
	  			
	  		} else {
	  			$wishlist->var_id = 0;
	  		}
	  		
	  		$wishlist->type_id = 1;
	  		
	  		$wishlist->create_user_id = Yii::app()->user->id;
	  		if($wishlist->save ()) {
	  			$arr ['status'] = 'OK';
	  		}
	  		$arr ['error'] = 'Item é Adicionar com sucesso na lista de desejos';
	  	} else {
	  		if($wishlist->delete()) {
	  			$arr ['status'] = 'NOK';
	  		}
	  		$arr ['error'] = 'Item removido com sucesso da lista de desejos';
	  	}
	  	
	  	$criteria = new CDbCriteria ();
	  	$criteria->compare ( 'create_user_id', Yii::app()->user->id);
	  	$count = WishList::model ()->count($criteria);
	  	
	  	$arr ['count'] = $count;
	  	
	  	$this->sendJSONResponse ( $arr );
	  }
	  public function actionAddQuantity($id) {
	  	$model = $this->loadModel ( $id, 'CartItem' );
	  	$cart = Cart::model()->findByAttributes(array(
	  			'id' => $model->cart_id
	  	));
	  	$productamount = Product::model()->findByAttributes(array(
	  			'id' => $model->product_id
	  	));
	  	/* echo "<pre>";
	  	 print_r($productamount->price);
	  	 die(); */
	  	//$updatedamount = 0;
	  	$prodamount = $model->amount;
	  	$cartamount = $cart->amount;
	  	$quantity = $model->quantity;
	  	//if($quantity != 0){
	  	$amount =  $prodamount + $productamount->price ;
	  	$cartamount = $cartamount + $productamount->price;
	  	$newquantity = $quantity + 1;
	  	$model->amount = $amount;
	  	$cart->amount = $cartamount;
	  	$model->quantity = $newquantity;
	  	$model->saveAttributes ( array (
	  			'quantity',
	  			'amount'
	  	) );
	  	$cart->saveAttributes ( array(
	  			'amount'
	  	));
	  	
	  	$this->redirect(array('cart'));
	  	//}else {
	  	//echo "<script type='text/javascript'>alert('Quantity should not be 0')</script>";
	  	//}
	  	
	  }
	  /* public function actionSubQuantity($id) {
	   $model = $this->loadModel ( $id, 'CartItem' );
	   $cart = Cart::model()->findByAttributes(array(
	   'id' => $model->cart_id
	   ));
	   $productamount = Product::model()->findByAttributes(array(
	   'id' => $model->product_id
	   ));
	   /* echo "<pre>";
	   print_r($productamount->price);
	   die(); */
	  //$updatedamount = 0;
	  /* $prodamount = $model->amount;
	   $cartamount = $cart->amount;
	   $quantity = $model->quantity;
	   //if($quantity != 0){
	   $amount =  $prodamount - $productamount->price ;
	   $cartamount = $cartamount - $productamount->price;
	   $newquantity = $quantity - 1;
	   $model->amount = $amount;
	   $cart->amount = $cartamount;
	   $model->quantity = $newquantity;
	   $model->saveAttributes ( array (
	   'quantity',
	   'amount'
	   ) );
	   $cart->saveAttributes ( array(
	   'amount'
	   ));
	   $this->redirect(array('cart'));
	   
	   /* else {
	   //echo "<script type='text/javascript'>alert('errormessage')</script>";
	   } */
	  
	  /* }  */
	  public function actionSubQuantity($id) {
	  	$model = $this->loadModel ( $id, 'CartItem' );
	  	$cart = Cart::model()->findByAttributes(array(
	  			'id' => $model->cart_id
	  	));
	  	$productamount = Product::model()->findByAttributes(array(
	  			'id' => $model->product_id
	  	));
	  	/* echo "";
	  	 print_r($productamount->price);
	  	 die(); */
	  	//$updatedamount = 0;
	  	$prodamount = $model->amount;
	  	$cartamount = $cart->amount;
	  	$quantity = $model->quantity;
	  	if($quantity > 1){
	  		$amount =  $prodamount - $productamount->price ;
	  		$cartamount = $cartamount - $productamount->price;
	  		$newquantity = $quantity - 1;
	  		$model->amount = $amount;
	  		$cart->amount = $cartamount;
	  		$model->quantity = $newquantity;
	  		$model->saveAttributes ( array (
	  				'quantity',
	  				'amount'
	  		) );
	  		$cart->saveAttributes ( array(
	  				'amount'
	  		));
	  		$this->redirect(array('cart'));
	  	}
	  	else {
	  		
	  		$this->redirect(array('cart'));
	  		echo "alert('Quantity should not be 0')";
	  	}
	  	
	  }
	  /*
	   * This action is used for updating a card dynamically on cart list in case of postage and coupon
	   *
	   */
	  public function actionUpdateCart() {
	  	$cart_id = $_POST ['id'];
	  	$postage_id = $_POST ['postage_id'];
	  	
	  	$model = Cart::model ()->findByPk ( $cart_id );
	  	if ($model) {
	  		$model->postage_id = $postage_id;
	  		$model->postage_charge = $model->calShipPrice ( $postage_id );
	  		$subtotal = round ( $model->getTotal (), 2 );
	  		$gst = round ( $subtotal / 11, 2 );
	  		$totalorder = round ( ($subtotal + $model->postage_charge - $model->coupon_amount), 2 );
	  		$model->amount = $totalorder;
	  		$model->saveAttributes ( array (
	  				'postage_id',
	  				'postage_charge',
	  				'amount'
	  		) );
	  		$this->renderPartial ( '_ajaxupdate', array (
	  				'model' => $model,
	  				'subtotal' => $subtotal,
	  				'gst' => $gst
	  		) );
	  	}
	  	Yii::app ()->end ();
	  }
	  /**
	   * This action is used to update the coupon
	   * Enter description here ...
	   */
	  public function actionUpdateCoupon() {
	  	$cart_id = $_POST ['id'];
	  	
	  	$cart = Cart::model ()->findByPk ( $cart_id );
	  	$coupon_code = $_POST ['code'];
	  	
	  	$criteria = new CDbCriteria ();
	  	$criteria->addCondition ( 'coupon_code = "' . $coupon_code . ' "' );
	  	$criteria->addCondition ( 'store_id = "' . $cart->shop_id . ' "' );
	  	
	  	$coupon = Coupon::model ()->find ( $criteria );
	  	
	  	if ($coupon) {
	  		$isusedbyme = $coupon->isusedByMe ();
	  		
	  		if ($coupon->no_of_uses <= $coupon->usesCount && $isusedbyme) {
	  			$model = Cart::model ()->findByPk ( $cart_id );
	  			
	  			if ($model) {
	  				
	  				$model->coupon_id = $coupon->id;
	  				
	  				$model->coupon_amount = $model->calCouponPrice ( $coupon->id );
	  				
	  				$subtotal = round ( $model->getTotal (), 2 );
	  				
	  				$gst = round ( $subtotal / 11, 2 );
	  				
	  				$totalorder = round ( ($subtotal + $model->postage_charge - $model->coupon_amount), 2 );
	  				
	  				$model->amount = $totalorder;
	  				
	  				$model->saveAttributes ( array (
	  						'coupon_id',
	  						'coupon_amount',
	  						'amount'
	  				) );
	  				
	  				$this->renderPartial ( '_ajaxupdate', array (
	  						'model' => $model,
	  						'subtotal' => $subtotal,
	  						'gst' => $gst
	  				) );
	  				Yii::app ()->end ();
	  			}
	  		}
	  	}
	  	echo 'error'; // dont change this text
	  	Yii::app ()->end ();
	  }
	  public function actionUpdateSize() {
	  	$item_id = $_POST ['id'];
	  	$size_id = $_POST ['size'];
	  	$iscart = CartItem::model ()->findByPk ( $item_id );
	  	if ($iscart) {
	  		$iscart->size_id = $size_id;
	  		$iscart->saveAttributes ( array (
	  				'size_id'
	  		) );
	  	}
	  	Yii::app ()->end ();
	  }
	  public function actionIndex() {
	  	$this->layout = 'column1';
	  	$user_id = Yii::app ()->user->id;
	  	
	  	// here we have group by shop
	  	$criteria = new CDbCriteria ();
	  	$criteria->addCondition ( 'create_user_id =\'' . $user_id . '\'' );
	  	$cart = Cart::model ()->find ( $criteria );
	  	// here count total items -----------------------------------//
	  	$totalItems = 0;
	  	$criteria2 = new CDbCriteria ();
	  	$criteria2->addCondition ( 'create_user_id =\'' . $user_id . '\'' );
	  	if ($cart != null)
	  		$criteria2->addCondition ( 'cart_id = ' . $cart->id );
	  		$models = CartItem::model ()->findAll ( $criteria2 );
	  		if ($models) {
	  			foreach ( $models as $model ) {
	  				$totalItems =  $cart->itemCounts;
	  				
	  				$cri = new CDbCriteria ();
	  				$cri->select = " SUM(quantity) as total_quantity";
	  				$cri->compare ( 'color_id', $model->color_id );
	  				$cri->compare ( 'size_id', $model->size_id);
	  				$varproduct = VarProduct::model ()->find ( $cri );
	  				
	  				if(!empty($varproduct) and $varproduct->total_quantity == 0) {
	  					Yii::app ()->user->setFlash ( 'error', 'Some Products are out of stock in the cart!' );
	  					Yii::app ()->user->setFlash ( 'checkout_button', true );
	  					
	  					
	  				}
	  			}
	  			$qty = 0;
	  			if($cart->cartItems > 0) {
	  				foreach ($cart->cartItems as $itm){
	  					$qty += $itm->quantity;
	  				}
	  			}
	  			if($qty <= 0)
	  			{
	  				$this->redirect ( array (
	  						'cart/index',
	  						
	  				) );
	  			}
	  		}
	  		// total item count close---------------------------------------------------- //
	  		
	  		$totalShops = count ( $models );
	  		
	  		$this->render ( 'index', array (
	  				'models' => $models,
	  				'cart' => $cart,
	  				'totalItems' => $totalItems,
	  				'totalShops' => $totalShops
	  		) );
	  }
	  public function actionCreate() {
	  	$model = new Cart ();
	  	
	  	$this->performAjaxValidation ( $model, 'cart-form' );
	  	
	  	if (isset ( $_POST ['Cart'] )) {
	  		$model->setAttributes ( $_POST ['Cart'] );
	  		
	  		if ($model->save ()) {
	  			if (Yii::app ()->getRequest ()->getIsAjaxRequest ())
	  				Yii::app ()->end ();
	  				else
	  					$this->redirect ( array (
	  							'view',
	  							'id' => $model->id
	  					) );
	  		}
	  	}
	  	$this->updateMenuItems ( $model );
	  	$this->render ( 'create', array (
	  			'model' => $model
	  	) );
	  }
	  public function actionView($id) {
	  	$model = $this->loadModel ( $id, 'Cart' );
	  	
	  	// if(!($this->isAllowed($model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	  	
	  	// $this->processActions($model);
	  	$this->updateMenuItems ( $model );
	  	$this->render ( 'view', array (
	  			'model' => $model
	  	) );
	  }
	  public function actionUpdate($id) {
	  	$model = $this->loadModel ( $id, 'Cart' );
	  	
	  	// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	  	
	  	$this->performAjaxValidation ( $model, 'cart-form' );
	  	
	  	if (isset ( $_POST ['Cart'] )) {
	  		$model->setAttributes ( $_POST ['Cart'] );
	  		
	  		if ($model->save ()) {
	  			$this->redirect ( array (
	  					'view',
	  					'id' => $model->id
	  			) );
	  		}
	  	}
	  	$this->updateMenuItems ( $model );
	  	$this->render ( 'update', array (
	  			'model' => $model
	  	) );
	  }
	  public function actionDelete($id) {
	  	$model = $this->loadModel ( $id, 'Cart' );
	  	//var_dump($model);exit;
	  	// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	  	
	  	if (Yii::app ()->getRequest ()->getIsPostRequest ()) {
	  		$this->loadModel ( $id, 'Cart' )->delete ();
	  		
	  		if (! Yii::app ()->getRequest ()->getIsAjaxRequest ())
	  			$this->redirect ( array (
	  					'admin'
	  			) );
	  	} else
	  		throw new CHttpException ( 400, Yii::t ( 'app', 'Your request is invalid.' ) );
	  }
	  
	  public function actionSearch() {
	  	$model = new Job ( 'search' );
	  	$model->unsetAttributes ();
	  	$this->updateMenuItems ( $model );
	  	
	  	if (isset ( $_GET ['Cart'] )) {
	  		$model->setAttributes ( $_GET ['Cart'] );
	  		$this->renderPartial ( '_list', array (
	  				'dataProvider' => $model->search (),
	  				'model' => $model
	  		) );
	  	}
	  	
	  	$this->renderPartial ( '_search', array (
	  			'model' => $model
	  	) );
	  }
	  public function actionAdmin() {
	  	$model = new Cart ( 'search' );
	  	$model->unsetAttributes ();
	  	$this->updateMenuItems ( $model );
	  	
	  	if (isset ( $_GET ['Cart'] ))
	  		$model->setAttributes ( $_GET ['Cart'] );
	  		
	  		$this->render ( 'admin', array (
	  				'model' => $model
	  		) );
	  }
	  /*
	   * protected function processActions($model = null)
	   * {
	   * parent::processActions($model);
	   * //$this->actions [] = array('label'=>Yii::t('app', 'Add Skill'), 'url'=>array('skill', 'id' => $model->id),'icon'=>'icon-plus icon-white');
	   * }
	   */
	  protected function updateMenuItems($model = null) {
	  	// create static model if model is null
	  	if ($model == null)
	  		$model = new Cart ();
	  		
	  		switch ($this->action->id) {
	  			case 'update' :
	  				{
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'View' ),
	  							'url' => array (
	  									'view',
	  									'id' => $model->id
	  							),
	  							'icon' => 'icon-plus icon-white'
	  					);
	  				}
	  			case 'create' :
	  				{
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'Manage' ),
	  							'url' => array (
	  									'admin'
	  							),
	  							'visible' => Yii::app ()->user->isAdmin,
	  							'icon' => 'icon-wrench icon-white'
	  					);
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'List' ),
	  							'url' => array (
	  									'index'
	  							),
	  							'icon' => 'icon-th-list icon-white'
	  					);
	  				}
	  				break;
	  			case 'index' :
	  				{
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'Manage' ),
	  							'url' => array (
	  									'admin'
	  							),
	  							'visible' => Yii::app ()->user->isAdmin,
	  							'icon' => 'icon-wrench icon-white'
	  					);
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'Create' ),
	  							'url' => array (
	  									'create'
	  							),
	  							'icon' => 'icon-plus icon-white'
	  					);
	  				}
	  				break;
	  			case 'admin' :
	  				{
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'List' ),
	  							'url' => array (
	  									'index'
	  							),
	  							'icon' => 'icon-th-list icon-white'
	  					);
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'Create' ),
	  							'url' => array (
	  									'create'
	  							),
	  							'icon' => 'icon-plus icon-white'
	  					);
	  				}
	  				break;
	  			default :
	  			case 'view' :
	  				{
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'List' ),
	  							'url' => array (
	  									'index'
	  							),
	  							'icon' => 'icon-th-list icon-white'
	  					);
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'Manage' ),
	  							'url' => array (
	  									'admin'
	  							),
	  							'visible' => Yii::app ()->user->isAdmin,
	  							'icon' => 'icon-wrench icon-white'
	  					);
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'Delete' ),
	  							'url' => '#',
	  							'linkOptions' => array (
	  									'submit' => array (
	  											'delete',
	  											'id' => $model->id
	  									),
	  									'confirm' => 'Are you sure you want to delete this item?'
	  							),
	  							'visible' => Yii::app ()->user->isAdmin,
	  							'icon' => 'icon-remove icon-white'
	  					);
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'Create' ),
	  							'url' => array (
	  									'create'
	  							),
	  							'icon' => 'icon-plus icon-white'
	  					);
	  					$this->menu [] = array (
	  							'label' => Yii::t ( 'app', 'Update' ),
	  							'url' => array (
	  									'update',
	  									'id' => $model->id
	  							),
	  							'visible' => Yii::app ()->user->isAdmin,
	  							'icon' => 'icon-edit icon-white'
	  					);
	  				}
	  				break;
	  		}
	  		
	  		// Add SEO headers
	  		$this->processSEO ( $model );
	  		
	  		// merge actions with menu
	  		$this->actions = array_merge ( $this->actions, $this->menu );
	  }
}
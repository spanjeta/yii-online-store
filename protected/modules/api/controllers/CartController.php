<?php

class CartController extends Controller {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('index','view','add'/* 'download', 'thumbnail' */),
						'users'=>array('*'),
		),
		array('allow',
						'actions'=>array('create','update', 'search' ),
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
	 * This action is used only for adding cart items.
	 * Enter description here ...
	 */

	public function actionAdd()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Cart;
		if (isset($_POST['Cart'])) {

			$model->setAttributes($_POST['Cart']);

			$item_id = $_POST['Cart']['product_id'];
			$quantity = $_POST['Cart']['quantity'];
			$size_id = isset($_POST['Cart']['size']) ? $_POST['Cart']['size'] : '';

			$product = Product::model()->findByPk($item_id);
			$shop_id =  $product->company->id;

			$criteria = new CDbCriteria;
			$criteria->addCondition('shop_id ='.$shop_id);
			$criteria->addCondition('create_user_id =\''.Yii::app()->user->id.'\'');
			$criteria->addCondition('state_id ='.Cart::CART_NEW);

			$iscart = Cart::model()->find($criteria);
			if($iscart){
				$cart = $iscart;
			}
			else {
				$cart = new Cart();
				$cart->shop_id = $shop_id;
				$cart->state_id = Cart::CART_NEW;
				//$cart->amount = $product->price;
				$cart->save();
			}
			// Now section is cart item. here we add item in cart with using of cart id...
			$cartItem = new CartItem();
			$criteria1 = new CDbCriteria;
			$criteria1->addCondition('cart_id ='.$cart->id);
			$criteria1->addCondition('product_id =\''.$item_id.'\'');
			$isItem =  CartItem::model()->find($criteria1);
			if($isItem)
			{
				$cartItem = $isItem;
			}
			$cartItem->product_id = $item_id;
			$cartItem->cart_id = $cart->id;
			$cartItem->amount = $product->calPrice();
			$cartItem->size_id = $size_id;
			$cartItem->quantity = $quantity;
			if($cartItem->save())
			{
				$count = 0;
				$criteria2 = new CDbCriteria;
				$criteria2->addCondition('create_user_id =\''.Yii::app()->user->id.'\'');
				$criteria2->addCondition('state_id ='.Cart::CART_NEW);
				$carts = Cart::model()->findAll($criteria2);
				if($carts) {
					foreach($carts as $cart)
					{
						$count = $count + $cart->itemCounts;
					}
				}
				$arr['status'] = 'OK';
				$arr['item_counts'] = $count;
				$arr['message'] = 'This item is successfully added in your cart';
			}
		}
		else
		{
			$arr['data'] = 'data not posted';
		}
		$this->sendJSONResponse($arr);
	}

}
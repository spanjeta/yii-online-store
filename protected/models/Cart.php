<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property integer $shop_id
 * @property string $device_id
 * @property string $ip_address
 * @property string $session_id
 * @property integer $state_id
 * @property integer $type_id
 * @property double $amout
 * @property integer $postage_id
 * @property double $postage_charge
 * @property integer $coupon_id
 * @property integer $coupon_amout
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import('application.models._base.BaseCart');
class Cart extends BaseCart
{
	const CART_NEW = 0;
	const CART_PAY = 1;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public static function setUpdateCart($id,$product_id){
		$modelcart = Cart::model()->findByAttributes(array(
				'id' => $id
		));
		$modelcartitem = CartItem::model()->findByAttributes(array(
				'cart_id' =>$id,
				'product_id' => $product_id
		));
		$prevamount = $modelcart->amount;
		$prodamount = $modelcartitem->amount;
		$newamount = $prevamount - $prodamount;
		$modelcart->amount = $newamount;
		Cart::model()->saveAttributes(array(
					'amount' 
		));
	}
	public function getItemsIds(){

		$ids = array();

		$cartitems = $this->cartItems;

		if($cartitems) {
			foreach($cartitems as $item) {
				$ids[] = $item->product_id;
			}

		}
		return $ids;
	}

	public function getTotal() {

		$amount = 0;

		$cartitems = $this->cartItems;

		if($cartitems) {
			foreach($cartitems as $item) {
				$amount = $amount + ($item->amount*$item->quantity);
			}

		}
		return $amount;
	}
	/**
	 * here we can add postage option for a particular shop
	 */
	public function addpostage(){

		$shopkeeper = $this->shop->createUser;
		$shipping = array();
		if($shopkeeper) {
			$postages =	$shopkeeper->postage_type1;
			if($postages) {

				foreach($postages as $postage) {

					$shipping[$postage->id] = $postage->title .'<span class="pull-right"> '.$this->calShipPrice($postage->id) .' $ </span>';
				}
			}
		}
		return $shipping;
	}
	/**
	 * This function is used for calulating the shipping address
	 * Enter description here ...
	 * @param unknown_type $id
	 */

	public function calShipPrice($id) {

		$postage =  Postage::model()->findByPk($id);
		$price = 0;
		if($postage) {

			$cartitems = $this->itemCounts;

			$price = $postage->first_item_cost;

			$remain = $cartitems - 1;

			if($cartitems) {

				$price = $price  + ($remain * $postage->additional_item_cost );
			}
		}
		return $price;
	}
	/**
	 * This function is used for calculating the coupon price
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function calCouponPrice($id) {

		$coupon =  Coupon::model()->findByPk($id);
		$total =round($this->getTotal(),2);

		if($coupon) {

			if($coupon->category_id == 1){

				return $coupon->amount;
			}

			else  {

				$discount = ( $total * $coupon->percent_off)/100;
					
				return round($discount,2);
			}
		}
		return 0.00;
	}


	/** this  function is used to delete cart session after logout
	 *
	 */


	public static function deleteSession(){

		$criteria = new CDbCriteria;
		$criteria->addCondition('create_user_id =\''.Yii::app()->user->id.'\'');
		$criteria->addCondition('state_id = '. Cart::CART_NEW);
		$carts= Cart::model()->findAll($criteria);
		if($carts) {
			foreach($carts as $cart) {
				$cart->delete();
			}
		}

	}
	/**
	 * Here come before delete action delete cart item plus billing info
	 *
	 */
	protected function beforeDelete()
	{
		CartItem::model()->deleteAllByAttributes(array ('cart_id'=>$this->id));
		PromoProduct::model()->deleteAllByAttributes(array ('cart_id'=>$this->id));
		//CartItem::model()->deleteAllByAttributes(array ('cart_id'=>$this->id));
		//Address::model()->deleteAllByAttributes(array ('cart_id'=>$this->id));

		return parent::beforeDelete();
	}

	/**
	 * this method is used for calculating the payment order verification
	 */

	public function verifyPayment($type) {
		
		$payment = new Payment();
		$criteria = new CDbCriteria;
		$criteria->addCondition('cart_id ='.$this->id);
		$isPayment = Payment::model()->find($criteria);
		//$order_no =  $this->shop->shop_code.'ORD'.User::randomPassword(3);
		$order_no = 'ORD';
		if($isPayment)  {
			$payment = $isPayment;
		}
		$payment ->order_no = (isset($isPayment) && !empty($isPayment)) ? $isPayment->order_no :$order_no ;
		$payment ->cart_id = $this->id;
		$payment ->type_id = $type;
		//$payment ->shop_id = $this->shop->id;
		$payment->state_id = Payment::STATUS_PENDING;
		$payment ->amount = $this->amount;
		if($payment->save())
		{
			//echo $payment->order_no; exit;
			$this->state_id = Cart::CART_PAY;
			$this->saveAttributes(array('state_id'));
		}
		else {
			print_r($payment->getErrors());
			exit;
		}
		return $payment;
	}
	/**
	 *
	 */
	public static function getTotalItemCount(){
		
		if(Yii::app()->user->isGuest)
			return 0;
			
			$totalItems = 0;
			$criteria2 = new CDbCriteria;
			$criteria2->addCondition('create_user_id =\''.Yii::app()->user->id.'\'');
			$criteria2->addCondition('state_id = '. Cart::CART_NEW);
			$carts = Cart::model()->findAll($criteria2);
			if($carts) {
				foreach($carts as $cart)
				{
					$totalItems = $totalItems + $cart->itemCounts;
				}
			}
			return $totalItems;
	}
	public function toArray()
	{
		$cart  = $this;
		$json_entry = array();
		$json_entry["id"] = $cart->id;
		$json_entry["sub_total"] =  round($cart->getTotal(),2);
		$json_entry["postage_charge"] =  $cart->postage_charge;
		$json_entry["gst"] =  round($cart->amount/11,2);
		$json_entry["coupon_amount"] =   $cart->coupon_amount;
		$json_entry["total_paid"] =   $cart->amount;
		$json_entry["notes"] =   isset($cart->payment->notes) ? strip_tags($cart->payment->notes):'';

		return $json_entry;
	}
}
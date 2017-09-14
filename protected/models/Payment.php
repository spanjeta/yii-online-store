<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property string $payer_email
 * @property string $rec_email
 * @property string $txn_id
 * @property integer $order_id
 * @property double $amount
 * @property integer $amount_type
 * @property string $content
 * @property integer $type_id
 * @property integer $state_id
 * @property string $create_time
 * @property integer $create_user_id
 */
Yii::import('application.models._base.BasePayment');
class Payment extends BasePayment
{
	public $User;
	public $order_no;
	const  STATUS_PENDING = 0;
	const  STATUS_COMPLETED = 1;
	const  STATUS_POSTED = 2;
	const  STATUS_REVIEWED = 3;
	const  STATUS_CANCEL = 4;
	const  STATUS_DELETED = 5;


	const TYPE_PAYPAL = 1;
	const TYPE_CREDIT = 2;
	const TYPE_DEPOSIT = 3;
	const TYPE_CASHPICKUP = 4;
	const TYPE_CASHDELIVERY = 5;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public static function getTypeOptions($id = null)
	{
		$list = array(
		self::TYPE_PAYPAL =>'Paypal',
		self::TYPE_CREDIT =>'Credit',
		self::TYPE_DEPOSIT =>'Deposit',
		self::TYPE_CASHPICKUP =>'Cash Pickup',
		self::TYPE_CASHDELIVERY =>'Cash Delivery'
		);
		if ($id == null )	return $list;
		if ( is_numeric( $id )) return $list [ $id ];
		return $id;
	}

	public static function getStatusOptions($id = null)
	{
		$list = array(
		self::STATUS_PENDING =>'Pending',
		self::STATUS_COMPLETED =>'Verified',
		self::STATUS_POSTED =>'Posted',
		self::STATUS_REVIEWED =>'Reviewd',
		self::STATUS_CANCEL =>'Cancel',
		self::STATUS_DELETED =>'Deleted',
		);
		if ($id == null )	return $list;
		if ( is_numeric( $id )) return $list [ $id % count($list) ];
		return $id;
	}

	/**
	 * Please dont change its order if you changes than be carefully it will affect some other changes.
	 * Enter description here ...
	 */
	public static function changeOperation($id= null)
	{
		$list = array('Pending','Paid','Posted',
		'Reviewed','cancel',
		);
		if ($id == null )	return $list;
		if ( is_numeric( $id )) return $list [ $id ];
		return $id;
	}
	public function getPrintOperation()
	{
		/* $list = array('Delete','Published','Unpublish',' Feature on my home page',
		 'unfeature on my home page','Featured on site','Unfeatured on site',
		 'Sale Label','Remove Sale Label','New Label','remove New Label'); */
		$list = array('1'=>'Export records in Csv file',
		);
		return  $list;
	}
	public function toArray()
	{
		$json_entry = array();
		$json_entry["id"] = $this->id;
		$json_entry["order_id"] = $this->order_no;
		$json_entry["amount"] = $this->amount;
		$json_entry["shop_name"] = $this->shop->shop_name;
		$json_entry["user_name"] = $this->createUser->email;
		$json_entry["state_id"] = $this->state_id;
		$json_entry["type_id"] = $this->type_id;
		$json_entry["create_time"] = $this->create_time;

		return $json_entry;
	}
	/** using in api
	 * this action is used to fetch shop id which we are using on order search
	 * Enter description here ...
	 */

	public static function	getMyShopIds($name) {
		$ids = array();
		$criteria = new CDbCriteria;
		//$criteria->compare('shop_name',$name,true);
		$criteria->addCondition('shop_name like "%'.$name.'%" ');
		$shops = Company::model()->findAll($criteria);

		if($shops) {
			foreach($shops as $shop){
				$ids[] = $shop->id;
			}
		}
		return $ids;
	}
	/** using in api
	 * This method is used on selling page where we search user name customer id
	 */

	public static function	getMyCustomerIds($name) {
		$ids = array();
		$criteria = new CDbCriteria;
		//$criteria->compare('shop_name',$name,true);
		$criteria->addCondition('email like "%'.$name.'%" ');
		$users = User::model()->findAll($criteria);

		if($users) {
			foreach($users as $user){
				$ids[] = $user->id;
			}
		}
		return $ids;
	}

}
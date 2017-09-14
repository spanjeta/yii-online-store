<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property integer $cart_item_id
 * @property integer $size_id
 * @property integer $quantity
 * @property string $amount
 * @property integer $state_id
 * @property integer $type_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import('application.models._base.BaseCartSize');
class CartSize extends BaseCartSize
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
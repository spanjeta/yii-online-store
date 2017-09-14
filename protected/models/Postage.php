<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $title
 * @property integer $first_item_cost
 * @property integer $additional_item_cost
 * @property integer $custom_price
 * @property integer $state_id
 * @property integer $type_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import('application.models._base.BasePostage');
class Postage extends BasePostage
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
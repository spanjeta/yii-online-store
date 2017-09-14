<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $bulding_name
 * @property string $street_add
 * @property string $suburb
 * @property integer $postcode
 * @property string $_state
 * @property string $country
 * @property string $bulding_name1
 * @property string $street_add1
 * @property string $suburb1
 * @property integer $postcode1
 * @property string $_state1
 * @property string $country1
 * @property string $lat
 * @property string $long
 * @property integer $state_id
 * @property integer $is_same
 * @property string $create_time
 * @property string $update_time
 * @property integer $create_user_id
 */
Yii::import('application.models._base.BaseUserAddress');
class UserAddress extends BaseUserAddress
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $credit_card_no
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 */
Yii::import('application.models._base.BasePaypalInfo');
class PaypalInfo extends BasePaypalInfo
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function toArray()
	{

		$json_entry = array();

		$json_entry["id"] = $this->id;
		$json_entry["email"] = $this->email;
		$json_entry["type_id"] = $this->type_id;
		$json_entry["state_id"] = $this->state_id;
		$json_entry["create_time"] = $this->create_time;
		return $json_entry;
	}
}
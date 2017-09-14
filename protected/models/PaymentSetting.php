<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $email
 * @property integer $mode
 * @property integer $type_id
 * @property integer $state_id
 * @property string $create_time
 */
Yii::import('application.models._base.BasePaymentSetting');
class PaymentSetting extends BasePaymentSetting
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
				 
		if(isset($this->id)) $json_entry['id'] = $this->id;  
		if(isset($this->email)) $json_entry['email'] = $this->email;  
		if(isset($this->mode)) $json_entry['mode'] = $this->mode;  
		if(isset($this->type_id)) $json_entry['type_id'] = $this->type_id;  
		if(isset($this->state_id)) $json_entry['state_id'] = $this->state_id;  
		if(isset($this->create_time)) $json_entry['create_time'] = $this->create_time;         
	   if ($with_relations)     
	   {
 		}

        return $json_entry;
	}
	
}
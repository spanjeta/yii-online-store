<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property integer $cart_id
 * @property integer $promo_id
 * @property integer $state_id
 * @property integer $type_id
 * @property string $create_time
 * @property integer $create_user_id
 */
Yii::import('application.models._base.BasePromoProduct');
class PromoProduct extends BasePromoProduct
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
				 
		if(isset($this->id)) $json_entry['id'] = $this->id;  
		if(isset($this->cart_id)) $json_entry['cart_id'] = $this->cart_id;  
		if(isset($this->promo_id)) $json_entry['promo_id'] = $this->promo_id;  
		if(isset($this->state_id)) $json_entry['state_id'] = $this->state_id;  
		if(isset($this->type_id)) $json_entry['type_id'] = $this->type_id;  
		if(isset($this->create_time)) $json_entry['create_time'] = $this->create_time;  
		if(isset($this->create_user_id)) $json_entry['create_user_id'] = $this->create_user_id;         
	   if ($with_relations)     
	   {
  					if(isset($this->cart)) $json_entry['cart'] = $this->cart->toArray(true);
		 					if(isset($this->createUser)) $json_entry['createUser'] = $this->createUser->toArray(true);
		 					if(isset($this->promo)) $json_entry['promo'] = $this->promo->toArray(true);
				}

        return $json_entry;
	}
	
}
<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $code
 * @property string $discount
 * @property string $expiry_date
 * @property integer $state_id
 * @property integer $type_id
 * @property string $create_time
 * @property integer $create_user_id
 */
Yii::import('application.models._base.BasePromoCode');
class PromoCode extends BasePromoCode
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	
	
	
	
	
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
				 
		if(isset($this->id)) $json_entry['id'] = $this->id;  
		if(isset($this->title)) $json_entry['title'] = $this->title;  
		if(isset($this->description)) $json_entry['description'] = $this->description;  
		if(isset($this->code)) $json_entry['code'] = $this->code;  
		if(isset($this->discount)) $json_entry['discount'] = $this->discount;  
		if(isset($this->expiry_date)) $json_entry['expiry_date'] = $this->expiry_date;  
		if(isset($this->state_id)) $json_entry['state_id'] = $this->state_id;  
		if(isset($this->type_id)) $json_entry['type_id'] = $this->type_id;  
		if(isset($this->create_time)) $json_entry['create_time'] = $this->create_time;  
		if(isset($this->create_user_id)) $json_entry['create_user_id'] = $this->create_user_id;         
	   if ($with_relations)     
	   {
  					if(isset($this->createUser)) $json_entry['createUser'] = $this->createUser->toArray(true);
		 				if(isset($this->promoProducts))
				{
					foreach( $this->promoProducts as $relation_item) $json_entry['promoProducts'] [] = $relation_item->toArray(true);
				}
				}

        return $json_entry;
	}
	
}
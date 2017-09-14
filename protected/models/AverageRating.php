<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property integer $product_id
 * @property string $average_rating
 * @property string $create_time
 */
Yii::import('application.models._base.BaseAverageRating');
class AverageRating extends BaseAverageRating
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
				 
		if(isset($this->id)) $json_entry['id'] = $this->id;  
		if(isset($this->product_id)) $json_entry['product_id'] = $this->product_id;  
		if(isset($this->average_rating)) $json_entry['average_rating'] = $this->average_rating;  
		if(isset($this->create_time)) $json_entry['create_time'] = $this->create_time;         
	   if ($with_relations)     
	   {
  					if(isset($this->product)) $json_entry['product'] = $this->product->toArray(true);
				}

        return $json_entry;
	}
	
}
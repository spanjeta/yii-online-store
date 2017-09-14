<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $title
 * @property string $key
 * @property string $text
 * @property integer $create_user_id
 * @property string $create_time
 */
Yii::import('application.models._base.BaseEmailTemplate');
class EmailTemplate extends BaseEmailTemplate
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
				 
		if(isset($this->id)) $json_entry['id'] = $this->id;  
		if(isset($this->title)) $json_entry['title'] = $this->title;  
		if(isset($this->key)) $json_entry['key'] = $this->key;  
		if(isset($this->text)) $json_entry['text'] = $this->text;  
		if(isset($this->create_user_id)) $json_entry['create_user_id'] = $this->create_user_id;  
		if(isset($this->create_time)) $json_entry['create_time'] = $this->create_time;         
	   if ($with_relations)     
	   {
  					if(isset($this->createUser)) $json_entry['createUser'] = $this->createUser->toArray(true);
				}

        return $json_entry;
	}
	
}
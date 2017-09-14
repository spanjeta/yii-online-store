<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property integer $state_id
 * @property integer $type_id
 * @property string $create_time
 * @property integer $create_user_id
 */
Yii::import('application.models._base.BaseNotification');
class Notification extends BaseNotification
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
				 
		if(isset($this->id)) $json_entry['id'] = $this->id;  
		if(isset($this->title)) $json_entry['title'] = $this->title;  
		if(isset($this->content)) $json_entry['content'] = $this->content;  
		if(isset($this->url)) $json_entry['url'] = $this->url;  
		if(isset($this->state_id)) $json_entry['state_id'] = $this->state_id;  
		if(isset($this->type_id)) $json_entry['type_id'] = $this->type_id;  
		if(isset($this->create_time)) $json_entry['create_time'] = $this->create_time;  
		if(isset($this->create_user_id)) $json_entry['create_user_id'] = $this->create_user_id;         
	   if ($with_relations)     
	   {
 		}

        return $json_entry;
	}
	
}
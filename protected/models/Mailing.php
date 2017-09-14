<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $subject
 * @property string $content
 * @property string $queue
 * @property string $sent
 * @property integer $type_id
 * @property integer $state_id
 * @property string $create_time
 * @property string $finishedOn
 */
Yii::import('application.models._base.BaseMailing');
class Mailing extends BaseMailing
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
				 
		if(isset($this->id)) $json_entry['id'] = $this->id;  
		if(isset($this->subject)) $json_entry['subject'] = $this->subject;  
		if(isset($this->content)) $json_entry['content'] = $this->content;  
		if(isset($this->queue)) $json_entry['queue'] = $this->queue;  
		if(isset($this->sent)) $json_entry['sent'] = $this->sent;  
		if(isset($this->type_id)) $json_entry['type_id'] = $this->type_id;  
		if(isset($this->state_id)) $json_entry['state_id'] = $this->state_id;  
		if(isset($this->create_time)) $json_entry['create_time'] = $this->create_time;  
		if(isset($this->finishedOn)) $json_entry['finishedOn'] = $this->finishedOn;         
	   if ($with_relations)     
	   {
 		}

        return $json_entry;
	}
	
}
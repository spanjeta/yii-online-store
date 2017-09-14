<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property string $id
 * @property string $transaction_id
 * @property integer $task_id
 * @property string $amount
 * @property integer $user_id
 * @property string $txn_dt
 */
Yii::import('application.models._base.BaseTransaction');
class Transaction extends BaseTransaction
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
				 
		if(isset($this->id)) $json_entry['id'] = $this->id;  
		if(isset($this->transaction_id)) $json_entry['transaction_id'] = $this->transaction_id;  
		if(isset($this->task_id)) $json_entry['task_id'] = $this->task_id;  
		if(isset($this->amount)) $json_entry['amount'] = $this->amount;  
		if(isset($this->user_id)) $json_entry['user_id'] = $this->user_id;  
		if(isset($this->txn_dt)) $json_entry['txn_dt'] = $this->txn_dt;         
	   if ($with_relations)     
	   {
 		}

        return $json_entry;
	}
	
}
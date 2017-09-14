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
	
	const NOT_READ = 0;
	const READ = 1;
	
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
/* 	public static function unreadNotification() {
		
		$model = Notification::find ()->where ( [
				'is_read' => self::NOT_READ
		] )->all ();
		return $model;
	}
	public function getNotificationModel() {
		$class = $this->model_type;
		return $this->hasOne ( $class::className (), [
				'id' => 'model_id'
		] );
	}
	public static function Notifi() {
		$model = User::find ()->where ( [
				'role_id' => User::ROLE_ADMIN
		] )->one ();
		$start_date = $model->last_visit_time;
		$end_date = date ( 'Y-m-d H:i:s' );
		
		$notification_count = Notification::find ()->Where ( [
				'is_read' => Notification::IS_NEW
		] )->count ();
		return $notification_count;
	} */
	
	
	public static function getFeedsCount() {
		return self::getRecentFeeds ( true );
	}
	public static function getRecentFeeds($count = true) {
		
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'DATE(`create_time`)', date ( 'Y-m-d' ) );
		
		/* if (! Yii::app ()->user->isGuest) {
			
			$projects = ProjectTeam::model ()->findAllByAttributes ( array (
					'user_id' => Yii::app ()->user->id
			) );
			$arrproject = array ();
			foreach ( $projects as $project ) {
				$arrproject [] = $project->project_id;
			}
			
			$criteria->addInCondition ( 'project_id', $arrproject );
		} */
		// $criteria->addCondition( 'create_time >= '. date("Y-m-d H:i:s",strtotime("-1 day")));
		if (! $count) {
			$criteria->limit = '5';
			return Notification::model ()->findAll ( $criteria );
		} else {
			return Notification::model ()->count ( $criteria );
		}
	}
}
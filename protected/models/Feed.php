<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 *
 * @property integer $id
 * @property string $content
 * @property integer $state_id
 * @property integer $type_id
 * @property string $model_type
 * @property integer $model_id
 * @property integer $project_id
 * @property string $create_time
 * @property integer $create_user_id
 */
Yii::import ( 'application.models._base.BaseFeed' );
class Feed extends BaseFeed {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	protected function afterSave() {
		return true;
	}
	protected function afterDelete() {
		return true;
	}
	protected function beforeDelete() {
		return parent::beforeDelete ();
	}
	public static function recentProjectFeeds($project_id) {
		$criteria = new CDbCriteria ();
		$criteria->limit = '20';

		$criteria->compare ( 'project_id', $project_id );
		// $criteria->compare ( 'model_type=Project AND model_id='.$project_id );
		$dataProvider = new CActiveDataProvider ( 'Feed', array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 5
				)
		) );

		return $dataProvider;
	}
	public static function recentFeeds() {
		$criteria = new CDbCriteria ();
		$criteria->limit = '5';

	
			$feeds = Feed::model ()->findAllByAttributes ( array (
					'create_user_id' => Yii::app ()->user->id
			) );
			$arrproject = array ();
			foreach ( $feeds as $feed ) {
				$arrproject [] = $feed->content;
			}

		//	$criteria->addInCondition ( 'project_id', $arrproject );
		

		$dataProvider = new CActiveDataProvider ( 'Feed', array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 7
				)
		) );

		return $dataProvider;
	}
	public static function getFeedsCount() {
		
		return self::getRecentFeeds ( true );
	}
	public static function getRecentFeeds($count = true) {
		
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'DATE(`create_time`)', date ( 'Y-m-d' ) );
		
		$feeds = Feed::model ()->findAllByAttributes ( array (
				'create_user_id' => Yii::app ()->user->id
		) );
		
		$arrproject = array ();
		foreach ( $feeds as $feed ) {
			$arrproject [] = $feed->content;
		}
		

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
			return Feed::model ()->findAll (  );
		} else {
			return Feed::model ()->count ( $criteria );
		}
	}
	public static function getUserFeeds($id, $count = null) {
		$dataProvider = null;
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'create_user_id ', $id );
		if (Yii::app ()->user->isUser) {
			$criteria->addCondition ( 'model_type != "Email"' );
		}
		if ($count) {
			$dataProvider = new CActiveDataProvider ( 'Feed', array (
					'criteria' => $criteria
			) );
			return $dataProvider->getTotalItemCount ();
		} else

			return $dataProvider = new CActiveDataProvider ( 'Feed', array (
					'criteria' => $criteria,
					'pagination' => array (
							'pageSize' => 5
					)
			) );
	}
	public function toArray($with_relations = false) {
		$model = $this;
		$json_entry = array ();

		if ($model) {

			if (isset ( $model->id ))
				$json_entry ['id'] = $model->id;

			if (isset ( $model->content ))
				$json_entry ['content'] = $model->content;

			if (isset ( $model->state_id ))
				$json_entry ['state_id'] = $model->state_id;

			if (isset ( $model->type_id ))
				$json_entry ['type_id'] = $model->type_id;

			if (isset ( $model->model_type ))
				$json_entry ['model_type'] = $model->model_type;

			if (isset ( $model->model_id ))
				$json_entry ['model_id'] = $model->model_id;

			if (isset ( $model->project_id ))
				$json_entry ['project_id'] = $model->project_id;

			if (isset ( $model->create_time ))
				$json_entry ['create_time'] = $model->create_time;

			if (isset ( $model->create_user_id ))
				$json_entry ['create_user_id'] = $model->create_user_id;
		}
		if ($with_relations) {
			if (isset ( $model->createUser ))
				$json_entry ['createUser'] = $model->createUser->toArray ();
		}

		return $json_entry;
	}
}
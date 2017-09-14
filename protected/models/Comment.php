<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property string $model_type
 * @property integer $model_id
 * @property string $comment
 * @property integer $state_id
 * @property string $create_time
 * @property integer $create_user_id
 */
Yii::import('application.models._base.BaseComment');
class Comment extends BaseComment
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public static function gerIds()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('model_id = '.Yii::app()->user->id);
		$tasks = Yii::app()->user->model->tasks;
		$comments = Comment::model()->findAll($criteria);
		$model_ids = array();
		if($tasks || $comments)
		{
			foreach($tasks as $task)
			{
				$model_ids[] = $task->id;
			}
			foreach($comments as $comment)
			{
				$model_ids[] = $comment->id;
			}
				
		}
		return $model_ids;
	}
}
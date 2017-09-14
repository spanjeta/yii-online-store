<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $title
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 */
Yii::import('application.models._base.BaseGroup');
class Group extends BaseGroup
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
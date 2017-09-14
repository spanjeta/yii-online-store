<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $title
 * @property string $description
 */
Yii::import('application.models._base.BaseUserRole');
class UserRole extends BaseUserRole
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
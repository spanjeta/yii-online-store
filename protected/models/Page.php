<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $content
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $view_count
 * @property string $create_time
 * @property string $update_time
 * @property integer $create_user_id
 */
Yii::import('application.models._base.BasePage');
class Page extends BasePage
{
	public $user;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
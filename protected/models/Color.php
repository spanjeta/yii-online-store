<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import('application.models._base.BaseColor');
class Color extends BaseColor
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function toArray()
	{

		$color = $this;
		$json_entry = array();
		$json_entry["id"] = $color->id;
		$json_entry["color_code"] = $color->color_code;
		$json_entry["title"] = $color->title;


		return $json_entry;
	}
	
	

	
	

}
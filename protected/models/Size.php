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
Yii::import('application.models._base.BaseSize');
class Size extends BaseSize
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function toArray()
	{

		$size = $this;
		$json_entry = array();
		$json_entry["id"] = $size->id;
		$json_entry["title"] = $size->title;

		return $json_entry;
	}

	public static function getSize()
	{
		$sizelist = array();
		$sizes = Size::model()->findAll();

		foreach($sizes as $size)
		{
			$sizelist[] = $size->title;
		}
		return $sizelist;
	}


}
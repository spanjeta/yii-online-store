<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property string $title
 * @property string $slider_image
 * @property integer $store_id
 * @property integer $type_id
 * @property integer $state_id
 * @property string $create_time
 * @property integer $create_user_id
 */
Yii::import('application.models._base.BaseSliderImage');
class SliderImage extends BaseSliderImage
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function toArray()
	{
		$json_entry = array();
		$img = 'banner-1.jpg';
		$slider = $this;
		$json_entry["id"] = $slider->id;
		$json_entry['slider_image'] =
		isset($slider->slider_image) ?
		Yii::app()->createAbsoluteUrl('sliderImage/thumb',array('file'=>$slider->slider_image,'id'=>$slider->create_user_id)) :
		Yii::app()->createAbsoluteUrl('sliderImage/download',array('file'=>$img));
		return $json_entry;
	}
}
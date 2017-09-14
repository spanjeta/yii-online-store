<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property string $image_path
 * @property integer $state_id
 * @property integer $product_id
 * @property integer $create_user_id
 * @property string $create_time
 */
Yii::import('application.models._base.BaseTempFile');
class TempFile extends BaseTempFile
{

	const PRODUCT_IMAGE = 0;
	const SLIDER_IMAGE = 1;
	const VARIENT_PRODUCT_IMAGE = 2;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

}
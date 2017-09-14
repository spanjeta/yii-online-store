<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 *
 * @property integer $id
 * @property string $image_file
 * @property string $content
 * @property string $url
 * @property integer $type_id
 * @property integer $state_id
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $createUser
 */
Yii::import ( 'application.models._base.BaseBanner' );
class Banner extends BaseBanner {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function toArray($with_relations = false) {
		$json_entry = array ();
		
		if (isset ( $this->id ))
			$json_entry ['id'] = $this->id;
		if (isset ( $this->image_file ))
			$json_entry ['image_file'] = $this->image_file;
		if (isset ( $this->content ))
			$json_entry ['content'] = $this->content;
		if (isset ( $this->url ))
			$json_entry ['url'] = $this->url;
		if (isset ( $this->type_id ))
			$json_entry ['type_id'] = $this->type_id;
		if (isset ( $this->state_id ))
			$json_entry ['state_id'] = $this->state_id;
		if (isset ( $this->create_time ))
			$json_entry ['create_time'] = $this->create_time;
		if (isset ( $this->create_user_id ))
			$json_entry ['create_user_id'] = $this->create_user_id;
		if (isset ( $this->update_time ))
			$json_entry ['update_time'] = $this->update_time;
		if (isset ( $this->createUser ))
			$json_entry ['createUser'] = $this->createUser;
		if ($with_relations) {
		}
		
		return $json_entry;
	}
	public function getBanImage() {
		return $this->getBannerImage();
	}
	
	public function getBannerImage() {
		$criteria = new CDbCriteria ();
		//$criteria->addCondition ( 'product_id = ' . $this->id);
		$images = Banner::model ()->findAll ();
		
		if ($images) {
			foreach ( $images as $image ) {
				return Yii::app ()->createAbsoluteUrl ( 'product/download', array (
						'file' => $image
				) );
			}
		}
		return Yii::app ()->createAbsoluteUrl ( 'product/download', array (
				'file' => 'default.png'
		) );
		// return Yii::app()->createAbsoluteUrl('product/download',array('file'=>'default.png'));
	}
}
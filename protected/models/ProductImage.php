<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property integer $product_id
 * @property string $image_path
 * @property string $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 */
Yii::import('application.models._base.BaseProductImage');
class ProductImage extends BaseProductImage
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function getProImage() {
		$criteria = new CDbCriteria ();
		//$criteria->addCondition ( 'product_id = ' . $this->product_id);
		$criteria->Compare ( 'image_path' , $this->image_path);
		$images = ProductImage::model ()->findAll ( $criteria );
		
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
	public function getSecondImage() {
		$criteria = new CDbCriteria ();
		//$criteria->addCondition ( 'product_id = ' . $this->product_id);
		
		$prod_id = $this->product_id;
		$product_images = ProductImage::model()->findAllByAttributes(array(
				'product_id' => $prod_id
		));
		$count = 0 ;
		$imagepath = null;
		foreach ($product_images as $product_image){
			if($count == 1)
				$imagepath = $product_image->image_path;
			
			$count++;
		}
		
		if ($imagepath) {
				return  Yii::app ()->createAbsoluteUrl ( 'product/download', array (
						'file' => $imagepath
				) );
		}else {
			return Yii::app()->createAbsoluteUrl('product/download',array('file'=>'default.png'));
		}
		return $this->getFirstImage();
	}
	public function getFirstImage() {
		$criteria = new CDbCriteria ();
		//$criteria->addCondition ( 'product_id = ' . $this->product_id);
		
		$prod_id = $this->product_id;
		$product_images = ProductImage::model()->findAllByAttributes(array(
				'product_id' => $prod_id
		));
		$count = 0 ;
		$imagepath = null;
		foreach ($product_images as $product_image){
			if($count == 0)
				$imagepath = $product_image->image_path;
				
				$count++;
		}
		
		if ($imagepath) {
			return  Yii::app ()->createAbsoluteUrl ( 'product/download', array (
					'file' => $imagepath
			) );
		}else{
			return Yii::app ()->createAbsoluteUrl ( 'product/download', array (
					'file' => 'default.png'
			) );
		}
		// return Yii::app()->createAbsoluteUrl('product/download',array('file'=>'default.png'));
	}
	public function toArray()
	{
		$json_entry = array();
		$img = 'blog.jpg';
		$product = $this;
		$json_entry["id"] = $product->id;
		$json_entry['image_path'] =
		isset($product->image_path) ?
		Yii::app()->createAbsoluteUrl('product/thumb',array('file'=>$product->image_path,'id'=>$product->create_user_id)) :
		Yii::app()->createAbsoluteUrl('product/download',array('file'=>$img));
		return $json_entry;
	}
	
	
}
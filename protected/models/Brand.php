<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import ( 'application.models._base.BaseBrand' );
class Brand extends BaseBrand {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public static function getBrand() {
		$criteria = new CDbCriteria ();
		$criteria->order = 'id desc';
		// $criteria->limit = '7';
		// $criteria->compare('type_id',Category::TYPE_PARENT);
		$brand = Brand::model ()->findAll ( $criteria );
		return $brand;
	}
	public static function getBrands() {
		$list = array ();
		$criteria = new CDbCriteria ();
		// $criteria->addCondition('state_id = 1');
		$products = Brand::model ()->my ()->findAll ( $criteria );
		foreach ( $brands as $id => $brand ) {
			if ($product->images) {
				$list [] = ($brand->title);
			}
		}
		return $list;
	}
	protected function beforeDelete() {
		
		// WishList::model()->deleteAllByAttributes(array ('model_id'=>$this->id,'type_id'=>Home::TYPE_PRODUCT));
		
		/* Product::model ()->deleteAllByAttributes ( array (
				'brand_id' => $this->id
		) ); */ 
		VarProduct::model ()->deleteAllByAttributes ( array (
				'brand_id' => $this->id
		) );
		/* CartItem::model ()->deleteAllByAttributes ( array (
				'brand_id' => $this->id
		) ); */
		/* Rating::model ()->deleteAllByAttributes ( array (
				'brand_id' => $this->id
		) ); */
		
		// DealItem::model ()->deleteAllByAttributes ( array (
		// 'product_id' => $this->id
		// ) );
		// EmpProduct::model()->deleteAllByAttributes(array('product_id'=>$this->id));
		// OfferItem::model ()->del eteAllByAttributes ( array (
		// 'product_id' => $this->id
		// ) );
		// LinkSize::model ()->deleteAllByAttributes ( array (
		// 'product_id' => $this->id
		// ) );
		// ProductImage::model()->deleteAllByAttributes(array ('product_id'=>$this->id));
		// Home::model ()->deleteAllByAttributes ( array (
		// 'model_id' => $this->id,
		// 'type_id' => Home::TYPE_PRODUCT
		// ) );
		// SiteHome::model ()->deleteAllByAttributes ( array (
		// 'model_id' => $this->id,
		// 'type_id' => Home::TYPE_PRODUCT
		// ) );
		return parent::beforeDelete ();
	}
}
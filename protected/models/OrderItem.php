<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $create_user_id
 * @property string $sku
 * @property string $quantity
 * @property string $amount
 * @property integer $type_id
 * @property integer $state_id
 * @property string $ship_time
 * @property string $create_time
 * @property string $update_time
 */
Yii::import('application.models._base.BaseOrderItem');
class OrderItem extends BaseOrderItem
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function getImage() {
		return $this->getProImage ();
	}
	
	public function getProImage() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'product_id = ' . $this->id);
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
	
	public function getOrderState($id) {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'id = ' . $id);
		$order_state = Order::model ()->findAll ( $criteria );
		
		return $order_state;
		
	}
	
	public function getTotal(){
		$total = 0;
		$models = self::model()->findAllByAttributes(array(
				'id' => $this->id
		));
		foreach ($models as $model){
			$total += $model->amount;
		}
		return $total;
	}
}
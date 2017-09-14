<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property integer $cart_id
 * @property integer $product_id
 * @property double $amout
 * @property integer $size_id
 * @property integer $color_id
 * @property integer $state_id
 * @property integer $type_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import('application.models._base.BaseCartItem');
class CartItem extends BaseCartItem
{
	public $sum;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function getImage()
	{
		if($this->product->images)
			
		return	CHtml::image($data->product->thumbnail_file);

	
	}

	public function getPrice()
	{
		$product = $this->product;

		if($product)
		{
			$price = $this->amount;
			$quant = $this->quantity;
			return  ($quant * $price );
		}
	}

	public static function getTotal($models,$gst=false)
	{
		if($models)
		{
			$price = 0;
			foreach($models as $model)
			{
				$product = $model->product;
				$quant = $model->quantity;
				$price = $price + ($quant * $product->price);
			}
			return $price;
		}
	}
	/**
	 * this one is used for size if available there
	 */
	public function getActions() {

		if(isset($this->size_id)) {
			$sizes = $this->product->getSizeOptions();
			return CHtml::dropDownList('status', $this->size_id,  $sizes,array('onchange'=>'changeSize(this)','id'=>$this->id));
		}
		else return ;
	}

	public function showpostage(){

		$options = $this->product;
	}
	protected function beforeDelete()
	{
		//Cart::setUpdateCart($this->id,$this->product_id);
		//Address::model()->deleteAllByAttributes(array ('cart_id'=>$this->id));
		
		return parent::beforeDelete();
	}
	/**
	 * To Array for cart items
	 */
	public function toArray()
	{
		$item = $this;
		$json_entry = array();
		$json_entry["id"] = $item->id;
		$json_entry["title"] =  $item->product->title;
		$json_entry["image_file"] =  $item->product->getImage();
		$json_entry["price"] = $item->getPrice();
		$json_entry["quantity"] =  $item->quantity;

		return $json_entry;
	}
}
<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property string $sku
 * @property integer $product_id
 * @property integer $color_id
 * @property integer $size_id
 * @property integer $brand_id
 * @property integer $quantity
 * @property string $price
 * @property string $discount_price
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 */
Yii::import('application.models._base.BaseVarProduct');
class VarProduct extends BaseVarProduct
{
	public $total_quantity;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
		
		if(isset($this->id)) $json_entry['id'] = $this->id;
		if(isset($this->sku)) $json_entry['sku'] = $this->sku;
		if(isset($this->product_id)) $json_entry['product_id'] = $this->product_id;
		if(isset($this->color_id)) $json_entry['color_id'] = $this->color_id;
		if(isset($this->size_id)) $json_entry['size_id'] = $this->size_id;
		if(isset($this->brand_id)) $json_entry['brand_id'] = $this->brand_id;
		if(isset($this->quantity)) $json_entry['quantity'] = $this->quantity;
		if(isset($this->price)) $json_entry['price'] = $this->price;
		if(isset($this->discount_price)) $json_entry['discount_price'] = $this->discount_price;
		if(isset($this->type_id)) $json_entry['type_id'] = $this->type_id;
		if(isset($this->state_id)) $json_entry['state_id'] = $this->state_id;
		if(isset($this->create_user_id)) $json_entry['create_user_id'] = $this->create_user_id;
		if(isset($this->create_time)) $json_entry['create_time'] = $this->create_time;
		if ($with_relations)
		{
			if(isset($this->brand)) $json_entry['brand'] = $this->brand->toArray(true);
			if(isset($this->color)) $json_entry['color'] = $this->color->toArray(true);
			if(isset($this->createUser)) $json_entry['createUser'] = $this->createUser->toArray(true);
			if(isset($this->product)) $json_entry['product'] = $this->product->toArray(true);
			if(isset($this->size)) $json_entry['size'] = $this->size->toArray(true);
		}
		
		return $json_entry;
	}
	
	public function linkImages($type_id) {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'create_user_id =' . Yii::app ()->user->id );
		$criteria->addCondition ( 'type_id =' . $type_id );
		$tempfiles = TempFile::model ()->findAll ( $criteria );
		//	var_dump($tempfiles);exit;
		if ($tempfiles) {
			foreach ( $tempfiles as $temp ) {
				
				$image = new ProductImage();
				$image->image_path = $temp->image_path;
				$image->product_id = $this->product_id;
				$image->var_id = $this->id;
				$image->order_no = $temp->order_no;
			//	$image->type_id = Product::TYPE_VARIENT;
				
				if($image->save ()){
					$temp->delete ();
				}else{
					print_r($image->getErrors());
				}
				
			}
		}
	}
	
}
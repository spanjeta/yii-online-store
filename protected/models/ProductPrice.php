<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 *
 * @property integer $id
 * @property string $min_price
 * @property string $max_price
 * @property integer $min_quantity
 * @property integer $max_quantity
 * @property integer $category_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 */
Yii::import ( 'application.models._base.BaseProductPrice' );
class ProductPrice extends BaseProductPrice {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function getCategoryOptions() {
		$cat = [ ];
		$criteria = new CDbCriteria ();
		$criteria->order = 'id desc';
		$criteria->limit = '10';
		$criteria->compare ( 'type_id', Category::TYPE_PARENT );
		$categories = Category::model ()->findAll ( $criteria );
		if ($categories != null) {
			foreach ( $categories as $category ) {
				$cat [$category->id] = $category->title;
			}
		}
		
		return $cat;
	}
	public function getValue($model, $attribute, $defaultValue) {
		switch ($attribute) {
			case 'category_id' :
				
				$name = $model->getCategoryName ();
				return $name;
		}
		
		return $model->$attribute;
	}
	public function getCategoryName() {
		$category = Category::model ()->findByPk ( $this->category_id );
		
		if ($category != null) {
			
			return $category->title;
		}
		return '';
	}
	public static function import($data_values) {
		$model = new ProductPrice ();
		$model->create_user_id = 1;
		if (isset ( $data_values ['Min Price'] )) {
			$model->min_price = $data_values ['Min Price'];
		}
		// echo $data_values ['Title_E'];exit;
		if (isset ( $data_values ['Max Price'] )) {
			$model->max_price = $data_values ['Max Price'];
		}
		
		if (isset ( $data_values ['Min Quantity'] )) {
			$model->min_quantity = $data_values ['Min Quantity'];
		}
		if (isset ( $data_values ['Max Quantity'] )) {
			$model->max_quantity = $data_values ['Max Quantity'];
		}
		if (isset ( $data_values ['Discount'] )) {
			$model->discount = $data_values ['Discount'];
		}
		
		$model->save ();
	}
}
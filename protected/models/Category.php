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
 * @property string $image_file
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import ( 'application.models._base.BaseCategory' );
class Category extends BaseCategory {
	public $max;
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function toArray() {
		$cat = $this;
		$json_entry = array ();
		$json_entry ["id"] = $cat->id;
		$json_entry ["title"] = $cat->title;
		return $json_entry;
	}
	public static function getCategories() {
		$criteria = new CDbCriteria ();
		$criteria->order = 'id desc';
		$criteria->limit = '7';
		$criteria->compare ( 'type_id', Category::TYPE_PARENT );
		$categories = Category::model ()->findAll ( $criteria );
		return $categories;
	}
	public function getSubcategoryIds() {
		$cat_ids = [ ];
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'type_id', Category::TYPE_CHILD );
		$criteria->addCondition ( 'parent_id =' . $this->id );
		$categorys = Category::model ()->findAll ( $criteria );
		if ($categorys != null) {
			foreach ( $categorys as $category ) {
				$cat_ids [] = $category->id;
			}
		}
		return $cat_ids;
	}
	public function getSubcategorys() {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'type_id', Category::TYPE_CHILD );
		$criteria->order = 'title asc';
		$criteria->limit = '21';
		$criteria->addCondition ( 'parent_id =' . $this->id );
		$categorys = Category::model ()->findAll ( $criteria );
		
		return $categorys;
	}
	public function getSizeOptions() {
		$sizes = [ ];
		$cat_ids = $this->getSubcategoryIds ();
		
		$criteria = new CDbCriteria ();
		$criteria->addInCondition ( 'category_id', $cat_ids );
		$criteria->group = 'size_id';
		$products = Product::model ()->findAll ( $criteria );
		
		if ($products) {
			foreach ( $products as $product ) {
				$size = Size::model ()->findByPk ( $product->size_id );
				if ($size != null) {
					$sizes [$size->id] = $size->title;
				}
			}
		}
		
		return $sizes;
	}
	public function getMaxPrice() {
		$total = 0;
		$cat_ids = $this->getSubcategoryIds ();
		$criteria = new CDbCriteria ();
		$criteria->select = '*, max(`price`) as max';
		$criteria->addInCondition ( 'category_id', $cat_ids );
		// $criteria->group = 'price';
		$products = Product::model ()->find ( $criteria );
		
		if (! empty ( $products )) {
			return round ( $products->max );
		}
		
		return $total;
	}
	public function getColors() {
		$colors = [ ];
		$cat_ids = $this->getSubcategoryIds ();
		
		$criteria = new CDbCriteria ();
		$criteria->addInCondition ( 'category_id', $cat_ids );
		$criteria->group = 'color_id';
		$products = Product::model ()->findAll ( $criteria );
		
		if ($products) {
			foreach ( $products as $product ) {
				$color = Color::model ()->findByPk ( $product->color_id );
				if ($color != null) {
					$colors [$color->id] = $color->color_code;
				}
			}
		}
		
		return $colors;
	}
	public function getBrandOptions() {
		$brands = [ ];
		$cat_ids = $this->getSubcategoryIds ();
		
		$criteria = new CDbCriteria ();
		$criteria->addInCondition ( 'category_id', $cat_ids );
		$criteria->group = 'brand_id';
		// print_r($criteria);exit;
		$products = Product::model ()->findAll ( $criteria );
		
		if ($products) {
			foreach ( $products as $product ) {
				$brand = Brand::model ()->findByPk ( $product->brand_id );
				if ($brand != null) {
					$brands [$brand->id] = $brand->title;
				}
			}
		}
		
		return $brands;
	}
	protected function beforeDelete() {
		
		// WishList::model()->deleteAllByAttributes(array ('model_id'=>$this->id,'type_id'=>Home::TYPE_PRODUCT));
		
		Product::model ()->deleteAllByAttributes ( array (
				'category_id' => $this->id
		) );
		 VarProduct::model ()->deleteAllByAttributes ( array (
				'brand_id' => $this->id
		) ); 
		
	
		return parent::beforeDelete ();
	}
}
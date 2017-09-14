<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property string $title
 * @property string $sku
 * @property integer $store_id
 * @property string $product_code
 * @property integer $prod_id
 * @property string $range
 * @property string $edition
 * @property integer $hide_public
 * @property string $description
 * @property string $large_description
 * @property string $tags
 * @property string $related_items
 * @property string $thumbnail_file
 * @property string $image_file
 * @property integer $category_id
 * @property string $size_id
 * @property integer $color_id
 * @property integer $brand_id
 * @property integer $is_sale
 * @property integer $feature_site
 * @property integer $is_featured
 * @property integer $postage_id
 * @property integer $view_count
 * @property integer $warranty_id
 * @property string $quantity
 * @property string $discount_price
 * @property double $price
 * @property integer $is_discount
 * @property string $tax
 * @property string $tax_amount
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property integer $product_id
 * @property integer $rss_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import('application.models._base.BaseVariantProduct');
class VariantProduct extends BaseVariantProduct
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function getProductColor() {
		$color = Color::model ()->findByPk ( $this->color_id );
		if($color)
		{
			return $color->title;
		}
		else {
			return '';
		}
	}
	public function getProductColorOptions() {
		$colors = [];
		$productcolor = [];
		$color_array = [];
		$criteria = new CDbCriteria();
		$criteria->group = 'color_id';
		$criteria->addCondition('product_id ='. $this->product_id );
		$variantProducts = VariantProduct::model ()->findAll($criteria);
	
		if($variantProducts)
		{
			foreach($variantProducts as $variantProduct)
			{
				if($variantProduct->image_file != '')
				$colors[$variantProduct->color_id] = $variantProduct->color->title;
			}
				
		}
	
		return $colors;
	}

	public function getProductSizeOptions() {
		$range = false;
		$extra = false;
		$sizes = [ ];
		$criteria = new CDbCriteria ();
		$criteria->group = 'size_id';
		$criteria->addCondition ( 'product_id =' . $this->product_id );
		$variantProducts = VariantProduct::model ()->findAll ( $criteria );
	
		if ($variantProducts) {
			foreach ( $variantProducts as $variantProduct ) {
				if ($variantProduct->size) {
					$sizes [] = $variantProduct->size->title;
					if (strpos ( $variantProduct->size->title, '-' ) !== false) {
						$range = true;
					}
					if (strpos ( $variantProduct->size->title, 'XL' ) !== false) {
						$extra = true;
					}
				}
			}
		}
		if($this->size)
		{
				
			if (!in_array($this->size->title,$sizes))
			{
					
				$sizes = array_merge(array($this->size->title),$sizes);
			}
		}
		if ($range == true) {
			natsort ( $sizes );
		} else if ($extra == true) {
			usort ( $sizes, "self::sort_clothes_sizes" );
		} else {
			usort ( $sizes, "self::cmp" );
		}
	
		return $sizes;
	}
	public function sort_clothes_sizes($a, $b) {
		$valid1 = false;
		$valid2 = false;
		$sizes = array (
				'XXS' => 0,
				'XS' => 1,
				'S' => 2,
				'SML' => 3,
				'MED' => 4,
				'LAR' => 5,
				'XL' => 6,
				'2XL' => 7,
				'3XL' => 8,
				'4XL' => 9,
				'5XL' => 10,
				'XXL' => 11
		);
		if (array_key_exists($a,$sizes))
		{
			$asize = $sizes [$a];
			$valid1 = true;
		}
		if (array_key_exists($b,$sizes))
		{
			$bsize = $sizes [$b];
			$valid2 = true;
		}
		if($valid1 == true && $valid2 == true)
		{
			if ($asize == $bsize)
				return 0;
	
				return ($asize > $bsize) ? 1 : - 1;
		}
	
		return 0;
	}
	public function cmp($a, $b) {
		if ($a == $b) {
			return 0;
		}
	
		if (is_numeric ( $a ) && is_numeric ( $b )) {
			$a = intval ( $a );
			$b = intval ( $b );
			return $a > $b ? 1 : - 1;
		}
	}
	public function calPrice() {
		return $this->price;
	}
}
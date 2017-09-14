<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 *
 * @property integer $id
 * @property string $title
 * @property string $sku
 * @property string $small_description
 * @property string $large_description
 * @property string $tags
 * @property string $related_items
 * @property string $thumbnail_file
 * @property string $image_file
 * @property integer $category_id
 * @property string $product_size
 * @property string $product_color
 * @property string $quantity
 * @property string $discount_price
 * @property string $price
 * @property string $discount
 * @property string $tax
 * @property string $tax_amount
 * @property integer $type_id
 * @property integer $state_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import ( 'application.models._base.BaseProduct' );
class Product extends BaseProduct {
	public $payment;
	public $del_ids;
	public $autocomplete_list;
	public $already_tagged;
	public $chk;
	public $min_price;
	public $max_price;
	public $location;
	public $is_near;
	public $brand;
	public $like_items;
	public $type;
	public $user;
	public $categories;
	public $Related_Products;
	public $Stock;
	public $Views;
	public $Item_Sold;
	public $Item_Returned;
	public $Date_Modified;
	public $Date_Created;
	public $Total_Live_Days;
	public $List_Fees;
	public $Sold_Fees;
	public $On_Sale;
	const DISCOUNT_INACTIVE = 0;
	const DISCOUNT_ACTIVE = 1;
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public static function getproducts() {
		$list = array ();
		$criteria = new CDbCriteria ();
		// $criteria->addCondition('state_id = 1');
		$products = Product::model ()->my ()->findAll ( $criteria );
		foreach ( $products as $id => $product ) {
			if ($product->images) {
				$list [] = ($product->title);
			}
		}
		return $list;
	}
	public static function getProdColors($prod_id) {
		$list = array ();
		$criteria = new CDbCriteria ();
		$criteria->addCondition('prod_id',$prod_id);
		$products = Product::model ()->findAll ( $criteria );
		foreach ( $products as $id => $product ) {
			if ($product->color_id) {
				$list [] = ($product->color_id);
			}
		}
		return $list;
	}
	public static function getVarProdColors($prod_id) {
		$colors = [];
		//$cat_ids = $this->getSubcategoryIds ();
		
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'product_id', $prod_id);
		$criteria->group = 'color_id';
		$products = VarProduct::model ()->findAll ( $criteria );
		
		
		if($products)
		{
			foreach($products as $product)
			{
				$color = Color::model()->findByPk($product->color_id);
				if($color != null)
				{
					$colors[$color->id] = $color->title;
					$colors['color_price'] = $product->price;
				}
			}
			
		}
		
		return $colors;
	}
	public static function getVarProdSizes($prod_id) {
		$sizes= [];
		//$cat_ids = $this->getSubcategoryIds ();
		
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'product_id', $prod_id);
		$criteria->group = 'size_id';
		$products = VarProduct::model ()->findAll ( $criteria );
		
		
		if($products)
		{
			foreach($products as $product)
			{
				$size = Size::model()->findByPk($product->size_id);
				if($size!= null)
				{
					$sizes[$size->id] = $size->title;
					$sizes['size_price'] = $product->price;
				}
			}
			
		}
		
		return $sizes;
	}
	/* public static function getVarProdColors($prod_id) {
		$list = array ();
		$criteria = new CDbCriteria ();
		$criteria->addCondition('product_id',$prod_id);
		$products = VarProduct::model ()->findAll ( $criteria );
		foreach ( $products as $id => $product ) {
			if ($product->color_id) {
				$list [] = ($product->color_id);
			}
		}
		return $list;
	} */
	public function toArray($wish_id = null) {
		$json_entry = array ();
		$product = $this;
		
		if (isset ( $product->company )) {
			$company_name = $product->company->shop_name;
		} else
			$company_name = 'my shop';
		
		$image = $product->getImage ();
		
		if (! $image) {
			$image = Yii::app ()->createAbsoluteUrl ( 'product/download', array (
					'file' => 'default.png' 
			) );
		}
		
		$json_entry = array ();
		
		$onsale = $product->onsale ();
		
		if ($wish_id)
			$json_entry ["data_id"] = $wish_id;
		
		$json_entry ["id"] = $product->id;
		
		$json_entry ["user_id"] = $product->create_user_id;
		$json_entry ["title"] = $product->title;
		$json_entry ['product_code'] = isset ( $product->product_code ) ? $product->product_code : 'qwert760';
		$json_entry ['sku'] = $product->sku;
		$json_entry ['description'] = strip_tags ( $product->description );
		$json_entry ['state_id'] = $product->state_id;
		$json_entry ['quantity'] = $product->quantity;
		$json_entry ['image_file'] = $image;
		$json_entry ['price'] = $product->price;
		// $json_entry['lat'] = $product->company->createUser->userAddresses->lat;
		// $json_entry['long'] = $product->company->createUser->userAddresses->long;
		$useraddress = $product->company->createUser->userAddresses;
		$latlongs = array (
				'lat' => $useraddress->lat,
				'long' => $useraddress->long 
		);
		$json_entry ['latlong'] = $latlongs;
		$json_entry ['delivery'] = $product->company->delivery_info;
		$json_entry ['warranty'] = '';
		$json_entry ['category'] = $product->category ? $product->category->title : '';
		$json_entry ['brand'] = $product->brand ? $product->brand->title : '';
		$json_entry ['color'] = $product->color ? $product->color->title : '';
		$json_entry ['was'] = '';
		$json_entry ['is_sale'] = $product->is_discount;
		if ($onsale) {
			$json_entry ['is_sale'] = 1;
		} else {
			$json_entry ['is_sale'] = 0;
		}
		$json_entry ['update_time'] = $product->update_time;
		if ($onsale) {
			$json_entry ['sale_content'] = $product->offerContent ();
		}
		$json_entry ['shop_name'] = $company_name;
		$json_entry ["data_type"] = WishList::TYPE_PRODUCT;
		// $json_entry['fav_count'] = '5';
		
		$json_entry ['is_enquiry'] = 1;
		if (! Yii::app ()->user->isGuest) {
			if ($product->create_user_id == Yii::app ()->user->id)
				$json_entry ['is_enquiry'] = 0;
			$json_entry ['is_fav'] = $product->myfav ( WishList::TYPE_PRODUCT );
		} else
			$json_entry ['is_fav'] = 0;
		return $json_entry;
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
	public function toArrayMini() {
		$product = $this;
		$json_entry = array ();
		$json_entry ["id"] = $product->id;
		$json_entry ["title"] = $product->title;
		return $json_entry;
	}
	public static function getProductId($title) {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'title = \'' . $title . '\'' );
		$criteria->addcondition ( 'create_user_id = ' . Yii::app ()->user->id );
		
		$product = Product::model ()->find ( $criteria );
		if ($product)
			return $product->id;
		return false;
	}
	public function getOperation() {
		$list = array (
				'delete',
				'mark featured',
				'un featured' 
		);
		
		return $list;
	}
	public function getInvOperation() {
		/*
		 * $list = array('Delete','Published','Unpublish',' Feature on my home page',
		 * 'unfeature on my home page','Featured on site','Unfeatured on site',
		 * 'Sale Label','Remove Sale Label','New Label','remove New Label');
		 */
		$list = array (
				'Delete',
				'Published',
				'Unpublish',
				' Feature on my home page',
				'unfeature on my home page',
				'Featured on site',
				'Unfeatured on site' 
		);
		return $list;
	}
	public function getPrintOperation() {
		/*
		 * $list = array('Delete','Published','Unpublish',' Feature on my home page',
		 * 'unfeature on my home page','Featured on site','Unfeatured on site',
		 * 'Sale Label','Remove Sale Label','New Label','remove New Label');
		 */
		$list = array (
				'1' => 'Export records in Csv file' 
		);
		return $list;
	}
	
	/**
	 * this function is used for adding related like items link with a product
	 */
	public function addRelatedLikes() {
		$ids = explode ( ',', $this->like_items );
		if (count ( $ids ) > 0) {
			foreach ( $ids as $id ) {
				
				$criteria = new CDbCriteria ();
				$criteria->addCondition ( 'like_product_id =' . $id );
				$criteria->addCondition ( 'product_id =' . $this->id );
				$islike = LikeProduct::model ()->my ()->find ( $criteria );
				if ($islike) {
					$related = $islike;
				} else {
					$related = new LikeProduct ();
				}
				$related->product_id = $this->id;
				$related->like_product_id = $id;
				$related->save ();
			}
		}
	}
	
	/**
	 * this function is used for adding related items link with a product
	 */
	public function addRelatedItems() {
		$ids = explode ( ',', $this->related_items );
		if (count ( $ids ) > 0) {
			foreach ( $ids as $id ) {
				$criteria = new CDbCriteria ();
				$criteria->addCondition ( 'link_product_id =' . $id );
				$criteria->addCondition ( 'product_id =' . $this->id );
				
				$linkrelated = LinkProduct::model ()->my ()->find ( $criteria );
				
				if ($linkrelated) {
					$related = $linkrelated;
				} else {
					$related = new LinkProduct ();
				}
				$related->product_id = $this->id;
				$related->link_product_id = $id;
				$related->save ();
			}
		}
	}
	
	/**
	 * this is used for linking size from api end here they send id in comma separated
	 */
	public function addRelatedSize() {
		$ids = explode ( ',', $this->size_id );
		
		if (count ( $ids ) > 0) {
			foreach ( $ids as $id ) {
				$criteria = new CDbCriteria ();
				$criteria->addCondition ( 'size_id =' . $id );
				$criteria->addCondition ( 'product_id =' . $this->id );
				
				$linksize = LinkSize::model ()->my ()->find ( $criteria );
				
				if ($linksize) {
					$related = $linksize;
				} else {
					$related = new LinkSize ();
				}
				$related->product_id = $this->id;
				$related->size_id = $id;
				$related->save ();
			}
		}
	}
	
	/**
	 * this is used for searching size and and add related sizw in case of option from web end only
	 */
	public function addRelatedSizeOnWeb() {
		$titles = explode ( ',', $this->size_id );
		
		// print_r($ids);
		if (count ( $titles ) > 0) {
			foreach ( $titles as $title ) {
				$criteria = new CDbCriteria ();
				$criteria->addCondition ( 'title = "' . $title . ' "' );
				$size = Size::model ()->find ( $criteria );
				
				if (! $size) {
					$size = new Size ();
					$size->title = $title;
					$size->save ();
				}
			}
		}
	}
	public  function getCategoryOptions($id = null) {
		$categories = Category::model ()->findAllByAttributes ( array (
				'type_id' => Category::TYPE_CHILD 
		) );
		$list = [ ];
		if ($categories) {
			foreach ( $categories as $category ) {
				$list [$category->title] = $category->id;
			}
		}
		
		if ($id === null)
			return $list;
		if (is_numeric ( $id ))
			// return $list [$id];
			return $id;
	}
	public function seacrhHome() {
		$criteria = new CDbCriteria ();
		
		if (isset ( $this->store_id ) && ! empty ( $this->store_id )) {
			$criteria->addCondition ( 'store_id = ' . $this->store_id );
		}
		if (isset ( $this->color_id ) && ! empty ( $this->color_id )) {
			$criteria->addCondition ( 'color_id = ' . $this->color_id );
		}
		if (isset ( $this->brand_id ) && ! empty ( $this->brand_id )) {
			$criteria->addCondition ( 'brand_id = ' . $this->brand_id );
		}
		if (isset ( $this->category_id ) && ! empty ( $this->category_id )) {
			$criteria->addCondition ( 'category_id = ' . $this->category_id );
		}
		
		return Product::model ()->findAll ( $criteria );
	}
	/**
	 * this is used while produt is deleted delete all related records
	 */
	protected function beforeDelete() {
		
		// WishList::model()->deleteAllByAttributes(array ('model_id'=>$this->id,'type_id'=>Home::TYPE_PRODUCT));
		$prodimages = $this->images;
		
		if ($prodimages) {
			foreach ( $prodimages as $prodimage ) {
				$imagefile = Yii::app ()->basePath . '/..' . UPLOAD_PATH . $prodimage->image_path;
				if (file_exists ( $imagefile )) {
					unlink ( $imagefile );
				}
				$prodimage->delete ();
			}
		}
		CartItem::model ()->deleteAllByAttributes ( array (
				'product_id' => $this->id 
		) );
		
		// DealItem::model ()->deleteAllByAttributes ( array (
		// 'product_id' => $this->id
		// ) );
		// EmpProduct::model()->deleteAllByAttributes(array('product_id'=>$this->id));
		// OfferItem::model ()->deleteAllByAttributes ( array (
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
	public function linkImages($type_id) {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'create_user_id =' . Yii::app ()->user->id );
		$criteria->addCondition ( 'type_id =' . $type_id );
		$tempfiles = TempFile::model ()->findAll ( $criteria );
		if ($tempfiles) {
			foreach ( $tempfiles as $temp ) {
				$image = new ProductImage ();
				$image->image_path = $temp->image_path;
				$image->product_id = $this->id;
				$image->order_no = $temp->order_no;
				
				$image->save ();
				$temp->delete ();
			}
		}
	}
	/**
	 * this is used for web on product view page to show size dropdown list if size is available there
	 *
	 * @return unknown
	 */
	public function getSizeOptions() {
		$options = array ();
		$criteria = new CDbCriteria ();
		
		$criteria->addCondition ( 'product_id =' . $this->id );
		$sizes = LinkSize::model ()->findAll ( $criteria );
		if ($sizes) {
			foreach ( $sizes as $size ) {
				$options [$size->id] = $size->size->title;
			}
			return $options; //
		}
		return false;
	}
	
	
	public function getVarientlist() {
		$product = $this;
		$options = array ();
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'product_id = ' . $product->id );
		
		$varProducts = VarProduct::model ()->findAll ( $criteria );
		if ($varProducts) {
			foreach ( $varProducts as $varProduct ) {
				$options [$varProduct->id] = $varProduct->title;
			}
		}
		
		return $options;
	}
	public function getVarient() {
		$product = $this;
		$options = array ();
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'product_id = ' . $product->id );
		$varProducts = VarProduct::model ()->findAll ( $criteria );
		return $varProducts;
	}
	
	/**
	 * this is for web used on product view page to display product related items as a dropdown.
	 *
	 * @return multitype:multitype:NULL
	 */
	public function getRelatedOptions() {
		$options = array ();
		$related = $this->related; // this is comming from relation
		if ($related) {
			foreach ( $related as $relate ) {
				$options [] = $relate->linkProduct->title;
			}
			return $options;
		}
		return false;
	}
	
	/**
	 * this option is used for adding in case of api this method is used
	 *
	 * @return multitype:multitype:NULL
	 */
	public function sizeOptionOnPurchase() {
		$options = array ();
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'product_id =' . $this->id );
		$sizes = LinkSize::model ()->findAll ( $criteria );
		if ($sizes) {
			foreach ( $sizes as $size ) {
				$options [] = array (
						'id' => $size->size->id,
						'title' => $size->size->title 
				);
			}
		}
		return $options;
	}
	/**
	 * this one is used to show product warranty and care on product info page
	 *
	 * @return multitype:multitype:NULL
	 */
	public function getWarranty() {
		$options = array ();
		$warranty = $this->warranty;
		if ($warranty) {
			return $warranty->description;
		}
		
		return '';
	}
	
	/**
	 * used for search in case of tab
	 *
	 * @return unknown
	 */
	public function TabSearchApi($price_id, $is_sale) {
		$criteria = new CDbCriteria ();
		if (! empty ( $this->brand_id ))
			$criteria->compare ( 'brand_id', $this->brand_id, true );
		
		if (! empty ( $this->category_id ))
			$criteria->compare ( 'category_id', $this->category_id, true );
		
		if (! empty ( $this->color_id ))
			$criteria->compare ( 'color_id', $this->color_id, true );
		
		if (! empty ( $this->store_id ))
			$criteria->compare ( 'store_id', $this->store_id, true );
		
		// if(!empty($this->price_id))
		// {
		if ($price_id == 0) {
			$criteria->order = 'price ASC';
		} else {
			$criteria->order = 'price DESC';
		}
		
		if ($is_sale == Product::SALE_ON) {
			$product_list = Product::getAllSaleAndDealProductList ();
			$criteria->addInCondition ( 'id', $product_list );
		}
		
		$products = Product::model ()->resetScope ()->findAll ( $criteria );
		
		return $products;
	}
	
	/**
	 * This is used only for showing that a product have any offer or deal
	 * Enter description here ...
	 */
	public function onsale() {
		$offer = $this->isoffer;
		$deal = $this->isdeal;
		if ($offer)
			return true;
		if ($deal)
			return true;
		return false;
	}
	
	
	public static function getAllProducts() {
		$prod = [ ];
		$products = Product::model ()->findAll ();
		if ($products) {
			foreach ( $products as $product ) {
				$prod [] = $product->title . '(' . $product->product_code . ')';
			}
		}
		return $prod;
	}
	
	/**
	 * this method is used for showing the offer and deal text on product info page
	 *
	 * @return string|boolean
	 */
	/*
	 * Deal Tile 1 means On and value zero means Off.
	 */
	public function offerContent($deal_title = 1) {
		$isofferItem = $this->isoffer; // this both are related from order item and deal item link with product
		$deal = $this->isdeal;
		if ($isofferItem) {
			switch ($isofferItem->offer->type_id) {
				case 1 :
					{
						return isset ( $isofferItem->offer->percent_off ) ? $isofferItem->offer->percent_off . ' % off ' : '';
						break;
					}
				case 2 :
					{
						return isset ( $isofferItem->offer->percent_off ) && isset ( $isofferItem->offer->get_item ) ? 'Buy Item ' . $isofferItem->offer->buy_item . ' get Item ' . $isofferItem->offer->get_item . ' Free ' : '';
						break;
					}
				case 3 :
					{
						return isset ( $isofferItem->offer->buy_item ) ? 'Buy Item ' . $isofferItem->offer->buy_item . ' And Get  ' . $isofferItem->offer->percent_off . ' % off' : '';
						break;
					}
				case 4 :
					{
						return isset ( $isofferItem->offer->buy_item ) ? 'Buy Item ' . $isofferItem->offer->buy_item . '  And Get   ' . $isofferItem->offer->percent_off . ' % Off' : '';
						break;
					}
				default :
					{
						return false;
					}
			}
		} else if ($deal) {
			switch ($deal->deal->type_id) {
				case 0 :
					{
						if (isset ( $deal->deal->percent_off )) {
							$deal_info = ($deal_title == 1) ? 'Deal ' . $deal->deal->title . '<h3>' . $deal->deal->percent_off . '$ Off </h3>' : $deal->deal->percent_off . '$ Off';
							return $deal_info;
							// return 'Deal '. $deal->deal->title .'<h3>'.$deal->deal->percent_off . ' % Off </h3>';
						} else
							return 'Deal ' . $deal->deal->title;
						break;
					}
				case 1 :
					{
						if (isset ( $deal->deal->dollor_off )) {
							$deal_info = ($deal_title == 1) ? 'Deal ' . $deal->deal->title . '<h3> $ ' . $deal->deal->dollor_off . ' Off</h3>' : ' $ ' . $deal->deal->dollor_off . ' Off';
							return $deal_info;
							// return 'Deal '. $deal->deal->title .'<h3> $ '.$deal->deal->dollor_off . ' Off</h3>';
						} else
							return $this->price;
						break;
					}
				default :
					{
						return 'Deal ' . $deal->deal->title;
					}
			}
		} 
		else
			return false;
	}
	
	/**
	 * This price is calculated on the basis of offer type and deal type first to find
	 * if there is any offer of deal is available on that item.
	 *
	 * @return string|boolean
	 */
	public function calPrice() {
		return $this->price;
	}
	/**
	 * this is used for to showing enquire about that product
	 * Enter description here ...
	 */
	public function showEnq() {
		$pcreateUser = $this->create_user_id;
		if ($pcreateUser == Yii::app ()->user->id)
			return false;
		return true;
	}
	/**
	 * This function is used for calculating reviews and show on product view page
	 */
	public function getReviews() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'shop_id = ' . $this->company->id );
		$reviews = Review::model ()->findAll ( $criteria );
		return $reviews;
	}
	public static function getTotalLiveday($data) {
		$datetime1 = new DateTime ( $data->create_time ); // must be smaller
		$datetime2 = new DateTime ( "now" );
		$interval = $datetime1->diff ( $datetime2 );
		echo $interval->format ( '%R%a days' );
	}
	/**
	 * Enter description here ...
	 * this function is used on variated product create
	 */
	public function saveVariated($post) {
		echo '<pre>';
		// print_r($_FILES);
		echo '</pre>';
		$arr = array (
				'status' => 'NOK' 
		);
		$counts = count ( $post ['title'] );
		$json_varprod = array ();
		$json_file = array ();
		for($i = 0; $i < $counts; $i ++) {
			$varprod = new VarProduct ();
			$varprod->product_id = $this->id;
			$varprod->title = isset ( $post ['title'] [$i] ) and ! empty ( $post ['title'] [$i] ) ? $post ['title'] [$i] : '';
			$varprod->price = isset ( $post ['price'] [$i] ) and ! empty ( $post ['price'] [$i] ) ? $post ['price'] [$i] : '';
			$varprod->sku = isset ( $post ['sku'] [$i] ) and ! empty ( $post ['sku'] [$i] ) ? $post ['sku'] [$i] : '';
			$varprod->color_id = isset ( $post ['color_id'] [$i] ) and ! empty ( $post ['color_id'] [$i] ) ? $post ['color_id'] [$i] : '';
			if ($varprod->save ()) {
				$json_varprod [] = $varprod->toArray ();
				$arr ['status'] = 'OK';
				if (isset ( $post ['size_id'] [$i] ) and ! empty ( $post ['size_id'] [$i] )) {
					$varprod->addVarSizeOnWeb ( $post ['size_id'] [$i], $this );
				}
				$productImage = new ProductImage ();
				$uploaded_file = CUploadedFile::getInstances ( $varprod, 'image_file' );
				if (isset ( $uploaded_file )) {
					$arr ['hello'] = 'OK';
					foreach ( $uimages as $image => $pic ) {
					}
					$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH;
					$filename = $path . get_class ( $productImage ) . '_' . time () . '_' . 'image_file' . '.' . $uploaded_file->getExtensionName ();
					$uploaded_file->save ();
					$productImage->$attribute = basename ( $filename );
					if ($$productImage->save ()) {
						$json_file [] = array (
								'id' => $productImage->id,
								'status' => 'OK' 
						);
					} else {
						$json_file [] = array (
								'error' => $productImage->getErrors (),
								'status' => 'NOK' 
						);
					}
				}
			} 
			else {
				$json_varprod [] = array (
						'error' => $varprod->getErrors (),
						'status' => 'NOK' 
				);
			}
		}
		$arr ['json_file'] = $json_file;
		$arr ['varprod'] = $json_varprod;
		return $arr;
	}
	public function countReturnItem() {
		$shop_id = $this->company->id;
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'shop_id = ' . $shop_id );
		$criteria->addCondition ( 'state_id = ' . Payment::STATUS_CANCEL );
		
		$payments = Payment::model ()->findAll ( $criteria );
		$cancel = 0;
		
		if ($payments) {
			
			foreach ( $payments as $payment ) {
				
				$cart = $payment->cart;
				
				if ($cart) {
					
					$items = $cart->cartItems;
					
					if ($items) {
						
						foreach ( $items as $items ) {
							
							if ($items->product_id == $this->id) {
								$cancel ++;
							}
						}
					}
				}
			}
		}
		return $cancel;
	}
	public function getReturnItem() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'create_user_id =' . Yii::app ()->user->id );
		$criteria->addCondition ( 'state_id = ' . Payment::STATUS_CANCEL );
		
		$payments = Payment::model ()->findAll ( $criteria );
		
		if ($payments) {
			
			foreach ( $payments as $payment ) {
				
				$cart = $payment->cart;
				
				if ($cart) {
					
					$items = $cart->cartItems;
					
					if ($items) {
						
						foreach ( $items as $item ) {
							
							$returnproduct = $item->product;
							return $returnproduct;
						}
					}
				}
			}
		}
	}
	public static function getAllSaleAndDealProductList() {
		$deals = DealItem::model ()->findAll ();
		$product_list = array ();
		foreach ( $deals as $deal ) {
			$product_list [] = $deal->product_id;
		}
		$offers = OfferItem::model ()->findAll ();
		foreach ( $offers as $offer ) {
			$product_list [] = $offer->product_id;
		}
		return $product_list;
	}
	public function showOfferDealArrow() {
		$product = $this;
		$arrow = '';
		if ($product->isoffer) {
			$arrow = '<ul class="tags2">
						<li><a href="#">' . $product->offerContent ( 0 ) . '</a></li>
					  </ul>';
		} else if ($product->isdeal) {
			$arrow = '<ul class="tags">
						<li><a href="#">' . $product->offerContent ( 0 ) . '</a></li>
					  </ul>';
		}
		return $arrow;
	}
	public function getProductColor() {
		$color = Color::model ()->findByPk ( $this->color_id );
		if ($color) {
			return $color->title;
		} else {
			return '';
		}
	}
	public function getProductColorOptions() {
		$colors = [ ];
		$productcolor = [ ];
		$color_array = [ ];
		$criteria = new CDbCriteria ();
		$criteria->group = 'color_id';
		$criteria->addCondition ( 'product_id =' . $this->prod_id );
		$variantProducts = VariantProduct::model ()->findAll ( $criteria );
		
		if ($variantProducts) {
			foreach ( $variantProducts as $variantProduct ) {
				if ($variantProduct->image_file != '')
					$colors [$variantProduct->color_id] = $variantProduct->color->title;
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
		$criteria->addCondition ( 'product_id =' . $this->prod_id );
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
		if ($this->size) {
			
			if (! in_array ( $this->size->title, $sizes )) {
				
				$sizes = array_merge ( array (
						$this->size->title 
				), $sizes );
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
		if (array_key_exists ( $a, $sizes )) {
			$asize = $sizes [$a];
			$valid1 = true;
		}
		if (array_key_exists ( $b, $sizes )) {
			$bsize = $sizes [$b];
			$valid2 = true;
		}
		if ($valid1 == true && $valid2 == true) {
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
	public static function getAllCatProducts($id) {
		$prod = [ ];
		$products = Product::model ()->findAllByAttributes ( array (
				'category_id' => $id 
		) );
		if ($products) {
			foreach ( $products as $product ) {
				$prod [] = $product->title;
			}
		}
		return $prod;
	}
	public function getProductMarkUpPrice() {
		$price = null;
		// $sub_category = Category::model ()->findByPk ( $this->category_id );
		// if ($sub_category != null) {
		$criteria = new CDbCriteria ();
		$criteria->order = 'id desc';
		$criteria->limit = '1';
		$criteria->addCondition ( 'min_price <=' . $this->price );
		$criteria->addCondition ( 'max_price >' . $this->price );
		// $criteria->addCondition ( 'category_id =' . $sub_category->parent_id );
		$productprice = ProductPrice::model ()->find ( $criteria );
		
		if ($productprice != null) {
			$price = $this->price + ($this->price) * ($productprice->discount) / 100;
			return round ( $price, 2 );
		}
		
		return $price;
	}
	public function getProductPrices() {
		$prices = null;
		// $sub_category = Category::model ()->findByPk ( $this->category_id );
		// if ($sub_category != null) {
		$criteria = new CDbCriteria ();
		$criteria->order = 'id asc';
		$criteria->addCondition ( 'min_price <=' . $this->price );
		$criteria->addCondition ( 'max_price >' . $this->price );
		// $criteria->addCondition ( 'category_id =' . $sub_category->parent_id );
		$prices = ProductPrice::model ()->findAll ( $criteria );
		
		if ($prices == null) {
			$sql = "select *
				from `tbl_product_price`
				where  `min_price` = (select max(`min_price`)  from `tbl_product_price`)";
			$prices = ProductPrice::model ()->findAllBySql ( $sql );
			/*
			 * $sql = "select *
			 * from `tbl_product_price`
			 * where `min_price` = (select max(`min_price`) && `category_id` = {$sub_category->parent_id} from `tbl_product_price`)";
			 * $prices = ProductPrice::model ()->findAllBySql ( $sql );
			 */
		}
		// }
		
		return $prices;
	}
}
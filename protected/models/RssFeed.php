<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $state_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import ( 'application.models._base.BaseRssFeed' );
class RssFeed extends BaseRssFeed {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public static function timerSync() {
		$update_time = 60 * 60 * 2; // 2 hours
		
		$criteria = new CDbCriteria ();
		$online_end = date ( 'Y-m-d H:i:s', time () - $update_time );
		$criteria->addCondition ( 'update_time < \'' . $online_end . '\'' );
		$criteria->limit = '5';
		// $criteria->compare ( 'state_id', RssFeed::STATUS_PUBLISH );
		$criteria->order = 'create_time ASC';
		
		$links = RssFeed::model ()->findAll ( $criteria );
		
		Yii::log ( CVarDumper::DumpAsString ( 'Time Sync Initiate ' ), CLogger::LEVEL_WARNING );
		if ($links != null) {
			
			foreach ( $links as $link ) {
				if ($link) {
					try {
						
						$out = self::sync ( $link );
					} catch ( Exception $e ) {
						var_dump ( $e );
					}
				}
			}
		}
	}
	public static function sync($model, $start = 0) {
		echo "sync Url: " . $model->url . '<br/>' . PHP_EOL;
		
		$url = trim ( $model->url );
		$url = self::myUrlEncode ( $url );
		echo "corrected sync Url: " . $url . '<br/>' . PHP_EOL;
		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		$content = curl_exec ( $ch );
		
		curl_close ( $ch );
		$output = json_decode ( $content );
		
		Yii::log ( CVarDumper::dumpAsString ( $model->url ), CLogger::LEVEL_WARNING, 'url' );
		// / $xml = simplexml_load_file ( $rss );
		
		// loop through the each node of molecule
		
		if ($output) {
			
			if ($output->Products) {
				foreach ( $output->Products as $record ) {
					// attribute are accessted by
					self::updateProduct ( $record, $model->id );
				}
				$model->update_time = new CDbExpression ( 'NOW()' );
				$model->saveAttributes ( array (
						'update_time' 
				) );
			} else {
				$model->update_time = new CDbExpression ( 'NOW()' );
				$model->saveAttributes ( array (
						'update_time' 
				) );
			}
		}
		/*
		 * $this->redirect ( array (
		 * 'rssFeed/admin'
		 * ) );
		 */
	}
	public static function myUrlEncode($string) {
		$entities = array (
				'%21',
				'%2A',
				'%27',
				'%28',
				'%29',
				'%3B',
				'%3A',
				'%40',
				'%26',
				'%3D',
				'%2B',
				'%24',
				'%2C',
				'%2F',
				'%3F',
				'%25',
				'%23',
				'%5B',
				'%5D' 
		);
		$replacements = array (
				'!',
				'*',
				"'",
				"(",
				")",
				";",
				":",
				"@",
				"&",
				"=",
				"+",
				"$",
				",",
				"/",
				"?",
				"%",
				"#",
				"[",
				"]" 
		);
		return str_replace ( $entities, $replacements, urlencode ( $string ) );
	}
	protected static function updateProduct($record, $id) {
		$rss = RssFeed::model ()->findByPk ( $id );
		$imageurl = '';
		if ($rss) {
			$imageurl = $rss->image_url;
		}
		$record = self::stdToArray ( $record );
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'prod_id ='. $record ['ParentProductID'] );
		$product = Product::model ()->find ( $criteria );
		Yii::log ( CVarDumper::dumpAsString ( $product ), CLogger::LEVEL_WARNING, '$$product' );
		if ($record ['ParentProductID'] == $record ['ProductID']) {
			if ($product == null) {
				
				$product = new Product ();
			}
		} else {
			Yii::log ( CVarDumper::dumpAsString ( $record ['ProductID'] ), CLogger::LEVEL_WARNING, 'record_p' );
			Yii::log ( CVarDumper::dumpAsString ( $record ['ParentProductID'] ), CLogger::LEVEL_WARNING, 'parent' );
			if ($product)
				$product_id = $product->id;
			else
				$product_id = null;
			$criteria = new CDbCriteria ();
			$criteria->addCondition ( 'product_code ='. $record ['ProductID'] );
			$criteria->addCondition ( 'product_id ='. $product_id );
			$varproduct = VariantProduct::model ()->find ( $criteria );
			if ($varproduct == null) {
				$varproduct = new VariantProduct ();
			}
			$product = $varproduct;
			$product->product_id = $record ['ParentProductID'];
		}
		$admin = User::model ()->findByAttributes ( array (
				'role_id' => User::ROLE_ADMIN 
		) );
		$product->prod_id = $record ['ProductID'];
		$product->title = $record ['ProductName'];
		$brand_id = $product->getItemBrand ( $record ['Brand'] );
		if ($brand_id != null)
			$product->brand_id = $brand_id;
	if(isset($record ['Color'] )){
		$color_id = $product->getItemColor ( $record ['Color'] );
		$product->color_id = $color_id;
		}
		$product->product_code = $record ['ProductCode'];
		$product->color_id = $color_id;
		Yii::log ( CVarDumper::dumpAsString ( $record ['ProductCategoryGroup'] ), CLogger::LEVEL_WARNING, 'parent_id' );
		Yii::log ( CVarDumper::dumpAsString ( $record ['ProductCategory'] ), CLogger::LEVEL_WARNING, 'category_id' );
		Yii::log ( CVarDumper::dumpAsString ( $record ['ProductGroupName'] ), CLogger::LEVEL_WARNING, 'group_id' );
		$category_id = $product->getItemCategory ( $record ['ProductCategoryGroup'], $record ['ProductCategory'], $record ['ProductGroupName'] );
		Yii::log ( CVarDumper::dumpAsString ( $category_id ), CLogger::LEVEL_WARNING, '$category_id' );
		$product->category_id = $category_id;
		$size_id = $product->getItemSize ( $record ['Size'] );
		$product->size_id = $size_id;
		if (isset ( $record ['Description'] )) {
			$product->description = ( string ) $record ['Description'];
		}
		if (isset ( $record ['Price'] )) {
			$product->price = $record ['Price'];
		}
		$product->create_user_id = $admin->id;
		// $product->quantity = $record ['QtyOnHand'];
		$product->update_time = date ( 'Y-m-d H:i:s' );
		$product->rss_id = $id;
		if ($record ['Picutre'] != null)
			$product->image_file = $imageurl . $record ['Picutre'];
		if ($record ['PicutreThumb'] != null)
			$product->thumbnail_file = $imageurl . $record ['PicutreThumb'];
		
		if ($product->save ()) {
			echo 'Added  : ' . $product->title . '<br/>' . PHP_EOL;
		} else {
			print_r ( $product->getErrors () );
			exit ();
		}
	}
	public static function stdToArray($obj) {
		$reaged = ( array ) $obj;
		foreach ( $reaged as $key => &$field ) {
			if (is_object ( $field ))
				$field = stdToArray ( $field );
		}
		return $reaged;
	}
}
<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property integer $product_id
 * @property string $rating
 * @property integer $create_user_id
 * @property string $create_time
 */
Yii::import('application.models._base.BaseRating');
class Rating extends BaseRating
{
	const Rating = 5;//calculate rating out of
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function updateAvgRate($pid){
		/* $ratingOutOf = self::Rating;
		$prv_rating = Product::model()->findByAttributes(array(
				'id' => $pid
		));
		if(!empty($prv_rating)){
			$rate_prod = $prv_rating->avg_rating;
		}else {
			$rate_prod = 1;
		}
		if($rate_prod == 0){
			$rate_prod = 1;
		}
		$final_rate = (int)$rate_prod;
		$rating = Rating::model()->findByAttributes(array(
				'product_id' => $pid,
		));
		$totalReviews = count($rating);
		if(!empty($prv_rating)){
			$new_rating = ($final_rate * $ratingOutOf) / $totalReviews / $ratingOutOf;
		}
		$prv_rating->saveAttributes(array(
			'avg_rating' => $new_rating
		)); */
		
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'product_id = ' . $pid);
		$getReviews= Rating::model ()->findAll ( $criteria );
		$totalReviews = count ( $getReviews );
		$ratingSum = "";
		$ratingOutOf = 5;
		foreach ( $getReviews as $rating ) {
			$ratingSum = $ratingSum + $rating->rating;
		}
		
		if ($totalReviews !== 0) {
			$avarageRating = ($ratingSum * $ratingOutOf) / $totalReviews / $ratingOutOf;
			// $avarageRating = Round($avarageRating);
		} else {
			$avarageRating = 0;
		}
		
		/* echo "<pre>";
		print_r($avarageRating);
		die(); */
		$pro = Product::model()->findByAttributes(array(
				'id' => $pid
		));
		$pro->saveAttributes(array(
				'avg_rating' => $avarageRating
		));
		// $avarageRating = number_format ( ( float ) $avarageRating, 1, '.', '' );
		
		return $avarageRating;
	} 
	public function toArray($with_relations = false) {
		
		$json_entry = array();
		
				 
		if(isset($this->id)) $json_entry['id'] = $this->id;  
		if(isset($this->product_id)) $json_entry['product_id'] = $this->product_id;  
		if(isset($this->rating)) $json_entry['rating'] = $this->rating;  
		if(isset($this->create_user_id)) $json_entry['create_user_id'] = $this->create_user_id;  
		if(isset($this->create_time)) $json_entry['create_time'] = $this->create_time;         
	   if ($with_relations)     
	   {
  					if(isset($this->createUser)) $json_entry['createUser'] = $this->createUser->toArray(true);
		 					if(isset($this->product)) $json_entry['product'] = $this->product->toArray(true);
				}

        return $json_entry;
	}
	
}
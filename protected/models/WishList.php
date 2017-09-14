<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 *
 * @property integer $id
 * @property integer $model_id
 * @property integer $type_id
 * @property integer $create_user_id
 * @property string $create_time
 */
Yii::import ( 'application.models._base.BaseWishList' );
class WishList extends BaseWishList {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public static function getTotalWishList($user_id) {
		$criteria = new CDbCriteria ();
		// $criteria->compare('model_id', $prod_id);
		$criteria->compare ( 'create_user_id', $user_id );
		return self::model ()->count($criteria);
	}
	public static function getWishList($prod_id, $user_id) {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'model_id', $prod_id );
		$criteria->compare ( 'create_user_id', $user_id );
		$model = self::model ()->find ( $criteria );
		if (! empty ( $model )) {
			return $model;
		}
	}
	public function getwish() {
		switch ($this->type_id) {
			case WishList::TYPE_BLOG :
				{
					return Blog::model ()->findByPk ( $this->model_id );
					break;
				}
			case WishList::TYPE_EMPORIUM :
				{
					return Emporium::model ()->findByPk ( $this->model_id );
					break;
				}
			case WishList::TYPE_DEAL :
				{
					return Deal::model ()->findByPk ( $this->model_id );
					break;
				}
			case WishList::TYPE_STORE :
				{
					return Company::model ()->findByPk ( $this->model_id );
					break;
				}
			case WishList::TYPE_PRODUCT :
				{
					return Product::model ()->findByPk ( $this->model_id );
					break;
				}
		}
	}
	public function checktype() {
		switch ($this->type_id) {
			case 0 :
				{
					return $this->product;
					break;
				}
			case 1 :
				{
					return Emporium::model ()->findByPk ( $this->model_id );
					break;
				}
			case 2 :
				{
					return Deal::model ()->findByPk ( $this->model_id );
					break;
				}
			case 3 :
				{
					return Company::model ()->findByPk ( $this->model_id );
					break;
				}
			case 4 :
				{
					return Blog::model ()->findByPk ( $this->model_id );
					break;
				}
		}
	}
}
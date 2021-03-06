<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * This is the model base class for the table "{{promo_product}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PromoProduct".
 *
 * Columns in table "{{promo_product}}" available as properties of the model,
 * followed by relations of table "{{promo_product}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $promo_id
 * @property integer $state_id
 * @property integer $type_id
 * @property string $create_time
 * @property integer $create_user_id
 *
 * @property Cart $cart
 * @property User $createUser
 * @property PromoCode $promo
 */
abstract class BasePromoProduct extends ActiveRecord {

	
	public static function getStatusOptions($id = null)
	{
		$list = array("Draft","Active","Closed");
		if ($id === null )	return $list;
		if ( is_numeric( $id )) return $list [ $id % count ( $list)];
		return $id;
	}	
	public static function getTypeOptions($id = null)
	{
		$list = array("TYPE1","TYPE2","TYPE3");
		if ($id === null )	return $list;
		if ( is_numeric( $id )) return $list [ $id % count ( $list)];
		return $id;
	}
 	public function beforeValidate()
	{
		if($this->isNewRecord)
		{
			if ( !isset( $this->create_time )) $this->create_time = date( 'Y-m-d H:i:s');
			if ( !isset( $this->create_user_id )) $this->create_user_id = Yii::app()->user->id;			
	}else{
				}
		return parent::beforeValidate();
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{promo_product}}';
	}

	public static function label($n = 1) {
			return Yii::t('app', 'Promo Product|Promo Products', $n);
	}

	public static function representingColumn() {
		return 'create_time';
	}

	public function rules() {
		return array(
			array('cart_id, create_user_id', 'required'),
			array('cart_id, promo_id, state_id, type_id, create_user_id', 'numerical', 'integerOnly'=>true),
			array('create_time', 'safe'),
			array('promo_id, state_id, type_id, create_time', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, cart_id, promo_id, state_id, type_id, create_time, create_user_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'cart' => array(self::BELONGS_TO, 'Cart', 'cart_id'),
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
			'promo' => array(self::BELONGS_TO, 'PromoCode', 'promo_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'cart_id' => null,
			'promo_id' => null,
			'state_id' => Yii::t('app', 'state'),
			'type_id' => Yii::t('app', 'type'),
			'create_time' => Yii::t('app', 'create time'),
			'create_user_id' => null,
			'cart' => null,
			'createUser' => null,
			'promo' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('cart_id', $this->cart_id);
		$criteria->compare('promo_id', $this->promo_id);
		$criteria->compare('state_id', $this->state_id);
		$criteria->compare('type_id', $this->type_id);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('create_user_id', $this->create_user_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
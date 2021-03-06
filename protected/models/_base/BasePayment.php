<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * This is the model base class for the table "{{payment}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Payment".
 *
 * Columns in table "{{payment}}" available as properties of the model,
 * followed by relations of table "{{payment}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $payer_email
 * @property string $rec_email
 * @property string $txn_id
 * @property integer $order_id
 * @property double $amount
 * @property integer $amount_type
 * @property string $content
 * @property integer $type_id
 * @property integer $state_id
 * @property string $create_time
 * @property integer $create_user_id
 *
 * @property User $createUser
 */
abstract class BasePayment extends ActiveRecord {
public $user;
	public static function getTypeOptions($id = null)
	{
		$list = array("TYPE1","TYPE2","TYPE3");
		if ($id == null )	return $list;
		if ( is_numeric( $id )) return $list [ $id ];
		return $id;
	}

	public static function getStatusOptions($id = null)
	{
		$list = array("Draft","Published","Archive");
		if ($id == null )	return $list;
		if ( is_numeric( $id )) return $list [ $id ];
		return $id;
	}
	public function beforeValidate()
	{
		if($this->isNewRecord)
		{
			if ( !isset( $this->create_time )) $this->create_time = new CDbExpression('NOW()');
			if ( !isset( $this->create_user_id)) $this->create_user_id = Yii::app()->user->id;
		}else{
		}
		return parent::beforeValidate();
	}

	public static function model($className=__CLASS__) {

		return parent::model($className);

	}

	public function tableName() {
		return '{{payment}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'payment|payments', $n);
	}

	public static function representingColumn() {
		return 'payer_email';
	}

	public function rules() {
		return array(
		array('order_id,amount, create_user_id', 'required'),
		array('order_id, amount_type, type_id, state_id, create_user_id,shop_id', 'numerical', 'integerOnly'=>true),
		array('amount', 'numerical'),
		array('payer_email, rec_email, txn_id', 'length', 'max'=>128),
		array('notes', 'length', 'max'=>1024),
		array('content, create_time, id,user', 'safe'),
		array('amount_type, content,notes, type_id,payer_email, rec_email, txn_id, state_id, create_time,update_time', 'default', 'setOnEmpty' => true, 'value' => null),
		array('id, payer_email, rec_email, txn_id, order_id, amount, amount_type,shop_id,update_time, content,user, type_id, state_id, create_time, create_user_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
				'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
				'shop' => array(self::BELONGS_TO, 'Company', 'shop_id'),
				'cart' => array(self::BELONGS_TO, 'Cart', 'order_id'),

		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
				'id' => Yii::t('app', 'ID'),
				'payer_email' => Yii::t('app', 'payer email'),
				'rec_email' => Yii::t('app', 'rec email'),
				'txn_id' => Yii::t('app', 'Txn'),
				'order_id' => Yii::t('app', 'order'),
				'amount' => Yii::t('app', 'amount'),
				'amount_type' => Yii::t('app', 'amount type'),
				'content' => Yii::t('app', 'content'),
				'type_id' => Yii::t('app', 'payment type'),
				'state_id' => Yii::t('app', 'status'),
				'create_time' => Yii::t('app', 'create time'),
				'create_user_id' => null,
				'createUser' => null,
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('payer_email', $this->payer_email, true);
		$criteria->compare('rec_email', $this->rec_email, true);
		$criteria->compare('txn_id', $this->txn_id, true);
		$criteria->compare('order_id', $this->order_id);
		$criteria->compare('amount', $this->amount);
		$criteria->compare('amount_type', $this->amount_type);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('type_id', $this->type_id);
		$criteria->compare('state_id', $this->state_id);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('create_user_id', $this->create_user_id);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
		));
	}

	public function searchSell() {
      
		$user = Yii::app()->user->model;
		//$shop_id = $user->company->id;
	//Yii::log(CVarDumper::dumpAsString($_GET),CLogger::LEVEL_WARNING);
	//Yii::log(CVarDumper::dumpAsString($this),CLogger::LEVEL_WARNING);
		$criteria = new CDbCriteria;
		$criteria->alias = 'p';
		//$criteria->addCondition('p.shop_id ='.$shop_id);

		$criteria->addCondition('p.state_id !='. Payment::STATUS_DELETED);
		$criteria->compare('p.id', $this->id);
		$criteria->compare('p.payer_email', $this->payer_email, true);
		$criteria->compare('p.rec_email', $this->rec_email, true);
		$criteria->compare('p.txn_id', $this->txn_id, true);
		$criteria->compare('p.order_id', $this->order_id);
		$criteria->compare('p.amount', $this->amount);
		$criteria->compare('p.amount_type', $this->amount_type);
		$criteria->compare('p.content', $this->content, true);
		$criteria->compare('p.type_id', $this->type_id);
		$criteria->compare('p.state_id', $this->state_id);
		$criteria->compare('p.create_time', $this->create_time, true);
		$criteria->compare('create_user_id', $this->create_user_id);
		$criteria->join = 'left join tbl_user as u on p.create_user_id = u.id';
		$criteria->addCondition('u.first_name like "%'.$this->user.'%"');

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
		'pagination'=>false,
		));
	}

	public function searchBuy() {

		$criteria = new CDbCriteria;

		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		//$criteria->addCondition('state_id ='.Cart::CART_PAY);
		$criteria->addCondition('state_id !='. Payment::STATUS_DELETED);
		$criteria->compare('id', $this->id);
		$criteria->compare('payer_email', $this->payer_email, true);
		$criteria->compare('rec_email', $this->rec_email, true);
		$criteria->compare('txn_id', $this->txn_id, true);
		$criteria->compare('order_id', $this->order_id);
		$criteria->compare('amount', $this->amount);
		$criteria->compare('amount_type', $this->amount_type);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('type_id', $this->type_id);
		$criteria->compare('state_id', $this->state_id);
		$criteria->compare('create_time', $this->create_time, true);
		//	$criteria->compare('create_user_id', $this->create_user_id);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
				'pagination'=>false,

		));
	}
}
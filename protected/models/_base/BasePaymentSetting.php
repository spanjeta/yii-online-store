<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * This is the model base class for the table "{{payment_setting}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PaymentSetting".
 *
 * Columns in table "{{payment_setting}}" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $email
 * @property integer $mode
 * @property integer $type_id
 * @property integer $state_id
 * @property string $create_time
 *
 */
abstract class BasePaymentSetting extends ActiveRecord {
	const MODE_LIVE = 0;
	const MODE_TEST = 1;
	const TYPE_LIVE = 0;
	const TYPE_TEST = 0;
	const STATE_ACTIVE = 0;
	const STATE_INACTIVE = 1;
	public static function getModeOptions($id = null) {
		$list = array (
				"Live",
				"Test"
		);
		if ($id === null)
			return $list;
			if (is_numeric ( $id ))
				return $list [$id % count ( $list )];
				return $id;
	}
	public static function getTypeOptions($id = null) {
		$list = array (
				"Live",
				"Test"
				
		);
		if ($id === null)
			return $list;
		if (is_numeric ( $id ))
			return $list [$id % count ( $list )];
		return $id;
	}
	public static function getStatusOptions($id = null) {
		$list = array (
				"Active",
				"InActive"
		);
		if ($id === null)
			return $list;
		if (is_numeric ( $id ))
			return $list [$id % count ( $list )];
		return $id;
	}
	public function beforeValidate() {
		if ($this->isNewRecord) {
			if (! isset ( $this->create_time ))
				$this->create_time = date ( 'Y-m-d H:i:s' );
		} else {
		}
		return parent::beforeValidate ();
	}
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return '{{payment_setting}}';
	}
	public static function label($n = 1) {
		return Yii::t ( 'app', 'Payment Setting|Payment Settings', $n );
	}
	public static function representingColumn() {
		return 'email';
	}
	public function rules() {
		return array (
				array (
						'email,  type_id, state_id, create_time',
						'required' 
				),
				array (
						'email',
						'email'
				),
				array (
						'mode, type_id, state_id',
						'numerical',
						'integerOnly' => true 
				),
				array (
						'email',
						'length',
						'max' => 255 
				),
				array (
						'id, email, mode, type_id, state_id, create_time',
						'safe',
						'on' => 'search' 
				) 
		);
	}
	public function relations() {
		return array ();
	}
	public function pivotModels() {
		return array ();
	}
	public function attributeLabels() {
		return array (
				'id' => Yii::t ( 'app', 'ID' ),
				'email' => Yii::t ( 'app', 'Email' ),
				'mode' => Yii::t ( 'app', 'Mode' ),
				'type_id' => Yii::t ( 'app', 'Type' ),
				'state_id' => Yii::t ( 'app', 'State' ),
				'create_time' => Yii::t ( 'app', 'Create Time' ) 
		);
	}
	public function search() {
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'email', $this->email, true );
		$criteria->compare ( 'mode', $this->mode );
		$criteria->compare ( 'type_id', $this->type_id );
		$criteria->compare ( 'state_id', $this->state_id );
		$criteria->compare ( 'create_time', $this->create_time, true );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
}
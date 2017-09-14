<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * This is the model base class for the table "{{email_template}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EmailTemplate".
 *
 * Columns in table "{{email_template}}" available as properties of the model,
 * followed by relations of table "{{email_template}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $title
 * @property string $key
 * @property string $text
 * @property integer $create_user_id
 * @property string $create_time
 *
 * @property User $createUser
 */
abstract class BaseEmailTemplate extends ActiveRecord {

	public function beforeValidate()
	{
		if($this->isNewRecord)
		{
			if ( !isset( $this->create_user_id )) $this->create_user_id = Yii::app()->user->id;			
		if ( !isset( $this->create_time )) $this->create_time = date( 'Y-m-d H:i:s');
		}else{
				}
		return parent::beforeValidate();
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{email_template}}';
	}

	public static function label($n = 1) {
			return Yii::t('app', 'Email Template|Email Templates', $n);
	}

	public static function representingColumn() {
		return 'title';
	}

	public function rules() {
		return array(
			array('title, key, text, create_user_id, create_time', 'required'),
			array('create_user_id', 'numerical', 'integerOnly'=>true),
			array('title, key, text', 'length', 'max'=>255),
			array('id, title, key, text, create_user_id, create_time', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'title'),
			'key' => Yii::t('app', 'key'),
			'text' => Yii::t('app', 'text'),
			'create_user_id' => null,
			'create_time' => Yii::t('app', 'create time'),
			'createUser' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('key', $this->key, true);
		$criteria->compare('text', $this->text, true);
		$criteria->compare('create_user_id', $this->create_user_id);
		$criteria->compare('create_time', $this->create_time, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
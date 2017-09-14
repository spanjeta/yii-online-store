<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * This is the model base class for the table "{{company}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Company".
 *
 * Columns in table "{{company}}" available as properties of the model,
 * followed by relations of table "{{company}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $user_name
 * @property string $shop_name
 * @property string $shop_type
 * @property string $shop_slogan
 * @property string $about_shop
 * @property string $admin_first_name
 * @property string $last_name
 * @property string $admin_company_position
 * @property string $email_contact
 * @property string $web_address
 * @property string $facebook
 * @property string $twitter
 * @property string $instagram
 * @property string $image_file
 * @property string $terms
 * @property string $delivery_info
 * @property string $fax
 * @property string $abn
 * @property string $acn
 * @property string $contact_no
 * @property integer $type_id
 * @property integer $state_id
 * @property string $create_time
 * @property string $update_time
 * @property integer $create_user_id
 *
 * @property User $createUser
 */
abstract class BaseCompany extends ActiveRecord {

	public static function getTypeOptions($id = null)
	{
		$list = array("TYPE1","TYPE2","TYPE3");
		if ($id == null )	return $list;
		if ( is_numeric( $id )) return $list [ $id % count($list) ];
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
			if ( !isset( $this->create_user_id )) $this->create_user_id = Yii::app()->user->id;
			if ( !isset( $this->type_id )) $this->type_id = 1;
		}else{
		}
		return parent::beforeValidate();
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{company}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Company|Companies', $n);
	}

	public static function representingColumn() {
		return 'user_name';
	}

	public function rules() {
		return array(
		array('create_user_id,user_name,shop_name,shop_type,admin_first_name,abn,last_name,admin_company_position,company_name', 'required'),
		array('shop_code', 'length','min'=>5 ,'max'=>5),
		array('shop_code', 'unique'),

		array('shop_code,about_shop,terms,shop_slogan,delivery_info', 'required','on'=>'step3'),

		//	array('facebook, twitter', 'url'),

		array('type_id, state_id,shop_type,create_user_id,is_featured', 'numerical', 'integerOnly'=>true),
		array('user_name, shop_name, shop_slogan,company_name, admin_first_name, last_name, admin_company_position,
						email_contact, web_address, fax, abn, acn', 'length', 'max'=>256),
		array('email_contact','email'),
		array('email_contact','unique'),
		array('facebook, twitter, instagram, image_file,logo_file', 'length', 'max'=>1024),
		array('contact_no', 'length', 'min'=>10, 'max'=>16),
		array('about_shop, terms, delivery_info, create_time, update_time', 'safe'),
		array('user_name, shop_name, shop_type,shop_code, shop_slogan,logo_file, about_shop,
				 admin_first_name, last_name, admin_company_position, email_contact, web_address, facebook, twitter,
				  instagram, image_file, terms, delivery_info, fax, abn, acn, contact_no, type_id, state_id, create_time, update_time',
				 'default', 'setOnEmpty' => true, 'value' => null),
		array('id, user_name, shop_name, shop_type,is_featured, shop_slogan, about_shop, admin_first_name, last_name, admin_company_position, email_contact, web_address, facebook, twitter, instagram, image_file, terms, delivery_info, fax, abn, acn, contact_no, type_id, state_id, create_time, update_time, create_user_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
				'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
				'products' => array(self::HAS_MANY, 'Product', 'store_id'),
				'prodcounts' => array(self::STAT, 'Product', 'store_id'),
				'sliderimages' => array(self::HAS_MANY, 'SliderImage', 'store_id'),
				'emporiums' => array(self::HAS_MANY, 'Emporium', 'store_id'),
				'deals' => array(self::HAS_MANY, 'Deal', 'store_id'),
				'offers' => array(self::HAS_MANY, 'Offer', 'store_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
				'id' => Yii::t('app', 'ID'),
				'user_name' => Yii::t('app', 'User Name'),
				'company_name' => Yii::t('app', 'Company Name'),
				'shop_name' => Yii::t('app', 'Shop Name'),
				'shop_type' => Yii::t('app', 'Shop Type'),
				'shop_slogan' => Yii::t('app', 'Shop Slogan'),
				'about_shop' => Yii::t('app', 'About Shop'),
				'admin_first_name' => Yii::t('app', 'Admin First Name'),
				'last_name' => Yii::t('app', 'Last Name'),
				'admin_company_position' => Yii::t('app', 'Admin Company Position'),
				'email_contact' => Yii::t('app', 'Email Contact'),
				'web_address' => Yii::t('app', 'Web Address'),
				'facebook' => Yii::t('app', 'Facebook'),
				'twitter' => Yii::t('app', 'Twitter'),
				'instagram' => Yii::t('app', 'Instagram'),
				'image_file' => Yii::t('app', 'Shop Photo'),
				'logo_file' => Yii::t('app', 'Company Logo'),
				'terms' => Yii::t('app', 'Terms'),
				'delivery_info' => Yii::t('app', 'Delivery Info'),
				'fax' => Yii::t('app', 'Fax'),
				'abn' => Yii::t('app', 'Abn'),
				'acn' => Yii::t('app', 'Acn'),
				'contact_no' => Yii::t('app', 'Contact No'),
				'type_id' => Yii::t('app', 'Type'),
				'state_id' => Yii::t('app', 'Status'),
				'create_time' => Yii::t('app', 'Create Time'),
				'update_time' => Yii::t('app', 'Update Time'),
				'create_user_id' => null,
				'createUser' => null,

				'account_no' => Yii::t('app', 'Account No'),
				'total_fee' => Yii::t('app', 'Total fees ($) '),
				'current_week' => Yii::t('app', 'Current Week ($)'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_name', $this->user_name, true);
		$criteria->compare('company_name', $this->company_name, true);
		$criteria->compare('shop_name', $this->shop_name, true);
		$criteria->compare('shop_type', $this->shop_type, true);
		$criteria->compare('shop_slogan', $this->shop_slogan, true);
		$criteria->compare('about_shop', $this->about_shop, true);
		$criteria->compare('admin_first_name', $this->admin_first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('admin_company_position', $this->admin_company_position, true);
		$criteria->compare('email_contact', $this->email_contact, true);
		$criteria->compare('web_address', $this->web_address, true);
		$criteria->compare('facebook', $this->facebook, true);
		$criteria->compare('twitter', $this->twitter, true);
		$criteria->compare('instagram', $this->instagram, true);
		$criteria->compare('image_file', $this->image_file, true);
		$criteria->compare('terms', $this->terms, true);
		$criteria->compare('delivery_info', $this->delivery_info, true);
		$criteria->compare('fax', $this->fax, true);
		$criteria->compare('abn', $this->abn, true);
		$criteria->compare('acn', $this->acn, true);
		$criteria->compare('contact_no', $this->contact_no, true);
		$criteria->compare('type_id', $this->type_id);
		$criteria->compare('state_id', $this->state_id);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('update_time', $this->update_time, true);
		$criteria->compare('create_user_id', $this->create_user_id);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
		));
	}
}
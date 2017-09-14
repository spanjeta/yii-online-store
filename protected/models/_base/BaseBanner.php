<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * This is the model base class for the table "{{banner}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Banner".
 *
 * Columns in table "{{banner}}" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $image_file
 * @property string $content
 * @property string $url
 * @property integer $type_id
 * @property integer $state_id
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $createUser
 *
 */
abstract class BaseBanner extends ActiveRecord {
	public static function getTypeOptions($id = null) {
		$list = array (
				"TYPE1",
				"TYPE2",
				"TYPE3" 
		);
		if ($id === null)
			return $list;
		if (is_numeric ( $id ))
			return $list [$id % count ( $list )];
		return $id;
	}
	public static function getStatusOptions($id = null) {
		$list = array (
				"Draft",
				"Active",
				"Closed" 
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
			if (! isset ( $this->create_user_id ))
				$this->create_user_id = Yii::app ()->user->id;
		} else {
			if (! isset ( $this->update_time ))
				$this->update_time = date ( 'Y-m-d H:i:s' );
		}
		return parent::beforeValidate ();
	}
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public function tableName() {
		return '{{banner}}';
	}
	public static function label($n = 1) {
		return Yii::t ( 'app', 'Banner|Banners', $n );
	}
	public static function representingColumn() {
		return 'image_file';
	}
	public function rules() {
		return array (
				array (
						
						' url,image_file',
						
						'required',
						//'on' => 'add' 
				),
				[ 
						[ 
								'url' 
						],
						'match',
						'pattern' => '/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}' . '((:[0-9]{1,5})?\\/.*)?$/i',
						'message' => 'Wrong url Pattern' 
				],
				array (
						'type_id, state_id, create_user_id, createUser',
						'numerical',
						'integerOnly' => true 
				),
				
				array (
						'image_file, content',
						'length',
						'max' => 512 
				),
				array (
						'url',
						'length',
						'max' => 255 
				),
				array (
						'id, image_file, content, url, type_id, state_id, create_time, create_user_id, update_time, createUser',
						'safe',
						'on' => 'search' 
				) ,
				/* array(
						'image_file',
						//'minWidth' => 250, 'maxWidth' => 250,'minHeight' => 250, 'maxHeight' => 250,
					'dimensionValidation',
						
				) */
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
				'content' => Yii::t ( 'app', 'content' ),
				'url' => Yii::t ( 'app', 'url' ),
				'image_file' => Yii::t ( 'app', 'image file' ),
				'type_id' => Yii::t ( 'app', 'type' ),
				'state_id' => Yii::t ( 'app', 'state' ),
				'create_time' => Yii::t ( 'app', 'create time' ),
				'create_user_id' => Yii::t ( 'app', 'create user' ),
				'update_time' => Yii::t ( 'app', 'update time' ),
				'createUser' => Yii::t ( 'app', 'create user' ) 
		);
	}
	public function search() {
		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'image_file', $this->image_file, true );
		$criteria->compare ( 'content', $this->content, true );
		$criteria->compare ( 'url', $this->url, true );
		$criteria->compare ( 'type_id', $this->type_id );
		$criteria->compare ( 'state_id', $this->state_id );
		$criteria->compare ( 'create_time', $this->create_time, true );
		$criteria->compare ( 'create_user_id', $this->create_user_id );
		$criteria->compare ( 'update_time', $this->update_time, true );
		$criteria->compare ( 'createUser', $this->createUser );
		
		return new CActiveDataProvider ( $this, array (
				'criteria' => $criteria 
		) );
	}
	public function dimensionValidation($attribute,$param){
		
		if($this->image_file){
			$temp = $this->image_file;
			list($width, $height) = getimagesize();
			
			if($width!=150 || $height!=150)
				$this->addError('photo','Photo size should be 150*150 dimension');
		}
	}
}
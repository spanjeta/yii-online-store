<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
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
 */
Yii::import('application.models._base.BaseCompany');
class Company extends BaseCompany
{
	public $sliders;
	public $product_count;

	public $account_no;
	public $total_fee;
	public $current_week;
	public $date_join;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function toArray($wish_id = null)
	{
		$com = $this;
		$json_entry = array();
		if($wish_id)
		$json_entry["data_id"] = $wish_id;

		$json_entry["id"] = $com->id;
		$json_entry["shop_name"] = $com->shop_name;
		$json_entry["shop_slogan"] = $com->shop_slogan;
		$json_entry['logo_file'] = isset($com->logo_file) && !empty($com->logo_file)?
		Yii::app()->createAbsoluteUrl('company/thumb',array('file'=>$com->logo_file,'id'=>$com->create_user_id))
		: 	Yii::app()->createAbsoluteUrl('company/download',array('file'=>'shop_logo.png'));
		$json_entry['image_file'] = isset($com->image_file) && !empty($com->image_file) ? Yii::app()->createAbsoluteUrl('company/thumb',array('file'=>$com->image_file,'id'=>$com->create_user_id))
		: 	Yii::app()->createAbsoluteUrl('company/download',array('file'=>'shop.png'));
		$json_entry["email_contact"] = isset($com->email_contact) ? $com->email_contact : '' ;
		$json_entry['web_address'] = $com->web_address;
		$json_entry['facebook'] = $com->facebook;
		$json_entry['twitter'] = $com->twitter;
		$json_entry['instagram'] = $com->instagram;
		$json_entry['contact_us'] = $com->contact_no;
		$json_entry['delivery_info'] = $com->delivery_info;
		$json_entry['terms'] = $com->terms;
		$json_entry['about_us'] = $com->about_shop;
		$json_entry["data_type"] = WishList::TYPE_STORE;
		if(!Yii::app()->user->isGuest)
		{
			$json_entry['is_fav'] = $com->myfav(WishList::TYPE_STORE);
		}
		else $json_entry['is_fav'] = 0;

		return $json_entry;
	}

	public function toArrayhome()
	{
		$shop = $this;
		$json_entry = array();
		$json_entry["id"] = $shop->id;
		$json_entry["shop_name"] = $shop->shop_name;
		$json_entry["shop_logo"] = Yii::app()->createAbsoluteUrl('company/download',array('file'=>'shop_logo.jpg'));
		$json_entry['shop_slogan'] = $shop->shop_slogan;
		$json_entry['image_file'] = Yii::app()->createAbsoluteUrl('product/download',array('file'=>'shop_image.jpg'));
		//	$json_entry['login_state'] = $product;
		//	$json_entry['active_state'] = $product->state_id;
		//	$json_entry['role_id'] = $product->role_id;
		return $json_entry;
	}
	public function getnametoraay()
	{
		$shop = $this;
		$json_entry["id"] = $shop->id;
		$json_entry['shop_slogan'] = $shop->shop_slogan;
		$json_entry['shop_name'] = $shop->shop_name;

		return $json_entry;
	}

	public function getLogo()
	{
		if(isset($this->logo_file) && !empty($this->logo_file))
		{
			return Yii::app()->createAbsoluteUrl('company/thumb',array('file'=>$this->logo_file,'id'=>$this->create_user_id));
		}
		return Yii::app()->createAbsoluteUrl('company/download',array('file'=>'shop_logo.png'));
	}

	public function getImage()
	{
		if(isset($this->image_file) && !empty($this->image_file))
		{
			return Yii::app()->createAbsoluteUrl('company/thumb',array('file'=>$this->image_file,'id'=>$this->create_user_id));
		}
		return Yii::app()->createAbsoluteUrl('company/download',array('file'=>'shop.png'));
	}


	
	public function deleteImage()
	{
		$imagefile = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER.$this->image_file;
		$logofile = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER.$this->logo_file;
		if(file_exists($imagefile) && $this->image_file)
		{
			unlink($imagefile);
		}
		if(file_exists($logofile) && $this->logo_file)
		{
			unlink($logofile);
		}
	}



	protected function beforeDelete()
	{
		Home::model()->deleteAllByAttributes(array ('model_id'=>$this->id,'type_id'=>Home::TYPE_STORE));
		SiteHome::model()->deleteAllByAttributes(array ('model_id'=>$this->id,'type_id'=>Home::SEARCH_STORE));
		// slider section with image deletion
		$sliders = $this->sliderimages;
		if($sliders)
		{
			foreach ($sliders as  $slider)
			{
				$imagefile = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER.$slider->slider_image;
				if(file_exists($imagefile))
				{
					unlink($imagefile);
				}
				$slider->delete();
			}
		}

		// product section
		$products = $this->products;
		if($products)
		{
			foreach ($products as  $product)
			{
				$product->delete();
			}
		}

		// emporiums
		$emporiums = $this->emporiums;
		if($emporiums)
		{
			foreach ($emporiums as  $emporium)
			{
				$imagefile = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER.$emporium->image_file;
				if(file_exists($imagefile))
				{
					unlink($imagefile);
				}
				$emporium->delete();
			}
		}

		// deals

		$deals = $this->deals;
		if($deals)
		{
			foreach ($deals as  $deal)
			{
				$deal->delete();
			}
		}


		// offers
		$offers = $this->offers;
		if($offers)
		{
			foreach ($offers as  $offer)
			{
				$offer->delete();
			}
		}

		return parent::beforeDelete();
	}

	public function showlabel()
	{
		$create_time = $this->create_time;
		$aftertime = date('Y-m-d H:i:s',strtotime("-15 days",time()));
		/* 	echo $aftertime;
			echo $create_time; */
		if($create_time > $aftertime )  return true;
		return false;

		//$aftertime = date("Y-m-d H:i:s",strtotime("-1 minutes",time()));
		if($create_time > $aftertime)
		{
			return true;
		}
	}
	/**
	 * this function is used on store home page in contact us detail to show send message button
	 * Enter description here ...
	 */
	public function showChat() {

		if($this->create_user_id == Yii::app()->user->id)
		return false;
		return true;
	}
	/**
	 * This function is used to chek on store home page for product category
	 * Enter description here ...
	 * @param unknown_type $cat_id
	 */
	public function getProductByCat($cat_id) {

		$criteria = new CDbCriteria;
		$criteria->addCondition('category_id ='.$cat_id);
		$criteria->addCondition('create_user_id ='.$this->create_user_id);
		$products = Product::model()->findAll($criteria);
		$ids = array();
		if($products){
			foreach($products as $product){
				$ids[] =  $product->id;
			}
		}
		return $ids;
	}
}
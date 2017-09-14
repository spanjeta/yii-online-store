<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $password
 * @property integer $gender
 * @property string $about_me
 * @property string $image_file
 * @property integer $tos
 * @property integer $role_id
 * @property integer $state_id
 * @property integer $type_id
 * @property string $last_visit_time
 * @property string $last_action_time
 * @property string $last_password_change
 * @property string $activation_key
 * @property integer $login_error_count
 * @property string $create_time
 */
Yii::import('application.models._base.BaseUser');
include ("pbkdf.php");
class User extends BaseUser
{
	public $ph_no;
	public $report;
	public $date_created;
	public $reported_by;
	public $page;
	public $interface;
	public $os;
	public $browser;
	public $device;
	public $urgency;
	public $favourites;
	public $uab;
	public $uac;

	// variable used in admin panel

	


	public static function test()
	{
		echo 'test'; exit;
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


	public static function searchByName($keyword, $limit = 20)
	{
		$list = array();
		$chars = str_split($keyword);
		{
			$criteria = new CDbCriteria;
			$criteria->addSearchCondition('username', $keyword, true);
			$criteria->addSearchCondition('first_name', $keyword, true);
			$criteria->scopes = 'active';
			$criteria->order = 'username';
			$criteria->limit = $limit;
			$list = self::model()->findAll($criteria);
		}
		return $list;
	}
	public static function findByEmail($name)
	{
		$user = User::model()->findByAttributes(array ( 'email'=>$name));
		return $user;
	}

      
	
	public static function getUserById($id)
	{
		$user = User::model()->active()->findByAttributes(array ( 'id'=>$id));
		return $user;
	}
	public function sendActivationEmail()
	{
		Yii::import('ext-prod.yii-mail.YiiMailMessage');
		$message = new YiiMailMessage;
		$message->view = 'register';
		$message->setSubject('Activate Your Account for: ' . Yii::app()->params['company']);
		//userModel is passed to the view
		$message->setBody(array('model'=>$this), 'text/html');
		$message->addTo($this->email);
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
	}
	public static function sendEmails($to, $from, $subject, $view, $data) {
		
		Yii::import ( 'ext-prod.yii-mail.YiiMailMessage' );
		$message = new YiiMailMessage ();
		$message->view = $view;
		$message->setBody ( $data, 'text/html' );
		$message->setSubject ($subject);
		$message->addFrom ( $from );
		$message->addTo ( $to );
		
		try {
			Yii::app ()->mail->send ( $message );
		} catch ( Exception $e ) {
			echo $e->getMessage ();
			return false;
		}
		
		return true;
		/* Yii::import ( 'ext-prod.yii-mail.YiiMailMessage' );
		$message = new YiiMailMessage ();
		$message->view = $view;
		$message->setSubject($subject);
		$message->setBody ( $data, 'text/html' );
		$message->addTo($mail);
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message); */
	}
	public function recover()
	{
		Yii::import('ext-prod.yii-mail.YiiMailMessage');
		$message = new YiiMailMessage;
		$message->view = 'recover_account';
		$message->setSubject('Password Recovery for: ' . Yii::app()->params['company']);
		//userModel is passed to the view
		$message->setBody(array('model'=>$this), 'text/html');
		//echo $message->body;
		//Yii::app()->end();
		$message->addTo($this->email);
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
	}

	
	public function sendMailToCustomer($sub, $view ,$body, $mail)
	{
		
		Yii::import('ext-prod.yii-mail.YiiMailMessage');
		$message = new YiiMailMessage;
		$message->view = $view;
		$message->setSubject($sub);
		//userModel is passed to the view
		$message->setBody(array('model'=>$this,'body'=>$body), 'text/html');
		
		//echo $message->body;
		
		$message->addTo($mail);
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
		
		
	}
	
	
	public function sendPassword()
	{
		$password = self::randomPassword();
		$this->setPassword($password, $password);

		$body 	 = 'Email ID: ' . $this->email . "<br>\r\n";
		$body 	.= 'Password: ' . $password . "\r\n";

		Yii::import('ext-prod.yii-mail.YiiMailMessage');
		$message = new YiiMailMessage;
		$message->view = 'send_password';
		$message->setSubject('Your new Password for: ' . Yii::app()->params['company']);
		//userModel is passed to the view
		$message->setBody(array('model'=>$this,'body'=>$body), 'text/html');

		//echo $message->body;

		$message->addTo($this->email);
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
	}
	public function getRecoverUrl() {
		$key = $this->generateActivationKey ();
		return Yii::app ()->createAbsoluteUrl ( 'user/setPassword', array (
				'id' => $this->id,
				'key' => $key
		) );
	}
	public static function randomPassword($count = 8, $onlyNum = false) {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		//$alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
		if ($onlyNum)
		{
			$alphabet = "0123456789";
		}
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < $count; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);; //turn the array into a string
	}
	public function generateActivationKey($activate = false)
	{
		$this->activation_key = $activate? User::encrypt(microtime()): User::encrypt(microtime() . $this->password);
		$this->saveAttributes(array('activation_key'));
		return $this->activation_key;
	}
	public function getActivationUrl($mode = 'login')
	{
		$this->generateActivationKey();
		return Yii::app()->createAbsoluteUrl('user/activate', array ( 'id' => $this->id, 'key' => $this->activation_key, 'mode'=>$mode));
	}
	public function getUnsubscribe()
	{
		return Yii::app()->createAbsoluteUrl('user/unsubscribe', array ( 'id' => $this->id));
	}
	public function activate($email, $key)
	{
		if ($this->email == $email)
		{
			if ($this->state_id != self::STATUS_INACTIVE)
			return -1;
			if ($this->activation_key == $key)
			{
				$this->state_id = self::STATUS_ACTIVE;
				$this->activation_key = null;
				if ($this->saveAttributes(array( 'state_id','activation_key')))
				{
					return 1;
				}
			} else return -2;
		}
		return false;
	}
	public function getIsAdmin()
	{
		if($this->role_id == 1) return true;
		return false;
	}

	public function getIsBuser()
	{
		if($this->role_id == 2 || $this->getIsAdmin())
		return true;
		return false;
	}

	public function getIsUser()
	{
		if($this->role_id == 3 || $this->getIsAdmin())
		return true;
		return false;
	}

	public static function isSelf($model)
	{
		if($model->id == Yii::app()->user->id) return true;
		return false;
	}
	public function setPassword($password,$password_2 = null)
	{
		if($password_2 != null){
		if ($password != '' && $password == $password_2 ) {
			$this->password = User::encrypt2($password);
			return $this->save(false,'password');
		}
		}
		else {
			
			$this->password = User::encrypt2($password);
			return $this->save ( false, 'password' );
		}
		return false;
	}

	public static function encrypt($string = "")
	{
		$salt = self::$salt1;
		$hashFunc = self::$hashFunc;
		$string = sprintf("%s%s%s", $salt, $string, $salt);

		if (!function_exists($hashFunc))
		throw new CException('Function `' . $hashFunc . '` is not a valid callback for hashing algorithm.');

		return $hashFunc($string);
	}

	public static function encrypt2($string = "")
	{

		$out = create_hash($string);
		return $out;
	}

	public static function isLoggedIn( $id)
	{
		if ( Yii::app()->user->isAdmin() || $id == Yii::app()->user->id )
		return true;
		return false;
	}
	public function getTotalProducts($id)
	{
		$criteria = new CDbCriteria;
		//$criteria->group = 'create_user_id';
		$ProductsByGroup = Product::model()->count($criteria);
		$dataProvider = new CActiveDataProvider('User',array('criteria'=>$criteria));
		return $dataProvider;
	}

	public static function validate_password($password_under_test, $password_real)
	{

		return validate_password( $password_under_test, $password_real);
	}

	public static function delTree($path)
	{
		$files = glob("$path/*");
		foreach($files as $file) {
			if(is_dir($file) && !is_link($file)) {
				self::delTree($file);
			}
			else {
				unlink($file);
			}
		}

		if($path == Yii::app()->basePath.'/../assets')
		{
			return true;
		}
		else
		{
			rmdir($path);
		}

	}


	public function regauthenticate()
	{
		$identity = new UserIdentity($this->email,'');
		//	$identity->authenticateReg($user);
		$identity->id = $this->id;
		$duration =  3600*24*30 ; // 30 days
		$identity->setState('id', $this->id);
		Yii::app()->user->login($identity,$duration);
		return $this;
	}
	public function logintoArray()
	{
		$user= $this;
		$json_entry = array();
		$json_entry["user_id"] = $user->id;
		$json_entry['username'] = $user->username;
		$json_entry['email'] = $user->email;
		$json_entry['first_name'] = $user->first_name;
		$json_entry['last_name'] = $user->last_name;
		$json_entry['login_state'] = 1;
		$json_entry['active_state'] = $user->state_id;
		$json_entry['role_id'] = $user->role_id;
		if($user->role_id == 3)
		{
			$step2 = $user->first_name;
			if($step2)
			{
				$json_entry['signup_step'] = 'completed';
			}
			else {
				$json_entry['signup_step'] = 'step1 is remaining';
			}
		}

		else if($user->role_id == 2)
		{
			$address = $user->userAddresses;
			$company = $user->company;
			if($address && $company)
			{
				//	echo 'basic user '; exit;
				if($company->shop_slogan == null || empty($company->shop_slogan) || $company->shop_code == null)
				{
					$json_entry['signup_step'] = 'step2 is remaining';
				}

				else{
					$json_entry['signup_step'] = 'completed';
				}
			}
			else {
				$json_entry['signup_step'] = 'step1 is remaining';
			}

		}

		return $json_entry;
	}


	public function profileArray()
	{
		$user= $this;
		$json_entry = array();
		$json_entry['id'] = $user->id;
		$json_entry['username'] = $user->username;
		$json_entry['email'] = $user->email;
		$json_entry['first_name'] = $user->first_name;
		$json_entry['last_name'] = $user->last_name;
		$json_entry['middle_name'] = $user->middle_name;
		$json_entry['gender'] = User::getGender($user->gender);
		$json_entry['ph_no'] = $user->ph_no;
		$json_entry['role_id'] = $user->role_id;
		return $json_entry;
	}

	public static function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir")
					{
						self::rrmdir($dir."/".$object);
					}
					else if($object != 'assets')
					{
						if(unlink($dir."/".$object))
						echo '<p style="color:red">Removed File : '.$dir."/".$object.'<br /></p>';
					}
				}
			}
			reset($objects);
			if($dir != Yii::app()->basePath.'/../assets' and $dir != Yii::app()->runtimePath)
			{
				if(rmdir($dir))
				echo '<p style="color:grey">Removed Directory :'.$dir.'<br /></p>';
			}
		}
	}
	public static function getUserState($id = null)
	{
		$list = array(
				'Normal', 'Overdue','Suspend');

		if ($id === null )	return $list;
		return $list [$id%count($list)];
	}

	public static function sellItems() {

		$user = Yii::app()->user->model;
		$shop_id = $user->company->id;
		$criteria = new CDbCriteria;
		$criteria->addCondition('shop_id ='.$shop_id);
		$criteria->addCondition('state_id ='.Cart::CART_PAY);
		$sellOrders = Cart::model()->findAll($criteria);

		return $sellOrders;
	}
	public static function buyItems() {

		$criteria = new CDbCriteria;
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$criteria->addCondition('state_id ='.Cart::CART_PAY);
		$burOrders = Cart::model()->findAll($criteria);

		return $buyOrders;
	}


	protected function beforeDelete()
	{
		//	ProductImage::model()->deleteAllByAttributes(array ('create_user_id'=>$this->id));

		
		ProductImage::model()->deleteAllByAttributes(array('create_user_id'=>$this->id));
		Address::model()->deleteAllByAttributes(array('create_user_id'=>$this->id));
		UserAddress::model()->deleteAllByAttributes(array('create_user_id'=>$this->id));
		Payment::model()->deleteAllByAttributes(array('create_user_id'=>$this->id));
		Order::model()->deleteAllByAttributes(array('create_user_id'=>$this->id));
		OrderItem::model()->deleteAllByAttributes(array('create_user_id'=>$this->id));
		WishList::model()->deleteAllByAttributes(array('create_user_id'=>$this->id));
		Comment::model()->deleteAllByAttributes(array('create_user_id'=>$this->id));
		
		return parent::beforeDelete();
		
	}
	/*
	 * this function is to calculate total blogs,emporiums,deals and products created by business user
	 */

	public function getUserContent($type) {

		$criteria = new CDbCriteria;
		$criteria->addCondition('create_user_id = '.$this->id);

		switch($type)
		{
			case Home::TYPE_BLOG :
				{
					$blog =  Blog::model()->count($criteria);
					if($blog)
					return $blog;
					return 0;
					break;
				}
			case Home::TYPE_PRODUCT :
				{
					$product =  Product::model()->count($criteria);
					if($product)
					return $product;
					return 0;
				}
			case Home::TYPE_EMPORIUM :
				{
					$emp =  Emporium::model()->count($criteria);
					if($emp)
					return $emp;
					return 0;
					break;
				}
			case Home::TYPE_DEAL :
				{
					$deal =  Deal::model()->count($criteria);
					if($deal)
					return $deal;
					return 0;
					break;
				}
			case Home::TYPE_OFFER:
				{

					$offer =  Offer::model()->findByPk($this->model_id);

					if($offer)
					return $offer;
					return false;
					break;
				}

			case Home::TYPE_STORE:
				{
					$com = Company::model()->findByPk($this->model_id);

					if($com)
					return $com;
					return false;
					break;
				}
			default:
				{
					return false;
				}
		}

	}
	/*
	 * this function is to calculate is_feature for business user
	 */
	public function getUserfeatured()
	{

		$company = $this->company;
	if($company == null){
			return '';
		}
			$company_id = $company->id;
			$criteria = new CDbCriteria;
			$criteria->addCondition('store_id = '.$company_id);
			$criteria->addCondition('is_feature = 1');
			$features = Home::model()->count($criteria);
			return $features;
		
	}

	/*
	 * this function is to calculate total revenue for business user
	 */

	public function getUserRevenued()
	{
		$company = $this->company;
		if($company == null){
			return '';
		}
		$company_id = $company->id;
		$criteria = new CDbCriteria;
		$criteria->addCondition('shop_id = '.$company_id);
		$revenues=Payment::model()->findAll($criteria);
		$amount=0;
		foreach($revenues as $revenue)
		{

			$amount+=$revenue->amount;
		}
		return $amount;
	}
	/*
	 * this function is to calculate total sold for business user
	 */
	public function getUserSoldProduct()
	{

		$company = $this->company;
		if($company == null){
			return '';
		}
		$company_id = $company->id;
		$criteria = new CDbCriteria;
		$criteria->addCondition('shop_id = '.$company_id);
		$payments = Payment::model()->findAll($criteria);
		$sellProduct = 0;

		if($payments) {

			foreach($payments as $payment) {

				$cart = $payment->cart;
				if($cart){

					if($cart->itemCounts) {

						//	$amount += $revenue->amount;

						$sellProduct = $sellProduct + $cart->itemCounts;


					}
				}

			}

		}

return $sellProduct;
	}
	/*
	 * this function is to count user favourite from wishlist for basic user
	 */
	public function getUserFavourite()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('create_user_id = '.$this->id);
		$criteria = WishList::model()->count($criteria);
		return $criteria;
	}
	/*
	 * this function is to count order from payment for basic user
	 */
	public function getUserOrders()
	{
		$criteria = new CDbCriteria;
		$criteria->addCondition('create_user_id = '.$this->id);
		$criteria =Payment::model()->count($criteria);
		return $criteria;
	}
	/*
	 * this function is to enter last_visit_time for user
	 */
	public static function updateLastVisitTime()
	{
		$user=Yii::app()->user->model;
		$user->last_visit_time=date('Y-m-d h:i:s');
		$user->saveAttributes(array('last_visit_time'));
	}

	public function getImage()
	{
		$image = $this->image_file;
		if($image)
		{
			return Yii::app()->createUrl('user/download',array('file'=>$image,'id'=>$this->id));
		}
		return Yii::app()->createAbsoluteUrl('user/download',array('file'=>'default_user.png'));
		//	return Yii::app()->createAbsoluteUrl('product/download',array('file'=>'default.png'));
	}
	
}
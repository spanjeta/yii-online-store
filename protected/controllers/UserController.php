<?php
class UserController extends Controller {
	public $loginForm = null;
	public $caseSensitiveUsers = true;
	public $returnAdminUrl = 'admin/index';
	public $returnHomePage = 'homepage';
	// LoginType :
	const LOGIN_BY_USERNAME = 1;
	const LOGIN_BY_EMAIL = 2;
	const LOGIN_BY_LDAP = 32;
	// Allow login only by username by default.
	public $loginType = 2;
	public function filters() {
		return array (
				'accessControl' 
		);
	}
	public function accessRules() {
		return array (
				array (
						'allow',
						'actions' => array (
								
								'basic',
								'thumb',
								'test',
								'ajaxLogin',
								'create',
								'inventory',
								'product',
								'login',
								'logout',
								'activate',
								'recover',
								'setting',
								'billing',
								'monthly',
								'download',
								'thumbnail',
								'error',
								'att',
								'ajaxtitle',
								'forgotpassword',
								'setPassword',
								'oauth',
								'oauthadmin' 
						),
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'order',
								'shipping',
								'address',
								'updateaddress',
								'shipproduct',
								'update',
								
								'view',
								'search',
								'business',
								'shop',
								'report',
								'inbox',
								'dash',
								'credit',
								// 'account',
								'myinfo',
								'editable',
								// 'admin',
								'changepassword',
								'accountb',
								'flush',
								'changeemail',
								'emailnotification',
								'changepass',
								'index'
							// 'account'
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'admin',
								'delete',
								'shipping',
								'address',
								'updateaddress',
								'shipproduct',
								'update',
								
								'view',
								'search',
								'business',
								'shop',
								'report',
								'inbox',
								'dash',
								'credit',
								'account',
								'myinfo',
								'editable',
								// 'admin',
								'changepassword',
								'accountb',
								'flush',
								'changeemail',
								'emailnotification',
								'changepass',
								'account' 
						),
						'expression' => 'Yii::app()->user->isAdmin' 
				),
				array (
						'deny',
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	public function actions() {
		return array (
				'oauth' => array (
						// the list of additional properties of this action is below
						'class' => 'ext-prod.hoauth.HOAuthAction',
						// Yii alias for your user's model, or simply class name, when it already on yii's import path
						// default value of this property is: User
						'model' => 'User',
						// map model attributes to attributes of user's social profile
						// model attribute => profile attribute
						// the list of avaible attributes is below
						'attributes' => array (
								'email' => 'email',
								'full_name' => 'displayName',
								/* 'first_name' => 'first_name',
								'last_name' => 'last_name',
								'ph_no' => 'ph_no', */
								// 'lname' => 'lastName',
								// 'gender' => 'genderShort',
								// 'birthday' => 'birthDate',
								// you can also specify additional values,
								// that will be applied to your model (eg. account activation status)
								/* 'password' => time (),
								'password_2' => time (),
								'state_id' => 1,
								'email_verified' => 1,
								'tos' => 1 */
						)
				),
				// this is an admin action that will help you to configure HybridAuth
				// (you must delete this action, when you'll be ready with configuration, or
				// specify rules for admin role. User shouldn't have access to this action!)
				'oauthadmin' => array (
						'class' => 'ext-prod.hoauth.HOAuthAdminAction'
				)
		);
	}
	/* public function actions() {
		return array (
				'oauth' => array (
						// the list of additional properties of this action is below
						'class' => 'ext-prod.hoauth.HOAuthAction',
						// Yii alias for your user's model, or simply class name, when it already on yii's import path
						// default value of this property is: User
						'model' => 'User',
						// map model attributes to attributes of user's social profile
						// model attribute => profile attribute
						// the list of avaible attributes is below
						'attributes' => array (
								'email' => 'email',
								'full_name' => 'displayName' 
							// 'lname' => 'lastName',
							// 'gender' => 'genderShort',
							// 'birthday' => 'birthDate',
							// you can also specify additional values,
							// that will be applied to your model (eg. account activation status)
							/*
						 * 'password' => time (),
						 * 'password_2' => time (),
						 * 'state_id' => 1,
						 * 'email_verified' => 1,
						 * 'tos' => 1
						
						) 
				),
				// this is an admin action that will help you to configure HybridAuth
				// (you must delete this action, when you'll be ready with configuration, or
				// specify rules for admin role. User shouldn't have access to this action!)
				'oauthadmin' => array (

						'class' => 'ext-prod.hoauth.HOAuthAdminAction' 
				) 
		);
	} */

	public function actionAjaxtitle() {
		if (isset ( $_GET ['q'] ) and ! empty ( $_GET ['q'] )) {
			
			$name = $_GET ['q'];
			$criteria = new CDbCriteria ();
			$criteria->compare ( 'first_name', $name, true, 'OR' );
			$criteria->compare ( 'last_name', $name, true, 'OR' );
			$criteria->addCondition ( 'id != ' . Yii::app ()->user->id );
			$users = User::model ()->findAll ( $criteria );
			$data = array ();
			foreach ( $users as $value ) {
				if ($value->first_name) {
					$data [] = array (
							'id' => $value->id,
							'text' => $value->first_name 
					);
				}
			}
		} else {
			return false;
		}
		echo CJSON::encode ( $data );
		Yii::app ()->end ();
	}
	public function actionAddress() {
		$model = new Address ();
		
		$this->performAjaxValidation ( $model, 'user-address-form' );
		
		if (isset ( $_POST ['Address'] )) {
			$model->setAttributes ( $_POST ['Address'] );
			
			if ($model->save ()) {
				$this->redirect ( array (
						'shipping' 
				) );
			}
		}
		$this->updateMenuItems ( $model );
		$this->render ( 'address', array (
				'model' => $model 
		) );
	}
	public function actionUpdateAddress($id) {
		$model = Address::model ()->findByPK ( $id );
		
		$this->performAjaxValidation ( $model, 'user-address-form' );
		
		if (isset ( $_POST ['Address'] )) {
			$model->setAttributes ( $_POST ['Address'] );
			
			if ($model->save ()) {
				$this->redirect ( array (
						'shipping' 
				) );
			}
		}
		$this->updateMenuItems ( $model );
		$this->render ( 'updateaddress', array (
				'model' => $model 
		) );
	}
	public function actionFlush() {
		$emporiums = Emporium::model ()->findAll ();
		$offers = Offer::model ()->findAll ();
		$deals = Deal::model ()->findAll ();
		$products = Product::model ()->findAll ();
		
		if ($emporiums) {
			foreach ( $emporiums as $emporium ) {
				$emporium->delete ();
			}
			foreach ( $offers as $offer ) {
				$offer->delete ();
			}
			foreach ( $deals as $deal ) {
				$deal->delete ();
			}
			foreach ( $products as $product ) {
				$product->delete ();
			}
		}
	}
	
	/*
	 * public function init() {
	 * parent::init();
	 * Yii::app()->errorHandler->errorAction='user/error';
	 * }
	 * public function actionError(){
	 *
	 * $error=Yii::app()->errorHandler->error;
	 * $this->render('error');
	 * }
	 */
	public function actionEditable() {
		$id = Yii::app ()->user->id;
		
		$user = User::model ()->findByPk ( $id );
		if ($_POST ['name'] == 'username') {
			$user->username = $_POST ['value'];
			$user->saveAttributes ( array (
					'username' 
			) );
			echo 'save user name';
			exit ();
		} else if ($_POST ['name'] == 'email') {
			$user->email = $_POST ['value'];
			$user->saveAttributes ( array (
					'email' 
			) );
			echo 'email save';
			exit ();
		} else if ($_POST ['name'] == 'first_name') {
			$user->first_name = $_POST ['value'];
			$user->saveAttributes ( array (
					'first_name' 
			) );
			echo 'first_name save';
			exit ();
		} else if ($_POST ['name'] == 'middle_name') {
			$user->middle_name = $_POST ['value'];
			$user->saveAttributes ( array (
					'middle_name' 
			) );
			echo 'middle_name save';
			exit ();
		} else if ($_POST ['name'] == 'last_name') {
			$user->last_name = $_POST ['value'];
			$user->saveAttributes ( array (
					'last_name' 
			) );
			echo 'last_name save';
			exit ();
		} else if ($_POST ['name'] == 'offer_and_deals') {
			$user->offer_and_deals = $_POST ['value'];
			print_r ( $user );
			exit ();
			$user->saveAttributes ( array (
					'offer_and_deals' 
			) );
			
			echo 'offer_and_deals save';
			exit ();
		} else if ($_POST ['name'] == 'ph_no') {
			$user->ph_no = $_POST ['value'];
			if ($user->save ( array (
					'ph_no' 
			) )) {
				echo 'success';
			} else {
				echo '<script> alert not save </script>';
			}
			
			exit ();
		}
	}
	public function actionShipping() {
		$model = new Address ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Address'] ))
			$model->setAttributes ( $_GET ['Address'] );
		
		$this->render ( 'shipping', array (
				'model' => $model 
		) );
	}
	public function actionShipProduct() {
		$model = new Address ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Address'] ))
			$model->setAttributes ( $_GET ['Address'] );
		
		$this->render ( 'shipproduct', array (
				'model' => $model 
		) );
	}
	public function actionAccount($id = null) {
		if ($id == null)
			$id = Yii::app ()->user->id;
		
		$model = $this->loadModel ( $id, 'User' );
		$this->updateMenuItems ( $model );
		/*
		 * if (! ($this->isAllowed ( $model )))
		 * throw new CHttpException ( 403, Yii::t ( 'app', 'You are not allowed to access this page.' ) );
		 */
		
		$this->render ( 'account', array (
				'model' => $model 
		) );
	}
	public function actionAccountb($id = null) {
		if ($id == null)
			$id = Yii::app ()->user->id;
		
		$model = $this->loadModel ( $id, 'User' );
		$this->updateMenuItems ( $model );
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		$this->render ( 'accountb', array (
				'model' => $model 
		) );
	}
	public function actionChangeEmail($id = null) {
		if ($id == null)
			$id = Yii::app ()->user->id;
		
		$model = $this->loadModel ( $id, 'User' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		$this->render ( 'changeemail', array (
				'model' => $model 
		) );
	}
	public function actionInbox() {
		$this->renderPartial ( 'product', array (), false, true );
	}
	public function isAllowed($model) {
		return $model->isAllowed ();
	} 
	public function actionMonthly() {
		$this->render ( 'monthly' );
	}
	public function actionForgotPassword() {
		$this->render ( 'credit' );
	}
	public function actionBilling() {
		$paypal = Yii::app ()->user->model->Paypal;
		$paymentMethod = Yii::app ()->user->model->paymentSetting;
		
		if (! $paymentMethod)
			$paymentMethod = new PaymentSetting ();
		$this->render ( 'billing', array (
				'paypal' => $paypal,
				'paymentMethod' => $paymentMethod 
		) );
	}
	public function actionSetting() {
		$this->render ( 'setting' );
	}
	public function actionView($id = null) {
		if ($id == null)
			$id = Yii::app ()->user->id;
		$model = $this->loadModel ( $id, 'User' );
		if (Yii::app ()->user->isAdmin) {
			
			$this->redirect ( array (
					'user/account',
					'id' => $id 
			) );
		} else
			$this->redirect ( array (
					'user/accountb' 
			) );
	}
	public function actionEmailNotification() {
		$id = Yii::app ()->user->id;
		
		$user = User::model ()->findByPk ( $id );
		$model = $this->loadModel ( $id, 'User' );
		
		if (isset ( $_POST ['User'] )) {
			
			$model->offer_and_deals = $_POST ['User'] ['offer_and_deals'];
			
			$model->promotional_mails = $_POST ['User'] ['promotional_mails'];
			$model->latest_update = $_POST ['User'] ['latest_update'];
			if ($model->save ()) {
				$this->redirect ( array (
						'user/changeemail' 
				) );
			} else {
				echo "not success";
			}
		}
	}
	public function actionCreate() {
		$model = new User ( 'create' );
		$this->performAjaxValidation ( $model, 'user-form' );
		if (isset ( $_POST ['User'] )) {
			$model->setAttributes ( $_POST ['User'] );
			$model->state_id = User::STATUS_ACTIVE;
			if ($model->save ()) {
				if (isset ( $model->password ) && $model->setPassword ( $model->password, $model->password_2 )) {
					
					$login = new LoginForm ();
					$login->username = $model->first_name;
					$login->email = $model->email;
					$login->password = $_POST ['User'] ['password'];
					$this->loginForm = $login;
					
					$to = $login->email;
					$from = 'outlet@outlet.co.mz';
					$subject = "Welcome - ";
					$view = "welcome";
					$mail_data = array (
							'model' => $login 
					);
					User::sendEmails ( $to, $from, $subject, $view, $mail_data );
					
					$noty = new Feed();
					$noty->model_id = $model->id;
					$noty->model_type = get_class($model);
					$noty->content = 'New customer register' . ' ' . $model->first_name;
					$noty->create_user_id = $model->id;
					if (! $noty->save ()) {
						print_r ( $noty->getErrors () );
						exit ();
					}
					
					if ($login->validate () && $this->authenticate ( $login )) {
						Yii::app ()->user->setFlash ( 'success', 'Please update your profile.' );
						
						$this->redirect ( array (
								'accountb' 
						) );
						
						// redirect to action that you want.
					} else {
						echo 'Not authenticated';
					}
					// exit ();
					
					if ($model->state_id == User::STATUS_INACTIVE) {
						
						Yii::app ()->user->setFlash ( 'register', 'thank you for registering with us. please check your email to activate your account' );
					}
				}
			}
			// else
			// {
			// print_R($model->getErrors()); exit;
			// }
		}
		
		$this->render ( 'create', array (
				'model' => $model 
		) );
	}
	public function actionBusiness() {
		if (YII_ENV == 'prod') {
			Yii::app ()->geoIP->locate ( $_SERVER ['REMOTE_ADDR'] ); // use your IP
			$location = Yii::app ()->geoIP->city . ',' . Yii::app ()->geoIP->countryName;
		} else {
			$location = 'dehli ,india';
		}
		$id = Yii::app ()->user->id;
		$company = Yii::app ()->user->model->company;
		
		if ($company)
			$company = $company;
		else
			$company = new Company ();
		
		$address = new UserAddress ();
		$isAddress = Yii::app ()->user->model->userAddresses;
		if ($isAddress) {
			$address = $isAddress;
		}
		
		$this->performAjaxValidation ( $address, 'user-form-bus' );
		// $this->performAjaxValidation($badd, 'user-form-bus');
		if (isset ( $_POST ['UserAddress'] ) && isset ( $_POST ['Company'] )) {
			$lat = $_POST ['Location'] ['latitude'];
			$long = $_POST ['Location'] ['longitude'];
			
			$company->setAttributes ( $_POST ['Company'] );
			$address->setAttributes ( $_POST ['UserAddress'] );
			$address->shop_location = $_POST ['Location'] ['location'];
			$address->lat = $lat;
			$address->long = $long;
			
			if ($company->save () && $address->save ()) {
				$user = $company->createUser;
				if ($user) {
					$user->username = $company->user_name;
					$user->first_name = $company->admin_first_name;
					$user->last_name = $company->last_name;
					$user->ph_no = $company->contact_no;
					$user->saveAttributes ( array (
							'username',
							'first_name',
							'last_name',
							'ph_no' 
					) );
				}
				$this->redirect ( array (
						'user/shop' 
				) );
			} else {
				print_r ( $company->getErrors () );
				print_r ( $address->getErrors () );
			}
		}
		
		$this->render ( '_business', array (
				'address' => $address,
				'company' => $company,
				'location' => $location 
		) );
	}
	public function actionShop() {
		$id = Yii::app ()->user->model->company->id;
		$user_id = Yii::app ()->user->id;
		$company = $this->loadModel ( $id, 'Company' );
		
		$company->scenario = 'step3';
		
		if (isset ( $_POST ['Company'] )) {
			
			$company->setAttributes ( $_POST ['Company'] );
			$company->create_user_id = $user_id;
			if ($company->save ()) {
				$company->saveUploadedFile ( $company, 'image_file' );
				$company->saveUploadedFile ( $company, 'logo_file' );
				$company->linkImages ( TempFile::SLIDER_IMAGE );
				
				$company->addSitedata ( Home::TYPE_STORE );
				
				$this->redirect ( array (
						'view' 
				) );
			}
		} else {
			$company->deleteTemp ( TempFile::SLIDER_IMAGE );
		}
		$this->render ( '_shop', array (
				'company' => $company 
		) );
	}
	public function actionBasic() {
		$id = Yii::app ()->user->id;
		$model = $this->loadModel ( $id, 'User' );
		if (isset ( $_POST ['User'] )) {
			$model->setAttributes ( $_POST ['User'] );
			
			if ($model->save ()) {
				$this->redirect ( array (
						'user/account' 
				) );
			}
		}
		
		$this->render ( '_basic', array (
				'model' => $model,
				'add' => $badd,
				'sadd' => $sadd 
		) );
	}
	public function actionUpdate($id = null) {
		if ($id == null)
			$id = Yii::app ()->user->id;
		$model = $this->loadModel ( $id, 'User' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		$this->performAjaxValidation ( $model, 'user-form' );
		
		if (isset ( $_POST ['User'] )) {
			$model->setAttributes ( $_POST ['User'] );
			$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER;
			
			$uploaded_file = CUploadedFile::getInstance ( $model, 'image_file' );
			
			if ($uploaded_file) {
				$filename = $path . 'User' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
				
				$uploaded_file->saveAs ( $filename );
				$model->image_file = basename ( $filename );
			}
			if ($model->save ()) {
				$this->redirect ( array (
						'view',
						'id' => $model->id 
				) );
			}
		}
		$this->updateMenuItems ( $model );
		$this->render ( 'update', array (
				'model' => $model 
		) );
	}
	public function actionDelete($id) {
		$model = $this->loadModel ( $id, 'User' );
		
		if ($this->isAllowed ( $model ))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
			
			if (Yii::app ()->getRequest ()->getIsPostRequest ()) {
				$this->loadModel ( $id, 'User' )->delete ();
				
				if (! Yii::app ()->getRequest ()->getIsAjaxRequest ())
					$this->redirect ( array (
							'/user/index'
					) );
			} else
				throw new CHttpException ( 400, Yii::t ( 'app', 'your request is invalid.' ) );
	}/* 
	public function actionDelete($id) {
		$model = $this->loadModel ( $id, 'User' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		$model->delete ();
		
		$this->redirect ( array (
				'/user/index' 
		) );
	} */
	public function actionIndex() {
		/*
		 * $this->redirect ( array (
		 * 'site/index'
		 * ) );
		 */
		$this->updateMenuItems ();
		$dataProvider = new CActiveDataProvider ( 'User', array (
				// 'criteria' => $criteria ,
				'pagination' => array (
						'pagesize' => 20 
				) 
		) );
		
		$criteria = new CDbcriteria ();
		$user = User::model ()->findAll ();
		
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionSearch() {
		$model = new Job ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['User'] )) {
			$model->setAttributes ( $_GET ['User'] );
			$this->renderPartial ( '_list', array (
					'dataProvider' => $model->search (),
					'model' => $model 
			) );
		}
		$this->renderPartial ( '_search', array (
				'model' => $model 
		) );
	}
	/*
	 * public function actionAdmin()
	 * {
	 * $model = new User('search');
	 * $model->unsetAttributes();
	 * $this->updateMenuItems($model);
	 *
	 * if (isset($_GET['User']))
	 * $model->setAttributes($_GET['User']);
	 *
	 * $this->render('admin', array(
	 * 'model' => $model,
	 * ));
	 * }
	 */
	/*
	 * public function actionAdmin() {
	 * $model = new User ();
	 * $columns = array_keys ( $model->getAttributes ( $model->safeAttributeNames ) ); // we are getting in a array.array('id','name','age','sex','email','address'),
	 * if (isset ( $_GET ["Columns"] ))
	 * $columns = $_GET ["Columns"]; // If user chooses the column, column names changes accordingly.
	 * $model->unsetAttributes (); // clear any default values
	 * if (isset ( $_GET ['User'] ))
	 * $model->attributes = $_GET ['User'];
	 *
	 * $this->render ( 'admin', array (
	 * 'model' => $model,
	 * 'columns' => $columns
	 * ) );
	 * }
	 */
	public function loginByUsername() {
		if ($this->caseSensitiveUsers)
			$user = User::model ()->find ( 'first_name = :first_name', array (
					':first_name' => $this->loginForm->username 
			) );
		
		$user = User::model ()->find ( 'upper(first_name) = :first_name', array (
				':first_name' => strtoupper ( $this->loginForm->username ) 
		) );
		
		if ($user)
			return $this->authenticate ( $user );
		else {
			Yii::log ( Yii::t ( 'app', 'Non-existent user {first_name} tried to log in (Ip-Address: {ip})', array (
					'{ip}' => Yii::app ()->request->getUserHostAddress (),
					'{first_name}' => $this->loginForm->username 
			) ), 'error' );
			
			$this->loginForm->addError ( 'password', Yii::t ( 'app', 'email or password is incorrect' ) );
		}
		
		return false;
	}
	public function authenticate($user) {
		$identity = new UserIdentity ( $user->email, $this->loginForm->password );
		$identity->authenticate ( $this->loginType );
		
		switch ($identity->errorCode) {
			case UserIdentity::ERROR_NONE :
				// $duration = $this->loginForm->rememberMe ? 3600*24*30 : 0; // 30 days
				$duration = 3600 * 24 * 30; // 30 days
				Yii::app ()->user->login ( $identity, $duration );
				return $user;
				
				break;
			case UserIdentity::ERROR_EMAIL_INVALID :
				$this->loginForm->addError ( "password", Yii::t ( 'app', 'email or password is incorrect' ) );
				break;
			case UserIdentity::ERROR_STATUS_INACTIVE :
				$this->loginForm->addError ( "password", Yii::t ( 'app', 'this account is not activated.' ) );
				break;
			case UserIdentity::ERROR_STATUS_BANNED :
				$this->loginForm->addError ( "password", Yii::t ( 'app', 'this account is blocked.' ) );
				break;
			case UserIdentity::ERROR_STATUS_REMOVED :
				$this->loginForm->addError ( 'password', Yii::t ( 'app', 'your account has been deleted.' ) );
				break;
			
			case UserIdentity::ERROR_PASSWORD_INVALID :
				Yii::log ( Yii::t ( 'app', 'Password invalid for user {username} (Ip-Address: {ip})', array (
						'{ip}' => Yii::app ()->request->getUserHostAddress (),
						'{username}' => $this->loginForm->username 
				) ), 'error' );
				
				if (! $this->loginForm->hasErrors ())
					$this->loginForm->addError ( "password", Yii::t ( 'app', 'email or password is incorrect' ) );
				break;
				return false;
		}
	}
	public function loginByEmail() {
		if ($this->caseSensitiveUsers)
			$user = User::model ()->find ( 'email = :email', array (
					':email' => $this->loginForm->username 
			) );
		else
			$user = User::model ()->find ( 'upper(email) = :email', array (
					':email' => strtoupper ( $this->loginForm->username ) 
			) );
		if ($user)
			return $this->authenticate ( $user );
		else
			return null;
		// throw new CException('The profile submodule must be enabled to allow login by Email');
	}
	public function actionAjaxLogin() {
		$this->layout = 'main';
		$this->loginForm = new LoginForm ();
		$success = false;
		$action = 'login';
		$login_type = null;
		
		$this->renderPartial ( '_ajaxlogin', array (
				'model' => $this->loginForm,
				'loginType' => $this->loginType 
		) );
	}
	public function actionCredit() {
		$this->render ( 'credit' );
	}
	public function actionLogin() {
		$this->layout = 'main';
		$this->loginForm = new LoginForm ();
		$success = false;
		$action = 'login';
		$login_type = null;
		$this->loginForm->username = 'admin@toxsl.in';
		$this->loginForm->password = 'admin';
		if (isset ( $_POST ['LoginForm'] )) {
			
			$this->loginForm->attributes = $_POST ['LoginForm'];
			// validate user input for the rest of login methods
			if ($this->loginForm->validate ()) {
				/*
				 * if ($this->loginType & self::LOGIN_BY_USERNAME) {
				 * $success = $this->loginByUsername();
				 * if ($success)
				 * $login_type = 'username';
				 * }
				 */
				if ($this->loginType & self::LOGIN_BY_EMAIL && ! $success) {
					$success = $this->loginByEmail ();
					if ($success)
						$login_type = 'email';
				}
				/*
				 * if($this->loginType & self::LOGIN_BY_LDAP && !$success) {
				 * $success = $this->loginByLdap();
				 * $action = 'ldap_login';
				 * $login_type = 'ldap';
				 * }
				 */
			}
			
			if ($success instanceof User) {
				// cookie with login type for later flow control in app
				
				$cookie = new CHttpCookie ( 'login_type', serialize ( $login_type ) );
				$cookie->expire = time () + (3600 * 24 * 30);
				Yii::app ()->request->cookies ['login_type'] = $cookie;
				
				// Yii::log('User :'.$success->username.' successfully logged in (IP:'. Yii::app()->request->getUserHostAddress());
				
				$this->redirectUser ( $success );
			} else {
				if (! $this->loginForm->hasErrors ())
					$this->loginForm->addError ( 'username', Yii::t('app','login is not possible with the given credentials') );
			}
		}
		
		if (Yii::app ()->user->isGuest) {
			
			$this->render ( 'login', array (
					'model' => $this->loginForm,
					'loginType' => $this->loginType 
			) );
		} else if (Yii::app ()->user->isAdmin) {
			$this->redirect ( array (
					$this->returnAdminUrl 
			) );
		} else {
			$this->redirect ( 'accountb' );
		}
	}
	public function redirectUser($user) {
		// $user->updateLastVisit();
		if ($user->isAdmin && $this->returnAdminUrl)
			$this->redirect ( array (
					$this->returnAdminUrl 
			) );
		
		if (isset ( Yii::app ()->user->returnUrl ))
			$this->redirect ( Yii::app ()->user->returnUrl );
		
		$this->redirect ( array (
				$this->returnHomePage 
		) );
	}
	public function actionLogout() {
		
		// If the user is already logged out send them to returnLogoutUrl
		User::updateLastVisitTime ();
		// Cart::deleteSession ();
		Yii::app ()->user->logout ();
		$this->redirect ( Yii::app ()->homeUrl );
		// $this->redirect(Yii::app()->homeUrl);
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new User ();
		
		switch ($this->action->id) {
			case 'update' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'view' ),
							'url' => array (
									'view',
									'id' => $model->id 
							),
							'icon' => 'icon-plus icon-white' 
					);
				}
			case 'create' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
							'url' => array (
									'admin' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-wrench icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'list' ),
							'url' => array (
									'index' 
							),
							'icon' => 'icon-th-list icon-white' 
					);
				}
				break;
			case 'account' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'update' ),
							'url' => array (
									'update',
									'id' => $model->id 
							),
							'icon' => 'icon-wrench icon-white' 
					);
					
					if ($model->role_id == User::ROLE_ADMIN) {
						$this->menu [] = array (
								'label' => Yii::t ( 'app', 'change password' ),
								'url' => array (
										'changePassword' 
								),
								'icon' => 'icon-th-list icon-white' 
						);
					}
				}
				break;
			case 'index' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
							'url' => array (
									'admin' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-wrench icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'create' ),
							'url' => array (
									'create' 
							),
							'icon' => 'icon-plus icon-white' 
					);
				}
				break;
			case 'admin' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'list' ),
							'url' => array (
									'index' 
							),
							'icon' => 'icon-th-list icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'create' ),
							'url' => array (
									'create' 
							),
							'icon' => 'icon-plus icon-white' 
					);
				}
				break;
			case 'accountb' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'update' ),
							'url' => array (
									'update',
									'id' => $model->id 
							),
							'icon' => 'icon-wrench icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'change password' ),
							'url' => array (
									'changepass' 
							),
							'icon' => 'icon-th-list icon-white' 
					);
				}
				break;
			default :
			case 'view' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'list' ),
							'url' => array (
									'index' 
							),
							'icon' => 'icon-th-list icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
							'url' => array (
									'admin' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-wrench icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'delete' ),
							'url' => '#',
							'linkOptions' => array (
									'submit' => array (
											'delete',
											'id' => $model->id 
									),
									
									'confirm' => Yii::t ( 'app', 'are you sure you want to delete this item?'  ),
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-remove icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Create' ),
							'url' => array (
									'create' 
							),
							'icon' => 'icon-plus icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Update' ),
							'url' => array (
									'update',
									'id' => $model->id 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-edit icon-white' 
					);
				}
				break;
		}
		
		// Add SEO headers
		$this->processSEO ( $model );
		
		// merge actions with menu
		$this->actions = array_merge ( $this->actions, $this->menu );
	}
	public function actionActivate($id, $key, $mode) {
		$model = $this->loadModel ( $id, 'User' );
		
		if ($mode == 'recover')
			$model->state_id = User::STATUS_INACTIVE;
		
		$ret = $model->activate ( $model->email, $key );
		
		if ($mode == 'login') {
			
			if ($ret == 1) {
				Yii::app ()->user->setFlash ( 'register', 'Congratulations! Your account is activated.' );
			} else if ($ret == - 2) {
				Yii::app ()->user->setFlash ( 'register', 'Invalid activation key.' );
				$this->redirect ( array (
						'login' 
				) );
			} else {
				Yii::app ()->user->setFlash ( 'register', 'Your account is already activated.' );
			}
			$this->redirect ( array (
					'create' 
			) );
		} else {
			if ($ret == 1) {
				$model->sendPassword ();
				Yii::app ()->user->setFlash ( 'recover', 'your new password is sent on email.' );
			} else if ($ret == - 2) {
				Yii::app ()->user->setFlash ( 'recover', 'Invalid activation key.' );
			}
			$this->render ( 'recover', array (
					'model' => $model 
			) );
		}
	}
	public function actionRecover() {
		$model = new User ();
		
		$this->performAjaxValidation ( $model, 'user-form' );
		
		if (isset ( $_POST ['User'] )) {
			$email = $_POST ['User'] ['email'];
			if ($email != null) {
				$user = User::model ()->findByAttributes ( array (
						'email' => $email 
				) );
				if ($user) {
					$to = $user->email;
					$from = 'web@jisro.com';
					$subject = "Recover Password ";
					$view = "recover_account";
					$mail_data = array (
							'model' => $user 
					);
					User::sendEmails ( $to, $from, $subject, $view, $mail_data );
					
					/*
					 * $email = $user->email;
					 * $view = "recover_account";
					 * $sub = "Recover Your Account at: " . Yii::app ()->params ['company'];
					 * $user->sendMails ( $email, $view, $sub );
					 */
					Yii::app ()->user->setFlash ( 'recover', 'Please check your email to reset your password' );
				} else {
					$model->addError ( 'email', "Email is not registered" );
					// Yii::app()->user->setFlash('recover','Email is not registered.');
				}
			} else {
				$model->addError ( 'email', "Email can not be blank" );
			}
		}
		
		$this->render ( 'recover', array (
				'model' => $model 
		) );
	}
	public function actionChangepassword($id = null) {
		if ($id == null) {
			$id = Yii::app ()->user->id;
		}
		$model = $this->loadModel ( $id, 'User' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'You are not allowed to access this page.' ) );
		
		$model->scenario = 'create';
		$this->updateMenuItems ();
		$this->performAjaxValidation ( $model, 'user-form' );
		
		if (isset ( $_POST ['User'] ) && isset ( $_POST ['User'] ['password'] )) {
			
			if ($model->setPassword ( $_POST ['User'] ['password'], $_POST ['User'] ['password_2'] )) {
				Yii::app ()->user->setFlash ( 'success', 'Your password is successfully changed.' );
				$this->redirect ( array (
						'/site/index' 
				) );
			}
		}
		
		$model->password = null; // empty it
		$this->render ( 'changepassword', array (
				'model' => $model 
		) );
	}
	/*
	 * public function actionChangepassword($id = null)
	 * {
	 * if($id == null) $id = Yii::app()->user->id;
	 * $model = $this->loadModel($id, 'User');
	 * // $model->scenario = 'edit';
	 * // $this->updateMenuItems();
	 * // $this->performAjaxValidation($model, 'user-form');
	 * //echo 'hello';
	 *
	 * if (isset($_POST['User']))
	 * {
	 * if($_POST['User']['password'] == '' || $_POST['User']['password_2'] == '' || $_POST['User']['email'] == '' )
	 * {
	 * echo 'Please enter all required field '; exit();
	 * }
	 *
	 * if ($model->setPassword($_POST['User']['password'], $_POST['User']['password_2']))
	 * {
	 * echo 'success';
	 * exit();
	 * }
	 * else{
	 *
	 * echo 'Password not match exactlty';
	 * exit();
	 * }
	 * }
	 *
	 * }
	 */
	public function regauthenticate($user) {
		$identity = new UserIdentity ( $user->email, '' );
		// $identity->authenticateReg($user);
		$identity->id = $this->id;
		$duration = 3600 * 24 * 30; // 30 days
		$identity->setState ( 'id', $user->id );
		Yii::app ()->user->login ( $identity, $duration );
		return $user;
	}
	public function actionSetPassword($id, $key) {
		$model = new User ();
		
		$user = $this->loadModel ( $id, 'User' );
		
		if ($user && $key) {
			
			$model->setScenario ( 'changePassword' );
			
			$this->performAjaxValidation ( $model, 'change-password-form' );
			if (isset ( $_POST ['User'] )) {
				$model->setAttributes ( $_POST ['User'] );
				
				if ($_POST ['User'] ['password'] == null || $_POST ['User'] ['password_2'] == null) {
					Yii::app ()->user->setFlash ( 'changePassword', 'Password or Confirm Password cannot be blank.' );
				} else {
					if ($_POST ['User'] ['password'] != $_POST ['User'] ['password_2']) {
						Yii::app ()->user->setFlash ( 'changePassword', 'Password or Confirm Password must be same.' );
					} else {
						if ($user->activation_key == $key && $user->activation_key != '') {
							if ($user->setPassword ( $_POST ['User'] ['password'] )) {
								$user->activation_key = '';
								$user->saveAttributes ( array (
										'activation_key' 
								) );
								Yii::app ()->user->setFlash ( 'success', 'Your password is changed successfully !!' );
							} else {
								// echo $user->getErrors ();
								Yii::app ()->user->setFlash ( 'changePassword', 'Your password is not changed!!' );
							}
						} else {
							Yii::app ()->user->setFlash ( 'changePassword', 'Your key is expired, please retry!!' );
						}
					}
				}
			}
		} else {
			Yii::app ()->user->setFlash ( 'changePassword', 'operation not allowed' );
		}
		
		$user->password = null;
		$this->render ( 'setPassword', array (
				'model' => $user,
				'key' => $key 
		) );
	}
}
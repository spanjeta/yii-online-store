<?php

class UserController extends GxController {


	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('signup','login','getGender','forgetpassword','check'),
						'users'=>array('*'),
		),
		array('allow', // allow authenticated user to perform
						'actions'=>array('logout','signupBasic','manageview','index',
								'signupBusiness','signupBusiness2','profile','changePassword','update','closeAccount','manage'),
						'users'=>array('@'),
		),
		array('allow', // allow admin user to perform
						'actions'=>array('admin','delete'),
						'expression'=>'Yii::app()->user->isAdmin()',
		),
		array('deny',
						'users'=>array('*'),
		),
		);
	}

	public function actionForgetpassword()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		//	$_POST['User']['email'] = 'test@toxsl.com';
		if (isset($_POST['User']))
		{
			$email = $_POST['User']['email'];
			$user = User::model()->findByAttributes(array('email'=>$email));
			if($user)
			{
				$arr['status'] = 'OK';
				$user->sendEmail($user->email,'Password Recovery for','recover_account');
				//$user->sendPassword();
				$arr['message'] = 'Please check your email to reset your password.';
			}
			else
			{
				$arr['error'] = 'Email id is not registered.';
			}
		}
		$this->sendJSONResponse($arr);
	}

	public function actionUpdate($id = null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		if($id == null) $id = Yii::app()->user->id;
		$model = $this->loadModel($id, 'User');

		if (isset($_POST['User'])) {
			$model->setAttributes($_POST['User']);

			if ($model->save()) {
				$arr['status'] = 'OK';
				$arr['success'] = 'your account is successfully Updated';
			}else{
				$err = '';
				foreach($model->getErrors() as $error){
					$err = implode(',', $error);
				}
				$arr['error'] = $err;
			}
		}
		$this->sendJSONResponse($arr);
	}

	public function actionCloseAccount($id = null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		if($id == null) $id = Yii::app()->user->id;
		$model = $this->loadModel($id, 'User');
		if($model)
		{
			$model->state_id = 2;
			$model->saveAttributes(array('state_id'));
			$arr['status'] = 'OK';
			$arr['mesage'] = 'your account is successfully closed';
		}
		else
		{
			$arr['user'] = 'user not found';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionChangePassword($id = null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		if($id == null) $id = Yii::app()->user->id;
		$model = $this->loadModel($id, 'User');
		if($model) {
			if (isset($_POST['User']))
			{
				if($_POST['User']['password'] == '' || $_POST['User']['password_2'] == '' || $_POST['User']['email'] == '' )
				{
					$arr['error'] = 'Please enter all required fields';
				}

				if ($model->setPassword($_POST['User']['password'], $_POST['User']['password_2']))
				{
					$arr['status'] = 'OK';
					$arr['mesage'] = 'your password is successfully changed';
				}
				else{

					$arr['password'] = 'Password not match exactlty';
				}
			}
		}

		else
		{
			$arr['user'] = 'user not found';
		}

		$this->sendJSONResponse($arr);
	}



	public function actionSignup()
	{
		//	if(Yii::app()->user->isGuest)

		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$model = new User('create');

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			//	$model->state_id =  User::STATUS_INACTIVE;
			$model->state_id =  User::STATUS_ACTIVE;
			if($model->save())
			{
				if (isset($model->password) && $model->setPassword($_POST['User']['password'],$_POST['User']['password_2']))
				{
					$arr['status']='OK';
					if ( $model-> state_id == User::STATUS_INACTIVE)
					{
						//	$model->sendEmail($model->email,'New User Registration','register');
						$arr['status']='OK';
						//	$arr['success'] = 'You can login by your username and password';
						$arr['success'] = 'Please check your emil to activate your account';
					}
					else {
						$arr['success'] = 'You can login by your username and password';
					}
				}
				else {
					$arr['error'] = 'password not set';
				}
			}
			else
			{
				$err = '';
				foreach( $model->getErrors() as $error)
				$err .= implode( ".",$error);
				$arr['error'] = $err;
			}
		}

		$this->sendJSONResponse($arr);
	}


	public function actionSignupBasic()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		//	$id = Yii::app()->session['userid'] ;
		$id = Yii::app()->user->id;
		$model = $this->loadModel($id, 'User');
		//		$badd = new UserAddress();
		//	$sadd = new SuserAddress();

		if (isset($_POST['User']))
		{
			$model->setAttributes($_POST['User']);

			if ($model->save())
			{
				$arr['status']='OK';
			}
		}

		else {
			$arr['data'] = 'data not posted';
		}

		$this->sendJSONResponse($arr);
	}

	public function actionSignupBusiness()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		//	$id = Yii::app()->session['userid'] ;
		$id = Yii::app()->user->id ;

		$company = new Company();

		$company1 = Yii::app()->user->model->company;
		if($company1)
		{
			$company = $company1;
		}
		$address = new UserAddress();

		$isAddress = Yii::app()->user->model->userAddresses;
		if($isAddress) {
			$address = $isAddress;
		}
		$arr['posted_data'] = $_POST;

			
		if (isset($_POST['UserAddress']) && isset($_POST['Company']))
		{
			$company->setAttributes($_POST['Company']);
			$address->setAttributes($_POST['UserAddress']);
			if ($company->save())
			{
				if($address->save())
				{
					$arr['address'] = 'address details are same saved successfuly';
				}
				else
				{
					$arr['address'] = 'address details are not saved';
				}
				$user = $company->createUser;
				if($user)
				{
					$user->username = $company->user_name;
					$user->first_name = $company->admin_first_name;
					$user->last_name = $company->last_name;
					$user->ph_no = $company->contact_no;
					$user->saveAttributes(array('username','first_name','last_name','ph_no'));
				}
				$arr['status'] = 'OK';
			}
			else
			{
				$err = '';
				foreach( $company->getErrors() as $error)
				$err .= implode( ".",$error);
				$arr['error'] = $err;
			}
		}
		else
		{
			$arr['data'] = 'data not posted';
		}

		$this->sendJSONResponse($arr);
	}

	public function actionSignupBusiness2()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$user_id = Yii::app()->user->id ;
		$company = Yii::app()->user->model->company;

		if (isset($_POST['Company']))
		{
			$company->setAttributes($_POST['Company']);
			$company->create_user_id = $user_id;
			if ($company->save())
			{
				$company->saveUploadedFile($company, 'logo_file');

				$arr['status'] = 'OK';
			}
			else
			{
				$err = '';
				foreach( $company->getErrors() as $error)
				$err .= implode( ".",$error);
				$arr['error'] = $err;
			}
		}
		else {
			$arr['data'] = 'data not posted';
		}

		$this->sendJSONResponse($arr);
	}

	public function actiongetGender()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$lists = User::getGender();
		$gender_list = array();
		foreach ($lists as $key=>$value)
		{
			$jsonentry[$value] = $key;
		}
		$arr['gender'] = $jsonentry;
		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

	public function actionProfile($id = null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		if($id == null) $id = Yii::app()->user->id;
		$model = User::model()->findByPk($id);
		if ($model)
		{
			$jsonentry[] = $model->profileArray();
		}
		$arr['profile'] = $jsonentry;
		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}


	public function actionLogin()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new LoginForm;

		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];

			// validate user input and redirect to the previous page if valid

			$user = User::model()->findByAttributes(array('email'=>$model->username));
			if($user) {
				if($model->validate() && $this->authenticate($model))
				{
					$auth_session = AuthSession::newSession($model);
					if(!$auth_session)
					{
						$arr['error_auth'] = 'Auth Session is not saved';
					}
					if($auth_session)
					$arr['auth_code'] = $auth_session->auth_code;

					$user = Yii::app()->user->model;
					$arr['status']='OK';
					$arr['success']='you have successfully Login';
					$userinfo[] = $user->logintoArray();
					$arr['userinfo'] = $userinfo;
				}
				else
				{
					$err = '';
					foreach($model->getErrors() as $error)
					$err .= implode( ".",$error);
					$arr['error'] = $err;
				}
			}

			else {
				$arr['error'] = 'Please Check Your username and password';
			}
		}


		$this->sendJSONResponse($arr);

	}

	public function authenticate($user) {
		$identity = new UserIdentity($user->username, $user->password);
		$identity->authenticate(true);

		switch($identity->errorCode) {
			case UserIdentity::ERROR_NONE:
				$duration = 3600*24*30; // 30 days
				Yii::app()->user->login($identity,$duration);
				return $user;
				break;
			case UserIdentity::ERROR_EMAIL_INVALID:
				$user->addError("password",Yii::t('app','Username or Password is incorrect'));
				break;
			case UserIdentity::ERROR_STATUS_INACTIVE:
				$user->addError("status",Yii::t('app','This account is not activated.'));
				break;
			case UserIdentity::ERROR_STATUS_BANNED:
				$user->addError("status",Yii::t('app','This account is blocked.'));
				break;
			case UserIdentity::ERROR_STATUS_REMOVED:
				$user->addError('status', Yii::t('app','Your account has been deleted.'));
				break;
			case UserIdentity::ERROR_STATUS_USER_DOES_NOT_EXIST:
				$user->addError('status', Yii::t('app','User doesnt exits.'));
				break;
			case UserIdentity::ERROR_PASSWORD_INVALID:
				Yii::log( Yii::t('app',
				'Password invalid for user {username} (Ip-Address: {ip})', array(
				'{ip}' => Yii::app()->request->getUserHostAddress(),
				'{username}' => $user->username)), 'error');

				if(!$user->hasErrors())
				$user->addError("password",Yii::t('app','Password is incorrect'));
				break;
		}
		return false;
	}
	public function actionLogout()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		AuthSession::logout();
		$arr['status'] = 'OK';
		Yii::app()->user->logout();
		$this->sendJSONResponse($arr);
	}

	/**
	 * this api is used for getting the all users
	 */

	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$criteria = new CDbCriteria;
		$criteria->addCondition('state_id = 1');
		$criteria->addCondition('id != '.Yii::app()->user->id);
		$criteria->addCondition('username  IS  NOT NULL');
		$users = User::model()->findAll($criteria);

		$list = array();
		foreach($users as $user)
		{
			$list[] = $user->profileArray();
		}
		$arr['list'] = $list;
		$arr['status'] = 'OK';
		$this->sendJSONResponse($arr);
	}
	/**
	 * This api is used for checking the user auth session
	 * Enter description here ...
	 */

	public function actionCheck()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$headers = AuthSession::getHead();
		$auth_code = isset($headers['auth_code']) ? $headers['auth_code'] : null;
		if ( $auth_code == null ) $auth_code = Yii::app()->request->getQuery('auth_code');
		if (  $auth_code == '(null)' ) $auth_code = null;  //DONE FOR IPHONE AND DONT CHANGE THE ORDER
		$arr['temp_device_auth_code'] = $auth_code;
		if($auth_code != null){
			$auth_session = AuthSession::model()->findByAttributes(array('auth_code'=>$auth_code));
			if($auth_session != null){
				$arr['status'] = 'OK';
				$user = Yii::app()->user->model;
				$arr['status']='OK';

				$arr['success']='you have successfully Login';
				//
				if(isset($_POST['AuthSession']['device_token'])){
					$auth_session->device_token = $_POST['AuthSession']['device_token'];
					if($auth_session->saveAttributes(array('device_token'))){
						$arr['auth_session']='Auth Session updated Updated device token';
					}
					else{
						$err = '';
						foreach( $auth_session->getErrors() as $error){
							$err .= implode( ".",$error);
						}
						$arr['error'] = $err;
						//$arr['status'] = 'NOK';
					}
				}else{
					$arr['device_token'] = 'Device token is not updated ';
				}
			}else{
				$arr['error'] = 'auth_code is not found';
			}

		}
		else
		$arr['error'] = 'Auth code not found in the header or query string.';
		$this->sendJSONResponse($arr);
	}
}
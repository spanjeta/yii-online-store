<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */

/**
 * @property integer $id
 * @property string $auth_code
 * @property string $device_token
 * @property integer $type_id
 * @property integer $create_user_id
 * @property string $create_time
 * @property string $update_time
 */
Yii::import('application.models._base.BaseAuthSession');
class AuthSession extends BaseAuthSession
{

	private static $session_expiration_days = 90;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes()
	{
		return array(
				'old' => array('condition'=> 'update_time < \''.date('Y-m-d H:i:s', strtotime('-90 day')) .'\''),
		);
	}

	public static function randomCode($count = 32) {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < $count; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);; //turn the array into a string
	}
	public static function newSession($model)
	{

		self::deleteOldSession();

		$auth_session = AuthSession::model()->findbyAttributes(array('device_token' => $model->device_token));

		if ( $auth_session == null ) $auth_session = new AuthSession();
		$auth_session->create_user_id = Yii::app()->user->id;
		$auth_session->auth_code = self::randomCode();
		$auth_session->device_token = $model->device_token;
		$auth_session->type_id = $model->device_type;
		if($auth_session->save())
		{
			return $auth_session;
		}
		else
		{
			return false;
		}
	}
	public static function deleteOldSession()
	{
		$old = AuthSession::model()->old()->findAll();
		foreach ( $old as $session)
			$session->delete();
	}
	public static function logout()
	{
		if ( Yii::app()->user->isGuest ) return ;
		$old = Yii::app()->user->model->authSessions;
		foreach ( $old as $session)
			$session->delete();
	}
	public static function getHead(){
		if (!function_exists('getallheaders'))
		{
			function getallheaders()
			{
				$headers = '';
				foreach ($_SERVER as $name => $value)
				{
					if (substr($name, 0, 5) == 'HTTP_')
					{
						$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
					}
				}
				return $headers;
			}
		}else{
			return getallheaders();
		}
	}

	public static function authenticateSession($auth_code = null)
	{

		// just exit if login is not required.
		if ( !Yii::app()->user->isGuest ) return;


		$headers =  self::getHead();
		$auth_code = isset($headers['auth_code']) ? $headers['auth_code'] : null;

		if ( $auth_code == null ) $auth_code = Yii::app()->request->getQuery('auth_code');
		
		if (  $auth_code == '(null)' ) $auth_code = null;  //DONE FOR IPHONE AND DONT CHANGE THE ORDER
		
		if (  $auth_code == null ) return;


	//	$arr = array('controller'=>"user", 'action'=>'check','status' =>'NOK');
		$arr = array('controller'=>"user", 'action'=>'check','status' =>'NOK');
	//	$arr = array('controller'=>"User", 'action'=>'Authenticate','status' =>'NOK');		
		$arr['auth_code'] = isset($auth_code) ? $auth_code : '';
		$auth_session = AuthSession::model()->findbyAttributes( array ( 'auth_code'=>$auth_code));

		if ($auth_session)
		{

			$user = $auth_session->createUser;

			$identity = new UserIdentity($user, $user);
			$identity->authenticateSession($user);

			switch($identity->errorCode) {
				case UserIdentity::ERROR_NONE:
					$duration = 3600*24*30; // 30 days
					Yii::app()->user->login($identity,$duration);
					$auth_session->save(); // update time is changed here
					return true;
					break;
				case UserIdentity::ERROR_STATUS_USER_DOES_NOT_EXIST:
					$user->addError('status', Yii::t('app','User doesnt exists.'));
					break;
			}
			return;
		}
		else {
			$controller = Yii::app()->controller;
			$arr['error'] = 'invalid auth_code';
			header('Content-type: application/json');
			echo json_encode($arr);
			Yii::app()->end();
		}
		return false;

		//if ( Yii::app()->module != null && Yii::app()->module->id == 'api')

	}
}
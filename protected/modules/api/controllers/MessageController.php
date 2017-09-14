<?php

class MessageController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
				array('allow',
						'actions'=>array( 'download', 'thumbnail' ),
						'users'=>array('*'),
				),
				array('allow',
						'actions'=>array('view','create','update', 'search','delete','index','chatBox','sendChat','checkChat',
								'userList','ajaxSearch','download','sendFile','multiDelete'),
						'users'=>array('@'),
				),
				array('allow',
						'actions'=>array('admin'),
						'expression'=>'Yii::app()->user->isAdmin',
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}


	/*public function actionUserList(){
		print_r($_GET);
	}*/
	public function actionMultiDelete(){
		$session_ids = $_POST['session_ids'];
		foreach($session_ids  as $session_id){
			$criteria = new CDbCriteria;
			$criteria->addCondition('session_id = '.$session_id);
			$criteria->group = 'message_id';
			$usermessages = UserMessage::model()->findAll($criteria);

			foreach($usermessages as $usermessage){
				$message_ids[] = $usermessage->message_id;
				if($usermessage->message->delete()){
					echo 'success User_Deleted ';
					/*if($usermessage->message->delete()){
						echo ' Message Deleted ';
					}else{
					print_r($usermessage->message->getErrors());
					}*/
				}else{
					print_r($usermessage->getErrors());
				}
			}

		}
	}
	// CheckChat in web
	public function actionCheckChat(){
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		if(isset($_GET['sid']) and isset($_GET['mid'])){
			$session_id = $_GET['sid'];
			$message_id = $_GET['mid'];
			$lastmessage_id = Message::LastMessageId($session_id);

			$criteria = new CDbCriteria;
			$criteria->addCondition('session_id = '.$session_id);
			$criteria->addCondition('create_user_id != '.Yii::app()->user->id);
			$criteria->group = 'message_id';

			$criteria->addCondition('message_id > '.$message_id);
			$usermessages = UserMessage::model()->findAll($criteria);
			if($usermessages){
				foreach ($usermessages as $usermessage){
					//$json_message[] = array('message_id' => $usermessage->message_id,'content' =>$usermessage->message->content,'createUserName' =>$usermessage->createuser->first_name);
					$json_message[] = $usermessage->message->toArray($session_id);
					$arr['status'] = 'OK';
				}
				$arr['message'] = $json_message;
			}
			$arr['last_mid'] = $lastmessage_id;
		}else{
			$arr['error'] = 'sid and mid is missing';
		}
		$this->sendJSONResponse($arr);
	}

	public function actionSendChat()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
			
		if(isset($_POST['sid'])){
			$session_id = $_POST['sid'];
			$chat = $_POST['chat'];
			$lastmessage_id = Message::LastMessageId($session_id);
			$arr['last_mid'] = $lastmessage_id;
			$criteria = new CDbCriteria;
			$criteria->addCondition('session_id  = '.$session_id);
			$criteria->group = 'user_id';
			$firstmessages = UserMessage::model()->findAll($criteria);

			if($firstmessages){
				foreach($firstmessages as $usermessage){
					$user_array[] = $usermessage->user_id;
				}
				$message = new Message;
				$message->type_id = Message::MESSAGE_CONTENT;
				$message->state_id = 0;
				$message->content = $chat;
				if ($message->save()) {
					foreach($user_array  as $user_id){
						$arr['status'] = 'OK';
						$userMessage = new UserMessage();
						$userMessage->user_id = $user_id;
						$userMessage->message_id = $message->id;
						$userMessage->session_id = $session_id;
						$userMessage->type_id = 0;
						if($user_id == Yii::app()->user->id){

							$userMessage->state_id = UserMessage::READ;
						}else{
							$userMessage->state_id = UserMessage::UNREAD;
						}
						if($userMessage->save()){
							$usermsg[] = $userMessage->medium_toArray();
						}else{
							$json_usermessage['status'] = 'NOK';
							$json_usermessage['user_id'] = $user_id;
							$usermsg[] = $json_usermessage;
						}
					}
					$arr['sendMsg'][] = $message->toArray($session_id);

				}else {
					$usermsg['error'] = $message->getErrors();
				}
			}else{
				$arr['error'] =  'not belong to this chat box';
			}
		}else{
			$arr['error'] = 'sid id not given';
		}

		$arr['usermsg'] = isset($usermsg) ? $usermsg : array();
		$this->sendJSONResponse($arr);

	}

	public function actionCreate()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		//**************File UPLOAD
		$arr['file'] = $_FILES;
		$arr['post'] = $_POST;
		$err = '';
		$message = new Message('create');

		if (isset($_POST['Message'])
				and !(empty($_POST['Message']['to_user_id']))
				and !(empty($_POST['Message']['subject']))
				and !(empty($_POST['Message']['content']))
		){
			$message->setAttributes($_POST['Message']);
			$message->type_id = Message::MESSAGE_CONTENT;
			$user_array = explode(',', $message->to_user_id);
			$session_id = User::randomPassword(8,true);

			if ($message->save()) {

				$arr['success']  = 'Message Saved.';
				//*************FILE UPLOAD
				$uimages=CUploadedFile::getInstancesByName('path_file');
				//	$uimages=CUploadedFile::getInstanceByName('path_file');

				//	$arr['uimages'] = $uimages;
				if($uimages){
					$arr['file_set'] = 'file is available';
					foreach ($uimages as $image=>$pic){
						$path = Yii::app()->basePath .'/..' . UPLOAD_PATH ;
						$filename = $path . get_class($message). '-' .time().uniqid(). '-' .'path_file'.'user_id_'. Yii::app()->user->id. '.'.$pic;
						if ( file_exists( $filename)) unlink($filename);

						if ($pic->saveAs($filename)){
							$file['file_upload'] = 'successfully';
							$fileMessage = new Message;
							$fileMessage->path_file = basename( $filename );
							$fileMessage->content = $message->content;
							$fileMessage->subject = $message->subject;
							$fileMessage->type_id = Message::FILE_CONTENT;

							if($fileMessage->save()){
								$file['file_Message'][] = $fileMessage->file_toArray();

								$userMessage = new UserMessage();
								$userMessage->user_id = Yii::app()->user->id;
								$userMessage->message_id = $fileMessage->id;
								$userMessage->session_id = $session_id;
								$userMessage->state_id = UserMessage::READ;

								if($userMessage->save()){
									$file['file_UserMessage'][] = $userMessage->medium_toArray();
									foreach($user_array  as $user_id){
										$userMessage = new UserMessage();
										$userMessage->user_id = $user_id;
										$userMessage->message_id = $fileMessage->id;
										$userMessage->session_id = $session_id;
										$userMessage->state_id = UserMessage::UNREAD;
										if($userMessage->save()){
											$arr['status'] = 'OK';
											$file['file_UserMessage'][] = $userMessage->medium_toArray();
										}
									} // foreach ends
								}
							}else{

								$file['file_error'] = $fileMessage->getErrors();

							}
						}else{
							$file['error'] = 'file not saved';
						}
					}// end of foreach
				}else{
					$arr['error'] = 'File Data is not Given';
				}
				$arr['usermsg_file'] = isset($file) ? $file : array();

				//*************** File UPLOAD
				//
				$userMessage = new UserMessage();
				$userMessage->user_id = Yii::app()->user->id;
				$userMessage->message_id = $message->id;
				$userMessage->session_id = $session_id;

				$userMessage->state_id = UserMessage::READ;
				if($userMessage->save()){
					$json_msg['UserMsg'][]  = $userMessage->medium_toArray();
				}
				foreach($user_array  as $user_id){
					$userMessage = new UserMessage();
					$userMessage->user_id = $user_id;
					$userMessage->message_id = $message->id;
					$userMessage->session_id = $session_id;
					$userMessage->state_id = UserMessage::UNREAD;
					if($userMessage->save()){
						$arr['status'] = 'OK';
						$json_msg['UserMsg'][]  = $userMessage->medium_toArray();
					}
				}
			}else {
				$arr['message_error'] = $message->getErrors();
			}
		}

		else {
			$arr['data'] = 'Missing Required fields';
		}
		$arr['msg'] = isset($json_msg) ? $json_msg : array();
		$arr['files'] = isset($file) ? $file : array();
		$this->sendJSONResponse($arr);
	}
	public function actionAjaxSearch() {
		if (isset($_GET['q'])   and  !empty($_GET['q'])) {

			$name = $_GET['q'];

			$criteria = new CDbCriteria;
			$criteria->compare('first_name',$name,true,'OR');
			$criteria->compare('last_name',$name,true,'OR');
			$criteria->addCondition('id != '.Yii::app()->user->id);
			$users = User::model()->findAll($criteria);
			$data = array();
			foreach ($users as $value) {

				if($value->first_name)
				{
					$data[] = array(
							'id' => $value->id,
							'text' => $value->first_name,
					);
				}
			}

		}
		else{
			return false;
		}
		echo CJSON::encode($data);
		Yii::app()->end();
	}
	/**
	 * Added delete with parent and child
	 * Enter description here ...
	 */

	public function actionDelete()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		//	$arr['post'] = $_POST;
		//$_POST['Message']['sess_ids'] = '95931525,66641223,09922512,38548338,57694803,82429009,31761800';
		if(isset($_POST['Message']['sess_ids'])  && !empty($_POST['Message']['sess_ids'])) {

			$delids = $_POST['Message']['sess_ids'];
			$sessionids = explode(',',$delids);

			$criteria = new CDbCriteria;

			//$arr['post_sess_ids'] = $delids;

			$arr['status'] = 'OK';

			foreach($sessionids as $id){
				$criteria->addCondition('session_id = '.$id);
				$criteria->group = 'message_id';

				$usermessages = UserMessage::model()->findAll($criteria);
				if($usermessages){
					foreach($usermessages as $usermessage) {
						$json_message['create_user_id'] = $usermessage->create_user_id;
						$json_message['message_id'] = $usermessage->message_id;
						$parentMessage = $usermessage->message;
						if($parentMessage){
							if($parentMessage->delete()){
								$arr['status'] = 'OK';
							}
						}
						//	$json_message_list['message_list'][] = $json_message;
					}
				}
				//$json_session_list[] = $json_message_list;
			}
			//	$arr['session_list'] = $json_session_list;
		}
		else {
			$arr['data'] = 'data not posted';
			//$arr['data_posted'] = $_POST;
		}

		$this->sendJSONResponse($arr);
	}
	/**
	 * this api is for message index for a user.
	 * Enter description here ...
	 */
	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$usermessages =array();
		//	echo Yii::app()->user->id;
		$messages = Yii::app()->user->model->usermessage;

		//	print_r($messages);  exit;

		if($messages){
			//die('dfdf');
			foreach($messages as $usermessage){
				$usermessages[]	= $usermessage->toArray();
				$arr['status'] = 'OK';
			}
		}
		$arr['usermessages'] = $usermessages;
		$this->sendJSONResponse($arr);
	}

	public function actionChatBox($sid = null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$session_id = $sid;
		//		$message_id = isset($_POST['mid']);

		if(isset($sid)){
			$criteria = new CDbCriteria;
			$criteria->addCondition('session_id = '.$sid);
			$criteria->addCondition('user_id = '.Yii::app()->user->id);

			$results = UserMessage::model()->updateAll(array('state_id'=>UserMessage::READ),$criteria);

			$sql = "SELECT * from
					(
					SELECT *
					FROM `tbl_user_message`
					WHERE `session_id` = '".$session_id."'
							GROUP BY `message_id`
							ORDER BY id DESC
							LIMIT  0, 5
							) as Z
							ORDER BY id ASC
							";

			$chatbox = UserMessage::model()->resetScope()->findAllBySql($sql);

			// UPDATE CHATBOX TO READ MESSAGE TO THE LOGIN CLIENT +

			foreach($chatbox as $usermessage){
				/*
				 $usermessage->state_id = UserMessage::READ;
				$usermessage->save(array('state_id')); // ? 'chatbox_saved' : ' unsavedchatbox ';
				*/
				// Show chatbox body
				$json_usermessage[] = $usermessage->message->toArray($sid);

				$arr['status'] = 'OK';
			}
			$arr['messages']= isset($json_usermessage) ? $json_usermessage : '';

			$firstUserMessage = UserMessage::firstUserMessageBySessionId($sid);
			if($firstUserMessage) {
			$fristmessage= $firstUserMessage->toArray();
			$arr['fristmessage'] = isset($fristmessage) ? $fristmessage : array();
			}
			/*$criteria1 = new CDbCriteria;
			 $criteria1->addCondition('session_id  = '.$session_id);
			$criteria1->group = 'user_id';
			$firstmessages = UserMessage::model()->old()->findAll($criteria1);*/
			//	$arr['first_message'] = $firstmessages->toArray();
		}

		$this->sendJSONResponse($arr);
	}

	public function actionSendFile(){
		//*************FILE UPLOAD
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$fileMessage = new Message;
		//	$fileMessage->setAttributes($_FILES['path_file']);
		$arr['file'] = $_FILES;
		$uimages=CUploadedFile::getInstanceByName('path_file');

		if(isset($_POST['sid'])){
			$session_id = $_POST['sid'];
			if($uimages){
				$userList = Message::getUserListBySessionId($session_id);

				$path = Yii::app()->basePath .'/..' . UPLOAD_PATH ;
				$filename = $path . get_class($fileMessage). '-' .time() .uniqid(). '-' .'path_file'.'user_id_'. Yii::app()->user->id. '.'.$uimages->getExtensionName();
				if ( file_exists( $filename)) unlink( $filename );

				if ($uimages->saveAs($filename)){
					$arr['status'] = 'OK';
					$fileMessage = new Message;
					$fileMessage->path_file= basename( $filename );
					$fileMessage->content = 'File';
					$fileMessage->subject = 'Filesubject';
					$fileMessage->type_id = Message::FILE_CONTENT;
					if($fileMessage->save()){
						foreach($userList  as $user_id){
							if($user_id == Yii::app()->user->id){
								$userMessage = new UserMessage();

								$userMessage->user_id = $user_id;
								$userMessage->message_id = $fileMessage->id;
								$userMessage->session_id = $session_id;
								$userMessage->type_id = 0;
								$userMessage->state_id = UserMessage::READ;
								$userMessage->save();
							}else{

								$userMessage = new UserMessage();

								$userMessage->user_id = $user_id;
								$userMessage->message_id = $fileMessage->id;
								$userMessage->session_id = $session_id;
								$userMessage->type_id = 0;
								$userMessage->state_id = UserMessage::UNREAD;
								$userMessage->save();

							}
						}
						$arr['sendMsg'][] = $fileMessage->toArray($session_id);
						//
					}else{
						print_r($fileMessage->getErrors());
					}
				}
			}else{
				$arr['error'] = 'File Not Received.';

			}
		}
		else{
			$arr['error'] = 'sid not given';

		}
		$this->sendJSONResponse($arr);


		//**************File UPLOAD
	}



}

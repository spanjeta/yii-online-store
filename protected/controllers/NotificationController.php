<?php
/**
 * Company: ToXSL Technologies Pvt. Ltd. <www.toxsl.com>
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
?>
<?php
class NotificationController extends Controller {
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
								'index',
								'view',
								'add',
								'update',
								'notification'
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'manage',
								'delete' 
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
	public function isAllowed($model) {
		return $model->isAllowed ();
	}
	public function actionView($id) {
		$model = $this->loadModel ( $id, 'Notification' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'You are not allowed to access this page.' ) );
		
		$this->updateMenuItems ( $model );
		$this->render ( 'view', array (
				'model' => $model 
		) );
	}
	
 	public function actionNotification() {
		$notiData = [ ];
		//Yii::app()->response->format = 'json';
		
		$criteria = new CDbCriteria ();
		$criteria->addCondition( 'is_read = 0 ');
		$model = Notification::model()->findAll ($criteria);
		
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'is_read = 0');
		
		$counts = Notification::model()->find ($criteria);
		$count = count ( $counts);
//	print_r($count);exit;
		$response = [ ];
		if (! empty ( $model )) {
			foreach ( $model as $notification ) {
				$user_data = [ ];
				$data = $notification->notificationModel;
				
				if (! isset ( $data->createUser ) && empty ( $data->createUser )) {
					$user_data = $data;
				} else {
					$user_data = $data->createUser;
				}
				$notiData ['user'] = $user_data;
				$notiData ['notification'] = $notification;
				// $notiData ['time'] = $notification->time_elapsed_string ( strtotime ( $notification->created_on ) );
				$response ['data'] [] = $notiData;
			}
			$response ['status'] = 'OK';
		} else {
			$response ['status'] = 'NOK';
		}
		$response ['count'] = $count;
		return $response;
	}
	
	public function actionNotification() {
		$response= array (
				'status' => 'NOK'
		);
		$criteria = new CDbCriteria ();
		$criteria->addCondition( 'is_read = 0 ');
		$model = Notification::model()->findAll ($criteria);
		
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'is_read = 0');
		
		$counts = Notification::model()->find ($criteria);
		$count = count ( $counts);
		//$response = [ ];
		if (! empty ( $model )) {
			foreach ( $model as $notification ) {
				$user_data = [ ];
				$data = $notification->notificationModel;
				
				if (! isset ( $data->createUser ) && empty ( $data->createUser )) {
					$user_data = $data;
				} else {
					$user_data = $data->createUser;
				}
				$notiData ['user'] = $user_data;
				$notiData ['notification'] = $notification;
				// $notiData ['time'] = $notification->time_elapsed_string ( strtotime ( $notification->created_on ) );
				$response ['data'] [] = $notiData;
			}
			$response ['status'] = 'OK';
		} else {
			$response ['status'] = 'NOK';
		}
		$response ['count'] = $count;
		
		$this->sendJSONResponse ( $arr );
	}
	
	public function actionAdd() {
		$model = new Notification ();
		
		$this->performAjaxValidation ( $model, 'notification-form' );
		
		if (isset ( $_POST ['Notification'] )) {
			$model->setAttributes ( $_POST ['Notification'] );
			
			if ($model->save ()) {
				if (Yii::app ()->getRequest ()->getIsAjaxRequest ())
					Yii::app ()->end ();
				else
					$this->redirect ( array (
							'view',
							'id' => $model->id 
					) );
			}
		}
		$this->updateMenuItems ( $model );
		$this->render ( 'add', array (
				'model' => $model 
		) );
	}
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id, 'Notification' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		$this->performAjaxValidation ( $model, 'notification-form' );
		
		if (isset ( $_POST ['Notification'] )) {
			$model->setAttributes ( $_POST ['Notification'] );
			
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
		$model = $this->loadModel ( $id, 'Notification' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		if (Yii::app ()->getRequest ()->getIsPostRequest ()) {
			$this->loadModel ( $id, 'Notification' )->delete ();
			
			if (! Yii::app ()->getRequest ()->getIsAjaxRequest ())
				$this->redirect ( array (
						'manage' 
				) );
		} else
			throw new CHttpException ( 400, Yii::t ( 'app', 'your request is invalid.' ) );
	}
	public function actionIndex() {
		$model = new Notification ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Notification'] ))
			$model->setAttributes ( $_GET ['Notification'] );
		
		$this->render ( 'index', array (
				'model' => $model 
		) );
	}
	public function actionManage() {
		$model = new Notification ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Notification'] ))
			$model->setAttributes ( $_GET ['Notification'] );
		
		$this->render ( 'manage', array (
				'model' => $model 
		) );
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new Notification ();
		
		switch ($this->action->id) {
			case 'update' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'view' ),
							'url' => array (
									'view',
									'id' => $model->id 
							),
							'icon' => 'fa fa-eye' 
					);
				}
			case 'add' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
							'url' => array (
									'manage' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-wrench' 
					);
				}
				break;
			case 'index' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
							'url' => array (
									'manage' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-wrench' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'add' ),
							'url' => array (
									'add' 
							),
							'icon' => 'fa fa-plus' 
					);
				}
				break;
			case 'manage' :
				{
					
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'add' ),
							'url' => array (
									'add' 
							),
							'icon' => 'fa fa-plus' 
					);
				}
				break;
			default :
			case 'view' :
				{
					
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
							'url' => array (
									'manage' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-wrench' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'update' ),
							'url' => array (
									'update',
									'id' => $model->id 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-edit' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'delete' ),
							'url' => '#',
							'linkOptions' => array (
									'submit' => array (
											'delete',
											'id' => $model->id 
									),
									'confirm' => Yii::t('app','Are you sure you want to delete this item?') 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-remove' 
					);
					// $this->menu[] = array('label'=>Yii::t('app', 'Add'), 'url'=>array('add'),'icon'=>'fa fa-plus');
				}
				break;
		}
		
		// Add SEO headers
		$this->processSEO ( $model );
		
		// merge actions with menu
		$this->actions = array_merge ( $this->actions, $this->menu );
	}
}
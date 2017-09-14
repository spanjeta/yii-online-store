<?php
class FeedController extends Controller {
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
								'userFeed',
								'message',
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
	public function actionMessage($id) {
		$time = date ( "Y-m-d H:i:s", strtotime ( "-1 minutes" ) );
		
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'project_id', $id );
		$criteria->compare ( 'model_type', 'Message' );
		$criteria->addCondition ( 'create_time >="' . $time . '" ' );
		$criteria->addCondition ( 'create_user_id !=' . Yii::app ()->user->id );
		$models = Feed::model ()->findAll ( $criteria );
		$count = count ( $models );
		
		$arr ['models'] = array ();
		if ($count > 0) {
			foreach ( $models as $model ) {
				$arr ['models'] = $this->loadModel ( $model->model_id, 'Message' )->content;
			}
		}
		
		$arr ['count'] = $count;
		$this->sendJSONResponse ( $arr );
	}
	public function actionUserFeed($id) {
		$dataProvider = null;
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'create_user_id ', $id );
		$dataProvider = new CActiveDataProvider ( 'Feed', array (
				'criteria' => $criteria 
		) );
		$this->render ( 'userfeed', array (
				'dataProvider' => $dataProvider,
				'id' => $id 
		) );
	}
	public function actionView($id) {
		$model = $this->loadModel ( $id, 'Feed' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		$this->updateMenuItems ( $model );
		$this->render ( 'view', array (
				'model' => $model 
		) );
	}
	public function actionAdd() {
		$model = new Feed ();
		
		$this->performAjaxValidation ( $model, 'feed-form' );
		
		if (isset ( $_POST ['Feed'] )) {
			$model->setAttributes ( $_POST ['Feed'] );
			
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
		$model = $this->loadModel ( $id, 'Feed' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		$this->performAjaxValidation ( $model, 'feed-form' );
		
		if (isset ( $_POST ['Feed'] )) {
			$model->setAttributes ( $_POST ['Feed'] );
			
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
		$model = $this->loadModel ( $id, 'Feed' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		/*
		 * if (Yii::app()->getRequest()->getIsPostRequest()) {
		 * $this->loadModel($id, 'Feed')->delete();
		 */
		$model->delete ();
		if (! Yii::app ()->getRequest ()->getIsAjaxRequest ())
			$this->redirect ( array (
					'index' 
			) );
		/*
		 * } else
		 * throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
		 */
	}
	public function actionIndex() {
		$model = new Feed ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Feed'] ))
			$model->setAttributes ( $_GET ['Feed'] );
		
		$this->render ( 'index', array (
				'model' => $model 
		) );
	}
	public function actionManage() {
		$model = new Feed ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Feed'] ))
			$model->setAttributes ( $_GET ['Feed'] );
		
		$this->render ( 'manage', array (
				'model' => $model 
		) );
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new Feed ();
		
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
									'confirm' => Yii::t('app','are you sure you want to delete this item?') 
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